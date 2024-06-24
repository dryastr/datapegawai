@extends('layouts.main')

@section('title', 'Edit Data Tugas')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Tugas</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="form form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="ticket">Ticket</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="ticket" class="form-control" name="ticket"
                                        value="{{ $task->ticket }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="region_id">Wilayah</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select id="region_id" class="form-control" name="region_id" required>
                                        <option value="">Pilih Wilayah</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}"
                                                {{ $task->region_id == $region->id ? 'selected' : '' }}>
                                                {{ $region->region_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="user_id">Pilih User</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select id="user_id" class="form-control" name="user_id" required>
                                        <option value="">Pilih User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $task->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="task_title">Judul Tugas</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="task_title" class="form-control" name="task_title"
                                        placeholder="Judul Tugas" value="{{ $task->task_title }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="task_schedule">Jadwal Tugas</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="datetime-local" id="task_schedule" class="form-control"
                                        name="task_schedule"
                                        value="{{ \Carbon\Carbon::parse($task->task_schedule)->format('Y-m-d\TH:i') }}"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label for="ticket_schedule">Jadwal Ticket</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="datetime-local" id="ticket_schedule" class="form-control"
                                        name="ticket_schedule"
                                        value="{{ \Carbon\Carbon::parse($task->ticket_schedule)->format('Y-m-d\TH:i') }}"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label for="task_detail">Detail Tugas</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea id="task_detail" class="form-control" name="task_detail" placeholder="Detail Tugas" rows="4" required>{{ $task->task_detail }}</textarea>
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <a href="{{ route('tasks.index') }}"
                                        class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
