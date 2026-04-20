<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-10 space-y-10">
            
            {{-- Welcome Hero Card --}}
            <div class="relative overflow-hidden bg-white border border-gray-100 rounded-[2rem] p-10 shadow-xl shadow-purple-100/20">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-50 text-purple-600 rounded-full text-xs font-bold uppercase tracking-widest mb-6">
                            <span class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></span>
                            Ringkasan Sistem
                        </div>
                        <h1 class="text-4xl sm:text-5xl font-black text-gray-900 mb-6 tracking-tight leading-tight">
                            Halo, {{ Auth::user()->name }}! <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-indigo-600">Siap membangun sesuatu yang hebat?</span>
                        </h1>
                        <p class="text-gray-500 text-lg leading-relaxed max-w-lg mb-8">
                            Selamat datang di pusat kendali Anda. Jaga profil Anda tetap tajam, perbarui skill Anda, dan tunjukkan project terbaik Anda kepada dunia.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6 w-full md:w-auto">
                        <div class="bg-purple-600 p-8 rounded-3xl shadow-xl shadow-purple-200 text-center transform hover:-translate-y-2 transition duration-500">
                            <p class="text-purple-200 font-bold uppercase text-[10px] tracking-widest mb-2">Project</p>
                            <h3 class="text-5xl font-black text-white leading-none">{{ $projectCount ?? 0 }}</h3>
                        </div>
                        <div class="bg-indigo-600 p-8 rounded-3xl shadow-xl shadow-indigo-200 text-center transform hover:-translate-y-2 transition duration-500">
                            <p class="text-indigo-200 font-bold uppercase text-[10px] tracking-widest mb-2">Skill</p>
                            <h3 class="text-5xl font-black text-white leading-none">{{ $skillCount ?? 0 }}</h3>
                        </div>
                    </div>
                </div>

                {{-- Decorative background elements --}}
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-purple-50 rounded-full opacity-50 blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-indigo-50 rounded-full opacity-50 blur-3xl"></div>
            </div>

            {{-- Recent Activity Tables --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                {{-- Recent Projects Table --}}
                <div class="bg-white rounded-[2rem] shadow-xl shadow-purple-100/20 border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                        <h3 class="text-lg font-black text-gray-900 tracking-tight flex items-center gap-2">
                            <i class="fas fa-rocket text-purple-500"></i> Project Terbaru
                        </h3>
                        <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-purple-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50/50 text-[10px] uppercase tracking-widest text-gray-400 font-bold">
                                <tr>
                                    <th class="px-8 py-4">Title</th>
                                    <th class="px-8 py-4">Kategori</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($latestProjects as $project)
                                    <tr class="hover:bg-purple-50/30 transition duration-300">
                                        <td class="px-8 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-8 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                                    @if($project->image_url)
                                                        <img src="{{ $project->image_url }}" alt="" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center text-gray-300"><i class="fas fa-image text-[10px]"></i></div>
                                                    @endif
                                                </div>
                                                <span class="text-sm font-bold text-gray-900 truncate max-w-[150px]">{{ $project->title }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-4">
                                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-black bg-purple-50 text-purple-600 border border-purple-100 uppercase">{{ $project->tag }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-8 py-10 text-center text-gray-400 text-sm italic">Belum ada project.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Recent Skills Table --}}
                <div class="bg-white rounded-[2rem] shadow-xl shadow-indigo-100/20 border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                        <h3 class="text-lg font-black text-gray-900 tracking-tight flex items-center gap-2">
                            <i class="fas fa-bolt text-indigo-500"></i> Skill Terbaru
                        </h3>
                        <a href="{{ route('skills.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50/50 text-[10px] uppercase tracking-widest text-gray-400 font-bold">
                                <tr>
                                    <th class="px-8 py-4">Skill</th>
                                    <th class="px-8 py-4">Level</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($latestSkills as $skill)
                                    <tr class="hover:bg-indigo-50/30 transition duration-300">
                                        <td class="px-8 py-4">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-gray-900">{{ $skill->name }}</span>
                                                <span class="text-[10px] text-indigo-400 font-black uppercase tracking-widest">{{ $skill->category }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="flex-1 bg-gray-100 h-1.5 rounded-full w-24 overflow-hidden">
                                                    <div class="bg-indigo-500 h-full rounded-full" style="width: {{ $skill->level }}%"></div>
                                                </div>
                                                <span class="text-[10px] font-black text-indigo-600 italic">{{ $skill->level }}%</span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-8 py-10 text-center text-gray-400 text-sm italic">Belum ada skill.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            
        </div>
    </div>
</x-app-layout>
