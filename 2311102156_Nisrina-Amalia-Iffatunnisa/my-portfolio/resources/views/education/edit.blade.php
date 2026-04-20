<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Education') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('education.update', $education->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="period" value="Periode (Misal: 2021 - 2025)" />
                        <x-text-input id="period" name="period" type="text" class="mt-1 block w-full" :value="old('period', $education->period)" required />
                    </div>

                    <div>
                        <x-input-label for="institution" value="Institusi Pendikan (Misal: Universitas Telkom)" />
                        <x-text-input id="institution" name="institution" type="text" class="mt-1 block w-full" :value="old('institution', $education->institution)" required />
                    </div>

                    <div>
                        <x-input-label for="major" value="Jurusan (Misal: S1 Teknik Informatika)" />
                        <x-text-input id="major" name="major" type="text" class="mt-1 block w-full" :value="old('major', $education->major)" required />
                    </div>

                    <div>
                        <x-input-label for="description" value="Deskripsi Singkat" />
                        <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('description', $education->description) }}</textarea>
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
