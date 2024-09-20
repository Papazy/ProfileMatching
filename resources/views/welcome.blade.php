<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Spendos - Welcome</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    </head>
    <body class="bg-gradient-custom">
        <main>
            <div class="container mx-auto flex flex-col min-h-screen justify-center items-center">
                <div class="w-full max-w-md">
                    <div class="w-28 h-28 mx-auto m-3">
                        <img src="gambar/logo_bosowa.png" alt="logo_unibos">
                    </div>
                        <h2 class="font-poppins font-bold text-6xl tracking-widest text-white text-center p-4">SPENDOS</h2>
                        <h3 class="font-poppins font-semibold text-xl text-center text-white">Sistem Pendukung Keputusan Penentuan Dosen Pembimbing Skripsi Teknologi Informasi</h3>
                    <div class="hover:bg-blue-400 my-9 flex-row m-auto p-3 gap-4 bg-white rounded-3xl font-poppins font-bold w-56 h-12 text-center hover:text-white hover:font-semibold tracking-widest active:bg-sky-600">
                        <a href="{{ route('login') }}">Mulai</a>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
