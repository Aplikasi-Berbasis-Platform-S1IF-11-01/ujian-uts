<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Portfolio Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: white;
            padding: 15px 20px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            border-left: 4px solid white;
        }
        .content-section {
            display: none;
        }
        .content-section.active {
            display: block;
        }
        .profile-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
        }
        .skill-item {
            cursor: move;
            transition: all 0.3s;
        }
        .skill-item:hover {
            background-color: #f8f9fa;
        }
        .sortable-ghost {
            opacity: 0.4;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar p-0">
                <div class="position-sticky">
                    <div class="p-4">
                        <h5 class="text-white">Portfolio Admin</h5>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" data-section="profile">
                                <i class="bi bi-person-circle me-2"></i>Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-section="skills">
                                <i class="bi bi-star-fill me-2"></i>Skills
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <form action="/admin/logout" method="POST" id="logout-form">
                                @csrf
                                <button type="submit" class="nav-link text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h2>Dashboard</h2>
                </div>

                <!-- Profile Section -->
                <div id="profile-section" class="content-section active">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Profile Information</h4>
                        </div>
                        <div class="card-body">
                            <form id="profile-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" id="full_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Title/Position</label>
                                            <input type="text" class="form-control" name="title" id="title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Short Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" id="address" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">GitHub URL</label>
                                            <input type="url" class="form-control" name="github_url" id="github_url">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">LinkedIn URL</label>
                                            <input type="url" class="form-control" name="linkedin_url" id="linkedin_url">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Twitter URL</label>
                                            <input type="url" class="form-control" name="twitter_url" id="twitter_url">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Profile Image</label>
                                            <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/*">
                                            <div id="image-preview" class="mt-2"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">About Me</label>
                                            <textarea class="form-control" name="about_me" id="about_me" rows="5" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div id="skills-section" class="content-section">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Manage Skills</h4>
                            <button class="btn btn-primary" onclick="showAddSkillModal()">
                                <i class="bi bi-plus-circle"></i> Add Skill
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="skills-list">
                                <!-- Skills will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add/Edit Skill Modal -->
    <div class="modal fade" id="skillModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="skillModalTitle">Add Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="skill-form">
                        <input type="hidden" id="skill_id">
                        <div class="mb-3">
                            <label class="form-label">Skill Name</label>
                            <input type="text" class="form-control" id="skill_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-control" id="skill_category" required>
                                <option value="Frontend">Frontend</option>
                                <option value="Backend">Backend</option>
                                <option value="Database">Database</option>
                                <option value="DevOps">DevOps</option>
                                <option value="Tools">Tools</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Percentage (0-100)</label>
                            <input type="number" class="form-control" id="skill_percentage" min="0" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon Class (Bootstrap Icons)</label>
                            <input type="text" class="form-control" id="skill_icon" placeholder="bi bi-code-slash">
                            <small class="text-muted">Example: bi bi-code-slash, bi bi-database, etc.</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveSkill()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        let skillModal;
        let sortableInstance;

        $(document).ready(function() {
            skillModal = new bootstrap.Modal(document.getElementById('skillModal'));
            
            // Load initial data
            loadPortfolioData();
            loadSkills();
            
            // Setup navigation
            $('.nav-link[data-section]').click(function(e) {
                e.preventDefault();
                const section = $(this).data('section');
                
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                
                $('.content-section').removeClass('active');
                $(`#${section}-section`).addClass('active');
                
                if (section === 'skills') {
                    loadSkills();
                }
            });
            
            // Handle profile form submission
            $('#profile-form').submit(function(e) {
                e.preventDefault();
                updateProfile();
            });
            
            // Preview image
            $('#profile_image').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').html(`
                            <img src="${e.target.result}" class="profile-preview img-thumbnail">
                        `);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });

        function loadPortfolioData() {
            $.ajax({
                url: '/api/admin/portfolio',
                method: 'GET',
                success: function(response) {
                    if (response.portfolio) {
                        $('#full_name').val(response.portfolio.full_name);
                        $('#title').val(response.portfolio.title);
                        $('#description').val(response.portfolio.description);
                        $('#email').val(response.portfolio.email);
                        $('#phone').val(response.portfolio.phone);
                        $('#address').val(response.portfolio.address);
                        $('#github_url').val(response.portfolio.github_url);
                        $('#linkedin_url').val(response.portfolio.linkedin_url);
                        $('#twitter_url').val(response.portfolio.twitter_url);
                        $('#about_me').val(response.portfolio.about_me);
                        
                        if (response.portfolio.profile_image) {
                            $('#image-preview').html(`
                                <img src="/storage/${response.portfolio.profile_image}" class="profile-preview img-thumbnail">
                            `);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Failed to load portfolio data', 'error');
                }
            });
        }

        function updateProfile() {
            const formData = new FormData($('#profile-form')[0]);
            
            $.ajax({
                url: '/api/admin/portfolio',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Success', 'Profile updated successfully', 'success');
                    loadPortfolioData();
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Failed to update profile', 'error');
                }
            });
        }

        function loadSkills() {
            $.ajax({
                url: '/api/admin/skills',
                method: 'GET',
                success: function(skills) {
                    renderSkillsList(skills);
                    initSortable();
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Failed to load skills', 'error');
                }
            });
        }

        function renderSkillsList(skills) {
            const skillsByCategory = {};
            skills.forEach(skill => {
                if (!skillsByCategory[skill.category]) {
                    skillsByCategory[skill.category] = [];
                }
                skillsByCategory[skill.category].push(skill);
            });
            
            let html = '';
            Object.keys(skillsByCategory).sort().forEach(category => {
                html += `
                    <div class="mb-4">
                        <h5 class="mb-3">${category}</h5>
                        <div class="list-group sortable-category" data-category="${category}">
                `;
                
                skillsByCategory[category].forEach(skill => {
                    html += `
                        <div class="list-group-item skill-item" data-skill-id="${skill.id}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-grip-vertical me-2"></i>
                                    ${skill.icon_class ? `<i class="${skill.icon_class} me-2"></i>` : ''}
                                    <strong>${skill.name}</strong>
                                    <span class="badge bg-primary ms-2">${skill.percentage}%</span>
                                    ${skill.is_active ? 
                                        '<span class="badge bg-success ms-2">Active</span>' : 
                                        '<span class="badge bg-secondary ms-2">Inactive</span>'
                                    }
                                </div>
                                <div>
                                    <button class="btn btn-sm ${skill.is_active ? 'btn-warning' : 'btn-success'}" 
                                            onclick="toggleSkillActive(${skill.id})">
                                        <i class="bi ${skill.is_active ? 'bi-eye-slash' : 'bi-eye'}"></i>
                                    </button>
                                    <button class="btn btn-sm btn-info" onclick="editSkill(${skill.id})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteSkill(${skill.id})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                html += `
                        </div>
                    </div>
                `;
            });
            
            $('#skills-list').html(html || '<p class="text-muted">No skills added yet.</p>');
        }

        function initSortable() {
            $('.sortable-category').each(function() {
                new Sortable(this, {
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    onEnd: function(evt) {
                        updateSkillsOrder();
                    }
                });
            });
        }

        function updateSkillsOrder() {
            const skills = [];
            $('.skill-item').each(function(index) {
                skills.push({
                    id: $(this).data('skill-id'),
                    display_order: index
                });
            });
            
            $.ajax({
                url: '/api/admin/skills/order',
                method: 'POST',
                data: { skills: skills },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Order updated successfully
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Failed to update skill order', 'error');
                }
            });
        }

        function showAddSkillModal() {
            $('#skillModalTitle').text('Add Skill');
            $('#skill_id').val('');
            $('#skill_name').val('');
            $('#skill_category').val('Frontend');
            $('#skill_percentage').val(50);
            $('#skill_icon').val('');
            skillModal.show();
        }

        function editSkill(id) {
            $.ajax({
                url: `/api/admin/skills`,
                method: 'GET',
                success: function(skills) {
                    const skill = skills.find(s => s.id === id);
                    if (skill) {
                        $('#skillModalTitle').text('Edit Skill');
                        $('#skill_id').val(skill.id);
                        $('#skill_name').val(skill.name);
                        $('#skill_category').val(skill.category);
                        $('#skill_percentage').val(skill.percentage);
                        $('#skill_icon').val(skill.icon_class || '');
                        skillModal.show();
                    }
                }
            });
        }

        function saveSkill() {
            const id = $('#skill_id').val();
            const data = {
                name: $('#skill_name').val(),
                category: $('#skill_category').val(),
                percentage: $('#skill_percentage').val(),
                icon_class: $('#skill_icon').val()
            };
            
            const url = id ? `/api/admin/skills/${id}` : '/api/admin/skills';
            const method = id ? 'PUT' : 'POST';
            
            $.ajax({
                url: url,
                method: method,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    skillModal.hide();
                    Swal.fire('Success', response.message, 'success');
                    loadSkills();
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Failed to save skill', 'error');
                }
            });
        }

        function deleteSkill(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/api/admin/skills/${id}`,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', response.message, 'success');
                            loadSkills();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error', 'Failed to delete skill', 'error');
                        }
                    });
                }
            });
        }

        function toggleSkillActive(id) {
            $.ajax({
                url: `/api/admin/skills/${id}/toggle`,
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Success', response.message, 'success');
                    loadSkills();
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error', 'Failed to toggle skill status', 'error');
                }
            });
        }
    </script>
</body>
</html>