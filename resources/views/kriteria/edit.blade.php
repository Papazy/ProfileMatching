<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!--form-->
        <div class="mt-20 flex justify-center">
            <div class="flex justify-start items-center">
                <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center space-x-3">
                        <!-- Label untuk kode kriteria-->
                        <label for="kode_kriteria" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Kode Kriteria</span>
                        </label>

                        <!-- Input untuk kode kriteria -->
                        <input type="text" id="kode_kriteria" value="{{ $kriteria->kode_kriteria }}" disabled
                            class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                        <input type="hidden" name="kode_kriteria" value="{{ $kriteria->kode_kriteria }}">
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk nama aspek-->
                        <label for="nama_aspek" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl"> Nama Aspek</span>
                        </label>
                        <!-- Input untuk nama aspek-->
                        <select id="kode_aspek" name="kode_aspek" required class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                            <option value="" disabled {{ is_null($kriteria->kode_aspek) ? 'selected' : '' }}>Pilih Aspek</option>
                            @foreach ($data_aspek as $aspek)
                                <option value="{{ $aspek->kode_aspek }}" {{ $aspek->kode_aspek == $kriteria->kode_aspek ? 'selected' : '' }}>
                                    {{ $aspek->nama_aspek }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk nama kriteria-->
                        <label for="nama_kriteria" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Nama Kriteria</span>
                        </label>
                        <!-- Input untuk nama kriteria -->
                        <input type="text" id="nama_kriteria" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" required class="bg-white w-72 h-16 text-black font-balsamiq p-4  focus:outline-blue-500">
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk nilai-->
                        <label for="nilai" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Nilai</span>
                        </label>
                        <!-- Input untuk nilai -->
                        <input type="text" id="nilai" name="nilai" value="{{ $kriteria->nilai }}" required class="bg-white w-72 h-16 text-black font-balsamiq p-4  focus:outline-blue-500">
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