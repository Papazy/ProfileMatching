<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section>
        <!-- tabel-->
        <div class="mt-12">

            <form action="{{ route('perhitungan') }}" method="POST">
                @csrf

                <table class="border border-slate-700 w-full m-2">
                    <thead>
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">No</td>
                            <td class="border border-slate-700 p-2 text-center">NIDN</td>
                            <td class="border border-slate-700 p-2 text-center">Dosen</td>
                            <td class="border border-slate-700 p-2 text-center">Pilih</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data_dosen->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Data dosen tidak tersedia.</td>
                            </tr>
                        @else
                            @foreach ($data_dosen as $index => $dosen)
                                <tr>
                                    <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border border-slate-700 p-2 text-center">{{ $dosen->nidn }}</td>
                                    <td class="border border-slate-700 p-2 text-center">{{ $dosen->nama_dosen }}</td>
                                    <td class="border border-slate-700 p-2 text-center">
                                        <input type="checkbox" name="dosen_ids[]" value="{{ $dosen->dosen_id }}">
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                </table>
                @if ($data_dosen->isEmpty())
                    <div class="flex justify-center mt-4">
                        <a href="/nilai/create" class="bg-[#3687FF] text-white px-4 py-2 rounded">Silahkan tambahkan
                            Penilaian Kesuaian - {{ $data_mahasiswa->nama_mahasiswa }}</a>
                    </div>
                @else
                    <div class="flex justify-end mt-4">
                        <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa_id }}">
                        <button type="submit" class="bg-[#3687FF] text-white px-4 py-2 rounded">Lihat
                            Perhitungan</button>
                    </div>
                @endif

            </form>
        </div>

    </section>

</x-layout>
