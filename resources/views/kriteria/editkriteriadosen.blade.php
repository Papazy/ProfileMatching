<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!--form-->
        <div class="mt-10 justify-center">
            <div class="items-center mx-4">
                <form action="{{ route('kriteria.updatekriteriadosen', $dosen->id) }}" method="POST">
                    @csrf
                    <!-- Gunakan metode POST untuk update -->
                    <div class="flex items-center space-x-3 mt-2">
                        <!-- Label untuk  nama Dosen-->
                        <label for="nama_dosen" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl"> Nama Dosen</span>
                        </label>
                        <!-- Input untuk nama Dosen-->
                        <select id="dosen_id" name="dosen_id" required disabled
                            class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                            <option value="{{ $dosen->id }}" selected>{{ $dosen->nama_dosen }}</option>
                        </select>
                    </div>

                    @foreach ($data_kriteria as $index => $kri)
                        <!-- Temukan keterangan yang sesuai untuk kode kriteria ini -->
                        @php
                            $keterangan = $kriteria_dosen->firstWhere('kode_kriteria', $kri->kode_kriteria)->keterangan ?? '';
                        @endphp

                        <div class="flex items-center space-x-3 mt-6">
                            <!-- Label untuk Nama Kriteria-->
                            <label for="keterangan{{ $index + 1 }}"
                                class="bg-white w-72 h-16 flex items-center px-3">
                                <span
                                    class="text-black font-balsamiq font-normal text-xl">{{ $kri->nama_kriteria . ' (' . $kri->kode_kriteria . ')' }}</span>
                            </label>
                            <input type="hidden" name="kode_kriteria{{ $index + 1 }}"
                                value="{{ $kri->kode_kriteria }}">
                            <!-- Input untuk nama kriteria -->
                            <textarea id="keterangan{{ $index + 1 }}"
                                name="keterangan{{ $index + 1 }}" required
                                class="bg-white w-full h-auto text-black font-balsamiq p-4  focus:outline-blue-500 overflow-auto resize-none text-justify">{{ $keterangan }}
                            </textarea>
                        </div>
                    @endforeach

                    <div class="mt-4 flex justify-center">
                        <div class="flex justify-start items-center">
                            <button type="submit"
                                class="bg-blue-500 my-9 flex-row ml-96 p-3 gap-4 rounded-3xl font-balsamiq font-bold w-24 h-11 text-center hover:font-semibold hover:text-white tracking-widest active:bg-sky-600">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>
