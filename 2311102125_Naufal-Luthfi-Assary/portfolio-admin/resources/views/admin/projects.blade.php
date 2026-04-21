<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Projects
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Tambah / Edit Project</h3>

                <form id="projectForm" class="mb-6">
                    <input type="hidden" id="projectId">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" id="title" class="w-full border border-gray-300 rounded-lg p-3" placeholder="Judul project">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Sort Order</label>
                            <input type="number" id="sort_order" class="w-full border border-gray-300 rounded-lg p-3" placeholder="1">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description" rows="4" class="w-full border border-gray-300 rounded-lg p-3" placeholder="Deskripsi project"></textarea>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Project URL</label>
                            <input type="text" id="project_url" class="w-full border border-gray-300 rounded-lg p-3" placeholder="https://...">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Image Path / URL</label>
                            <input type="text" id="image" class="w-full border border-gray-300 rounded-lg p-3" placeholder="assets/project.png atau https://...">
                        </div>
                    </div>

                    <div class="mt-4 flex gap-3">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                            Simpan
                        </button>
                        <button type="button" onclick="resetProjectForm()" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                            Reset
                        </button>
                    </div>
                </form>

                <div id="projectMessage" class="mb-4 text-green-600 font-medium"></div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-3 text-left">No</th>
                                <th class="border p-3 text-left">Judul</th>
                                <th class="border p-3 text-left">URL</th>
                                <th class="border p-3 text-left">Order</th>
                                <th class="border p-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="projectTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let projectCache = [];

        async function loadProjects() {
            try {
                const response = await fetch('/admin/projects/list');
                const projects = await response.json();
                projectCache = projects;

                const tbody = document.getElementById('projectTableBody');
                tbody.innerHTML = '';

                if (projects.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" class="border p-4 text-center text-gray-500">
                                Belum ada project
                            </td>
                        </tr>
                    `;
                    return;
                }

                projects.forEach((project, index) => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="border p-3">${index + 1}</td>
                            <td class="border p-3">${project.title}</td>
                            <td class="border p-3">${project.project_url ?? '-'}</td>
                            <td class="border p-3">${project.sort_order}</td>
                            <td class="border p-3">
                                <button type="button"
                                    onclick="editProjectById(${project.id})"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded mr-2">
                                    Edit
                                </button>
                                <button type="button"
                                    onclick="deleteProject(${project.id})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } catch (error) {
                console.error(error);
                document.getElementById('projectMessage').innerText = 'Gagal memuat project';
            }
        }

        function editProjectById(id) {
            const project = projectCache.find(item => item.id === id);
            if (!project) return;

            document.getElementById('projectId').value = project.id;
            document.getElementById('title').value = project.title ?? '';
            document.getElementById('description').value = project.description ?? '';
            document.getElementById('project_url').value = project.project_url ?? '';
            document.getElementById('image').value = project.image ?? '';
            document.getElementById('sort_order').value = project.sort_order ?? 0;
            document.getElementById('projectMessage').innerText = 'Mode edit aktif';
        }

        function resetProjectForm() {
            document.getElementById('projectForm').reset();
            document.getElementById('projectId').value = '';
            document.getElementById('projectMessage').innerText = '';
        }

        document.getElementById('projectForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const id = document.getElementById('projectId').value;
            const payload = {
                title: document.getElementById('title').value,
                description: document.getElementById('description').value,
                project_url: document.getElementById('project_url').value,
                image: document.getElementById('image').value,
                sort_order: document.getElementById('sort_order').value
            };

            const url = id ? `/admin/projects/${id}` : '/admin/projects';
            const method = id ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (!response.ok) {
                    document.getElementById('projectMessage').innerText = 'Gagal menyimpan project';
                    return;
                }

                document.getElementById('projectMessage').innerText = result.message;
                resetProjectForm();
                loadProjects();
            } catch (error) {
                console.error(error);
                document.getElementById('projectMessage').innerText = 'Terjadi kesalahan saat menyimpan';
            }
        });

        async function deleteProject(id) {
            const confirmDelete = confirm('Yakin ingin menghapus project ini?');
            if (!confirmDelete) return;

            try {
                const response = await fetch(`/admin/projects/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();
                document.getElementById('projectMessage').innerText = result.message;
                loadProjects();
            } catch (error) {
                console.error(error);
                document.getElementById('projectMessage').innerText = 'Gagal menghapus project';
            }
        }

        window.addEventListener('load', loadProjects);
    </script>
</x-app-layout>