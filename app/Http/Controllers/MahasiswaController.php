<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PengajuanJudul;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::all();




        return view('mahasiswa.index', compact('mahasiswas'), [
            'title' => 'Mahasiswa',
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create', ['title' => 'Mahasiswa']);
    }



    /**nga
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama_mahasiswa' => 'required',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'no_hp' => 'required',
        ]);

        // Buat data mahasiswa
        $data = $request->all();

        // Tambahkan password sesuai dengan nim dan hash password tersebut
        $data['password'] = bcrypt($data['nim']);
        $data['role_id'] = '2';

        // dd($data);
        // Simpan data ke database
        Mahasiswa::create($data);

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', ['mahasiswa' => $mahasiswa, 'title' => 'Mahasiswa']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // Validasi input
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama_mahasiswa' => 'required',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'no_hp' => 'required',
        ]);

        $data = $request->all();

        // Tambahkan password sesuai dengan nim dan hash password tersebut
        $data['password'] = bcrypt($data['nim']);
        $data['role_id'] = '2';

        $mahasiswa->update($data);

        // Redirect ke halaman daftar mahasiswa
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {

        $mahasiswa->delete();

        // Redirect ke halaman daftar mahasiswa
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function dashboard()
    {
        $mahasiswas = Mahasiswa::all();

        return view('mahasiswa.dashboardmahasiswa', compact('mahasiswas'));
    }
}
