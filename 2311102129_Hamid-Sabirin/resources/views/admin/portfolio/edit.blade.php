<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-10">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- Form Header --}}
                <div class="px-8 py-6 border-b border-gray-100 flex items-center gap-4">
                    <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-circle text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Pengaturan Portofolio</h2>
                        <p class="text-sm text-gray-500">Perbarui informasi utama yang ditampilkan pada halaman landing Anda.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.portfolio.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="p-8 divide-y divide-gray-100">
                        {{-- Name --}}
                        <div class="py-6 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="name" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-user text-purple-400"></i> Nama Lengkap
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="name" name="name" type="text" value="{{ old('name', $portfolio->name) }}" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 text-gray-900 text-sm focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition" />
                            </div>
                        </div>

                        {{-- Subtitle --}}
                        <div class="py-6 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="subtitle" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-tag text-purple-400"></i> Peran / Subtitle
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="subtitle" name="subtitle" type="text" value="{{ old('subtitle', $portfolio->subtitle) }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 text-gray-900 text-sm focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition" />
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="py-6 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="email" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-envelope text-purple-400"></i> Email Kontak
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="email" name="email" type="email" value="{{ old('email', $portfolio->email) }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 text-gray-900 text-sm focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition" />
                            </div>
                        </div>

                        {{-- GitHub --}}
                        <div class="py-6 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="github_url" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fab fa-github text-purple-400"></i> GitHub URL
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="github_url" name="github_url" type="text" value="{{ old('github_url', $portfolio->github_url) }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 text-gray-900 text-sm focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition" />
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="py-6 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="address" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-purple-400"></i> Lokasi
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="address" name="address" type="text" value="{{ old('address', $portfolio->address) }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 text-gray-900 text-sm focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition" />
                            </div>
                        </div>

                        {{-- Photo --}}
                        <div class="py-6 flex flex-col md:flex-row md:items-start gap-4">
                            <div class="md:w-1/3">
                                <label for="photo_url" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-camera text-purple-400"></i> Foto Profil
                                </label>
                            </div>
                            <div class="md:w-2/3 flex items-center gap-6">
                                @if($portfolio->photo_url)
                                    <img src="{{ $portfolio->photo_url }}" alt="Photo" class="h-16 w-16 rounded-2xl object-cover border-4 border-purple-50 shadow-sm" onerror="this.src='https://placehold.co/100x100?text=?'">
                                @endif
                                <input id="photo_url" name="photo_url" type="file" accept="image/*"
                                    class="flex-1 text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-purple-600 file:text-white hover:file:bg-purple-700 transition cursor-pointer" />
                            </div>
                        </div>

                        {{-- About Me --}}
                        <div class="py-6 flex flex-col md:flex-row md:items-start gap-4">
                            <div class="md:w-1/3 pt-2">
                                <label for="about_me" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-quote-left text-purple-400"></i> Bio Singkat
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea id="about_me" name="about_me" rows="5"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 text-gray-900 text-sm focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition resize-none">{{ old('about_me', $portfolio->about_me) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="px-8 py-8 bg-gray-50 border-t border-gray-100 flex justify-end">
                        <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-purple-200 transition transform hover:-translate-y-1 inline-flex items-center gap-3">
                            <i class="fas fa-check-circle"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
