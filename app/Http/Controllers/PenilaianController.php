<?php

namespace App\Http\Controllers;

use App\Penilaian;
use App\Dosen;
use App\Mahasiswa;
use App\MataKuliah;
use Auth;
use Illuminate\Http\Request;
use DB;
use PDF;

class PenilaianController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function id() {
        $id = str_replace('@mail.com', '', Auth::user()->email);
        return $id;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDosen()
    {
        $dosen = Dosen::where('nip', '=', $this->id())->first();
        $penilaian = Penilaian::where('id_matkul', '=', $dosen->id_matkul)->get();
        return view('dosen.penilaian', ['dosen' => $dosen, 'penilaian' => $penilaian]);
    }

    public function indexMahasiswa()
    {
        $mahasiswa = Mahasiswa::where('nim', '=', $this->id())->first();
        $penilaian = Penilaian::where('id_mahasiswa', '=', $mahasiswa->id)->get();
        return view('mahasiswa.nilai', ['penilaian' => $penilaian]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_matkul)
    {
        $mahasiswa = Mahasiswa::all();
        return view('dosen.createPenilaian', ['mahasiswa' => $mahasiswa, 'id_matkul' => $id_matkul]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nilaiSetara = $this->nilaiSetara($request->nilai);
        $nilaiHuruf = $this->nilaiHuruf($nilaiSetara);
        Penilaian::create([
            'id_mahasiswa' => $request->mahasiswa,
            'id_matkul' => $request->id_matkul,
            'nilai' => $request->nilai,
            'nilai_setara' => $nilaiSetara,
            'nilai_huruf' => $nilaiHuruf
        ]);
        return redirect('penilaian/penilaian/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(Penilaian $penilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penilaian = Penilaian::find($id);
        $mahasiswa = Mahasiswa::all();
        return view('dosen.editPenilaian', ['penilaian' => $penilaian, 'mahasiswa' => $mahasiswa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nilaiSetara = $this->nilaiSetara($request->nilai);
        $nilaiHuruf = $this->nilaiHuruf($nilaiSetara);

        $penilaian = Penilaian::find($id);
        $penilaian->id_mahasiswa = $request->mahasiswa;
        $penilaian->nilai = $request->nilai;
        $penilaian->nilai_setara = $nilaiSetara;
        $penilaian->nilai_huruf = $nilaiHuruf;
        $penilaian->save();
        
        return redirect('penilaian/penilaian/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penilaian = Penilaian::find($id);
        $penilaian->delete();
        return redirect('penilaian/penilaian/');
    }

    /**
     * Custom function for Penilaian
     */

    public function nilaiSetara($nilai) {
        if ($nilai > 80 && $nilai <= 100) {
            return 4;
        } else if ($nilai > 73 && $nilai <= 80) {
            return 3.5;
        } else if ($nilai > 65 && $nilai <= 73) {
            return 3;
        } else if ($nilai > 60 && $nilai <= 65) {
            return 2.5;
        } else if ($nilai > 50 && $nilai <= 60) {
            return 2;
        } else if ($nilai > 39 && $nilai <= 50) {
            return 1;
        } else {
            return 0;
        }
    }

    public function nilaiHuruf($nilaiSetara) {
        if ($nilaiSetara == 4)
            return 'A';
        else if ($nilaiSetara == 3.5)
            return 'B+';
        else if ($nilaiSetara == 3)
            return 'B';
        else if ($nilaiSetara == 2.5)
            return 'C+';
        else if ($nilaiSetara == 2)
            return 'C';
        else if ($nilaiSetara == 1)
            return 'D';
        else
            return 'E';
    }

    public function khs() {
        $mahasiswa = Mahasiswa::where('nim', '=', $this->id())->first();
        $penilaian = Penilaian::where('id_mahasiswa', '=', $mahasiswa->id)->get();
        $pdf = PDF::loadview('mahasiswa.khs', ['mahasiswa' => $mahasiswa, 'penilaian' => $penilaian]);
        return $pdf->stream();

    }
}
