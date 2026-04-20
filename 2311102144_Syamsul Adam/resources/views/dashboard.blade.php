<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Portofolio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                
                @if(session('success'))
                    <div class="mb-4 text-green-600 font-bold">
                        {{ session('success') }}
                    </div>
                @endif

                @php $profile = \App\Models\Profile::first(); @endphp

                <form action="{{ route('portfolio.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ $profile->nama }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">NIM</label>
                        <input type="text" name="nim" value="{{ $profile->nim }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Tentang Saya (About)</label>
                        <textarea name="about" rows="4" class="w-full border-gray-300 rounded-md shadow-sm">{{ $profile->about }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Skills (Pisahkan dengan koma)</label>
                        <input type="text" name="skills" value="{{ $profile->skills }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mt-4">
                        <label class="block font-bold text-gray-700">Ganti Foto Profil</label>
                        <input type="file" name="foto" class="mt-1 block w-full border border-gray-300 p-2 rounded-md">
                        @if($profile->foto)
                            <p class="text-xs text-gray-500 mt-1">File saat ini: {{ $profile->foto }}</p>
                        @endif
                    </div>

                    <button type="submit" class="mt-6 bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition font-bold">
                        Simpan Perubahan
                    </button>
                </form>
                </div>
        </div>
    </div>
</x-app-layout>