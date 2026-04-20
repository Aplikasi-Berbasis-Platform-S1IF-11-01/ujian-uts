<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-10">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-4">
                    <div class="w-9 h-9 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-pencil-alt text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Perbarui Project</h2>
                        <p class="text-xs text-gray-500">Memperbarui: <span class="font-semibold text-gray-700">{{ $project->title }}</span></p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="p-8 divide-y divide-gray-100">
                        {{-- Project Title --}}
                        <div class="py-5 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="title" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-heading text-purple-400"></i> Judul Project
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="title" name="title" type="text" value="{{ old('title', $project->title) }}" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition" />
                            </div>
                        </div>

                        {{-- Tag --}}
                        <div class="py-5 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="tag" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-tag text-purple-400"></i> Tag / Kategori
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="tag" name="tag" type="text" value="{{ old('tag', $project->tag) }}" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition" />
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="py-5 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="image_url" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-image text-purple-400"></i> Gambar Project
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                @if($project->image_url)
                                    <div class="mb-3">
                                        <img src="{{ $project->image_url }}" alt="Current" class="h-20 w-auto rounded-xl border border-gray-200 object-cover shadow-sm" onerror="this.src='https://placehold.co/120x80?text=No+Image'">
                                    </div>
                                @endif
                                <input id="image_url" name="image_url" type="file" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-purple-600 file:text-white hover:file:bg-purple-700 transition cursor-pointer" />
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="py-5 flex flex-col md:flex-row md:items-start gap-4 border-b border-gray-100">
                            <div class="md:w-1/3 pt-2">
                                <label for="description" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-align-left text-purple-400"></i> Deskripsi
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea id="description" name="description" rows="4" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition resize-none">{{ old('description', $project->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                        <a href="{{ route('admin.projects.index') }}"
                            class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-purple-600 transition">
                            <i class="fas fa-arrow-left"></i> Kembali ke Project
                        </a>
                        <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-purple-200 transition transform hover:-translate-y-1 inline-flex items-center gap-3">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
