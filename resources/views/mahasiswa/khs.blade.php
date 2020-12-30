<!DOCTYPE html>
<html>
    <head>
        <title>Kartu Hasil Studi</title>
        <style>

            * {
                font-family: Arial, Helvetica, sans-serif;
            }

            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
                color: inherit;
                font-size: 1.5rem;
            }
            
            .pr-5, .px-5 {
                padding-right: 3rem !important;
            }

            table {
                border-collapse: collapse;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
                background-color: transparent;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
                text-align: left;
                font-size: 16px;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }

            .table tbody + tbody {
                border-top: 2px solid #dee2e6;
            }

            .table {
                border-collapse: collapse !important;
            }
            
            .table td,
            .table th {
                background-color: #ffffff !important;
            }

            .table-bordered {
                border: 1px solid #dee2e6;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #dee2e6;
            }

            .table-bordered thead th,
            .table-bordered thead td {
                border-bottom-width: 2px;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #dee2e6 !important;
            }
        </style>
    </head>

    <body>
        <center>
            <h4>KARTU HASIL STUDI</h4>
            <h4>(KHS)</h4>
        </center>
        <table>
            <tr>
                <td class="pr-5">NAMA MAHASISWA</td>
                <td>:</td>
                <td>{{ $mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td class="pr-5">NIM</td>
                <td>:</td>
                <td>{{ $mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td class="pr-5">TINGKAT/KELAS</td>
                <td>:</td>
                <td>{{ $mahasiswa->kelas->tingkatan . "/" . $mahasiswa->kelas->nama_kelas }}</td>
            </tr>
        </table>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th style="width: 10px">NO</th>
                    <th>MATA KULIAH</th>
                    <th>NILAI SETARA</th>
                    <th>NILAI HURUF</th>
                    <th>SKS</th>
                    <th>N x SKS</th>
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
                        <td>{{ $item->nilai_setara }}</td>
                        <td>{{ $item->nilai_huruf }}</td>
                        <td>{{ $item->matkul->sks }}</td>
                        <td>{{ $item->nilai_setara * $item->matkul->sks }}</td>
                    </tr>
                    @php
                        $sks += $item->matkul->sks;
                        $total += $item->nilai_setara * $item->matkul->sks;
                    @endphp
                @endforeach
                <tr>
                    <th colspan="4">JUMLAH</th>
                    <th>{{ $sks }}</th>
                    <th>{{ $total }}</th>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6">Indeks Prestasi Semester : {{ number_format($total / $sks, 2, '.', '') }}</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
