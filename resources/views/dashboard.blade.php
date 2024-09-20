<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!-- tabel-->
        <div class="mt-8">
            <table class="datatable border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">Tanggal Persetujuan</td>
                        <td class="border border-slate-700 p-2 text-center">NIM</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Mahasiswa</td>
                        <td class="border border-slate-700 p-2 text-center">Judul</td>
                        <td class="border border-slate-700 p-2 text-center">Dospem 1</td>
                        <td class="border border-slate-700 p-2 text-center">Dospem 2</td>
                        <td class="border border-slate-700 p-2 text-center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pengajuan as $pengajuan)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-slate-700 p-2 text-center">
                                {{ \DateTime::createFromFormat('Y-m-d H:i:s', $pengajuan->tanggal_pengajuan)->format('d-m-Y H:i:s') }}
                            </td>

                            <td class="border border-slate-700 p-2 text-center">{{ $pengajuan->nim }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $pengajuan->nama_mahasiswa }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $pengajuan->judul }}</td>
                            <td class="border border-slate-700 p-2 text-center">
                                @if ($pengajuan->dospem_1 == null)
                                    Belum Dipilih
                                @else
                                    {{ $pengajuan->nama_dosen_1 }}
                                @endif
                            </td>
                            <td class="border border-slate-700 p-2 text-center">
                                @if ($pengajuan->dospem_2 == null)
                                    Belum Dipilih
                                @else
                                    {{ $pengajuan->nama_dosen_2 }}
                                @endif
                            </td>
                            <td class="border border-slate-700 p-2 text-center">
                                @if ($pengajuan->dospem_1 !== null || $pengajuan->dospem_2 !== null)
                                    <a href="{{ route('pemilihandosen', ['mahasiswa_id' => $pengajuan->mahasiswa_id]) }}"
                                        class="bg-[#3687FF] text-white px-4 py-1 rounded-full text-sm">Edit</a>
                                @else
                                    <a href="{{ route('pemilihandosen', ['mahasiswa_id' => $pengajuan->mahasiswa_id]) }}"
                                        class="bg-[#3687FF] text-white px-4 py-1 rounded-full text-sm">Pilih</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layout>
