@extends('layouts.main')

@section('title', 'Daftar Tugas')

@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Daftar Tugas</h4>
                        <a href="{{ route('tasks.create') }}" class="btn btn-success btn-sm ms-auto">Tambah Tugas</a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="TableTasks" class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>Kode Tiket</th>
                                        <th>Wilayah</th>
                                        <th>Karyawan</th>
                                        <th>Judul Tugas</th>
                                        <th>Jadwal Tugas</th>
                                        <th>Jadwal Ticket</th>
                                        <th>Detail Tugas</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $task->ticket }}</td>
                                            <td>{{ $task->region->region_name }}</td>
                                            <td>{{ $task->user->name }}</td>
                                            <td>{{ $task->task_title }}</td>
                                            <td>{{ $task->task_schedule }}</td>
                                            <td>{{ $task->ticket_schedule }}</td>
                                            <td>{{ Str::limit($task->task_detail, 30, '...') }}</td>
                                            @if ($task->status == 'accepted')
                                                <td><span class="text-white btn btn-warning">Process</span></td>
                                            @elseif($task->status == 'pending')
                                                <td><span class="text-white btn btn-secondary">Pending</span></td>
                                            @elseif($task->status == 'completed')
                                                <td><span class="text-white btn btn-success">Done</span></td>
                                            @else
                                                <td><span class="text-white btn btn-danger">Rejected</span></td>
                                            @endif
                                            <td class="text-nowrap">
                                                <div class="dropdown dropup">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton-{{ $task->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton-{{ $task->id }}">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('tasks.show', $task->id) }}">Detail</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('tasks.edit', $task->id) }}">Ubah</a></li>
                                                        <li>
                                                            <form action="{{ route('tasks.destroy', $task->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan buku ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item">Hapus</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
