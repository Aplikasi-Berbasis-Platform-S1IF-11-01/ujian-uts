<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white text-center p-10">

<img id="photo" class="w-32 h-32 mx-auto rounded-full mb-4">
<h1 id="name"></h1>
<p id="desc"></p>

<div id="projects" class="mt-10"></div>

<script>

// PROFILE
fetch('/api/profile')
.then(res => res.json())
.then(data => {
    if (!data) return;

    document.getElementById('name').innerText = data.name;
    document.getElementById('desc').innerText = data.description;

    if (data.photo) {
        document.getElementById('photo').src = '/storage/' + data.photo;
    }
});

// PROJECT
fetch('/api/projects')
.then(res => res.json())
.then(data => {
    let html = '';

    data.forEach(p => {
        html += `
        <div class="mb-6">
            <h3>${p.title}</h3>
            <p>${p.description}</p>
            ${p.image ? `<img src="/storage/${p.image}" class="w-40 mx-auto">` : ''}
        </div>
        `;
    });

    document.getElementById('projects').innerHTML = html;
});

</script>

</body>
</html>