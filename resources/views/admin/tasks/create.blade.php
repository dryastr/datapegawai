@extends('layouts.main')

@section('title', 'Tambah Data Tugas')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Tugas</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="POST" class="form form-horizontal">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="ticket">Ticket</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="ticket" class="form-control" name="ticket"
                                        value="{{ old('ticket', $ticket) }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="region_id">Wilayah</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select id="region_id" class="form-control" name="region_id" required>
                                        <option value="">Pilih Wilayah</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="user_id">Pilih Karyawan</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select id="user_id" class="form-control" name="user_id" required>
                                        <option value="">Pilih Karyawan</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="task_title">Judul Tugas</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="task_title" class="form-control" name="task_title"
                                        placeholder="Judul Tugas" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="task_schedule">Jadwal Tugas</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="datetime-local" id="task_schedule" class="form-control"
                                        name="task_schedule" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="ticket_schedule" class="d-none">Jadwal Ticket</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="datetime-local" id="ticket_schedule" class="d-none form-control"
                                        name="ticket_schedule">
                                </div>

                                <div class="col-md-4">
                                    <label for="task_detail">Detail Tugas</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea id="task_detail" class="form-control" name="task_detail" placeholder="Detail Tugas" rows="4" required></textarea>
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
