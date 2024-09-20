<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">

    </head>

    <body class="bg-slate-200 flex min-h-screen">
        <x-sidebar></x-sidebar>

        <div class="flex-1 p-4 overflow-auto">
            <x-header>{{ $title }}</x-header>

            <main>
                {{ $slot }}
            </main>
        </div>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
        

        <script>
            $(document).ready(function() {
                $('.datatable').DataTable({
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
    </body>
</html>
