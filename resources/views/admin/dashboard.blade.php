@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="page-heading">
            <h3>Dashboard</h3>
            <p>Selamat datang, {{ $user->name }}</p>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <h6 class="text-muted font-semibold">Selesai</h6>
                            <h6 class="font-extrabold mb-0">{{ $completedCount }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <h6 class="text-muted font-semibold">Dalam Pengerjaan</h6>
                            <h6 class="font-extrabold mb-0">{{ $processCount }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <h6 class="text-muted font-semibold">Ditolak</h6>
                            <h6 class="font-extrabold mb-0">{{ $rejectedCount }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <h6 class="text-muted font-semibold">Belum Dikerjakan</h6>
                            <h6 class="font-extrabold mb-0">{{ $pendingCount }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
