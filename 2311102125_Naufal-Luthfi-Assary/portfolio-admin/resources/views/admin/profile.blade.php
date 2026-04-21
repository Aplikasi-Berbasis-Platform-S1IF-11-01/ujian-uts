<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Profile
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-6">Edit Data Profile</h3>

                <form id="profileForm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" id="full_name" class="w-full border border-gray-300 rounded-lg p-3"
                                value="{{ $profile->full_name ?? '' }}">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Brand Name</label>
                            <input type="text" id="brand_name" class="w-full border border-gray-300 rounded-lg p-3"
                                value="{{ $profile->brand_name ?? '' }}">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Headline</label>
                            <input type="text" id="headline" class="w-full border border-gray-300 rounded-lg p-3"
                                value="{{ $profile->headline ?? '' }}">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-700">About</label>
                            <textarea id="about" rows="5" class="w-full border border-gray-300 rounded-lg p-3">{{ $profile->about ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Domisili</label>
                            <input type="text" id="domicile" class="w-full border border-gray-300 rounded-lg p-3"
                                value="{{ $profile->domicile ?? '' }}">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" class="w-full border border-gray-300 rounded-lg p-3"
                                value="{{ $profile->email ?? '' }}">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Career Interest</label>
                            <input type="text" id="career_interest" class="w-full border border-gray-300 rounded-lg p-3"
                                value="{{ $profile->career_interest ?? '' }}">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Languages</label>
                            <input type="text" id="languages" class="w-full border border-gray-300 rounded-lg p-3"
                                value="{{ $profile->languages ?? '' }}">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Hero Badge</label>
                            <input type="text" id="hero_badge" class="w-full border border-gray-300 rounded-lg p-3"
                                value="{{ $profile->hero_badge ?? '' }}">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Availability</label>
                            <input type="text" id="availability" class="w-full border border-gray-300 rounded-lg p-3"
                                value="{{ $profile->availability ?? '' }}">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                            Simpan Profile
                        </button>
                    </div>
                </form>

                <div id="profileMessage" class="mt-4 text-green-600 font-medium"></div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.getElementById('profileForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const payload = {
                full_name: document.getElementById('full_name').value,
                brand_name: document.getElementById('brand_name').value,
                headline: document.getElementById('headline').value,
                about: document.getElementById('about').value,
                domicile: document.getElementById('domicile').value,
                email: document.getElementById('email').value,
                career_interest: document.getElementById('career_interest').value,
                languages: document.getElementById('languages').value,
                hero_badge: document.getElementById('hero_badge').value,
                availability: document.getElementById('availability').value,
            };

            try {
                const response = await fetch('/admin/profile', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (!response.ok) {
                    document.getElementById('profileMessage').innerText = 'Gagal menyimpan profile';
                    return;
                }

                document.getElementById('profileMessage').innerText = result.message;
            } catch (error) {
                console.error(error);
                document.getElementById('profileMessage').innerText = 'Terjadi kesalahan saat menyimpan';
            }
        });
    </script>
</x-app-layout>