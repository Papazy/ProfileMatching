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
                        <a href="{{ route('nilai.hasilgap') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Hasil
                            Gap</a>
                        <a href="{{ route('nilai.nilaicore') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Core Factor
                        </a>
                        <a href="{{ route('nilai.nilaisecondary') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Secondary
                            Factor</a>
                    </div>
                </div>
            </div>

            <div id="circleButton"
                class="bg-[#3687FF] hover:bg-opacity-80 w-14 h-14 rounded-full ml-6 flex items-center justify-center cursor-pointer transition duration-300 active:ring-2">
                <a href="{{ route('nilai.create') }}" title="Tambah"
                    class="flex items-center justify-center w-full h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="white"
                            d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2">
                    </svg>
                </a>
            </div>
        </div>

    </section>

    <section>
        <!-- tabel-->
        <div class="mt-12">
            <table id="nilaiProfilesTable" class="border border-slate-700 w-full m-2">
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
                            <td class="border border-slate-700 p-2 text-center">{{ $nilaiProfile->nama_mahasiswa }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $nilaiProfile->judul }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $nilaiProfile->nama_dosen }}</td>
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
                            <td class="border border-slate-700  text-center">
                                <a href="{{ route('nilai.edit', ['mahasiswa_id' => $nilaiProfile->mahasiswa_id, 'dosen_id' => $nilaiProfile->dosen_id]) }}">
                                    <button type="submit" title="Ubah" x-data="{ clicked: false }"
                                    @click="clicked = true; setTimeout(() => clicked = false, 300)">
                                            <svg :class="clicked ? 'scale-90' : ''"
                                                class="transition-transform duration-200 ease-in-out"
                                                xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="black"
                                                    stroke-linecap="round"stroke-linejoin="round" stroke-width="2">
                                                    <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                </g>
                                            </svg>
                                    </button>
                                </a>

                                    <form
                                    action="{{ route('nilai.destroy', ['mahasiswa_id' => $nilaiProfile->mahasiswa_id, 'dosen_id' => $nilaiProfile->dosen_id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus" x-data="{ clicked: false }"
                                        @click="clicked = true; setTimeout(() => clicked = false, 300)"
                                        onclick="return confirm ('Apakah Anda yakin ingin menghapus nilai profile ini?')">
                                            <svg :class="clicked ? 'scale-90' : ''"
                                             class="transition-transform duration-200 ease-in-out"
                                            xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                            viewBox="0 0 24 24">
                                                <path fill="black"
                                                    d="M10 5h4a2 2 0 1 0-4 0M8.5 5a3.5 3.5 0 1 1 7 0h5.75a.75.75 0 0 1 0 1.5h-1.32l-1.17 12.111A3.75 3.75 0 0 1 15.026 22H8.974a3.75 3.75 0 0 1-3.733-3.389L4.07 6.5H2.75a.75.75 0 0 1 0-1.5zm2 4.75a.75.75 0 0 0-1.5 0v7.5a.75.75 0 0 0 1.5 0zM14.25 9a.75.75 0 0 1 .75.75v7.5a.75.75 0 0 1-1.5 0v-7.5a.75.75 0 0 1 .75-.75m-7.516 9.467a2.25 2.25 0 0 0 2.24 2.033h6.052a2.25 2.25 0 0 0 2.24-2.033L18.424 6.5H5.576z" />
                                            </svg>
                                        </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        </div>
    </section>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#nilaiProfilesTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 5 // Set number of rows per page to 5
            });

            // Add Tailwind classes to search input
            $('div.dataTables_filter input').addClass('px-3 py-2 border rounded-full focus:outline-none focus:ring-2 m-3');

            // Add Tailwind classes to length select dropdown
            $('div.dataTables_length select').addClass('px-3 py-2 bg-blue-400 bg-black border rounded-full focus:outline-none focus:ring-2 m-3');
        });
    </script>
</x-layout>
