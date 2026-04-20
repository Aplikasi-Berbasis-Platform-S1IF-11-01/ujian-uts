<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-10">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-4">
                    <div class="w-9 h-9 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-pencil-alt text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Perbarui Skill</h2>
                        <p class="text-xs text-gray-500">Memperbarui: <span class="font-semibold text-gray-700">{{ $skill->name }}</span></p>
                    </div>
                </div>

                <form method="POST" action="{{ route('skills.update', $skill->id) }}">
                    @csrf @method('PUT')
                    <div class="p-8 divide-y divide-gray-100">
                        {{-- Skill Name --}}
                        <div class="py-5 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="name" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-code text-purple-400"></i> Nama Skill
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="name" name="name" type="text" value="{{ old('name', $skill->name) }}" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition" />
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="py-5 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="category" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-tag text-purple-400"></i> Kategori
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="category" name="category" type="text" value="{{ old('category', $skill->category) }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition"
                                    placeholder="Frontend" />
                            </div>
                        </div>

                        {{-- Level --}}
                        <div class="py-5 flex flex-col md:flex-row md:items-center gap-4 border-b border-gray-100">
                            <div class="md:w-1/3">
                                <label for="level" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-chart-line text-purple-400"></i> Tingkat Keahlian (%)
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <div class="flex items-center gap-4">
                                    <input id="level" name="level" type="number" min="0" max="100" value="{{ old('level', $skill->level) }}" required
                                        class="w-full md:w-32 bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition" />
                                    <span class="text-gray-400 font-bold ml-2">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                        <a href="{{ route('skills.index') }}"
                            class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-purple-600 transition">
                            <i class="fas fa-arrow-left"></i> Kembali ke Skill
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
