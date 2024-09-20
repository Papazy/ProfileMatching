<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!--form-->
        <div class="mt-20 flex justify-center">
            <div class="flex justify-start items-center">
                <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center space-x-3" >
                        <!-- Label untuk NIM -->
                        <label for="nim" class="bg-white w-56 h-16 flex items-center px-3">
                        <span class="text-black font-balsamiq font-normal text-xl">NIM</span>
                        </label>
                        <!-- Input untuk NIM -->
                        <input type="text" id="nim" name="nim" value="{{ $mahasiswa->nim }}" required class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk nama mahasiswa-->
                        <label for="nama_mahasiswa" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Nama Mahasiswa</span>
                        </label>
                        <!--Input untuk nama mahasiswa -->
                        <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ $mahasiswa->nama_mahasiswa }}" required class="bg-white w-72 h-14 text-black font-balsamiq p-4 focus:outline-blue-500">
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!--Label jenis kelamin-->
                        <label for="jenis_kelamin" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Jenis Kelamin</span>
                        </label>
                        <!--Input jenis kelamin-->
                        <input id="jenis_kelamin_laki_laki" name="jenis_kelamin" required value="Laki-Laki" {{ $mahasiswa->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }} class="form-radio text-blue-500 p-4" type="radio">
                        <span class="ml-2 text-black font-balsamiq">Laki-laki</span>
                        <input id="jenis_kelamin_perempuan" name="jenis_kelamin" required value="Perempuan" {{ $mahasiswa->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} class="form-radio text-blue-500 p-4" type="radio">
                        <span class="ml-2 text-black font-balsamiq">Perempuan</span>
                    </div>
                    

                    <div class="flex items-center space-x-3 mt-6" action="">
                        <!-- Label untuk No Hp -->
                        <label for="no_hp" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">No Hp</span>
                        </label>
                        <!-- Input untuk No Hp -->
                        <input type="text" id="no_hp" name="no_hp" value="{{ $mahasiswa->no_hp }}" class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
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