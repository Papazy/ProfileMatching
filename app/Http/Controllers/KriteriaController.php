<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kriteria;
use App\Models\KriteriaDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriterias = Kriteria::query()
            ->join('aspeks', 'kriterias.kode_aspek', '=', 'aspeks.kode_aspek')
            ->select('kriterias.*', 'aspeks.nama_aspek')
            ->get(); // Mengambil hasil query setelah join
        // Select the necessary fields

        $data_aspek = DB::table('aspeks')->get();
        $data_dosen = DB::table('dosens')->get();

        $kriteria_dos = KriteriaDosen::query()
            ->join('dosens', 'kriteria_dos.dosen_id', '=', 'dosens.id')
            ->join('kriterias', 'kriteria_dos.kode_kriteria', '=', 'kriterias.kode_kriteria')
            ->select(
                'kriteria_dos.dosen_id',
                'kriteria_dos.kode_kriteria',
                'kriteria_dos.keterangan'
            )
            ->get()
            ->groupBy('dosen_id');
        // dd($kriteria_dos);   


        return view('kriteria.index', compact('kriterias', 'data_aspek', 'data_dosen', 'kriteria_dos'), [
            'title' => 'Kriteria',
        ]);
    }

    public function createkriteriados()
    {
        $data_kriteria = DB::table('kriterias')->get();

        $existingDosenIds = KriteriaDosen::pluck('dosen_id')->toArray();
        // Ambil semua dosen yang tidak ada di existingDosenIds
        $data_dosen = Dosen::whereNotIn('id', $existingDosenIds)->get();

        return view('kriteria.createkridosen', compact('data_kriteria', 'data_dosen'), [
            'title' => 'Kriteria Dosen',
        ]);
    }

    public function storekriteriados(Request $request)
    {
        // Validate the request
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'keterangan*' => 'required|string',
        ]);

        // Retrieve the number of kriteria
        $data_kriteria = DB::table('kriterias')->get();

        foreach ($data_kriteria as $index => $kri) {
            // Create a new KriteriaDosen entry
            KriteriaDosen::create([
                'dosen_id' => $request->dosen_id,
                'kode_kriteria' => $kri->kode_kriteria,
                'keterangan' => $request->input('keterangan' . ($index + 1)),
            ]);
        }

        return redirect()->route('kriteria.index')->with('success', 'Kriteria dosen berhasil disimpan');
    }

    public function editKriteriaDosen($dosen_id)
    {
        $data_kriteria = DB::table('kriterias')->get();
        $dosen = Dosen::find($dosen_id);

        // Mengambil data kriteria dosen berdasarkan dosen_id
        $kriteria_dosen = KriteriaDosen::where('dosen_id', $dosen_id)->get();

        return view('kriteria.editkriteriadosen', compact('data_kriteria', 'dosen', 'kriteria_dosen'), [
            'title' => 'Kriteria Dosen',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateKriteriaDosen(Request $request, $dosen_id)
    {
        // Validasi request
        // $request->validate([
        //     'dosen_id' => 'required|exists:dosens,id',
        //     'keterangan*' => 'required|string',
        // ]);

        // Ambil data kriteria dari database
        $data_kriteria = DB::table('kriterias')->get();

        foreach ($data_kriteria as $index => $kri) {
            // Update KriteriaDosen entry
            KriteriaDosen::where('dosen_id', $dosen_id)
                ->where('kode_kriteria', $kri->kode_kriteria)
                ->update([
                    'keterangan' => $request->input('keterangan' . ($index + 1)),
                ]);
        }

        return redirect()->route('kriteria.index')->with('success', 'Kriteria dosen berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteKriteriaDosen($dosen_id)
    {
        // Hapus semua kriteria dosen berdasarkan dosen_id
        KriteriaDosen::where('dosen_id', $dosen_id)->delete();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria dosen berhasil dihapus.');
    }

    public function create()
    {
        $data_aspek = DB::table('aspeks')->get();

        $lastKri = Kriteria::orderBy('id', 'desc')->first();

        if ($lastKri) {
            $lastNumber = (int)substr($lastKri->kode_kriteria, 1);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Gabungkan dengan prefix "A"
        $newKodeKri = 'K' . $newNumber;

        return view('kriteria.create', compact('data_aspek'), ['title' => 'Kriteria', 'newKodeKri' => $newKodeKri]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi input
        $request->validate([
            'kode_kriteria' => 'required|unique:kriterias,kode_kriteria',
            'kode_aspek' => 'required',
            'nama_kriteria' => 'required',
            'nilai' => 'required|integer',
        ]);

        //Simpan data ke database
        Kriteria::create($request->all());

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
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
    public function edit(Kriteria $kriteria)
    {
        $data_aspek = DB::table('aspeks')->get();

        return view('kriteria.edit',  compact('data_aspek'), ['kriteria' => $kriteria, 'title' => 'Kriteria']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        // Validasi input
        $request->validate([
            'kode_kriteria' => 'required|unique:kriterias,kode_kriteria,' . $kriteria->id,
            'kode_aspek' => 'required',
            'nama_kriteria' => 'required',
            'nilai' => 'required|integer',
        ]);

        // Update data di database
        $kriteria->update($request->all());

        // Redirect ke halaman daftar kriteria
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();

        //Redirect ke halaman daftar mahasiswa
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus');
    }
}
