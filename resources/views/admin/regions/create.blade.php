@extends('layouts.main')

@section('title', 'Tambah Data Wilayah')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Wilayah</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('regions.store') }}" method="POST" class="form form-horizontal">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="region_name">Nama Wilayah</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="region_name" class="form-control" name="region_name"
                                        placeholder="Nama Wilayah" required>
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
