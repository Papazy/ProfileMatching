<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>

        <!--form-->
        <div class="mt-20 flex justify-center">
            <div class="flex justify-start items-center">
                <form action="{{ route('mahasiswa.pengajuanjudul.store') }}" method="POST">
                    @csrf

                    <input type="hidden" id="tanggal_pengajuan" name="tanggal_pengajuan"
                           value="{{ date('Y-m-d H:i:s') }}"
                           class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">

                    <!-- Input Judul -->
                    <div class="flex items-center space-x-3 mt-6">
                        <label for="judul" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Judul</span>
                        </label>
                        <textarea id="judul" name="judul" required
                                  class="bg-white w-72 h-auto text-black font-balsamiq p-4 focus:outline-blue-500 overflow-auto"></textarea>
                    </div>

                    <!-- Dosen PA -->
                    <div class="flex items-center space-x-3 mt-6">
                        <label for="dosen_id" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Dosen PA</span>
                        </label>
                        <select id="dosen_id" name="dosen_id" required class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                            <option value="" disabled selected>Pilih Dosen</option>
                            @foreach ($data_dosen as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kategori 1 -->
                    <div class="flex items-center space-x-3 mt-6">
                        <label for="kategori_1" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Bidang Keilmuan</span>
                        </label>
                        <select id="kategori_1" name="kategori_1" required class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="1">Komputer</option>
                            <option value="2">E-government</option>
                            <option value="3">Web programming</option>
                            <option value="4">Sistem pendukung keputusan</option>
                            <option value="5">Multimedia</option>
                            <option value="6">Embedded system</option>
                            <option value="7">Pemrograman</option>
                            <option value="8">Manajemen telekomunikasi</option>
                            <option value="9">Teknik informatika</option>
                            <option value="10">Sistem informasi</option>



                            <!-- Add more options as needed -->
                        </select>
                    </div>

                    <!-- Kategori 2 -->
                    <div class="flex items-center space-x-3 mt-6">
                        <label for="kategori_2" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Mata Kuliah Terkait</span>
                        </label>
                        <select id="kategori_2" name="kategori_2" required class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="11">E-commerce</option>
                            <option value="12">E-government</option>
                            <option value="13">Sistem informasi manajemen</option>
                            <option value="14">Metodologi penelitian</option>
                            <option value="15">Hukum dan etika teknologi informasi</option>
                            <option value="16">Teknologi web</option>
                            <option value="17">Teknologi basis data</option>
                            <option value="18">Pemrograman web</option>
                            <option value="19">Bahasa kueri terstruktur</option>
                            <option value="20">Media sosial dan periklanan</option>
                            <option value="21">Algoritma dan pemrograman</option>
                            <option value="22">Struktur data</option>
                            <option value="23">Jaringan komputer dan komunikasi data</option>
                            <option value="24">3D object modelling</option>
                            <option value="25">3D animation</option>
                            <option value="26">Arsitektur teknologi informasi</option>
                            <option value="27">Teknologi immersive</option>
                            <option value="28">Teknologi jaringan nirkabel</option>
                            <option value="29">Design grafis berbasis vector</option>
                            <option value="30">Teknologi cloud computing</option>
                            <option value="31">Decision support system</option>
                            <option value="32">Manajemen big data</option>
                            <option value="33">Pemrograman berorientasi objek</option>
                            <option value="34">Interaksi manusia dan komputer</option>
                        </select>
                    </div>

                    <!-- Kategori 3 -->
                    <div class="flex items-center space-x-3 mt-6">
                        <label for="kategori_3" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Bidang Penelitian</span>
                        </label>
                        <select id="kategori_3" name="kategori_3" required class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="35">E-government</option>
                            <option value="36">E-commerce</option>
                            <option value="37">Data mining</option>
                            <option value="38">Literasi digital</option>
                            <option value="39">Teknologi informasi</option>
                            <option value="40">Web programming</option>
                            <option value="41">Embedded system</option>
                            <option value="42">Multimedia</option>
                            <option value="43">Game</option>
                            <option value="44">Animasi</option>
                            <option value="45">Design grafis</option>
                            <option value="46">Artificial Intelligence</option>
                            <option value="47">Teknologi tepat guna</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>

                    <!-- Kategori 4 -->
                    <div class="flex items-center space-x-3 mt-6">
                        <label for="kategori_4" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Pengabdian Terkait</span>
                        </label>
                        <select id="kategori_4" name="kategori_4" required class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="48">Seminar etika berteknologi</option>
                            <option value="49">KKN literasi digital</option>
                            <option value="50">Pembimbing olimpiade informatika</option>
                            <option value="51">Pengabdian tentang teknologi multimedia</option>
                            <option value="52">Pengabdian teknologi tepat guna</option>
                        </select>
                    </div>



                    <!-- Submit Button -->
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
    </section>

    <!-- Menampilkan alert -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ({{ session('success') ? 'true' : 'false' }}) {
                alert('{{ session('success') }}');
            }
        });
    </script>
</x-layout>


