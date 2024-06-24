@extends('layouts.main')

@section('title', 'Buat Laporan')

@section('content')
    <div class="row">
        <div class="page-heading">
            <h3>Buat Laporan untuk Tugas: {{ $task->task_title }}</h3>
        </div>

        <section class="section">
            <div class="row" id="report-create">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Buat Laporan</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('reports-user.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    <div class="form-group">
                                        <label for="report_detail">Detail Laporan</label>
                                        <textarea name="report_detail" id="report_detail" class="form-control" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
