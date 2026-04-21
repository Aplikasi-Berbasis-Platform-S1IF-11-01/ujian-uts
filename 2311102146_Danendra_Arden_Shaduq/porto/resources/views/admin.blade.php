<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white p-10">

<h1 class="text-2xl mb-6">Admin</h1>

<!-- PROFILE -->
<div class="mb-10">
    <h2 class="text-lg mb-2">Profile</h2>

    <input id="name" placeholder="Name" class="p-2 text-black block mb-2">
    <textarea id="desc" placeholder="Description" class="p-2 text-black block mb-2"></textarea>
    <input type="file" id="photo" class="mb-2">

    <button onclick="saveProfile()" class="bg-blue-500 px-4 py-2">Save Profile</button>
</div>

<!-- PROJECT -->
<div>
    <h2 class="text-lg mb-2">Project</h2>

    <input id="project_title" placeholder="Title" class="p-2 text-black block mb-2">
    <textarea id="project_desc" placeholder="Description" class="p-2 text-black block mb-2"></textarea>
    <input type="file" id="project_image" class="mb-2">

    <button onclick="addProject()" class="bg-green-500 px-4 py-2">Add Project</button>
</div>

<script>

// PROFILE UPLOAD
function saveProfile() {
    let formData = new FormData();

    formData.append('name', document.getElementById('name').value);
    formData.append('description', document.getElementById('desc').value);

    let file = document.getElementById('photo').files[0];
    if (file) {
        formData.append('photo', file);
    }

    fetch('/api/profile', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(() => alert('Profile saved'));
}


// PROJECT UPLOAD
function addProject() {
    let formData = new FormData();

    formData.append('title', document.getElementById('project_title').value);
    formData.append('description', document.getElementById('project_desc').value);

    let file = document.getElementById('project_image').files[0];
    if (file) {
        formData.append('image', file);
    }

    fetch('/api/projects', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(() => alert('Project added'));
}

</script>

</body>
</html>