<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!--button tambah-->
        <div class="flex justify-end mt-2 items-center">
            <div id="circleButton" class="bg-[#3687FF] hover:bg-opacity-80 w-14 h-14 rounded-full ml-6 flex items-center justify-center cursor-pointer transition duration-300 active:ring-2">
                <a href="{{ route('dosen.create') }}" title="Tambah" class="flex items-center justify-center w-full h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="white" d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2"/></svg>
                </a>
            </div>
        </div>
    </section>

    <section>
        <!-- tabel-->
        <div class="mt-8">
            <table class="datatable border border-slate-700 w-full">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">NIDN</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Dosen</td>
                        <td class="border border-slate-700 p-2 text-center">No Hp</td>
                        <td class="border border-slate-700 p-2 text-center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $dosens as $dosen )
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border border-slate-700 p-2 text-center">{{ $dosen->nidn }}</td>
                        <td class="border border-slate-700 p-2 text-center">{{ $dosen->nama_dosen }}</td>
                        <td class="border border-slate-700 p-2 text-center">{{ $dosen->no_hp }}</td>
                        <td class="border border-slate-700 p-2 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('dosen.edit', $dosen->id) }}">
                                    <button type="submit" title="Ubah" x-data="{ clicked: false }" @click="clicked = true; setTimeout(() => clicked = false, 300)">
                                        <svg :class="clicked ? 'scale-90' : ''" class="transition-transform duration-200 ease-in-out" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><g fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"/><path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3"/></g></svg>
                                    </button>
                                </a>
                                <form id="delete-form-{{ $dosen->id }}" action="{{ route('dosen.destroy', $dosen->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus" x-data="{ clicked: false }"
                                    @click="clicked = true; setTimeout(() => clicked = false, 300)"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus dosen ini?')">
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

