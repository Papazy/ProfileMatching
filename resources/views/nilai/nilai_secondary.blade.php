<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section>
        <div class="flex justify-end mt-2 items-center">
            <div x-data="{ open: false }" class="relative inline-block text-left">
                <div class="bg-gradient-custom-search rounded-full w-60 h-10 flex items-center justify-between px-3">
                    <span class="text-black font-balsamiq font-medium text-xl">Secondary Factor</span>
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
        </div>
    </section>

    <section>
        <div class="mt-12">
            <table class="datatable border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">Mahasiswa</td>
                        <td class="border border-slate-700 p-2 text-center">Judul</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Dosen</td>
                        @foreach ($aspek_secon as $asp)
                            <td class="border border-slate-700 p-2 text-center">{{ $asp->nama_aspek }}</td>
                        @endforeach
                        <td class="border border-slate-700 p-2 text-center">NSF</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiProfiles as $index => $nilaiProfile)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile->nama_mahasiswa }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile->judul }}</td>
                            <td class="border border-slate-700 p-2">{{ $nilaiProfile->nama_dosen }}</td>
                            @foreach ($aspek_secon as $asp)
                                <td class="border border-slate-700 p-2 text-center">
                                    {{ $nilaiProfile->rataRataBobot[$asp->kode_aspek] ?? '-' }}
                                </td>
                            @endforeach
                            <td class="border border-slate-700 p-2 text-center">
                                {{ $nilaiProfile->nilaiNSF }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layout>
