<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!-- tabel-->
        <div class="mt-8">
            <table class="datatable border border-slate-700 w-full m-2">
                <thead>
                    <tr>
                        <td class="border border-slate-700 p-2 text-center">No</td>
                        <td class="border border-slate-700 p-2 text-center">NIM</td>
                        <td class="border border-slate-700 p-2 text-center">Nama Mahasiswa</td>
                        <td class="border border-slate-700 p-2 text-center">Judul</td>
                        <td class="border border-slate-700 p-2 text-center">Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_bimbingan as $index => $bimbingan)
                        <tr>
                            <td class="border border-slate-700 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $bimbingan->nim }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $bimbingan->nama_mahasiswa }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $bimbingan->judul }}</td>
                            <td class="border border-slate-700 p-2 text-center">{{ $bimbingan->keterangan }}</td>
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

        });
    </script>
</x-layout>
