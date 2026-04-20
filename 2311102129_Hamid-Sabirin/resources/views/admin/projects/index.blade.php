<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-10 space-y-6">

            {{-- Add New Project --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-4">
                    <div class="w-9 h-9 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-plus text-sm"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Tambah Project Baru</h2>
                        <p class="text-xs text-gray-500">Tampilkan project baru dalam portofolio Anda.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="p-8 divide-y divide-gray-100">
                        {{-- Project Title --}}
                        <div class="py-5 flex flex-col md:flex-row md:items-center gap-4">
                            <div class="md:w-1/3">
                                <label for="title" class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fas fa-heading text-purple-400"></i> Judul Project
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input id="title" name="title" type="text" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition"
                                    placeholder="My Awesome Project" />
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
                                <input id="tag" name="tag" type="text" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition"
                                    placeholder="Web Development" />
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
                                <input id="image_url" name="image_url" type="file" accept="image/*" required
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
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm text-gray-900 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition resize-none"
                                    placeholder="Briefly describe your project..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-end">
                        <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-purple-200 transition transform hover:-translate-y-1 inline-flex items-center gap-3">
                            <i class="fas fa-plus-circle"></i> Tambah Project
                        </button>
                    </div>
                </form>
            </div>

            {{-- Projects Table --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-gray-100">
                    <h2 class="text-base font-bold text-gray-900">Daftar Project</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Total {{ $projects->count() }} project</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-gray-400 text-xs uppercase tracking-wider">
                                <th class="py-4 px-6 font-semibold w-[10%]">Gambar</th>
                                <th class="py-4 px-6 font-semibold w-[20%]">Judul</th>
                                <th class="py-4 px-6 font-semibold w-[15%]">Tag</th>
                                <th class="py-4 px-6 font-semibold w-[40%] hidden md:table-cell">Deskripsi</th>
                                <th class="py-4 px-6 font-semibold w-[15%] text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($projects as $project)
                                <tr class="hover:bg-purple-50/30 transition">
                                    <td class="py-4 px-6 text-center">
                                        <div class="w-14 h-10 mx-auto rounded-lg overflow-hidden bg-gray-100 border border-gray-200 flex items-center justify-center">
                                            @if($project->image_url)
                                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                                            @else
                                                <i class="fas fa-image text-gray-300 text-sm"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 font-semibold text-gray-900 text-sm">{{ $project->title }}</td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-100">
                                            {{ $project->tag }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-gray-500 text-sm max-w-[200px] truncate hidden md:table-cell">{{ $project->description }}</td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.projects.edit', $project->id) }}"
                                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-amber-400 hover:bg-amber-500 text-white text-xs font-bold transition">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <form id="del-proj-{{ $project->id }}" action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete('del-proj-{{ $project->id }}', '{{ $project->title }}')"
                                                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white text-xs font-bold transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-gray-400 text-sm">
                                        <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                        No projects yet. Add your first one above!
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
