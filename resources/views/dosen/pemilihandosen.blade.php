<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!--button-->
        <div class="flex justify-end mt-2 items-center">
            <div x-data="{ open: false }" class="relative inline-block text-left">
                <div class="bg-gradient-custom-search rounded-full w-60 h-10 flex items-center justify-between px-3">
                    <span class="text-black font-balsamiq font-medium text-xl">Penilaian kesesuaian</span>
                    <button @click="open = !open" type="button" class="flex items-center justify-center"
                        aria-expanded="true" aria-haspopup="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            :class="{ 'transform rotate-180': open }">
                            <path fill="black" d="M7 10l5 5 5-5z" />
                        </svg>
                    </button>
                </div>

                <div x-show="open" @click.away="open = false"
                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton">
                        <a href="{{ route('nilai.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Penilaian
                            Kesesuaian</a>
                        <a href="{{ route('nilai.nilaigap') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Pemetaan
                            Gap</a>
                        <a href="{{ route('nilai.hasilgap') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem">Hasil Gap</a>
                    </div>
                </div>
            </div>

            <div id="circleButton"
                class="bg-[#3687FF] hover:bg-opacity-80 w-14 h-14 rounded-full ml-6 flex items-center justify-center cursor-pointer transition duration-300 active:ring-2">
                <a href="{{ route('nilai.create') }}" title="Tambah"
                    class="flex items-center justify-center w-full h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="white"
                            d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2" />
                    </svg>
                </a>
            </div>
        </div>

    </section>

    <section>
        <!-- tabel-->
        <div class="mt-12">
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
                        <td class="border border-slate-700 p-2 text-center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiProfiles as $index => $nilaiProfile)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile->nama_mahasiswa }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile->judul }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile->nama_dosen }}</td>
                            @foreach ($kriteria as $kri)
                                @php
                                    $nilaiKriteria = App\Models\NilaiProfile::where(
                                        'mahasiswa_id',
                                        $nilaiProfile->mahasiswa_id,
                                    )
                                        ->where('dosen_id', $nilaiProfile->dosen_id)
                                        ->where('kode_kriteria', $kri->kode_kriteria)
                                        ->first();
                                @endphp
                                <td class="border border-slate-700 p-2 text-center">
                                    {{ $nilaiKriteria ? $nilaiKriteria->nilai_kesesuaian : '-' }}
                                </td>
                            @endforeach
                            <td class="border border-slate-700 p-2 text-center">
                                {{-- <a href="{{ route('nilai.edit', $nilaiProfile->id) }}"
                                    class="text-blue-500 hover:text-blue-700">Edit</a>
                                <form action="{{ route('nilai.destroy', $nilaiProfile->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-4">Delete</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layout>
