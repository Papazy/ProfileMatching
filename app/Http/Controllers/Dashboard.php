<?php

namespace App\Http\Controllers;

use App\Models\Aspek;
use App\Models\DashboardKaprodi;
use App\Models\Dosen;
use App\Models\Kriteria;
use App\Models\Mahasiswa;
use App\Models\NilaiProfile;
use App\Models\PengajuanJudul;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $data_pengajuan = PengajuanJudul::query()
            ->join('mahasiswas', 'pengajuan_juduls.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('dosens as dosen_pembimbing_utama', 'pengajuan_juduls.dosen_id', '=', 'dosen_pembimbing_utama.id')
            ->leftJoin('dosens as dosen_pembimbing_1', 'pengajuan_juduls.dospem_1', '=', 'dosen_pembimbing_1.id')
            ->leftJoin('dosens as dosen_pembimbing_2', 'pengajuan_juduls.dospem_2', '=', 'dosen_pembimbing_2.id')
            ->where('pengajuan_juduls.status', 1)
            ->select('pengajuan_juduls.*', 
                     'mahasiswas.*', 
                     'dosen_pembimbing_utama.nama_dosen as nama_dosen_utama', 
                     'dosen_pembimbing_1.nama_dosen as nama_dosen_1',
                     'dosen_pembimbing_2.nama_dosen as nama_dosen_2')
            ->get();
    
        // dd($data_pengajuan);
    
        return view('dashboard', compact('data_pengajuan'), ['title' => 'Dashboard']);
    }
    

    public function pemilihandosen($mahasiswa_id)
    {
        // Ambil dosen yang sudah dipilih oleh mahasiswa ini dan group by dosen_id
        $data_dosen = Dosen::query()
            ->join('nilai_profil', 'dosens.id', '=', 'nilai_profil.dosen_id')
            ->where('nilai_profil.mahasiswa_id', $mahasiswa_id)
            ->select('dosens.id as dosen_id', 'dosens.nama_dosen', 'dosens.nidn', 'nilai_profil.mahasiswa_id')
            ->groupBy('dosens.id', 'dosens.nama_dosen', 'dosens.nidn', 'nilai_profil.mahasiswa_id')
            ->get();

        $data_mahasiswa = Mahasiswa::query()
            ->where('id', $mahasiswa_id)
            ->first();

        return view('pemilihandosen', compact('data_dosen', 'mahasiswa_id', 'data_mahasiswa'), ['title' => 'Pemilihan Dosen']);
    }

    public function perhitungan(Request $request)
    {
        $mahasiswa_id = $request->input('mahasiswa_id');
        $dosen_ids = $request->input('dosen_ids', []);

        // Ambil data nilai profil berdasarkan mahasiswa_id dan dosen_ids yang dipilih
        $nilaiProfiles = NilaiProfile::query()
            ->join('mahasiswas', 'nilai_profil.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('dosens', 'nilai_profil.dosen_id', '=', 'dosens.id')
            ->join('pengajuan_juduls', 'nilai_profil.mahasiswa_id', '=', 'pengajuan_juduls.mahasiswa_id')
            ->where('nilai_profil.mahasiswa_id', $mahasiswa_id)
            ->whereIn('nilai_profil.dosen_id', $dosen_ids)
            ->where('pengajuan_juduls.status', 1)
            ->select('nilai_profil.mahasiswa_id', 'pengajuan_juduls.judul', 'nilai_profil.dosen_id', 'mahasiswas.nama_mahasiswa', 'dosens.nama_dosen', 'pengajuan_juduls.dospem_1', 'pengajuan_juduls.dospem_2')
            ->groupBy('nilai_profil.mahasiswa_id', 'pengajuan_juduls.judul', 'nilai_profil.dosen_id', 'mahasiswas.nama_mahasiswa', 'dosens.nama_dosen', 'pengajuan_juduls.dospem_1', 'pengajuan_juduls.dospem_2')
            ->get();


        // Dapatkan semua kriteria
        $kriteria = Kriteria::all();
        $dosen = Dosen::all();



        $kriteriaCore = Kriteria::query()
            ->join('aspeks', 'kriterias.kode_aspek', '=', 'aspeks.kode_aspek')
            ->where('aspeks.kategori', 'Core Factor')
            ->select('kriterias.kode_aspek', 'aspeks.nama_aspek')
            // ->distinct()
            ->get();
        // dd($kriteriaCore);

        $kriteriaSecondary = Kriteria::query()
            ->join('aspeks', 'kriterias.kode_aspek', '=', 'aspeks.kode_aspek')
            ->where('aspeks.kategori', 'Secondary Factor')
            ->select('kriterias.kode_aspek', 'aspeks.nama_aspek')
            ->distinct()
            ->get();

        $jumlahAspekCoreFactor = $kriteriaCore->count();
        $jumlahAspekSecondaryFactor = $kriteriaSecondary->count();

        $nilaiProfilesWithCalculations = [];

        foreach ($nilaiProfiles as $nilaiProfile) {
            $profile = [
                'mahasiswa_id' => $nilaiProfile->mahasiswa_id,
                'nama_mahasiswa' => $nilaiProfile->nama_mahasiswa,
                'judul' => $nilaiProfile->judul,
                'nama_dosen' => $nilaiProfile->nama_dosen,
                'dosen_id' => $nilaiProfile->dosen_id,
                'dospem_1' => $nilaiProfile->dospem_1,
                'dospem_2' => $nilaiProfile->dospem_2,
                'gaps' => [],
                'bobots' => [],
                'rataRataBobot' => [],
                'nilaiNFC' => 0,
                'nilaiNSF' => 0,
            ];

            $bobotAspekCore = [];
            $totalBobotCoreFactor = [];
            $jumlahCoreFactor = [];

            $bobotAspekSecondary = [];
            $totalBobotSecondaryFactor = [];
            $jumlahSecondaryFactor = [];

            foreach ($kriteria as $kri) {
                $nilaiKriteria = NilaiProfile::where('mahasiswa_id', $nilaiProfile->mahasiswa_id)
                    ->where('dosen_id', $nilaiProfile->dosen_id)
                    ->where('kode_kriteria', $kri->kode_kriteria)
                    ->first();

                $pemetaan_gap = $nilaiKriteria ? $nilaiKriteria->nilai_kesesuaian - $nilaiKriteria->nilai_kriteria : null;

                // Menghitung nilai gap
                if ($pemetaan_gap !== null) {
                    switch ($pemetaan_gap) {
                        case 0:
                            $bobot = 5;
                            break;
                        case 1:
                            $bobot = 4.5;
                            break;
                        case -1:
                            $bobot = 4;
                            break;
                        case 2:
                            $bobot = 3.5;
                            break;
                        case -2:
                            $bobot = 3;
                            break;
                        case 3:
                            $bobot = 2.5;
                            break;
                        case -3:
                            $bobot = 2;
                            break;
                        case 4:
                            $bobot = 1.5;
                            break;
                        case -4:
                            $bobot = 1;
                            break;
                        default:
                            $bobot = '-';
                            break;
                    }
                } else {
                    $bobot = '-';
                }

                // Simpan nilai gap
                $profile['gaps'][$kri->kode_kriteria] = $pemetaan_gap;

                // Simpan bobot
                $profile['bobots'][$kri->kode_kriteria] = $bobot;

                // Menghitung bobot untuk Core Factor
                if ($bobot !== '-') {
                    $aspek = Aspek::where('kode_aspek', $kri->kode_aspek)->first();
                    if ($aspek && $aspek->kategori == 'Core Factor') {
                        if (!isset($bobotAspekCore[$kri->kode_aspek])) {
                            $bobotAspekCore[$kri->kode_aspek] = 0;
                            $jumlahCoreFactor[$kri->kode_aspek] = 0;
                        }
                        $bobotAspekCore[$kri->kode_aspek] += $bobot;
                        $jumlahCoreFactor[$kri->kode_aspek]++;

                        if (!isset($totalBobotCoreFactor[$kri->kode_aspek])) {
                            $totalBobotCoreFactor[$kri->kode_aspek] = 0;
                        }
                        $totalBobotCoreFactor[$kri->kode_aspek] += $bobot;
                    }

                    // Menghitung bobot untuk Secondary Factor
                    if ($aspek && $aspek->kategori == 'Secondary Factor') {
                        if (!isset($bobotAspekSecondary[$kri->kode_aspek])) {
                            $bobotAspekSecondary[$kri->kode_aspek] = 0;
                            $jumlahSecondaryFactor[$kri->kode_aspek] = 0;
                        }
                        $bobotAspekSecondary[$kri->kode_aspek] += $bobot;
                        $jumlahSecondaryFactor[$kri->kode_aspek]++;

                        if (!isset($totalBobotSecondaryFactor[$kri->kode_aspek])) {
                            $totalBobotSecondaryFactor[$kri->kode_aspek] = 0;
                        }
                        $totalBobotSecondaryFactor[$kri->kode_aspek] += $bobot;
                    }
                }
            }

            // Menghitung rata-rata bobot untuk setiap kode_aspek
            foreach ($bobotAspekCore as $kode_aspek => $totalBobot) {
                $profile['rataRataBobot'][$kode_aspek] = $totalBobot / $jumlahCoreFactor[$kode_aspek];
            }
            // dd($profile['rataRataBobot'][$kode_aspek]);

            // Menghitung nilai NFC
            $nilaiNFC = 0;
            foreach ($totalBobotCoreFactor as $kode_aspek => $totalBobot) {
                if (isset($jumlahCoreFactor[$kode_aspek]) && $jumlahCoreFactor[$kode_aspek] > 0) {
                    $nilaiNFC += $totalBobot / $jumlahCoreFactor[$kode_aspek];
                }
            }
            // dd($jumlahAspekCoreFactor);
            $profile['nilaiNFC'] = $jumlahAspekCoreFactor ? $nilaiNFC / $jumlahAspekCoreFactor : '-';
            // $profile['niaibobotsecondary'] = $jumlahAspekCoreFactor ? $nilaiNFC / $jumlahAspekCoreFactor: '-';

            // Menghitung rata-rata bobot untuk Secondary Factor
            $nilaiNSF = 0;
            foreach ($totalBobotSecondaryFactor as $kode_aspek => $totalBobot) {
                if (isset($jumlahSecondaryFactor[$kode_aspek]) && $jumlahSecondaryFactor[$kode_aspek] > 0) {
                    $nilaiNSF += $totalBobot / $jumlahSecondaryFactor[$kode_aspek];
                }
            }
            $profile['nilaiNSF'] = $jumlahAspekSecondaryFactor ? $nilaiNSF / $jumlahAspekSecondaryFactor : '-';
            $profile['niaibobotsecondary'] = $jumlahAspekSecondaryFactor ? $nilaiNSF : '-';
            $profile['nilaiAkhir'] = ($profile['nilaiNFC'] !== '-' ? 0.7 * $profile['nilaiNFC'] : 0) + ($profile['nilaiNSF'] !== '-' ? 0.3 * $profile['nilaiNSF'] : 0);

            $nilaiProfilesWithCalculations[] = $profile;
        }

        usort($nilaiProfilesWithCalculations, function ($a, $b) {
            return $b['nilaiAkhir'] <=> $a['nilaiAkhir'];
        });

        return view('perhitungan', [
            'title' => 'Pemilihan Dosen',
            'nilaiProfiles' => $nilaiProfilesWithCalculations,
            'kriteria' => $kriteria,
            'kriteriaCore' => $kriteriaCore,
            'kriteriaSecondary' => $kriteriaSecondary,
            'jumlahAspekCoreFactor' => $jumlahAspekCoreFactor,
            'jumlahAspekSecondaryFactor' => $jumlahAspekSecondaryFactor,
        ]);
    }

    public function selectDosen(Request $request)
    {
        // Debug: Lihat semua data yang dikirimkan dari form
        // dd($request->all());

        // Ambil mahasiswa_id dari request
        $mahasiswa_id = $request->input('mahasiswa_id');
        $pengajuanJudul = PengajuanJudul::where('mahasiswa_id', $mahasiswa_id)
            ->where('status', 1)
            ->first();

        $pengajuanJudul->dospem_1 = $request->input('dospem_1');
        $pengajuanJudul->dospem_2 = $request->input('dospem_2');
        $pengajuanJudul->save();
        // Redirect atau memberikan respons setelah update
        return redirect()->route('dashboard')->with('success', 'Dosen Pembimbing berhasil diperbarui');
    }
}
