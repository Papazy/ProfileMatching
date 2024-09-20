<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!-- tabel-->
        <div class="mt-8">
            <table class="datatable2 border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">Tanggal Pengajuan</td>
                        <td class="border border-slate-700 p-2 text-center">NIM</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Mahasiswa</td>
                        <td class="border border-slate-700 p-2 text-center">Judul</td>
                        <td class="border border-slate-700 p-2 text-center">Status</td>
                        <td class="border border-slate-700 p-2 text-center">Keterangan</td>

                        <td class="border border-slate-700 p-2 text-center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pengajuan as $index => $pengajuan)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-slate-700 p-2 text-center">
                                {{ \DateTime::createFromFormat('Y-m-d H:i:s', $pengajuan->tanggal_pengajuan)->format('d-m-Y H:i:s') }}
                            </td>
                            <td class="border border-slate-700 p-2 text-center">{{ $pengajuan->nim }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $pengajuan->nama_mahasiswa }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $pengajuan->judul }}</td>
                            <td class="border border-slate-700 p-2 text-center">
                                @if ($pengajuan->status == 0)
                                    Menunggu Persetujuan
                                @elseif ($pengajuan->status == 1)
                                    Disetujui
                                @elseif ($pengajuan->status == 2)
                                    Ditolak
                                @endif
                            </td>
                            <td class="border border-slate-700 p-2 text-center">
                                @if ($pengajuan->keterangan === null)
                                    -
                                @else
                                    {{ $pengajuan->keterangan }}
                                @endif
                            </td>

                            <td class="border border-slate-700 p-2 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    @if ($pengajuan->status == 0)
                                        <button type="button" title="Pilih" class="approve-button"
                                            data-id="{{ $pengajuan->id_pengajuan }}">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button type="button" title="Pilih" class="reject-button"
                                            data-id="{{ $pengajuan->id_pengajuan }}">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    @elseif ($pengajuan->status == 1)
                                        <button type="button" title="Pilih" class="reject-button"
                                            data-id="{{ $pengajuan->id_pengajuan }}">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    @elseif ($pengajuan->status == 2)
                                        <button type="button" title="Pilih" class="approve-button"
                                            data-id="{{ $pengajuan->id_pengajuan }}">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('.datatable2').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 5 // Set number of rows per page to 5
            });

            // Add Tailwind classes to search input
            $('div.dataTables_filter input').addClass('px-3 py-2 border rounded-full focus:outline-none focus:ring-2 m-3');

            // Add Tailwind classes to length select dropdown
            $('div.dataTables_length select').addClass('px-3 py-2 bg-blue-400 bg-black border rounded-full focus:outline-none focus:ring-2 m-3');

            // Event delegation for dynamically added elements
            $(document).on('click', '.approve-button', function() {
                var id = $(this).data('id');
                handleClick(id);
            });

            $(document).on('click', '.reject-button', function() {
                var id = $(this).data('id');
                handleClickreject(id);
            });
        });

        function handleClick(id) {
            // Loop untuk meminta keterangan hingga pengguna mengisi
            let keterangan = '';
            while (!keterangan.trim()) { // Trim untuk menghilangkan spasi di awal dan akhir
                keterangan = prompt("Masukkan keterangan untuk persetujuan:");
                if (keterangan === null) {
                    // Jika pengguna menekan 'Cancel', batalkan operasi
                    return;
                }
                if (!keterangan.trim()) {
                    alert("Keterangan wajib diisi.");
                }
            }

            // Jika pengguna mengisi keterangan, lanjutkan dengan permintaan
            if (confirm("Disetujui?")) {
                sendRequest(id, '/approve/' + id, keterangan);
            }
        }

        function handleClickreject(id) {
            // Loop untuk meminta keterangan hingga pengguna mengisi
            let keterangan = '';
            while (!keterangan.trim()) { // Trim untuk menghilangkan spasi di awal dan akhir
                keterangan = prompt("Masukkan keterangan untuk penolakan:");
                if (keterangan === null) {
                    // Jika pengguna menekan 'Cancel', batalkan operasi
                    return;
                }
                if (!keterangan.trim()) {
                    alert("Keterangan wajib diisi.");
                }
            }

            // Jika pengguna mengisi keterangan, lanjutkan dengan permintaan
            if (confirm("Ditolak?")) {
                sendRequestreject(id, '/reject/' + id, keterangan);
            }
        }


        function sendRequest(id, url, keterangan) {
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        keterangan: keterangan
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload(); // Misalnya, merefresh halaman setelah aksi
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function sendRequestreject(id, url, keterangan) {
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        keterangan: keterangan
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload(); // Misalnya, merefresh halaman setelah aksi
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</x-layout>
