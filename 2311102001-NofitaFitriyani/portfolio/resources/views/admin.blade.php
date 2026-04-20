<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white min-h-screen">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Admin Panel</h2>
                <p class="text-slate-400 text-sm mt-1">Manage Portfolio</p>
            </div>
            <nav class="mt-6 px-4">
                <a href="#profile" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-800 hover:text-white">Profile Settings</a>
                <a href="#skills" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-800 hover:text-white mt-2">Manage Skills</a>
                <a href="/" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-800 hover:text-white mt-10 opacity-70">← Back to Site</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 overflow-y-auto">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <header class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Profile Form -->
                <div id="profile" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">Profile Information</h3>
                    <form action="/admin/profile" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" value="{{ $profile->name ?? '' }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                            <input type="text" name="job_title" value="{{ $profile->job_title ?? '' }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ $profile->email ?? '' }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border" required>{{ $profile->description ?? '' }}</textarea>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                        
                            @if($profile && $profile->photo)
    <img src="{{ asset('storage/' . $profile->photo) }}" 
         alt="Current Photo" 
         class="h-20 w-20 object-cover rounded mb-2">
@endif
                            <input type="file" name="photo" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition">
                            Save Profile
                        </button>
                    </form>
                </div>

                <!-- Skills Management -->
                <div id="skills" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col h-full">
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">Skills</h3>
                    
                    <form action="/admin/skills" method="POST" class="mb-6 flex gap-2">
                        @csrf
                        <input type="text" name="name" placeholder="E.g. React.js" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 border" required>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                            Add Skill
                        </button>
                    </form>

                    <div class="overflow-y-auto flex-1 max-h-96">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-gray-600 text-sm">Skill Name</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-gray-600 text-sm text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skills as $skill)
                                <tr>
                                    <td class="py-3 px-4 border-b border-gray-100">{{ $skill->name }}</td>
                                    <td class="py-3 px-4 border-b border-gray-100 text-right">
                                        <form action="/admin/skills/{{ $skill->id }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold transition" onclick="return confirm('Delete this skill?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @if($skills->isEmpty())
                                <tr>
                                    <td colspan="2" class="py-4 text-center text-gray-500 text-sm">No skills added yet.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
