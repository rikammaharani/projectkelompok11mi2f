@extends('layouts.master')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Nilai Mahasiswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Nilai Mahasiswa</li>
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
              <div class="card-header">
                <a href="{{ route('cetakKHS') }}" target="_blank" class="btn btn-primary btn-sm">CETAK KHS</a>
              </div>
              <div class="card-body table-responsive p-0">
                  <table class="table text-nowrap">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Nilai Setara</th>
                        <th>Nilai Huruf</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $sks = 0;
                          $total = 0;
                      @endphp
                      @foreach ($penilaian as $key => $item)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->matkul->nama_matkul }}</td>
                            <td>{{ $item->matkul->sks }}</td>
                            <td>{{ $item->nilai_setara }}</td>
                            <td>{{ $item->nilai_huruf }}</td>
                          </tr>
                          @php
                              $sks += $item->matkul->sks;
                              $total += $item->nilai_setara * $item->matkul->sks;
                          @endphp
                      @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6">Indeks Prestasi Semester : {{ number_format($total / $sks, 2, '.', '') }}</th>
                        </tr>
                    </tfoot>
                  </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection