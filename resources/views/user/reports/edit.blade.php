@extends('layouts.main')

@section('title', 'Edit Laporan')

@section('content')
    <div class="row">
        <div class="page-heading">
            <h3>Edit Laporan untuk Tugas: {{ $report->task->task_title }}</h3>
        </div>

        <section class="section">
            <div class="row" id="report-edit">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Edit Laporan</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('reports-user.update', $report->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="report_detail">Detail Laporan</label>
                                        <textarea name="report_detail" id="report_detail" class="form-control" rows="5" required>{{ $report->report_detail }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="{{ route('reports-user-all.all-reports') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
