<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="flex-1 p-4 overflow-auto">
        <div class="mt-20 flex justify-center">
            <div class="flex justify-start items-center">
                <form action="{{ route('mahasiswa.submitjudul', $pengajuan->id) }}" method="POST">
                    @csrf
                    <div class="flex items-center space-x-3">
                        <!-- Label untuk nama mahasiswa-->
                        <label for="nama_mahasiswa" class="bg-white w-60 h-14 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Nama Mahasiswa</span>
                        </label>
                        <!-- Input untuk nama mahasiswa -->
                        <input type="text" id="nama_mahasiswa" value="{{ $pengajuan->nama_mahasiswa }}" readonly class="bg-white w-60 h-14 text-black font-balsamiq p-4 focus:outline-blue-500" >
                    </div>

                    <div class="flex items-center space-x-3 mt-3">
                        <!-- Label untuk nim-->
                        <label for="nim" class="bg-white w-60 h-14 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">NIM</span>
                        </label>
                        <!-- Input untuk nim-->
                        <input type="text" id="nim" value="{{ $pengajuan->nim }}" readonly class="bg-white w-60 h-14 text-black font-balsamiq p-4 focus:outline-blue-500" >
                    </div>

                    <div class="mt-8">
                        <table class="border border-slate-700 w-full">
                            <thead>
                                <tr>
                                    <td class="border border-slate-700 p-2 text-center">No</td>
                                    <td class="border border-slate-700 p-2 text-center">Judul yang Diajukan</td>
                                    <td class="border border-slate-700 p-2 text-center">Verifikasi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-slate-700 p-2 text-center">1</td>
                                    <td class="border border-slate-700 p-2 text-center">{{ $pengajuan->judul1 }}</td>
                                    <td class="border border-slate-700 p-2 text-center">
                                        <input type="checkbox" id="judul1" name="judul1" value="judul1">
                                        <label for="judul1" >Verifikasi</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-slate-700 p-2 text-center">2</td>
                                    <td class="border border-slate-700 p-2 text-center">{{ $pengajuan->judul2 }}</td>
                                    <td class="border border-slate-700 p-2 text-center">
                                        <input type="checkbox" id="judul2" name="judul2" value="judul2">
                                        <label for="judul2" >Verifikasi</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-slate-700 p-2 text-center">3</td>
                                    <td class="border border-slate-700 p-2 text-center">{{ $pengajuan->judul3 }}</td>
                                    <td class="border border-slate-700 p-2 text-center">
                                        <input type="checkbox" id="judul3" name="judul3" value="judul3">
                                        <label for="judul3" >Verifikasi</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
        
                    <div class="mt-4 flex justify-center">
                        <div class="flex justify-start items-center">
                            <button type="submit" class="bg-blue-500 my-9 flex-row ml-96 p-3 gap-4 rounded-3xl font-balsamiq font-bold w-24 h-11 text-center hover:font-semibold hover:text-white tracking-widest active:bg-sky-600">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>