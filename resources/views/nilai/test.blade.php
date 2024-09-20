<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <section>
    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
      <div class="relative p-4 w-full max-w-2xl  rounded-lg shadow-lg">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
            <h2 class="text-xl font-bold mb-4" id="namaDosen"></h2>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2 right-2 inline-flex justify-center items-center" data-modal-hide="default-modal">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-4">
            <table id="kriteriaTable" class="min-w-full border-collapse border border-gray-300">
              <thead>
                <tr>
                  <th class="border border-gray-300 px-4 py-2">Kode Kriteria</th>
                  <th class="border border-gray-300 px-4 py-2">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <!-- Data akan diisi oleh AJAX -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--button-->
    <div class="flex justify-end mt-2 items-center">
      <div x-data="{ open: false }" class="relative inline-block text-left">

        <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
          <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton">
            <a href="{{ route('nilaisecond.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Secondary
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
        <form action="{{ route('nilai.predict') }}" method="POST">
          @csrf
          <div class="card">
            <div class="flex items-center space-x-3 mt-6">
              <label for="mahasiswa_id" class="bg-white w-72 h-14 flex items-center px-3">
                <span class="text-black font-balsamiq font-normal text-xl">Mahasiswa</span>
              </label>
              <select name="mahasiswa_id" id="mahasiswa_id" required class="bg-white w-full h-14 text-black font-balsamiq px-3 focus:outline-blue-500">
                <option value="" disabled selected>Pilih Mahasiswa</option>
                @foreach ($data_pengajuan as $pengajuan)
                <option value="{{ $pengajuan->mahasiswa_id }}" data-judul="{{ $pengajuan->judul }}" {{ session('mahasiswa_id') == $pengajuan->mahasiswa_id ? 'selected' : '' }}>
                  {{ $pengajuan->nama_mahasiswa }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="flex items-center w-[700px] gap-3 mt-6">
              <label for="judul" class="bg-white w-72 h-14 flex items-center px-3">
                <span class="text-black font-balsamiq font-normal text-xl">Judul</span>
              </label>
              <div id="judul" name="judul" value="" class="bg-white w-full h-14 max-h-24 flex items-center text-black font-balsamiq px-4 focus:outline-blue-500 overflow-auto text-justify">@if(session('judul')){{ session('judul') }}@endif</div>
              <input type="hidden" name="judul" id="judul2" value="{{ session('judul') }}" />
            </div>


            <div class="mt-4 flex ">
              <div class="flex justify-start items-center">
                <button type="submit" class="bg-blue-500 my-9 flex-row ml-96 p-3 gap-4 rounded-3xl font-balsamiq font-bold w-24 h-11 text-center hover:font-semibold hover:text-white tracking-widest active:bg-sky-600">
                  Submit
                </button>
              </div>
            </div>
          </div>
      </div>
      </form>
    </div>
    @if(session('success'))

    <div class=" mx-auto p-4">

      <form action={{ route('nilai.store') }} method="POST">
        @csrf

        <input type="hidden" name="mahasiswa_id" value={{ session('id_mahasiswa') }} />
        <table class="table-auto border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-100">
              <th class="border border-gray-300 px-4 py-2">Nama</th>
              <th class="border border-gray-300 px-4 py-2">K1</th>
              <th class="border border-gray-300 px-4 py-2">K2</th>
              <th class="border border-gray-300 px-4 py-2">K3</th>
              <th class="border border-gray-300 px-4 py-2">K4</th>
              <th class="border border-gray-300 px-4 py-2">K5</th>
            </tr>
          </thead>
          <tbody>
            @foreach(session('all_dosen') as $dosen)
            <tr>
              <td data-dosen-id="{{ $dosen->id }}"" data-mahasiswa-id=" {{ session('mahasiswa_id') }}" class="dosen-row border border-gray-300 px-4 py-2 cursor-pointer transition-all hover:font-bold ">{{ $dosen->nama_dosen }}</td>
              @php
              $nilai_dosen = session('nilai_dosen')[$dosen->id] ?? []; // Menghindari error jika tidak ada nilai untuk dosen tertentu
              @endphp
              @for ($i = 1; $i <= 5; $i++) <td class="border border-gray-300 px-4 py-2">
                <input type="text" name="nilai_kesesuaian[]" value="{{ $nilai_dosen[$i] ?? '' }}" class="border rounded px-2 py-1 w-8" />
                <input type="hidden" name="kode_kriteria[]" value="{{ $i }}" />
                <input type="hidden" name="dosen_ids[]" value="{{ $dosen->id }}" />
                </td>
                @endfor
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="mt-4">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
        </div>
      </form>

    </div>
    @endif
    </div>
  </section>
</x-layout>

<script src="https://code.jquery.com/jquery-3.7.1.min.js""></script>
<script>
$(document).ready(function() {
    $('.dosen-row').on('click', function() {
        var dosenId = $(this).data('dosen-id');
        var mahasiswaId = $(this).data('mahasiswa-id');
        const modal = document.getElementById('default-modal');
        modal.classList.remove('hidden'); // Tampilkan modal

        // AJAX request untuk mengambil data dosen dan kriterianya
        $.ajax({
            url: '/dosen/' + dosenId + '/kriteria/' + mahasiswaId,
            type: 'GET',
            success: function(response) {
                console.log(response);
                var tbody = $('#kriteriaTable tbody');
                tbody.empty(); // Kosongkan tabel sebelum diisi ulang
                var namaDosen = $('#namaDosen');
                namaDosen.text(response[0].nama_dosen);
                response.forEach(function(kriteria) {
                    tbody.append(`
                        <tr>
                            <td class=" border border-gray-300 px-4 py-2">
  $ {
    kriteria.kode_kriteria
  }
  </td> <
  td class = "border border-gray-300 px-4 py-2" > $ {
    kriteria.keterangan
  }
  </td> <
  /tr>
  `);
                });

                $('#kriteriaModal').removeClass('hidden'); // Tampilkan modal
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });

    // Close modal ketika background luar di klik
    $('#kriteriaModal').on('click', function(e) {
        if ($(e.target).is('#kriteriaModal') || $(e.target).is('#closeModal')) {
            $('#kriteriaModal').addClass('hidden'); // Sembunyikan modal
        }
    });
});

</script>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const mahasiswaSelect = document.getElementById('mahasiswa_id');
    const judulInput = document.getElementById('judul');
    const judulInput2 = document.getElementById('judul2');
    const dosenSelect = document.getElementById('dosen_id');
    const kriteriaFields = document.querySelectorAll('input[name^="kode_kriteria"]');

    mahasiswaSelect.addEventListener('change', function() {
      const selectedOption = mahasiswaSelect.options[mahasiswaSelect.selectedIndex];
      const judul = selectedOption.getAttribute('data-judul');
      judulInput.innerHTML = judul;
      judulInput2.value = judul;
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

  });

  const openModalButton = document.getElementById('open-modal');
  const closeModalButtons = document.querySelectorAll('[data-modal-hide]');
  const modal = document.getElementById('default-modal');

  // Function to show the modal
  function showModal() {
    modal.classList.remove('hidden');
  }

  // Function to hide the modal
  function hideModal() {
    modal.classList.add('hidden');
  }

  // Open modal button click event
  if (openModalButton) {
    openModalButton.addEventListener('click', showModal);
  }

  // Close modal button click event
  closeModalButtons.forEach(button => {
    button.addEventListener('click', function() {
      const targetModalId = this.getAttribute('data-modal-hide');
      const targetModal = document.getElementById(targetModalId);
      if (targetModal) {
        targetModal.classList.add('hidden');
      }
    });
  });

  // Close modal when clicking outside of the modal content
  window.addEventListener('click', function(event) {
    if (event.target === modal) {
      hideModal();
    }
  });

</script>
