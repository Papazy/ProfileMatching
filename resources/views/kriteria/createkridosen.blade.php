<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!--form-->
        <div class="mt-10 justify-center">
            <div class="items-center mx-4">
                <form action="{{ route('kriteria.storekriteriados') }}" method="POST">
                    @csrf
                    <div class="flex items-center space-x-3 mt-2">
                        <!-- Label untuk  nama dosen-->
                        <label for="nama_aspek" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl"> Nama Dosen</span>
                        </label>
                        <!-- Input untuk nama dosen-->
                        <select id="dosen_id" name="dosen_id" required
                            class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                            <option value="" disabled selected>Pilih Dosen</option>
                            @foreach ($data_dosen as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach ($data_kriteria as $index => $kri)
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
                            <textarea id="keterangan{{ $index + 1 }}" name="keterangan{{ $index + 1 }}" required
                                class="bg-white w-full h-auto text-black font-balsamiq p-4 focus:outline-blue-500 overflow-auto text-justify">
                            </textarea>
                        </div>
                    @endforeach

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
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Adjust textarea height automatically
            $('textarea').on('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    </script> --}}
</x-layout>
