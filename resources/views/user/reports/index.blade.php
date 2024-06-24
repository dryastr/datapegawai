@extends('layouts.main')

@section('title', 'Daftar Tugas')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Tugas</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Tiket</th>
                                        <th>Judul Tugas</th>
                                        <th>Status</th>
                                        <th>Jadwal Tugas</th>
                                        <th>Jadwal Tiket</th>
                                        <th>Detail Tugas</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $task->ticket }}</td>
                                            <td>{{ $task->task_title }}</td>
                                            <td>{{ $task->status }}</td>
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
                                                        <li><a href="{{ route('reports-user.create', $task->id) }}"
                                                                class="dropdown-item">Buat Laporan</a></li>
                                                        <li>
                                                            <form action="{{ route('reports-user.cancel', $task->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin membatalkan tugas ini?')">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">Batal</button>
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
