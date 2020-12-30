<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MataKuliahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next) {
            if(Gate::allows('administrator')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matkul = MataKuliah::all();
        return view('admin.matakuliah.index', ['matkul' => $matkul]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.matakuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MataKuliah::create([
            'nama_matkul' => $request->nama_matkul,
            'sks' => $request->sks,
        ]);
        return redirect('matkul');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function show(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matkul = MataKuliah::find($id);
        return view('admin.matakuliah.edit', ['matkul' => $matkul]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $matkul = MataKuliah::find($id);
        $matkul->nama_matkul = $request->nama_matkul;
        $matkul->sks = $request->sks;
        $matkul->save();
        return redirect('matkul');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matkul = MataKuliah::find($id);
        $matkul->delete();
        return redirect('matkul');
    }
}
