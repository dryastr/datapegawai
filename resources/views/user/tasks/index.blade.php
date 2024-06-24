@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="page-heading">
            <h3>Statistik Karyawan</h3>
        </div>

        <!-- User List start -->
        <section class="section">
            <div class="row" id="user-list">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title">Daftar Tugas</h4>
                                <div class="d-fllex">

                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>Kode Tiket</th>
                                                <th>Wilayah</th>
                                                <th>Judul Tugas</th>
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
                                                    <td>{{ $task->ticket }}</td>
                                                    <td>{{ $task->region->region_name }}</td>
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
                                                            <button class="btn btn-sm btn-secondary dropdown-toggle"
                                                                type="button" id="dropdownMenuButton-{{ $task->id }}"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton-{{ $task->id }}">
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('tasks-user.show', $task->id) }}">Detail</a>
                                                                </li>
                                                                @if ($task->status == 'accepted')
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('tasks-user.complete', $task->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="dropdown-item"
                                                                                onclick="return confirm('Apakah Anda yakin ingin menyelesaikan tugas ini?')">Selesai</button>
                                                                        </form>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('tasks-user.accept', $task->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="dropdown-item"
                                                                                onclick="return confirm('Apakah Anda yakin ingin menerima tugas ini?')">Terima</button>
                                                                        </form>
                                                                    </li>
                                                                    <li>
                                                                        <form
                                                                            action="{{ route('tasks-user.reject', $task->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="dropdown-item"
                                                                                onclick="return confirm('Apakah Anda yakin ingin menolak tugas ini?')">Tolak</button>
                                                                        </form>
                                                                    </li>
                                                                @endif
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
        </section>
        <!-- User List end -->
    </div>

@endsection
