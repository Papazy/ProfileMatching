<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnArgument;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dosens = Dosen::all();

     

        return view('dosen.index', compact('dosens'), [
            'title' => 'Dosen',
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create',['title' => 'Dosen']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi input
        $request->validate([
            'nidn' => 'required|unique:dosens,nidn',
            'nama_dosen' => 'required',
            'no_hp' => 'required'
        ]);

        $data = $request->all();

        // Tambahkan password sesuai dengan nim dan hash password tersebut
        $data['password'] = bcrypt($data['nidn']);
        $data['role_id'] = '3';

        //Simpan data ke database
        Dosen::create($data);

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
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
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', ['dosen' => $dosen, 'title' => 'Dosen']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        //validasi input
        $request->validate([
            'nidn' => 'required|unique:dosens,nidn,' . $dosen->id,
            'nama_dosen' => 'required',
            'no_hp' => 'required'
        ]);
        
            $data = $request->all();

            // Tambahkan password sesuai dengan nim dan hash password tersebut
            $data['password'] = bcrypt($data['nidn']);
            $data['role_id'] = '3';

            //Update data di database
            $dosen->update($data);

            //Redirect ke halaman daftar mahasiswa
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        //Redirect ke halaman daftar mahasiswa
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
    }
}