<?php

namespace App\Http\Controllers;

use App\Models\Aspek;
use Illuminate\Http\Request;


class AspekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $aspeks = Aspek::all();

        return view('aspek.index', compact('aspeks'), [
        'title' => 'Aspek',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil kode_aspek terakhir dari database
        $lastAspek = Aspek::orderBy('id', 'desc')->first();
    
        if ($lastAspek) {
            // Ambil nomor dari kode_aspek terakhir, misalnya A1 menjadi 1
            $lastNumber = (int)substr($lastAspek->kode_aspek, 1);
            // Tambahkan 1 untuk kode aspek berikutnya
            $newNumber = $lastNumber + 1;
        } else {
            // Jika belum ada data, mulai dari 1
            $newNumber = 1;
        }
    
        // Gabungkan dengan prefix "A"
        $newKodeAspek = 'A' . $newNumber;
    
        return view('aspek.create', ['title' => 'Aspek', 'newKodeAspek' => $newKodeAspek]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //validasi input
         $request->validate([
            'kode_aspek' => 'required|unique:aspeks,kode_aspek',
            'nama_aspek' => 'required',
            'kategori' => 'required',

        ]);

        //Simpan data ke database
        Aspek::create($request->all());

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('aspek.index')->with('success', 'Aspek berhasil ditambahkan');
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
    public function edit(Aspek $aspek)
    {
        return view('aspek.edit', ['aspek' => $aspek, 'title' => 'Aspek']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aspek $aspek)
    {
        //validasi input
        // $request->validate([
        //     'kode_aspek' => 'required|unique:aspeks,kode_aspek,' . $aspek->id,
        //     'nama_aspek' => 'required',
        //     'persentase' => 'required|numeric|min:0|max:100',
        //     'kategori' => 'required',

        //     ]);

            //Update data di database
            $aspek->update($request->all());

            //Redirect ke halaman daftar mahasiswa
            return redirect()->route('aspek.index')->with('success', 'Aspek berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aspek $aspek)
    {
        $aspek->delete();

        //Redirect ke halaman daftar mahasiswa
        return redirect()->route('aspek.index')->with('success', 'Aspek berhasil dihapus');
    }
}
