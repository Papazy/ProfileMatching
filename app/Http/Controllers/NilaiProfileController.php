<?php

namespace App\Http\Controllers;

use App\Models\Aspek;
use App\Models\Dosen;
use App\Models\KecocokanKriteria;
use App\Models\Kriteria;
use App\Models\KriteriaDosen;
use App\Models\NilaiProfile;
use Illuminate\Http\Request;
use App\Models\NilaiProfXileCore;
use App\Models\PengajuanJudul;
use Illuminate\Console\View\Components\Ask;
use Yajra\DataTables\DataTables;

class NilaiProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilaiProfiles = NilaiProfile::query()
            ->join('mahasiswas', 'nilai_profil.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('dosens', 'nilai_profil.dosen_id', '=', 'dosens.id')
            ->join('pengajuan_juduls', 'nilai_profil.mahasiswa_id', '=', 'pengajuan_juduls.mahasiswa_id')
            ->select(
                'nilai_profil.mahasiswa_id',
                'pengajuan_juduls.judul',
                'nilai_profil.dosen_id',
                'mahasiswas.nama_mahasiswa',
                'dosens.nama_dosen',
                'pengajuan_juduls.status'
            )
            ->where('pengajuan_juduls.status', 1)
            ->groupBy(
                'nilai_profil.mahasiswa_id',
                'pengajuan_juduls.judul',
                'nilai_profil.dosen_id',
                'mahasiswas.nama_mahasiswa',
                'dosens.nama_dosen',
                'pengajuan_juduls.status'
            )
            ->get();

        // dd($nilaiProfiles);

        // Dapatkan semua kriteria
        $kriteria = Kriteria::all();

        return view('nilai.index', [
            'title' => 'Nilai Profile',
            'nilaiProfiles' => $nilaiProfiles,
            'kriteria' => $kriteria
        ]);
    }

    public function nilaigap()
    {
        // Ambil semua nilai profile dengan join tabel terkait
        $nilaiProfiles = NilaiProfile::query()
            ->join('mahasiswas', 'nilai_profil.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('dosens', 'nilai_profil.dosen_id', '=', 'dosens.id')
            ->join('pengajuan_juduls', 'nilai_profil.mahasiswa_id', '=', 'pengajuan_juduls.mahasiswa_id')
            ->select(
                'nilai_profil.mahasiswa_id',
                'pengajuan_juduls.judul',
                'nilai_profil.dosen_id',
                'mahasiswas.nama_mahasiswa',
                'dosens.nama_dosen',
                'pengajuan_juduls.status'
            )
            ->where('pengajuan_juduls.status', 1)
            ->groupBy(
                'nilai_profil.mahasiswa_id',
                'pengajuan_juduls.judul',
                'nilai_profil.dosen_id',
                'mahasiswas.nama_mahasiswa',
                'dosens.nama_dosen',
                'pengajuan_juduls.status'
            )
            ->get();

        // Dapatkan semua kriteria
        $kriteria = Kriteria::all();

        // Menyiapkan array untuk menyimpan hasil pemetaan gap
        $nilaiProfilesWithGap = [];

        foreach ($nilaiProfiles as $nilaiProfile) {
            $profile = [
                'mahasiswa_id' => $nilaiProfile->mahasiswa_id,
                'nama_mahasiswa' => $nilaiProfile->nama_mahasiswa,
                'judul' => $nilaiProfile->judul,
                'nama_dosen' => $nilaiProfile->nama_dosen,
                'gaps' => []
            ];

            foreach ($kriteria as $kri) {
                $nilaiKriteria = NilaiProfile::where('mahasiswa_id', $nilaiProfile->mahasiswa_id)
                    ->where('dosen_id', $nilaiProfile->dosen_id)
                    ->where('kode_kriteria', $kri->kode_kriteria)
                    ->first();

                if ($nilaiKriteria) {
                    $pemetaan_gap = $nilaiKriteria->nilai_kesesuaian - $nilaiKriteria->nilai_kriteria;
                    $profile['gaps'][$kri->kode_kriteria] = $pemetaan_gap;
                } else {
                    $profile['gaps'][$kri->kode_kriteria] = '-';
                }
            }

            $nilaiProfilesWithGap[] = $profile;
        }

        return view('nilai.nilai_gap', [
            'title' => 'Nilai Profile',
            'nilaiProfiles' => $nilaiProfilesWithGap,
            'kriteria' => $kriteria
        ]);
    }

    public function hasilgap()
    {
        $nilaiProfiles = NilaiProfile::query()
            ->join('mahasiswas', 'nilai_profil.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('dosens', 'nilai_profil.dosen_id', '=', 'dosens.id')
            ->join('pengajuan_juduls', 'nilai_profil.mahasiswa_id', '=', 'pengajuan_juduls.mahasiswa_id')
            ->select(
                'nilai_profil.mahasiswa_id',
                'pengajuan_juduls.judul',
                'nilai_profil.dosen_id',
                'mahasiswas.nama_mahasiswa',
                'dosens.nama_dosen',
                'pengajuan_juduls.status'
            )
            ->where('pengajuan_juduls.status', 1)
            ->groupBy(
                'nilai_profil.mahasiswa_id',
                'pengajuan_juduls.judul',
                'nilai_profil.dosen_id',
                'mahasiswas.nama_mahasiswa',
                'dosens.nama_dosen',
                'pengajuan_juduls.status'
            )
            ->get();

        // Dapatkan semua kriteria
        $kriteria = Kriteria::all();

        // Menyiapkan array untuk menyimpan hasil bobot berdasarkan gap
        $nilaiProfilesWithBobot = [];

        foreach ($nilaiProfiles as $nilaiProfile) {
            $profile = [
                'mahasiswa_id' => $nilaiProfile->mahasiswa_id,
                'nama_mahasiswa' => $nilaiProfile->nama_mahasiswa,
                'judul' => $nilaiProfile->judul,
                'nama_dosen' => $nilaiProfile->nama_dosen,
                'bobots' => []
            ];

            foreach ($kriteria as $kri) {
                $nilaiKriteria = NilaiProfile::where('mahasiswa_id', $nilaiProfile->mahasiswa_id)
                    ->where('dosen_id', $nilaiProfile->dosen_id)
                    ->where('kode_kriteria', $kri->kode_kriteria)
                    ->first();

                $pemetaan_gap = $nilaiKriteria ? $nilaiKriteria->nilai_kesesuaian - $nilaiKriteria->nilai_kriteria : null;

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

                $profile['bobots'][$kri->kode_kriteria] = $bobot;
            }

            $nilaiProfilesWithBobot[] = $profile;
        }

        return view('nilai.hasil_gap', [
            'title' => 'Nilai Profile',
            'nilaiProfiles' => $nilaiProfilesWithBobot,
            'kriteria' => $kriteria
        ]);
    }

    public function nilaicore()
    {
        // Mendapatkan profil nilai dengan join ke tabel terkait dan hanya mengambil kategori Core Factor
        $nilaiProfiles = NilaiProfile::query()
            ->join('mahasiswas', 'nilai_profil.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('dosens', 'nilai_profil.dosen_id', '=', 'dosens.id')
            ->join('pengajuan_juduls', 'nilai_profil.mahasiswa_id', '=', 'pengajuan_juduls.mahasiswa_id')
            ->select(
                'nilai_profil.mahasiswa_id',
                'pengajuan_juduls.judul',
                'nilai_profil.dosen_id',
                'mahasiswas.nama_mahasiswa',
                'dosens.nama_dosen',
                'pengajuan_juduls.status'
            )
            ->where('pengajuan_juduls.status', 1)
            ->groupBy(
                'nilai_profil.mahasiswa_id',
                'pengajuan_juduls.judul',
                'nilai_profil.dosen_id',
                'mahasiswas.nama_mahasiswa',
                'dosens.nama_dosen',
                'pengajuan_juduls.status'
            )
            ->get();

        // Dapatkan semua kriteria yang termasuk kategori Core Factor
        $kriteria = Kriteria::query()
            ->join('aspeks', 'kriterias.kode_aspek', '=', 'aspeks.kode_aspek')
            ->where('aspeks.kategori', 'Core Factor')
            ->select('kriterias.*', 'aspeks.nama_aspek')
            ->get();

        $kriteria_core = Kriteria::query()
            ->join('aspeks', 'kriterias.kode_aspek', '=', 'aspeks.kode_aspek')
            ->where('aspeks.kategori', 'Core Factor')
            ->select('kriterias.kode_aspek', 'aspeks.nama_aspek')
            ->distinct()
            ->get();

        $aspeks = Aspek::where('kategori', 'Core Factor')->get();
        // dd($aspek);
        $kriteriass = Kriteria::query()
            ->join('aspeks', 'kriterias.kode_aspek', '=', 'aspeks.kode_aspek')
            ->where('aspeks.kategori', 'Core Factor')
            ->select('kriterias.kode_aspek', 'aspeks.nama_aspek')
            ->get();
        $jumlahAspekCoreFactor = $kriteriass->count();

        // Menghitung nilai NFC
        foreach ($nilaiProfiles as $nilaiProfile) {
            $bobotAspek = [];
            $jumlahAspek = [];
            $totalBobotCoreFactor = [];
            $jumlahCoreFactor = [];

            foreach ($kriteria as $kri) {
                $nilaiKriteria = NilaiProfile::where('mahasiswa_id', $nilaiProfile->mahasiswa_id)
                    ->where('dosen_id', $nilaiProfile->dosen_id)
                    ->where('kode_kriteria', $kri->kode_kriteria)
                    ->first();

                $pemetaan_gap = $nilaiKriteria
                    ? $nilaiKriteria->nilai_kesesuaian - $nilaiKriteria->nilai_kriteria
                    : null;

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

                if ($bobot !== '-') {
                    // Menambahkan bobot ke dalam array berdasarkan kode_aspek
                    if (!isset($bobotAspek[$kri->kode_aspek])) {
                        $bobotAspek[$kri->kode_aspek] = 0;
                        $jumlahAspek[$kri->kode_aspek] = 0;
                    }
                    $bobotAspek[$kri->kode_aspek] += $bobot;
                    $jumlahAspek[$kri->kode_aspek]++;

                    // Menambahkan bobot untuk aspek core factor
                    $aspek = Aspek::where('kode_aspek', $kri->kode_aspek)->first();
                    if ($aspek && $aspek->kategori == 'Core Factor') {
                        if (!isset($totalBobotCoreFactor[$kri->kode_aspek])) {
                            $totalBobotCoreFactor[$kri->kode_aspek] = 0;
                            $jumlahCoreFactor[$kri->kode_aspek] = 0;
                        }
                        $totalBobotCoreFactor[$kri->kode_aspek] += $bobot;
                        $jumlahCoreFactor[$kri->kode_aspek]++;
                    }
                }
            }

            // Menghitung rata-rata bobot untuk setiap kode_aspek
            $rataRataBobot = [];
            foreach ($bobotAspek as $kode_aspek => $totalBobot) {
                $rataRataBobot[$kode_aspek] = $totalBobot / $jumlahAspek[$kode_aspek];
            }

            // Menghitung nilai NFC
            $nilaiNFC = 0;
            $jumlahCoreFactors = count($totalBobotCoreFactor);
            foreach ($totalBobotCoreFactor as $kode_aspek => $totalBobot) {
                if ($jumlahCoreFactor[$kode_aspek] > 0) {
                    $nilaiNFC += $totalBobot / $jumlahCoreFactor[$kode_aspek];
                }
            }
            $nilaiNFC = $jumlahCoreFactors ? $nilaiNFC / $jumlahAspekCoreFactor : '-';

            // Menyimpan hasil perhitungan dalam properti tambahan
            $nilaiProfile->rataRataBobot = $rataRataBobot;
            $nilaiProfile->nilaiNFC = $nilaiNFC;
        }

        return view('nilai.nilai_core', [
            'title' => 'Nilai Profile',
            'nilaiProfiles' => $nilaiProfiles,
            'kriteria' => $kriteria,
            'aspek' => $aspek,
            'aspeks' => $aspeks,
            'kriteria_core' => $kriteria_core,
            'jumlahAspekCoreFactor' => $jumlahAspekCoreFactor,
        ]);
    }

    public function nilaisecondary()
    {
        $nilaiProfiles = NilaiProfile::query()
            ->join('mahasiswas', 'nilai_profil.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('dosens', 'nilai_profil.dosen_id', '=', 'dosens.id')
            ->join('pengajuan_juduls', 'nilai_profil.mahasiswa_id', '=', 'pengajuan_juduls.mahasiswa_id')
            ->select(
                'nilai_profil.mahasiswa_id',
                'pengajuan_juduls.judul',
                'nilai_profil.dosen_id',
                'mahasiswas.nama_mahasiswa',
                'dosens.nama_dosen',
                'pengajuan_juduls.status'
            )
            ->where('pengajuan_juduls.status', 1)
            ->groupBy(
                'nilai_profil.mahasiswa_id',
                'pengajuan_juduls.judul',
                'nilai_profil.dosen_id',
                'mahasiswas.nama_mahasiswa',
                'dosens.nama_dosen',
                'pengajuan_juduls.status'
            )
            ->get();

        $kriteria_secon = Kriteria::query()
            ->join('aspeks', 'kriterias.kode_aspek', '=', 'aspeks.kode_aspek')
            ->where('aspeks.kategori', 'Secondary Factor')
            ->select('kriterias.*', 'aspeks.nama_aspek')
            ->get();

        $aspek_secon = Aspek::where('kategori', 'Secondary Factor')->get();
        $jumlahAspekCoreFactor_secon = $kriteria_secon->groupBy('kode_aspek')->count();

        foreach ($nilaiProfiles as $nilaiProfile) {
            $bobotAspek = [];
            $jumlahAspek = [];

            foreach ($kriteria_secon as $kri) {
                $nilaiKriteria = NilaiProfile::where('mahasiswa_id', $nilaiProfile->mahasiswa_id)
                    ->where('dosen_id', $nilaiProfile->dosen_id)
                    ->where('kode_kriteria', $kri->kode_kriteria)
                    ->first();

                $pemetaan_gap = $nilaiKriteria
                    ? $nilaiKriteria->nilai_kesesuaian - $nilaiKriteria->nilai_kriteria
                    : null;

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

                if ($bobot !== '-') {
                    if (!isset($bobotAspek[$kri->kode_aspek])) {
                        $bobotAspek[$kri->kode_aspek] = 0;
                        $jumlahAspek[$kri->kode_aspek] = 0;
                    }
                    $bobotAspek[$kri->kode_aspek] += $bobot;
                    $jumlahAspek[$kri->kode_aspek]++;
                }
            }

            $rataRataBobot = [];
            foreach ($bobotAspek as $kode_aspek => $totalBobot) {
                $rataRataBobot[$kode_aspek] = $totalBobot / $jumlahAspek[$kode_aspek];
            }

            $nilaiNSF = 0;
            $jumlahAspekSecondaryFactor = count($bobotAspek);
            foreach ($bobotAspek as $kode_aspek => $totalBobot) {
                if ($jumlahAspek[$kode_aspek] > 0) {
                    $nilaiNSF += $totalBobot / $jumlahAspek[$kode_aspek];
                }
            }
            $nilaiNSF = $nilaiNSF / $jumlahAspekCoreFactor_secon;

            $nilaiProfile->rataRataBobot = $rataRataBobot;
            $nilaiProfile->nilaiNSF = $nilaiNSF;
        }

        return view('nilai.nilai_secondary', [
            'title' => 'Nilai Profile',
            'nilaiProfiles' => $nilaiProfiles,
            'kriteria_secon' => $kriteria_secon,
            'aspek_secon' => $aspek_secon,
            'jumlahAspekCoreFactor_secon' => $jumlahAspekCoreFactor_secon
        ]);
    }

    public function create()
    {
        $existingDosenIds = NilaiProfile::pluck('dosen_id')->toArray();
        // Ambil semua dosen yang tidak ada di existingDosenIds
        $dosens = Dosen::whereNotIn('id', $existingDosenIds)->get();
        $kriteria = Kriteria::all();
        $mahasiswaWithAllScores = NilaiProfile::select('mahasiswa_id')
            ->groupBy('mahasiswa_id')
            ->havingRaw('COUNT(DISTINCT dosen_id) = ?', [Dosen::count()])
            ->pluck('mahasiswa_id')->toArray();

        // Ambil data pengajuan mahasiswa yang belum dinilai oleh semua dosen
        $data_pengajuan = PengajuanJudul::query()
            ->join('mahasiswas', 'pengajuan_juduls.mahasiswa_id', '=', 'mahasiswas.id')
            ->where('pengajuan_juduls.status', 1)
            ->whereNotIn('mahasiswas.id', $mahasiswaWithAllScores)
            ->select('pengajuan_juduls.*', 'mahasiswas.*')->get();
        // dd($existingDosenIds);
        return view('nilai.create', compact('dosens', 'data_pengajuan', 'kriteria'), ['title' => 'Nilai Profile']);
    }

    public function getCriteriaByDosen($dosen_id)
    {
        // Fetch criteria and keterangan for the selected dosen_id
        $kriteria_dos = KriteriaDosen::query()
            ->join('kriterias', 'kriteria_dos.kode_kriteria', '=', 'kriterias.kode_kriteria')
            ->where('kriteria_dos.dosen_id', $dosen_id)
            ->select('kriteria_dos.kode_kriteria', 'kriteria_dos.keterangan')
            ->get();

        return response()->json($kriteria_dos);
    }


    public function getAvailableDosens($mahasiswa_id)
    {
        // Dapatkan dosen yang sudah memiliki nilai profil untuk mahasiswa tertentu
        $usedDosenIds = NilaiProfile::where('mahasiswa_id', $mahasiswa_id)->pluck('dosen_id')->toArray();

        // Dapatkan dosen yang tidak ada di daftar usedDosenIds
        $availableDosens = Dosen::whereNotIn('id', $usedDosenIds)->get();

        return response()->json($availableDosens);
    }

    public function store(Request $request)
    {
        // Hitung jumlah kriteria yang ada
        // $kriteriaCount = Kriteria::count();
        $kriteria_nilai = Kriteria::all();
        // dd($request->input("nilai_kesesuaian"));

        // Simpan setiap nilai kriteria ke dalam tabel nilai_profil
        $kriteriaCodes = $request->input("kode_kriteria");
        // dd($kriteriaCodes);
        $nilaiKriterias = $request->input("nilai_kriteria");
        $nilaiKesesuaians = $request->input("nilai_kesesuaian");
        $dosen_count = count($request->input('dosen_ids'));

        $i = 0;
        while ($i < $dosen_count) {
            $index = $i % 5;
            NilaiProfile::create([
                'mahasiswa_id' => $request->input('mahasiswa_id'),
                'dosen_id' => $request->input('dosen_ids')[$i],
                'kode_kriteria' => 'K' . $kriteriaCodes[$index],
                'nilai_kriteria' => $kriteria_nilai[$index]->nilai,
                'nilai_kesesuaian' => $nilaiKesesuaians[$i]
            ]);
            $this->debug_to_console($request->input('dosen_ids')[$i] . ' -> ' . $i . ' = ' . $nilaiKesesuaians[$i]);
            $i++;
        }
        return redirect()->route('nilai.index')->with('success', 'Nilai Profile berhasil ditambahkan');
    }


    public function edit($mahasiswa_id, $dosen_id)
    {
        // dd($dosen_id);
        $nilaiProfile = NilaiProfile::join('pengajuan_juduls', 'nilai_profil.mahasiswa_id', '=', 'pengajuan_juduls.mahasiswa_id')
            ->join('dosens', 'nilai_profil.dosen_id', '=', 'dosens.id')
            ->where('nilai_profil.mahasiswa_id', $mahasiswa_id)
            ->where('nilai_profil.dosen_id', $dosen_id)
            ->where('pengajuan_juduls.status', 1)
            ->select('nilai_profil.*', 'pengajuan_juduls.*', 'dosens.*')
            ->addSelect('nilai_profil.dosen_id as dosen_idnilai') // add other fields except dosen_id
            ->firstOrFail();
        // dd($nilaiProfile);

        $data_pengajuan = PengajuanJudul::query()
            ->join('mahasiswas', 'pengajuan_juduls.mahasiswa_id', '=', 'mahasiswas.id')
            ->where('pengajuan_juduls.mahasiswa_id', $mahasiswa_id)
            ->where('pengajuan_juduls.status', 1)
            ->select('pengajuan_juduls.*', 'mahasiswas.*')->get();
        // dd($data_pengajuan);


        $dosens = Dosen::all();
        $kriteria = nilaiProfile::where('mahasiswa_id', $mahasiswa_id)
            ->where('dosen_id', $dosen_id)->get();
        $kriteriaNilai = NilaiProfile::where('mahasiswa_id', $mahasiswa_id)
            ->where('dosen_id', $dosen_id)
            ->pluck('nilai_kesesuaian', 'kode_kriteria');
        // dd($kriteriaNilai);

        return view('nilai.edit', compact('nilaiProfile', 'data_pengajuan', 'dosens', 'kriteria', 'kriteriaNilai'));
    }


    public function update(Request $request, $mahasiswa_id, $dosen_id)
    {
        // Dump and die to see the incoming request data
        // dd($request->all());

        // Validate the incoming request data
        // $validatedData = $request->validate([
        //     'nilai_kesesuaian*' => 'required|integer|min=1|max=5',
        // ]);

        // Get all NilaiProfile records for the given mahasiswa_id and dosen_id
        $nilaiProfiles = NilaiProfile::where('mahasiswa_id', $mahasiswa_id)
            ->where('dosen_id', $dosen_id)
            ->get();
        // dd($nilaiProfiles);
        // Iterate over each kriteria and update the corresponding NilaiProfile record
        foreach ($nilaiProfiles as $index => $nilaiProfile) {
            $kodeKriteria = $request->input("kode_kriteria" . ($index + 1));
            $nilaiKesesuaian = $request->input("nilai_kesesuaian" . ($index + 1));
            $nilaiProfile->update([
                'nilai_kesesuaian' => $nilaiKesesuaian,
            ]);
        }

        // dd($nilaiProfile);


        return redirect()->route('nilai.index')->with('success', 'Data berhasil diperbarui.');
    }



    public function destroy($mahasiswa_id, $dosen_id)
    {
        // Find the nilai profile by mahasiswa_id and dosen_id
        $nilaiProfiles = NilaiProfile::where('mahasiswa_id', $mahasiswa_id)
            ->where('dosen_id', $dosen_id)
            ->get();

        // Check if the nilai profiles exist and delete them
        if ($nilaiProfiles->isNotEmpty()) {
            foreach ($nilaiProfiles as $nilaiProfile) {
                $nilaiProfile->delete();
            }
            return redirect()->route('nilai.index')->with('success', 'Nilai profiles deleted successfully');
        }

        return redirect()->route('nilai.index')->with('error', 'Nilai profiles not found');
    }

    public function test()
    {

        $existingDosenIds = NilaiProfile::pluck('dosen_id')->toArray();
        // Ambil semua dosen yang tidak ada di existingDosenIds
        $dosens = Dosen::whereNotIn('id', $existingDosenIds)->get();
        $kriteria = Kriteria::all();
        $mahasiswaWithAllScores = NilaiProfile::select('mahasiswa_id')
            ->groupBy('mahasiswa_id')
            ->havingRaw('COUNT(DISTINCT dosen_id) = ?', [Dosen::count()])
            ->pluck('mahasiswa_id')->toArray();

        // Ambil data pengajuan mahasiswa yang belum dinilai oleh semua dosen
        $data_pengajuan = PengajuanJudul::query()
            ->join('mahasiswas', 'pengajuan_juduls.mahasiswa_id', '=', 'mahasiswas.id')
            ->where('pengajuan_juduls.status', 1)
            ->whereNotIn('mahasiswas.id', $mahasiswaWithAllScores)
            ->select('pengajuan_juduls.*', 'mahasiswas.*')->get();

        return view('nilai.test', compact('dosens', 'data_pengajuan', 'kriteria'), ['title' => 'Nilai Profile']);
    }

    public function predict(Request $request)
    {
        // Hitung jumlah kriteria yang ada
        $judul = $request->judul;
        // $judul = "Perancangan dan Pembangunan Aplikasi Mobile dan Situs Web Interaktif untuk Pelayanan Gereja";
        $judul_lower = strtolower($judul);
        $all_dosen = Dosen::all();
        $nilai_dosen = [];
        $indexxx = 0;
        foreach ($all_dosen as $dosen) {
            $krit_kecocokan = KecocokanKriteria::where('dosen_id', $dosen->id)->get();
            $nilai_kriteria = [];
            $nilai_kriteria_kesesuaian = [];

            $kode_kriteria = ['K1', 'K2', 'K3', 'K4', 'K5'];
            foreach ($kode_kriteria as $kode) {
                $nilai_kriteria[$kode] = $krit_kecocokan->where('kode_kriteria', $kode)->first()->nilai;
            }
            $keywords = [];
            $nilai_semua = [];
            $indexx = 1;
            foreach ($kode_kriteria as $kode) {
                $keywords = explode(',', $nilai_kriteria[$kode]);
                $nilai = 0;
                foreach ($keywords as $index => $keyword) {
                    if ($keyword == '' || $keyword == null || $keyword == ' ' || $keyword == "\r\n" || $keyword == "\n" || $keyword == "\r" || $keyword == "") {
                        continue;
                    }
                    $keyword = str_replace("\r\n", '', $keyword);

                    if (strpos($judul_lower, strtolower($keyword)) !== false) {
                        $nilai++;
                        // dd($keyword);

                    }
                    
                }
                $nilai_semua[$indexx] = $this->normalizeValue($nilai);
                $indexx++;
            }
            $nilai_semua[5] = 3;
            if ($dosen->id == 4) {
                $nilai_semua[5] = 2;
            }
            $nilai_dosen[$dosen->id] = $nilai_semua;
            $indexxx++;
            // if($indexxx > 2){
            //     break;
            // }
        }

        return redirect()->route('nilai.test')->with(
            [
                'success' => 'Prediksi nilai berhasil dilakukan',
                'nilai_dosen' => $nilai_dosen,
                'all_dosen' => $all_dosen,
                'id_mahasiswa' => $request->mahasiswa_id,
                'judul' => $request->judul,
                'mahasiswa_id' => $request->mahasiswa_id,
            ]
        );
    }

    public function normalizeValue($value)
    {
        if ($value == 0) {
            return 1;
        }
        if ($value == 1) {
            return 2;
        } elseif ($value == 2) {
            return 3;
        } elseif ($value == 3) {
            return 4;
        } elseif ($value >= 4) {
            return 5;
        }
        return $value;
    }



    public function getDosenKriteria($dosenId, $mahasiswaId)
    {
        // Ambil data kriteria dan keterangan dari model KriteriaDosen
        $kriteriaDosen = KriteriaDosen::where('dosen_id', $dosenId)->get();
        $dosen = Dosen::where('id', $dosenId)->first();

        // Periksa apakah data dosen ditemukan
        if (!$dosen) {
            return response()->json(['error' => 'Dosen not found'], 404);
        }

        $result = $kriteriaDosen->map(function ($kriteria) use ($dosen) {
            return [
                'nama_dosen' => $dosen->nama_dosen,
                'kode_kriteria' => $kriteria->kode_kriteria,
                'keterangan' => $kriteria->keterangan,
            ];
        });

        return response()->json($result);
    }

    function debug_to_console($data)
    {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
}
