<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portfolio Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-xl bg-green-50 shadow-sm border border-green-100"
                    role="alert">
                    <span class="font-medium">Berhasil!</span> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 shadow-sm border border-red-100"
                    role="alert">
                    <span class="font-medium">Oops, ada masalah!</span>
                    <ul class="mt-1.5 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Profile Utama -->
            <div class="p-4 sm:p-8 bg-white shadow-sm border border-slate-100 sm:rounded-3xl">
                <section>
                    <header class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900">Profil Utama</h2>
                        <p class="mt-1 text-sm text-gray-600">Ubah info profil profil, termasuk foto utama Anda di
                            beranda.</p>
                    </header>
                    <form method="post" action="{{ route('profile.update-data') }}" enctype="multipart/form-data"
                        class="space-y-6 max-w-2xl">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <x-input-label for="prof_name" value="Nama" />
                                <x-text-input id="prof_name" name="name" type="text" class="mt-1 block w-full"
                                    :value="$profile->name ?? ''" required />
                            </div>
                            <div>
                                <x-input-label for="prof_title" value="Judul (Misal: AI Enthusiast)" />
                                <x-text-input id="prof_title" name="title" type="text" class="mt-1 block w-full"
                                    :value="$profile->title ?? ''" required />
                            </div>
                            <div>
                                <x-input-label for="prof_image" value="Foto Profil" />
                                <input id="prof_image" name="image_url" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                @if(isset($profile) && $profile->image_url)
                                    <p class="mt-2 text-sm text-gray-500">Gambar saat ini: <a
                                            href="{{ $profile->image_url }}" target="_blank"
                                            class="text-indigo-600 hover:underline">Lihat</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit"
                                class="inline-flex justify-center items-center px-6 py-2.5 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 shadow-md hover:shadow-lg transition duration-300">Simpan
                                Profil</button>
                        </div>
                    </form>
                </section>
            </div>

            <!-- Manage Portfolios -->
            <div class="p-4 sm:p-8 bg-white shadow-sm border border-slate-100 sm:rounded-3xl">
                <section>
                    <header class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Kelola Project Portofolio</h2>
                            <p class="mt-1 text-sm text-gray-600">Tambah, Edit, atau Hapus project yang tampil di
                                website.</p>
                        </div>
                    </header>

                    <form method="post" action="{{ route('portfolio.store') }}"
                        class="mb-8 bg-gray-50 p-4 rounded-lg border border-gray-200" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-md font-medium text-gray-900 mb-4">Tambah Project Baru</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="p_title" value="Judul Project" />
                                <x-text-input id="p_title" name="title" type="text" class="mt-1 block w-full"
                                    required />
                            </div>
                            <div>
                                <x-input-label for="p_category" value="Kategori" />
                                <select id="p_category" name="category"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Product Development">Product Development</option>
                                    <option value="Project Management">Project Management</option>
                                    <option value="Leadership">Leadership</option>
                                    <option value="Public Speaking">Public Speaking</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="p_date_range" value="Rentang Waktu (Misal: Maret 2026)" />
                                <x-text-input id="p_date_range" name="date_range" type="text"
                                    class="mt-1 block w-full" />
                            </div>
                            <div>
                                <x-input-label for="p_image" value="Gambar Project" />
                                <input id="p_image" name="image_url" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="p_desc" value="Deskripsi" />
                                <textarea id="p_desc" name="description"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="p_link" value="Tautan Project (URL)" />
                                <x-text-input id="p_link" name="link" type="url" class="mt-1 block w-full" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit"
                                class="inline-flex justify-center items-center px-6 py-2.5 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 shadow-md hover:shadow-lg transition duration-300">Tambah
                                Project</button>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-500">
                            <thead
                                class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-100 rounded-xl">
                                <tr>
                                    <th class="px-6 py-4 rounded-tl-xl font-semibold">Project Info</th>
                                    <th class="px-6 py-4 font-semibold">Category / Date</th>
                                    <th class="px-6 py-4 font-semibold">Link</th>
                                    <th class="px-6 py-4 rounded-tr-xl font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($portfolios as $p)
                                    <tr class="bg-white border-b border-slate-50 hover:bg-slate-50/50 transition">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-slate-900 text-base mb-1">{{ $p->title }}</div>
                                            <div class="text-xs">{{ Str::limit($p->description, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div>{{ $p->category ?? '-' }}</div>
                                            <div class="text-xs text-gray-400">{{ $p->date_range ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ $p->link }}" class="text-blue-600 hover:text-blue-800 transition"
                                                target="_blank" title="Lihat">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 flex items-center gap-4">
                                            <a href="{{ route('portfolio.edit', $p->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 transition" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('portfolio.destroy', $p->id) }}"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition"
                                                    onclick="return confirm('Hapus project ini?')" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if((isset($portfolios) ? $portfolios : collect([]))->isEmpty())
                            <p class="text-center text-gray-500 mt-4">Belum ada project.</p>
                        @endif
                    </div>
                </section>
            </div>

        </div>
    </div>
</x-app-layout>