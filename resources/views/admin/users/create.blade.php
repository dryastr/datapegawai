@extends('layouts.main')

@section('title', 'Tambah Pengguna Baru')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Karyawan Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="role_id" class="d-none form-label">Nama</label>
                            <input type="hidden" class="form-control" id="role_id" name="role_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="users_uniq_code" class="form-label">ID Karyawan</label>
                            <input type="text" class="form-control" id="users_uniq_code" name="users_uniq_code"
                                value="{{ $users_uniq_code }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="telegram_id" class="form-label">ID Telegram</label>
                            <input type="text" class="form-control" id="telegram_id" name="telegram_id">
                        </div>
                        <div class="mb-3">
                            <label for="region_id" class="form-label">Wilayah</label>
                            <select class="form-select" id="region_id" name="region_id" required>
                                <option selected disabled>Pilih Wilayah</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <label id="password-warning" class="form-label text-muted mt-1">Password minimal 8
                                karakter</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const warningLabel = document.getElementById('password-warning');

            if (password.length === 0) {
                warningLabel.textContent = 'Password minimal 8 karakter';
                warningLabel.classList.remove('text-success', 'text-danger');
                warningLabel.classList.add('text-muted');
            } else if (password.length < 8) {
                warningLabel.textContent = 'Password minimal 8 karakter';
                warningLabel.classList.remove('text-success', 'text-muted');
                warningLabel.classList.add('text-danger');
            } else {
                warningLabel.textContent = 'Password aman';
                warningLabel.classList.remove('text-danger', 'text-muted');
                warningLabel.classList.add('text-success');
            }
        });
    </script>
@endsection
