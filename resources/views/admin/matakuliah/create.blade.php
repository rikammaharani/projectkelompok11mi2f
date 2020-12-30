@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Mata Kuliah Baru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('matkul') }}">Data Mata Kuliah</a></li>
              <li class="breadcrumb-item active">Tambah Mata Kuliah Baru</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <form role="form" action="{{ route('storeMatkul') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_matkul">Nama Mata Kuliah</label>
                    <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" placeholder="Nama Mata Kuliah" required>
                  </div>
                  <div class="form-group">
                    <label for="sks">Jumlah SKS</label>
                    <input type="number" class="form-control" id="sks" name="sks" placeholder="Ex. 2" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary mr-1">Submit</button>
                  <a href="{{ route('matkul') }}" class="btn btn-default">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection