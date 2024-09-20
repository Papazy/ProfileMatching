<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section>
        <!--button search-->
        <div class="flex justify-end mt-2 items-center">


            <div id="circleButton"
                class="bg-[#3687FF] hover:bg-opacity-80 w-14 h-14 rounded-full ml-6 flex items-center justify-center cursor-pointer transition duration-300 active:ring-2">
                <a href="{{ route('kriteria.create') }}" title="Tambah"
                    class="flex items-center justify-center w-full h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                        class="fill-current text-white">
                        <path
                            d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section>
        <!-- tabel-->
        <div class="mt-8">
            <table class="datatable border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">Kode Kriteria</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Aspek</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Kriteria</td>
                        <td class="border border-slate-700 p-2 text-center">Nilai</td>
                        <td class="border border-slate-700 p-2 text-center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriterias as $kriteria)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $kriteria->kode_kriteria }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $kriteria->nama_aspek }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $kriteria->nama_kriteria }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $kriteria->nilai }}</td>
                            <td class="border border-slate-700 p-2 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('kriteria.edit', $kriteria->id) }}">
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
                                    <form id="delete-form-{{ $kriteria->id }}"
                                        action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" x-data="{ clicked: false }"
                                        @click="clicked = true; setTimeout(() => clicked = false, 300)"
                                        onclick="return confirm ('Apakah Anda yakin ingin menghapus kriteria ini?')">
                                            <svg :class="clicked ? 'scale-90' : ''"
                                             class="transition-transform duration-200 ease-in-out"
                                            xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                            viewBox="0 0 24 24">
                                                <path fill="black"
                                                    d="M10 5h4a2 2 0 1 0-4 0M8.5 5a3.5 3.5 0 1 1 7 0h5.75a.75.75 0 0 1 0 1.5h-1.32l-1.17 12.111A3.75 3.75 0 0 1 15.026 22H8.974a3.75 3.75 0 0 1-3.733-3.389L4.07 6.5H2.75a.75.75 0 0 1 0-1.5zm2 4.75a.75.75 0 0 0-1.5 0v7.5a.75.75 0 0 0 1.5 0zM14.25 9a.75.75 0 0 1 .75.75v7.5a.75.75 0 0 1-1.5 0v-7.5a.75.75 0 0 1 .75-.75m-7.516 9.467a2.25 2.25 0 0 0 2.24 2.033h6.052a2.25 2.25 0 0 0 2.24-2.033L18.424 6.5H5.576z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- tabel kriteria dari setiap dosen --}}
        <div class="mt-8">
            {{-- <a href="/createkriteriadosen"
                class="bg-[#3687FF] hover:bg-opacity-80  h-9 rounded-full mb-6 flex items-center justify-center cursor-pointer transition duration-300 active:ring-2"
                style="padding: 5px 10px 5px 10px;margin: 0 0 20px 0;float: right; color: white;"><b> Tambah Kriteria
                    Dosen</b></a> --}}
            <table class="datatable border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">Dosen</td>
                        @foreach ($kriterias as $kri)
                            <td class="border border-slate-700 p-2 text-center">{{ $kri->kode_kriteria }}</td>
                        @endforeach
                        <td class="border border-slate-700 p-2 text-center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_dosen as $dos)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $dos->nama_dosen }}</td>

                            @foreach ($kriterias as $kri)
                                @php
                                    // Retrieve the specific kriteria_dos record for the current dosen and kriteria
                                    $kriteriaDos = $kriteria_dos
                                        ->get($dos->id)
                                        ?->firstWhere('kode_kriteria', $kri->kode_kriteria);
                                    $keterangan = $kriteriaDos?->keterangan ?? '-';
                                @endphp
                                <td class="border border-slate-700 p-2 text-center">{{ $keterangan }}</td>
                            @endforeach

                            <td class="border border-slate-700 p-2 text-center">
                                @if ($kriteria_dos->get($dos->id))
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('kriteria.editkriteriadosen', $dos->id) }}">
                                            <button type="submit" title="Ubah" x-data="{ clicked: false }"
                                                @click="clicked = true; setTimeout(() => clicked = false, 300)" >
                                                <svg :class="clicked ? 'scale-90' : ''"
                                                    class="transition-transform duration-200 ease-in-out"
                                                    xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="black"
                                                        stroke-linecap="round"stroke-linejoin="round" stroke-width="2">
                                                        <path
                                                            d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                    </g>
                                                </svg>
                                            </button>
                                        </a>
                                        <form action="{{ route('kriteria.deletekriteriadosen', $dos->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus" x-data="{ clicked: false }"
                                            @click="clicked = true; setTimeout(() => clicked = false, 300)"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kriteria dosen ini?')">
                                                <svg :class="clicked ? 'scale-90' : ''"
                                                    class="transition-transform duration-200 ease-in-out"
                                                    xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                    viewBox="0 0 24 24">
                                                    <path fill="black"
                                                        d="M10 5h4a2 2 0 1 0-4 0M8.5 5a3.5 3.5 0 1 1 7 0h5.75a.75.75 0 0 1 0 1.5h-1.32l-1.17 12.111A3.75 3.75 0 0 1 15.026 22H8.974a3.75 3.75 0 0 1-3.733-3.389L4.07 6.5H2.75a.75.75 0 0 1 0-1.5zm2 4.75a.75.75 0 0 0-1.5 0v7.5a.75.75 0 0 0 1.5 0zM14.25 9a.75.75 0 0 1 .75.75v7.5a.75.75 0 0 1-1.5 0v-7.5a.75.75 0 0 1 .75-.75m-7.516 9.467a2.25 2.25 0 0 0 2.24 2.033h6.052a2.25 2.25 0 0 0 2.24-2.033L18.424 6.5H5.576z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="/createkriteriadosen">
                                            <button type="submit" title="Tambah" x-data="{ clicked: false }"
                                                @click="clicked = true; setTimeout(() => clicked = false, 300)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    viewBox="0 0 24 24" class="fill-current text-dark">
                                                    <path
                                                        d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2" />
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <!--Menampilkan alert -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if ({{ session('success') ? 'true' : 'false' }}) {
                alert('{{ session('success') }}');
            }
        });
    </script>
</x-layout>
