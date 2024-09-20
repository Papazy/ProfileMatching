<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!--form-->
        <div class="mt-20 flex justify-center">
            <div class="flex justify-start items-center">
                <form action="{{ route('dosen.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="password">
                    <div class="flex items-center space-x-3">
                        <!-- Label untuk NIDN-->
                        <label for="nidn" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">NIDN</span>
                        </label>
                        <!-- Input untuk NIDN -->
                        <input type="text" id="nidn" name="nidn" required class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk nama dosen-->
                        <label for="nama_dosen" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Nama Dosen</span>
                        </label>
                        <!-- Input untuk nama dosen-->
                        <input type="text" id="nama_dosen" name="nama_dosen" required class="bg-white w-72 h-16 text-black font-balsamiq p-4  focus:outline-blue-500">
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk no hp-->
                        <label for="no_hp" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">No Hp</span>
                        </label>
                        <!-- Input untuk no hp -->
                        <input type="text" id="no_hp" name="no_hp" required class="bg-white w-72 h-16 text-black font-balsamiq p-4  focus:outline-blue-500">
                    </div>

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
</x-layout>