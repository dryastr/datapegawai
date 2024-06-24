@extends('layouts.main')

@section('title', 'Detail Tugas')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Tugas</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Kode Tiket:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $task->ticket }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Wilayah:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $task->region->region_name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Karyawan:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $task->user->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Judul Tugas:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $task->task_title }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Jadwal Tugas:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $task->task_schedule }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Jadwal Ticket:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $task->ticket_schedule }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Detail Tugas:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $task->task_detail }}
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 d-flex justify-content-end">
                            <a href="{{ route('tasks-user.index') }}" class="btn btn-light-secondary me-1">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
