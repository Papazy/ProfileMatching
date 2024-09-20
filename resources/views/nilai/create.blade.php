<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!--button-->
        <div class="flex justify-end mt-2 items-center">
            <div x-data="{ open: false }" class="relative inline-block text-left">

                <div x-show="open" @click.away="open = false"
                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton">
                        <a href="{{ route('nilaisecond.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Secondary
                            Factor
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <!--form-->
        <div class="mt-7">
            <div class="flex px-3">
                <form action="{{ route('nilai.store') }}" method="POST">
                    @csrf
                    <div class="card">
                    <div class="flex items-center space-x-3 mt-6">
                        <label for="mahasiswa_id" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Pilih Mahasiswa</span>
                        </label>
                        <select name="mahasiswa_id" id="mahasiswa_id" required
                            class="bg-white w-72 h-16 text-black font-balsamiq p-3 focus:outline-blue-500">
                            <option value="" disabled selected>Pilih Mahasiswa</option>
                            @foreach ($data_pengajuan as $pengajuan)
                                <option value="{{ $pengajuan->mahasiswa_id }}" data-judul="{{ $pengajuan->judul }}">
                                    {{ $pengajuan->nama_mahasiswa }}
                                </option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="flex items-center space-x-3 mt-6">
                        <label for="judul" class="bg-white w-72 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Judul</span>
                        </label>
                        <textarea id="judul" name="judul" value="" disabled
                            class="bg-white w-full h-auto text-black font-balsamiq p-4 focus:outline-blue-500 overflow-auto text-justify">
                        </textarea>
                    </div>
    
                    <!-- Dropdown untuk memilih Dosen -->
                    <div class="flex items-center space-x-3 mt-6">
                        <label for="dosen_id" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Pilih Dosen</span>
                        </label>
                        <select name="dosen_id" id="dosen_id" required
                            class="bg-white w-72 h-16 text-black font-balsamiq p-3 focus:outline-blue-500">
                            <option value="" disabled selected>Pilih Dosen</option>
                        
                        </select>
                    </div>
    
                    <!-- Input untuk kriteria -->
                    @foreach ($kriteria as $index => $kri)
                        <div class="flex items-center space-x-3 mt-6">
                            <label for="k{{ $index }}" class="bg-white w-56 h-16 flex items-center px-3">
                                <span class="text-black font-balsamiq font-normal text-xl">Kriteria {{ $index + 1 }}</span>
                            </label>
                            <input type="hidden" name="kode_kriteria{{ $index + 1 }}"
                                value="{{ $kri->kode_kriteria }}">
                            <input type="hidden" name="nilai_kriteria{{ $index + 1 }}"
                                value="{{ $kri->nilai }}">
                            <select name="nilai_kesesuaian{{ $index + 1 }}"
                                id="nilai_kesesuaian{{ $index + 1 }}" required
                                class="bg-white w-72 h-16 text-black font-balsamiq p-3 focus:outline-blue-500">
                                <option value="" disabled selected>Pilih Nilai Kesesuaian</option>
                                <option value="1">1 Sangat tidak sesuai</option>
                                <option value="2">2 Tidak sesuai</option>
                                <option value="3">3 Cukup sesuai</option>
                                <option value="4">4 Sesuai</option>
                                <option value="5">5 Sangat sesuai</option>
                            </select>
                        </div>
                        
                        <span data-kriteria="{{ $index + 1 }}"
                        class="text-black font-balsamiq text-sm py-6 mt-2 ml-16 block w-full"></span>
                    @endforeach
    
                    <div class="mt-4 flex ">
                        <div class="flex justify-start items-center">
                            <button type="submit"
                                class="bg-blue-500 my-9 flex-row ml-96 p-3 gap-4 rounded-3xl font-balsamiq font-bold w-24 h-11 text-center hover:font-semibold hover:text-white tracking-widest active:bg-sky-600">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
                </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mahasiswaSelect = document.getElementById('mahasiswa_id');
        const judulInput = document.getElementById('judul');
        const dosenSelect = document.getElementById('dosen_id');
        const kriteriaFields = document.querySelectorAll('input[name^="kode_kriteria"]');

        mahasiswaSelect.addEventListener('change', function() {
            const selectedOption = mahasiswaSelect.options[mahasiswaSelect.selectedIndex];
            const judul = selectedOption.getAttribute('data-judul');
            judulInput.value = judul;
            judulInput.disabled = false;

            const mahasiswaId = selectedOption.value;

            fetch(`/nilai/available-dosens/${mahasiswaId}`)
                .then(response => response.json())
                .then(data => {
                    dosenSelect.innerHTML =
                        '<option value="" disabled selected>Pilih Dosen</option>';
                    data.forEach(dosen => {
                        dosenSelect.innerHTML +=
                            `<option value="${dosen.id}">${dosen.nama_dosen}</option>`;
                    });
                });
        });

        dosenSelect.addEventListener('change', function() {
            const dosenId = dosenSelect.value;

            fetch(`/nilai/criteria/${dosenId}`)
                .then(response => response.json())
                .then(data => {
                    kriteriaFields.forEach(field => {
                        const kriteriaIndex = field.name.replace('kode_kriteria', '');
                        const kriteriaData = data.find(kri => kri.kode_kriteria === field.value);
                        const keteranganField = document.querySelector(`span[data-kriteria="${kriteriaIndex}"]`);
                        if (kriteriaData) {
                            keteranganField.textContent = kriteriaData.keterangan;
                        } else {
                            keteranganField.textContent = 'Tidak ada keterangan tersedia';
                        }
                    });
                });
        });
    });
</script>
