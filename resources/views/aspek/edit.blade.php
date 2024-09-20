<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section>
        <!--form-->
        <div class="mt-20 flex justify-center">
            <div class="flex justify-start items-center">
                <form action="{{ route('aspek.update', $aspek->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center space-x-3">
                        <!-- Label untuk kode-->
                        <label for="kode_aspek" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Kode</span>
                        </label>
                        <!-- Input untuk kode -->
                        <input type="text" id="kode_aspek" value="{{ $aspek->kode_aspek }}" disabled
                            class="bg-white w-72 h-16 text-black font-balsamiq p-4 focus:outline-blue-500">
                        <input type="hidden" name="kode_aspek" value="{{ $aspek->kode_aspek }}">
                    </div>

                    <div class="flex items-center space-x-3 mt-6">
                        <!-- Label untuk aspek-->
                        <label for="nama_aspek" class="bg-white w-56 h-16 flex items-center px-3">
                            <span class="text-black font-balsamiq font-normal text-xl">Aspek</span>
                        </label>
                        <!-- Input untuk aspek-->
                        <input type="text" id="nama_aspek" name="nama_aspek" value="{{ $aspek->nama_aspek }}"
                            required class="bg-white w-72 h-16 text-black font-balsamiq p-4  focus:outline-blue-500">
                    </div>

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
