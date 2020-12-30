<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\MataKuliah;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
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
        $dosen = Dosen::all();
        return view('admin.dosen.index', ['dosen' => $dosen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matkul = MataKuliah::all();
        return view('admin.dosen.create', ['matkul' => $matkul]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Dosen::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_matkul' => $request->matkul
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->nip . '@mail.com',
            'password' => Hash::make($request->nip),
            'roles' => 'Dosen'
        ]);

        return redirect('dosen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show($nip)
    {
        $dosen = Dosen::where('nip', '=', $nip)->first();
        return view('dosen.biodata', ['dosen' => $dosen]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dosen = Dosen::find($id);
        $matkul = MataKuliah::all();
        return view('admin.dosen.edit', ['dosen' => $dosen, 'matkul' => $matkul]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dosen = Dosen::find($id);
        $dosen->nip = $request->nip;
        $dosen->nama = $request->nama;
        $dosen->jenis_kelamin = $request->jenis_kelamin;
        $dosen->alamat = $request->alamat;
        $dosen->no_telp = $request->no_telp;
        $dosen->id_matkul = $request->matkul;
        $dosen->save();
        return redirect('dosen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::find($id);
        $dosen->delete();
        return redirect('dosen');
    }

    /**
     * Custom function for Dosen
     */

    public function editBiodata($id) 
    {
        $dosen = Dosen::find($id);
        return view('dosen.editBiodata', ['dosen' => $dosen]);
    }

    public function updateBiodata(Request $request, $id) 
    {
        $dosen = Dosen::find($id);
        $dosen->nama = $request->nama;
        $dosen->jenis_kelamin = $request->jenis_kelamin;
        $dosen->alamat = $request->alamat;
        $dosen->no_telp = $request->no_telp;
        $dosen->save();

        if ($request->file('photo') != null) {
            $user = User::find(Auth::user()->id);
            if($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
                \Storage::delete('public/'.$user->photo);
            }
            $image_name = $request->file('photo')->store('images', 'public');
            $user->photo = $image_name;
            $user->save();
        }

        return redirect('dosen/biodata/' . $dosen->nip);
    }
}
