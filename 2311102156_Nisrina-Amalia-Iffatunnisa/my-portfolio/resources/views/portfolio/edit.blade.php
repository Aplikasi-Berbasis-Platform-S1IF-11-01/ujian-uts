<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Portfolio / Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 shadow-sm border border-red-100" role="alert">
                    <span class="font-medium">Oops, ada masalah!</span>
                    <ul class="mt-1.5 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('portfolio.update', $portfolio->id) }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="title" value="Judul Project" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $portfolio->title)" required />
                        </div>
                        <div>
                            <x-input-label for="category" value="Kategori" />
                            <select id="category" name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="Product Development" {{ old('category', $portfolio->category) == 'Product Development' ? 'selected' : '' }}>Product Development</option>
                                <option value="Project Management" {{ old('category', $portfolio->category) == 'Project Management' ? 'selected' : '' }}>Project Management</option>
                                <option value="Leadership" {{ old('category', $portfolio->category) == 'Leadership' ? 'selected' : '' }}>Leadership</option>
                                <option value="Public Speaking" {{ old('category', $portfolio->category) == 'Public Speaking' ? 'selected' : '' }}>Public Speaking</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="date_range" value="Rentang Waktu (Misal: Maret 2026)" />
                            <x-text-input id="date_range" name="date_range" type="text" class="mt-1 block w-full" :value="old('date_range', $portfolio->date_range)" />
                        </div>
                        <div>
                            <x-input-label for="image_url" value="Gambar Project" />
                            <input id="image_url" name="image_url" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            @if($portfolio->image_url)
                                <p class="mt-2 text-sm text-gray-500">Gambar saat ini: <a href="{{ $portfolio->image_url }}" target="_blank" class="text-indigo-600 hover:underline">Lihat</a></p>
                            @endif
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="description" value="Deskripsi" />
                            <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">{{ old('description', $portfolio->description) }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="link" value="Tautan Project (URL)" />
                            <x-text-input id="link" name="link" type="url" class="mt-1 block w-full" :value="old('link', $portfolio->link)" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 mt-6">
                        <x-primary-button>Simpan Perubahan</x-primary-button>
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
