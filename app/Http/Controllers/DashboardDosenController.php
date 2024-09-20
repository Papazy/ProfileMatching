<?php

namespace App\Http\Controllers;

use App\Models\PengajuanJudul;
use Illuminate\Http\Request;

class DashboardDosenController extends Controller
{
    public function index()
    {
        $dosen_id = auth()->user()->id;
        $data_pengajuan = PengajuanJudul::query()
        ->join('dosens', 'pengajuan_juduls.dosen_id', '=', 'dosens.id')
        ->join('mahasiswas', 'pengajuan_juduls.mahasiswa_id', '=', 'mahasiswas.id')
        ->where('pengajuan_juduls.dosen_id', $dosen_id) // Menambahkan kondisi where
        ->select('pengajuan_juduls.*', 'pengajuan_juduls.id as id_pengajuan', 'dosens.*', 'mahasiswas.*')
        ->get();
    
        return view('dosen.dashboard_dosen', compact('data_pengajuan'), ['title' => 'Data Pengajuan']);
    }

    public function data_bimbingan()
    {
        $dosen_id = auth()->user()->id;
    
        $data_bimbingan = PengajuanJudul::query()
            ->join('mahasiswas', function ($join) {
                $join->on('pengajuan_juduls.mahasiswa_id', '=', 'mahasiswas.id');
            })
            ->leftJoin('dosens as dosen_pembimbing_1', 'pengajuan_juduls.dospem_1', '=', 'dosen_pembimbing_1.id')
            ->leftJoin('dosens as dosen_pembimbing_2', 'pengajuan_juduls.dospem_2', '=', 'dosen_pembimbing_2.id')
            ->where(function ($query) use ($dosen_id) {
                $query->where('pengajuan_juduls.dospem_1', $dosen_id)
                      ->orWhere('pengajuan_juduls.dospem_2', $dosen_id);
            })
            ->select('pengajuan_juduls.*', 'mahasiswas.nim', 'mahasiswas.nama_mahasiswa', 
                     'dosen_pembimbing_1.nama_dosen as nama_dosen_1',
                     'dosen_pembimbing_2.nama_dosen as nama_dosen_2')
            ->get();
    
        // Menambahkan keterangan untuk setiap data bimbingan
        foreach ($data_bimbingan as $bimbingan) {
            if ($bimbingan->dospem_1 == $dosen_id) {
                $bimbingan->keterangan = 'Pembimbing 1';
            } elseif ($bimbingan->dospem_2 == $dosen_id) {
                $bimbingan->keterangan = 'Pembimbing 2';
            }
        }
    
        return view('dosen.data_bimbingan', compact('data_bimbingan'), ['title' => 'Data Bimbingan']);
    }
    

    public function approveJudul(Request $request, $id)
    {
        // Update data document
        PengajuanJudul::where('id', $id)->update([
            'status' => 1,
            'keterangan' => $request->keterangan, // Simpan keterangan
            'tgl_approve' => now()->toDateString(), // Set tgl_approve dengan tanggal saat ini (YYYY-MM-DD)

        ]);
    
        // Return success response
        return response()->json(['message' => 'Pengajuan judul berhasil disetujui']);
    }
    
    public function rejectJudul(Request $request, $id)
    {
        // Update data document
        PengajuanJudul::where('id', $id)->update([
            'status' => 2,
            'keterangan' => $request->keterangan, // Simpan keterangan
        ]);
    
        // Return success response
        return response()->json(['message' => 'Pengajuan judul ditolak']);
    }
}
