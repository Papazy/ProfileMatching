<?php

namespace App\Http\Controllers;

use App\Models\PengajuanJudul;
use Illuminate\Http\Request;
use App\Models\DashboardMahasiswa;
use App\Models\DashboardDosen;
use App\Models\Kriteria;
use App\Models\Dosen;
use App\Models\Kategori;
use App\Models\NilaiProfile;
use App\Models\SubcategoryRelation;
use Illuminate\Support\Facades\DB;

class MahasiswaPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mahasiswa_id = auth()->user()->id;
        // $pengajuanJuduls = PengajuanJudul::where('mahasiswa_id', $mahasiswa_id)->get();
        $pengajuanJuduls = PengajuanJudul::where('mahasiswa_id', $mahasiswa_id)->get();
        $data_pengajuan = PengajuanJudul::query()
            ->join('mahasiswas', 'pengajuan_juduls.mahasiswa_id', '=', 'mahasiswas.id')
            ->leftJoin('dosens as dosen_pembimbing_1', 'pengajuan_juduls.dospem_1', '=', 'dosen_pembimbing_1.id')
            ->leftJoin('dosens as dosen_pembimbing_2', 'pengajuan_juduls.dospem_2', '=', 'dosen_pembimbing_2.id')
            ->where('pengajuan_juduls.mahasiswa_id', $mahasiswa_id)
            ->select(
                'pengajuan_juduls.*',
                'mahasiswas.*',
                'pengajuan_juduls.id as id_pengajuan',
                'dosen_pembimbing_1.nama_dosen as nama_dosen_1',
                'dosen_pembimbing_2.nama_dosen as nama_dosen_2'
            )->get();
        // dd($data_pengajuan);

        return view('mahasiswa.pengajuan', compact('pengajuanJuduls', 'data_pengajuan'), [
            'title' => 'Pengajuan Judul',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // menampilkan form pengajuan judul
    public function create()
    {
        $data_dosen = DB::table('dosens')->get();
        $data_mahasiswa = DB::table('mahasiswas')->get();
        return view('mahasiswa.pengajuanjudul', [
            'data_dosen' => $data_dosen,
            'data_mahasiswa' => $data_mahasiswa,
            'title' => 'Pengajuan Judul'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    //menyimpan data pengajuan judul
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
        ]);
        $mahasiswa_id = auth()->user()->user_id;

        $kategori_1 = $request->kategori_1;
        $kategori_2 = $request->kategori_2;
        $kategori_3 = $request->kategori_3;
        $kategori_4 = $request->kategori_4;
        $kategori_5 = $request->kategori_5;

        $kategori_id[1] = Kategori::where('id', $kategori_1)->first();
        $kategori_id[2] = Kategori::where('id', $kategori_2)->first();
        $kategori_id[3] = Kategori::where('id', $kategori_3)->first();
        $kategori_id[4] = Kategori::where('id', $kategori_4)->first();
        $kategori_id[5] = Kategori::where('id', $kategori_5)->first();

        $jumlah_kategori[1] = Kategori::where('kategori', 'Kategori 1')->get()->count();
        $jumlah_kategori[2] = Kategori::where('kategori', 'Kategori 2')->get()->count();
        $jumlah_kategori[3] = Kategori::where('kategori', 'Kategori 3')->get()->count();
        $jumlah_kategori[4] = Kategori::where('kategori', 'Kategori 4')->get()->count();

        $kelompok_kategori[1] = 'Kategori 1';
        $kelompok_kategori[2] = 'Kategori 2';
        $kelompok_kategori[3] = 'Kategori 3';
        $kelompok_kategori[4] = 'Kategori 4';

        $all_dosen = Dosen::all();
        $nilai_dosen = [];
        $nilai_semua_kriteria = [];
        foreach ($all_dosen as $dosen) {
            $nilai = 0;
            $dosen_all_kategori = DB::table('dosen_kategori')->where('dosen_id', $dosen->id)->get();
            for ($i = 1; $i <= 4; $i++) {

                $this->debug_to_console("kategori : " . $i);
                $this->debug_to_console("kategori id: " . $kategori_id[$i]->id);
                $nilai_max = 0;
                foreach ($dosen_all_kategori as $kategori) {
                    $kelompok = Kategori::where('id', $kategori->kategori_id)->first();
                    $this->debug_to_console("kelompok : " . $kelompok->kategori . " kategori : " . $kelompok_kategori[$i]);
                    if ($kelompok->kategori == $kelompok_kategori[$i]) {
                        $this->debug_to_console("masuk");
                        $nilai = SubcategoryRelation::where('subcategory1_id', $kategori->kategori_id)->where('subcategory2_id', $kategori_id[$i]->id)->first();
                        // $this->debug_to_console($nilai);

                        // $this->debug_to_console('kategori request: ' . $kategori_id[$i]->id . ' kategori dosen: ' . $kategori->kategori_id . ' nilai: ' . $nilai->sc);
                        if ($nilai != null && $nilai->score > $nilai_max) {
                            $nilai_max = $nilai->score;
                        }
                    }
                }
                $nilai_semua_kriteria[$i] = $nilai_max;
                $this->debug_to_console('dosen : ' . $dosen->id . ', kriteria : ' . $i . ', nilai max: ' . $nilai_max);
                // dd($nilai_max);
                // $nilai_sementara = SubcategoryRelation::where('subcategory1_id', $dosen->id)->where('kategori_id', $i)->first()->nilai;
                // $nilai_max += $nilai_sementara;
            }
            $nilai_semua_kriteria[5] = 3;
            $nilai_dosen[$dosen->id] = $nilai_semua_kriteria;
        }

        $kriteriaCodes = ['1', '2', '3', '4', '5']; // Contoh kode kriteria (misal K1, K2, dst.)


        // dd($mahasiswa_id);
        $nilai_kriteria_dosen = Kriteria::all();
        // dd($nilai_kriteria_dosen[0]->nilai);
        foreach ($nilai_dosen as $dosen_id => $kriteria_nilai) {
            foreach ($kriteria_nilai as $index => $nilai) {
                // Simpan nilai profile dosen
                NilaiProfile::create([
                    'mahasiswa_id' => $mahasiswa_id,
                    'dosen_id' => $dosen_id,
                    'kode_kriteria' => 'K' . $kriteriaCodes[$index - 1], // Sesuaikan kode kriteria (K1, K2, dst.)
                    'nilai_kriteria' => $nilai_kriteria_dosen[$index-1]->nilai,
                    'nilai_kesesuaian' => $nilai, // sama dengan nilai kriteria, bisa dimodifikasi sesuai kebutuhan
                ]);
            }
        }

        // Menyimpan pengajuan judul
        PengajuanJudul::create([
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $request->dosen_id,
            'judul' => $request->judul,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
        ]);
        return redirect()->route('mahasiswa.pengajuanjudul')->with('success', 'Pengajuan judul berhasil disimpan');
    }
    public function edit(string $id)
    {
        $pengajuanJudul = PengajuanJudul::findOrFail($id);
        // dd($pengajuanJudul);
        $data_dosen = DB::table('dosens')->get();
        return view('mahasiswa.editpengajuan', compact('pengajuanJudul', 'data_dosen'))->with('title', 'Pengajuan Judul');
    }

    // memperbarui data pengajuan judul
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'dosen_id' => 'required',
        ]);

        $pengajuanJudul = PengajuanJudul::findOrFail($id);
        $pengajuanJudul->update([
            'judul' => $request->judul,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'dosen_id' => $request->dosen_id,
        ]);

        return redirect()->route('mahasiswa.pengajuanjudul')->with('success', 'Pengajuan judul berhasil diperbaharui');
    }

    // menghapus data pengajuan judul
    public function destroy(string $id)
    {
        $pengajuanJudul = PengajuanJudul::findOrFail($id);
        $pengajuanJudul->delete();

        return redirect()->route('mahasiswa.pengajuanjudul')->with('success', 'Pengajuan judul berhasil dihapus');
    }

    public function show($id)
    {
        $pengajuan = PengajuanJudul::findorFail($id);

        // Cek apakah pengajuan judul ditemukan
        if (!$pengajuan) {
            return redirect()->route('dosen.dashboarddosen')->with('error', 'Pengajuan judul tidak ditemukan');
        }

        return view('dosen.pemilihanjudul', compact('pengajuan'))->with('title', 'Pemilihan Judul');
    }

    function debug_to_console($data)
    {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
}
