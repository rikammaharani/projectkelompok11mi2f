@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Dosen</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('dosen') }}">Data Dosen</a></li>
              <li class="breadcrumb-item active">Edit Dosen</li>
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
              <form role="form" action="{{ route('updateDosen', $dosen->id) }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" value="{{ $dosen->nip }}">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="{{ $dosen->nama }}">
                  </div>
                  <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <div class="d-flex">
                        <div class="custom-control custom-radio mr-3">
                          <input class="custom-control-input" type="radio" id="laki-laki" name="jenis_kelamin" value="L" {{ $dosen->jenis_kelamin == 'L' ? 'checked' : ''}}>
                          <label for="laki-laki" class="custom-control-label">Laki - Laki</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="perempuan" name="jenis_kelamin" value="P" {{ $dosen->jenis_kelamin == 'P' ? 'checked' : ''}}>
                          <label for="perempuan" class="custom-control-label">Perempuan</label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <textarea class="form-control" name="alamat" id="alamat" rows="3">{{ $dosen->alamat }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="no_telp">No. Telp</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="08xxxxxxxxxx" value="{{ $dosen->no_telp }}">
                  </div>
                  <div class="form-group">
                    <label for="matkul">Mata Kuliah</label>
                    <select class="form-control select2bs4" name="matkul" id="matkul" style="width: 100%;">
                      @foreach ($matkul as $item)
                        <option value="{{ $item->id }}" {{ $dosen->id_matkul == $item->id ? 'selected' : '' }}>{{ $item->nama_matkul }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary mr-1">Submit</button>
                  <a href="{{ route('dosen') }}" class="btn btn-default">Cancel</a>
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