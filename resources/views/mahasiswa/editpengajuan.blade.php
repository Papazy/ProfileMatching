<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!-- Form -->
        <div class="mt-20 flex justify-center">
            <div class="flex justify-start items-center">
                <form action="{{ route('mahasiswa.update.pengajuan', $pengajuanJudul->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex items-center space-x-3">
                        <!-- Label untuk Dosen Pembimbing -->
                        <label for="dosen_id" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Dosen PA</span>
                        </label>
                        <!-- Select untuk Dosen Pembimbing -->
                        <select id="dosen_id" name="dosen_id" required class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                            @foreach ($data_dosen as $dosen)
                                <option value="{{ $dosen->id }}" {{ $pengajuanJudul->dosen_id == $dosen->id ? 'selected' : '' }}>{{ $dosen->nama_dosen }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk Tanggal Pengajuan -->
                        <label for="tanggal_pengajuan" class="bg-white w-60 h-14 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Tanggal Pengajuan</span>
                        </label>
                        <!-- Input untuk Tanggal Pengajuan -->
                        <input type="date" id="tanggal_pengajuan" name="tanggal_pengajuan" value="{{ $pengajuanJudul->tanggal_pengajuan }}" required class="bg-white w-60 h-14 text-black font-balsamiq p-4 focus:outline-blue-500">
                    </div> --}}
                    <input type="hidden" id="tanggal_pengajuan" name="tanggal_pengajuan" value="{{ $pengajuanJudul->tanggal_pengajuan }}" required class="bg-white w-60 h-14 text-black font-balsamiq p-4 focus:outline-blue-500">


                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk Judul -->
                        <label for="judul" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Judul</span>
                        </label>
                        <!-- Input untuk Judul -->
                        <textarea id="judul" name="judul" required class="bg-white w-72 h-auto text-black font-balsamiq p-4 focus:outline-blue-500 overflow-auto">{{ $pengajuanJudul->judul }}
                        </textarea>
                    </div>

                    <div class="mt-4 flex justify-center">
                        <div class="flex justify-start items-center">
                            <button type="submit" class="bg-blue-500 my-9 flex-row ml-96 p-3 gap-4 rounded-3xl font-balsamiq font-bold w-24 h-11 text-center hover:font-semibold hover:text-white tracking-widest active:bg-sky-600">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>
