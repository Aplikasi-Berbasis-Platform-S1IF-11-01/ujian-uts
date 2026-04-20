<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-10 space-y-6">

            {{-- Add New Skill --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-4">
                    <div class="w-9 h-9 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-plus text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Tambah Skill Baru</h2>
                        <p class="text-xs text-gray-500">Isi detail di bawah untuk menambah skill baru.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('skills.store') }}">
                    @csrf
                    <div class="p-8 divide-y divide-gray-100">
                        {{-- Skill Name --}}
                        <div class="py-5 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="name" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-code text-purple-400"></i> Nama Skill
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="name" name="name" type="text" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition"
                                    placeholder="Laravel" />
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
                                <input id="category" name="category" type="text"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition"
                                    placeholder="Backend" />
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
                                    <input id="level" name="level" type="number" min="0" max="100" required
                                        class="w-full md:w-32 bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition"
                                        placeholder="85" />
                                    <span class="text-gray-400 font-bold ml-2">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-end">
                        <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-purple-200 transition transform hover:-translate-y-1 inline-flex items-center gap-3">
                            <i class="fas fa-plus-circle"></i> Tambah Skill
                        </button>
                    </div>
                </form>
            </div>

            {{-- Skills Table --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-gray-100">
                    <h2 class="text-base font-bold text-gray-900">Daftar Skill</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Total {{ $skills->count() }} skill</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-gray-400 text-xs uppercase tracking-wider">
                                <th class="py-4 px-6 font-semibold w-[30%]">Nama Skill</th>
                                <th class="py-4 px-6 font-semibold w-[25%]">Level</th>
                                <th class="py-4 px-6 font-semibold w-[25%] text-left">Kategori</th>
                                <th class="py-4 px-6 font-semibold w-[20%] text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($skills as $skill)
                                <tr class="hover:bg-purple-50/30 transition">
                                    <td class="py-4 px-6 font-semibold text-gray-900 text-sm">{{ $skill->name }}</td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-1 max-w-[120px] h-2 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full" style="width: {{ $skill->level }}%"></div>
                                            </div>
                                            <span class="text-xs font-bold text-gray-600">{{ $skill->level }}%</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-100">
                                            {{ $skill->category ?? '—' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('skills.edit', $skill->id) }}"
                                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-amber-400 hover:bg-amber-500 text-white text-xs font-bold transition">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <form id="del-skill-{{ $skill->id }}" action="{{ route('skills.destroy', $skill->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete('del-skill-{{ $skill->id }}', '{{ $skill->name }}')"
                                                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white text-xs font-bold transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-gray-400 text-sm">
                                        <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                        No skills added yet. Add one above!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
