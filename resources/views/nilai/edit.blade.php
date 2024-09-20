<x-layout>
    <x-slot:title>Nilai Profile</x-slot:title>

    <section class="mt-7 flex justify-center">
        <div class="flex justify-start items-center">
            <form
                action="{{ route('nilai.update', ['mahasiswa_id' => $nilaiProfile->mahasiswa_id, 'dosen_id' => $nilaiProfile->dosen_idnilai]) }}"
                method="POST">
                @csrf
                @method('PUT')

                <!-- Dropdown untuk memilih Mahasiswa -->
                <div class="flex items-center space-x-3 mt-6">
                    <label for="mahasiswa_id" class="bg-white w-56 h-16 flex items-center px-3">
                        <span class="text-black font-balsamiq font-normal text-xl">Pilih Mahasiswa</span>
                    </label>
                    <select name="mahasiswa_id" id="mahasiswa_id" required
                        class="bg-white w-72 h-16 text-black font-balsamiq p-3 focus:outline-blue-500">
                        <option value="" disabled>Pilih Mahasiswa</option>
                        @foreach ($data_pengajuan as $pengajuan)
                            <option value="{{ $pengajuan->mahasiswa_id }}"
                                {{ $pengajuan->mahasiswa_id == $nilaiProfile->mahasiswa_id ? 'selected' : '' }}>
                                {{ $pengajuan->nama_mahasiswa }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Input untuk Judul -->
                <div class="flex items-center space-x-3 mt-6">
                    <label for="judul" class="bg-white w-56 h-16 flex items-center px-3">
                        <span class="text-black font-balsamiq font-normal text-xl">Judul</span>
                    </label>
                    <textarea id="judul" name="judul"
                        class="bg-white w-72 h-auto text-black font-balsamiq p-4 overflow-auto text-justify" disabled>{{ $nilaiProfile->judul }}
                    </textarea>
                </div>

                <!-- Dropdown untuk memilih Dosen -->
                <div class="flex items-center space-x-3 mt-6">
                    <label for="dosen_id" class="bg-white w-56 h-16 flex items-center px-3">
                        <span class="text-black font-balsamiq font-normal text-xl">Pilih Dosen</span>
                    </label>
                    <input type="text" value="{{ $nilaiProfile->nama_dosen }}"
                        class="bg-white w-72 h-16 text-black font-balsamiq p-4" disabled>
                    <input type="hidden" id="dosen_id" name="dosen_id" value="{{ $nilaiProfile->dosen_idnilai }}"
                        class="bg-white w-72 h-16 text-black font-balsamiq p-4">
                </div>

                <!-- Input untuk kriteria -->
                @foreach ($kriteria as $index => $kri)
                    <div class="flex items-center space-x-3 mt-6">
                        <label for="k{{ $index }}" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Kriteria
                                {{ $index + 1 }}</span>
                        </label>
                        <input type="hidden" name="kode_kriteria{{ $index + 1 }}"
                            value="{{ $kri->kode_kriteria }}">
                        {{-- <input type="hidden" name="nilai_kriteria{{ $index + 1 }}" value="{{ $kri->nilai }}"> --}}
                        <select name="nilai_kesesuaian{{ $index + 1 }}" id="nilai_kesesuaian{{ $index + 1 }}"
                            required class="bg-white w-72 h-16 text-black font-balsamiq p-3 focus:outline-blue-500">
                            <option value="" disabled>Pilih Nilai Kesesuaian</option>
                            <option value="1"
                                {{ isset($kriteriaNilai[$kri->kode_kriteria]) && $kriteriaNilai[$kri->kode_kriteria] == 1 ? 'selected' : '' }}>
                                1 Sangat tidak sesuai</option>
                            <option value="2"
                                {{ isset($kriteriaNilai[$kri->kode_kriteria]) && $kriteriaNilai[$kri->kode_kriteria] == 2 ? 'selected' : '' }}>
                                2 Tidak sesuai</option>
                            <option value="3"
                                {{ isset($kriteriaNilai[$kri->kode_kriteria]) && $kriteriaNilai[$kri->kode_kriteria] == 3 ? 'selected' : '' }}>
                                3 Cukup sesuai</option>
                            <option value="4"
                                {{ isset($kriteriaNilai[$kri->kode_kriteria]) && $kriteriaNilai[$kri->kode_kriteria] == 4 ? 'selected' : '' }}>
                                4 Sesuai</option>
                            <option value="5"
                                {{ isset($kriteriaNilai[$kri->kode_kriteria]) && $kriteriaNilai[$kri->kode_kriteria] == 5 ? 'selected' : '' }}>
                                5 Sangat sesuai</option>
                        </select>
                    </div>
                @endforeach

                <div class="mt-4 flex justify-center">
                    <div class="flex justify-start items-center">
                        <button type="submit"
                            class="bg-blue-500 my-9 flex-row ml-96 p-3 gap-4 rounded-3xl font-balsamiq font-bold w-24 h-11 text-center hover:font-semibold hover:text-white tracking-widest active:bg-sky-600">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-layout>
