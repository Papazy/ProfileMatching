<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!--form-->
        <div class="mt-20 flex justify-center">
            <div class="flex justify-start items-center">
                <form action="{{ route('kriteria.store') }}" method="POST">
                    @csrf
                    <div class="flex items-center space-x-3">
                        <!-- Label untuk Kode-->
                        <label for="kode_kriteria" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Kode Kriteria</span>
                        </label>
                        <!-- Input untuk kode -->

                        <input type="text" id="kode_kriteria" value="{{ $newKodeKri }}" disabled
                            class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                        <input type="hidden" name="kode_kriteria" value="{{ $newKodeKri }}">
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk  nama Aspek-->
                        <label for="nama_aspek" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl"> Nama Aspek</span>
                        </label>
                        <!-- Input untuk nama Aspek-->
                        <select id="kode_aspek" name="kode_aspek" required
                            class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                            <option value="" disabled selected>Pilih Aspek</option>
                            @foreach ($data_aspek as $aspek)
                                <option value="{{ $aspek->kode_aspek }}">{{ $aspek->nama_aspek }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk Nama Kriteria-->
                        <label for="nama_kriteria" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Nama Kriteria</span>
                        </label>
                        <!-- Input untuk nama kriteria -->
                        <input type="text" id="nama_kriteria" name="nama_kriteria" required
                            class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk Nilai-->
                        <label for="nilai" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Nilai</span>
                        </label>
                        <!-- Input untuk Nilai -->
                        <input type="text" id="nilai" name="nilai" required
                            class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                    </div>
                    <div class="mt-4 flex justify-center">
                        <div class="flex justify-start items-center">
                            <button type="submit"
                                class="bg-blue-500 my-9 flex-row ml-96 p-3 gap-4 rounded-3xl font-balsamiq font-bold w-24 h-11 text-center hover:font-semibold hover:text-white tracking-widest active:bg-sky-600">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>
