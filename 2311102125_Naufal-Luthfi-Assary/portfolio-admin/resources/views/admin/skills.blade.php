<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Skills
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Tambah / Edit Skill</h3>

                <form id="skillForm" class="mb-6">
                    <input type="hidden" id="skillId">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Nama Skill</label>
                            <input
                                type="text"
                                id="skillName"
                                class="w-full border border-gray-300 rounded-lg p-3"
                                placeholder="Contoh: Laravel"
                            >
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Urutan</label>
                            <input
                                type="number"
                                id="skillOrder"
                                class="w-full border border-gray-300 rounded-lg p-3"
                                placeholder="Contoh: 1"
                            >
                        </div>
                    </div>

                    <div class="mt-4 flex gap-3">
                        <button
                            type="submit"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg"
                        >
                            Simpan
                        </button>

                        <button
                            type="button"
                            onclick="resetForm()"
                            class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg"
                        >
                            Reset
                        </button>
                    </div>
                </form>

                <div id="skillMessage" class="mb-4 text-green-600 font-medium"></div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-3 text-left">No</th>
                                <th class="border p-3 text-left">Nama Skill</th>
                                <th class="border p-3 text-left">Order</th>
                                <th class="border p-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="skillTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let skillCache = [];

        async function loadSkills() {
            try {
                const response = await fetch('/admin/skills/list');
                const skills = await response.json();
                skillCache = skills;

                const tbody = document.getElementById('skillTableBody');
                tbody.innerHTML = '';

                if (skills.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="border p-4 text-center text-gray-500">
                                Belum ada data skill
                            </td>
                        </tr>
                    `;
                    return;
                }

                skills.forEach((skill, index) => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="border p-3">${index + 1}</td>
                            <td class="border p-3">${skill.name}</td>
                            <td class="border p-3">${skill.sort_order}</td>
                            <td class="border p-3">
                                <button
                                    type="button"
                                    onclick="editSkillById(${skill.id})"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded mr-2"
                                >
                                    Edit
                                </button>
                                <button
                                    type="button"
                                    onclick="deleteSkill(${skill.id})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } catch (error) {
                console.error(error);
                document.getElementById('skillMessage').innerText = 'Gagal memuat data skill';
            }
        }

        function editSkillById(id) {
            const skill = skillCache.find(item => item.id === id);
            if (!skill) return;

            document.getElementById('skillId').value = skill.id;
            document.getElementById('skillName').value = skill.name;
            document.getElementById('skillOrder').value = skill.sort_order;
            document.getElementById('skillMessage').innerText = 'Mode edit aktif';
        }

        function resetForm() {
            document.getElementById('skillForm').reset();
            document.getElementById('skillId').value = '';
            document.getElementById('skillMessage').innerText = '';
        }

        document.getElementById('skillForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const id = document.getElementById('skillId').value;
            const name = document.getElementById('skillName').value;
            const sortOrder = document.getElementById('skillOrder').value;

            const url = id ? `/admin/skills/${id}` : '/admin/skills';
            const method = id ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: name,
                        sort_order: sortOrder
                    })
                });

                const result = await response.json();

                if (!response.ok) {
                    document.getElementById('skillMessage').innerText = 'Gagal menyimpan skill';
                    return;
                }

                document.getElementById('skillMessage').innerText = result.message;
                resetForm();
                loadSkills();
            } catch (error) {
                console.error(error);
                document.getElementById('skillMessage').innerText = 'Terjadi kesalahan saat menyimpan';
            }
        });

        async function deleteSkill(id) {
            const confirmDelete = confirm('Yakin ingin menghapus skill ini?');
            if (!confirmDelete) return;

            try {
                const response = await fetch(`/admin/skills/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();
                document.getElementById('skillMessage').innerText = result.message;
                loadSkills();
            } catch (error) {
                console.error(error);
                document.getElementById('skillMessage').innerText = 'Gagal menghapus skill';
            }
        }

        window.addEventListener('load', loadSkills);
    </script>
</x-app-layout>