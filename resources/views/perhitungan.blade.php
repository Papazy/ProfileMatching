<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!-- tabel -->
        <div class="mt-8">
            <h5 style="font-size: 22px;padding: 0 0 20px 0;">Penilaian Kesesuaian</h5>
            <table class="border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">Mahasiswa</td>
                        <td class="border border-slate-700 p-2 text-center">Judul</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Dosen</td>
                        @foreach ($kriteria as $kri)
                            <td class="border border-slate-700 p-2 text-center">{{ $kri->kode_kriteria }}</td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiProfiles as $index => $nilaiProfile)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_mahasiswa'] }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['judul'] }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_dosen'] }}</td>
                            @foreach ($kriteria as $kri)
                                @php
                                    $nilaiKriteria = App\Models\NilaiProfile::where(
                                        'mahasiswa_id',
                                        $nilaiProfile['mahasiswa_id'],
                                    )
                                        ->where('dosen_id', $nilaiProfile['dosen_id'])
                                        ->where('kode_kriteria', $kri->kode_kriteria)
                                        ->first();
                                @endphp
                                <td class="border border-slate-700 p-2 text-center">
                                    {{ $nilaiKriteria ? $nilaiKriteria->nilai_kesesuaian : '-' }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            <h5 style="font-size: 22px; padding: 0 0 20px 0;">Pemetaan Gap</h5>
            <table class="border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">Mahasiswa</td>
                        <td class="border border-slate-700 p-2 text-center">Judul</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Dosen</td>
                        @foreach ($kriteria as $kri)
                            <td class="border border-slate-700 p-2 text-center">{{ $kri->kode_kriteria }}</td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiProfiles as $index => $nilaiProfile)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_mahasiswa'] }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['judul'] }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_dosen'] }}</td>
                            @foreach ($kriteria as $kri)
                                <td class="border border-slate-700 p-2 text-center">
                                    {{ $nilaiProfile['gaps'][$kri->kode_kriteria] ?? '-' }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            <h5 style="font-size: 22px; padding: 0 0 20px 0;">Pemberian bobot pada hasil gap</h5>
            <table class="border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">Mahasiswa</td>
                        <td class="border border-slate-700 p-2 text-center">Judul</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Dosen</td>
                        @foreach ($kriteria as $kri)
                            <td class="border border-slate-700 p-2 text-center">{{ $kri->kode_kriteria }}</td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiProfiles as $index => $nilaiProfile)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_mahasiswa'] }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['judul'] }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_dosen'] }}</td>
                            @foreach ($kriteria as $kri)
                                <td class="border border-slate-700 p-2 text-center">
                                    {{ $nilaiProfile['bobots'][$kri->kode_kriteria] ?? '-' }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            <h5 style="font-size: 22px; padding: 0 0 20px 0;">Core Factor</h5>
            <table class="border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">Mahasiswa</td>
                        <td class="border border-slate-700 p-2 text-center">Judul</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Dosen</td>
                        @foreach ($kriteriaCore as $kri)
                            <td class="border border-slate-700 p-2 text-center">{{ $kri->kode_aspek }}</td>
                        @endforeach
                        <td class="border border-slate-700 p-2 text-center">NFC</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiProfiles as $index => $nilaiProfile)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_mahasiswa'] }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['judul'] }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_dosen'] }}</td>
                            @foreach ($kriteriaCore as $kri)
                                <td class="border border-slate-700 p-2 text-center">
                                    {{ $nilaiProfile['rataRataBobot'][$kri->kode_aspek] ?? '-' }}
                                </td>
                            @endforeach
                            <td class="border border-slate-700 p-2 text-center">
                                {{ $nilaiProfile['nilaiNFC'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-8">
            <h5 style="font-size: 22px; padding: 0 0 20px 0;">Secondary Factor</h5>
            <table class="border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">Mahasiswa</td>
                        <td class="border border-slate-700 p-2 text-center">Judul</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Dosen</td>
                        @foreach ($kriteriaSecondary as $kri)
                            <td class="border border-slate-700 p-2 text-center">{{ $kri->nama_aspek }}</td>
                        @endforeach
                        <td class="border border-slate-700 p-2 text-center">NSF</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiProfiles as $index => $nilaiProfile)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_mahasiswa'] }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['judul'] }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_dosen'] }}</td>
                            <td class="border border-slate-700 p-2 text-center">
                                {{ $nilaiProfile['niaibobotsecondary'] }}
                            </td>
                            <td class="border border-slate-700 p-2 text-center">
                                {{ $nilaiProfile['nilaiNSF'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            <h5 style="font-size: 22px;padding: 0 0 20px 0;">Hasil Perhitungan</h5>

            <form action="{{ route('selectDosen') }}" method="POST">
                @csrf
                <table class="border border-slate-700 w-full m-2">
                    <thead>
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">No</td>
                            <td class="border border-slate-700 p-2 text-center">Nama Dosen</td>
                            <td class="border border-slate-700 p-2 text-center">Core Factor</td>
                            <td class="border border-slate-700 p-2 text-center">Secondary Factor</td>
                            <td class="border border-slate-700 p-2 text-center">Total</td>
                            <td class="border border-slate-700 p-2 text-center">Ranking</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiProfiles as $index => $nilaiProfile)
                            <input type="hidden" name="mahasiswa_id" value="{{ $nilaiProfile['mahasiswa_id'] }}">

                            <tr>
                                <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                                <td class="border border-slate-700 p-2">{{ $nilaiProfile['nama_dosen'] }}</td>
                                <td class="border border-slate-700 p-2">{{ $nilaiProfile['nilaiNFC']  }}</td>
                                <td class="border border-slate-700 p-2">{{ $nilaiProfile['nilaiNSF']  }}</td>
                                <td class="border border-slate-700 p-2">{{ $nilaiProfile['nilaiAkhir'] }}</td>
                                <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5 style="font-size: 22px;padding: 20px 0 20px 0;">Pilih Dosen Pembimbing</h5>

                <div>
                    <label for="dospem_1" class="block text-sm font-medium text-gray-700 mb-1">Dosen Pembimbing
                        1:</label>
                    <select id="dospem_1" name="dospem_1"
                        class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2" required>
                        <option value="" disabled selected>Pilih Dosen Pembimbing 1</option>
                        @foreach ($nilaiProfiles as $nilaiProfile)
                            <option value="{{ $nilaiProfile['dosen_id'] }}"
                                {{ $nilaiProfile['dosen_id'] == $nilaiProfile['dospem_1'] ? 'selected' : '' }}>
                                {{ $nilaiProfile['nama_dosen'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="dospem_2" class="block text-sm font-medium text-gray-700 mb-1">Dosen Pembimbing
                        2:</label>
                    <select id="dospem_2" name="dospem_2"
                        class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2" required>
                        <option value="" disabled selected>Pilih Dosen Pembimbing 2</option>

                        @foreach ($nilaiProfiles as $nilaiProfile)
                            <option value="{{ $nilaiProfile['dosen_id'] }}"
                                {{ $nilaiProfile['dosen_id'] == $nilaiProfile['dospem_2'] ? 'selected' : '' }}>
                                {{ $nilaiProfile['nama_dosen'] }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 my-9 flex-row p-3 gap-4 rounded-3xl font-balsamiq font-bold w-24 h-11 text-center hover:font-semibold hover:text-white tracking-widest active:bg-sky-600">
                    Simpan
                </button>
            </form>
        </div>
    </section>

    <script>
        document.querySelectorAll('input[name="dosen_pilih"]').forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                document.querySelectorAll('input[name="dosen_pilih"]').forEach((box) => {
                    if (box !== this) {
                        box.checked = false;
                    }
                });
            });
        });
    </script>
</x-layout>
