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
                                            <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                            @if ($report->task->status == 'accepted')
                                                <td><span class="text-white btn btn-warning">Process</span></td>
                                            @elseif($report->task->status == 'pending')
                                                <td><span class="text-white btn btn-secondary">Pending</span></td>
                                            @elseif($report->task->status == 'completed')
                                                <td><span class="text-white btn btn-success">Done</span></td>
                                            @else
                                                <td><span class="text-white btn btn-danger">Rejected</span></td>
                                            @endif
                                            <td>
                                                <a href="{{ route('reports.show', $report->id) }}"
                                                    class="btn btn-sm btn-primary">Detail</a>
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
