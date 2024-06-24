@extends('layouts.main')

@section('title', 'Daftar Laporan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Laporan</h4>
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
                                        <th>Detail Laporan</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $report->task->ticket }}</td>
                                            <td>{{ $report->task->task_title }}</td>
                                            <td>{{ Str::limit($report->report_detail, 50, '...') }}</td>
                                            <td>{{ $report->created_at }}</td>
                                            @if ($report->task->status == 'accepted')
                                                <td><span class="text-white btn btn-warning">Process</span></td>
                                            @elseif($report->task->status == 'pending')
                                                <td><span class="text-white btn btn-secondary">Pending</span></td>
                                            @elseif($report->task->status == 'completed')
                                                <td><span class="text-white btn btn-success">Done</span></td>
                                            @else
                                                <td><span class="text-white btn btn-danger">Rejected</span></td>
                                            @endif
                                            <td class="text-nowrap">
                                                <div class="dropdown dropup">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton-{{ $report->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton-{{ $report->id }}">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('reports-user.edit', $report->id) }}">Ubah</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('reports-user.destroy', $report->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
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
