<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Kelas;
use App\User;
use App\MataKuliah;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin.mahasiswa.index', ['mahasiswa' => $mahasiswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.mahasiswa.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_kelas' => $request->kelas
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->nim . '@mail.com',
            'password' => Hash::make($request->nim),
            'roles' => 'Mahasiswa'
        ]);

        return redirect('mahasiswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', '=', $nim)->first();
        return view('mahasiswa.biodata', ['mahasiswa' => $mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $kelas = Kelas::all();
        return view('admin.mahasiswa.edit', ['mahasiswa' => $mahasiswa, 'kelas' => $kelas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->no_telp = $request->no_telp;
        $mahasiswa->id_kelas = $request->kelas;
        $mahasiswa->save();
        return redirect('mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();
        return redirect('mahasiswa');
    }

    /**
     * Custom function for Mahasiswa
     */

    public function editBiodata($id) 
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('mahasiswa.edit', ['mahasiswa' => $mahasiswa]);
    }

    public function updateBiodata(Request $request, $id) 
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nama = $request->nama;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->no_telp = $request->no_telp;
        $mahasiswa->save();

        if ($request->file('photo') != null) {
            $user = User::find(Auth::user()->id);
            if($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
                \Storage::delete('public/'.$user->photo);
            }
            $image_name = $request->file('photo')->store('images', 'public');
            $user->photo = $image_name;
            $user->save();
        }

        return redirect('mahasiswa/biodata/' . $mahasiswa->nim);
    }
}
