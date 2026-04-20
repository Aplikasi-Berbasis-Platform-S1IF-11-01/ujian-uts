<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Portofolio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --grad-1: #6366f1;
            --grad-2: #8b5cf6;
            --grad-3: #d946ef;
            --bg-light: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }

        .text-gradient {
            background: linear-gradient(90deg, var(--grad-1), var(--grad-2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Sidebar styling */
        .sidebar {
            min-height: 100vh;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            padding-top: 30px;
            position: fixed;
            width: 260px;
            z-index: 100;
        }

        .sidebar-header {
            padding: 0 25px 30px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .sidebar-nav a {
            color: var(--text-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 25px;
            margin: 5px 15px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--grad-1);
        }

        .sidebar-nav a i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 40px;
            min-height: 100vh;
            position: relative;
        }

        /* Ambient Glow Backgrounds in Main Content */
        .ambient-glow-1, .ambient-glow-2 {
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.15;
            pointer-events: none;
        }

        .ambient-glow-1 { top: -10%; left: 30%; background: var(--grad-1); }
        .ambient-glow-2 { bottom: -10%; right: -5%; background: var(--grad-3); }

        /* Cards */
        .card-custom {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            transition: all 0.4s ease;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .card-custom:hover {
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.08);
            transform: translateY(-2px);
        }

        .card-header-custom {
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 20px 25px;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text-dark);
            font-family: 'Outfit', sans-serif;
            display: flex;
            align-items: center;
        }

        .card-header-custom i {
            margin-right: 10px;
            background: linear-gradient(135deg, var(--grad-1), var(--grad-3));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-body-custom {
            padding: 30px 25px;
        }

        /* Form Elements */
        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            color: var(--text-dark);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--grad-2);
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
            background-color: #fff;
        }

        .form-label {
            font-weight: 500;
            color: #475569;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        /* Buttons */
        .btn-gradient {
            background: linear-gradient(90deg, var(--grad-1), var(--grad-2));
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(99, 102, 241, 0.3);
            color: white;
        }

        .btn-danger-light {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            transition: all 0.3s ease;
        }

        .btn-danger-light:hover {
            background: #ef4444;
            color: white;
        }

        /* Skills List */
        .list-group-item {
            border: 1px solid #f1f5f9;
            margin-bottom: 8px;
            border-radius: 12px !important;
            background: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.01);
        }

        .badge-category {
            background: rgba(99, 102, 241, 0.1);
            color: var(--grad-1);
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        /* Alerts */
        .alert {
            border-radius: 12px;
            border: none;
        }
        .alert-success {
            background-color: rgba(34, 197, 94, 0.1);
            color: #166534;
        }

        .profile-img-preview {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4 class="text-gradient fw-bold mb-0">Admin Panel.</h4>
            <small class="text-muted">Manage your portfolio</small>
        </div>
        <div class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="active">
                <i class="fas fa-border-all"></i> Dashboard
            </a>
            <a href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt"></i> View Website
            </a>
            <div class="mt-5 px-3">
                <a href="#" onclick="document.getElementById('logout-form').submit();" class="text-danger" style="background: rgba(239, 68, 68, 0.05);">
                    <i class="fas fa-sign-out-alt text-danger"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="ambient-glow-1"></div>
        <div class="ambient-glow-2"></div>

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold mb-1">Dashboard Overview</h2>
                <p class="text-muted mb-0">Customize your portfolio content easily</p>
            </div>
            <div class="d-flex align-items-center">
                @if(isset($profile) && $profile->profile_picture)
                    <img src="{{ asset($profile->profile_picture) }}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                @else
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; font-weight:bold;">A</div>
                @endif
                <span class="fw-semibold">Admin</span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center mb-4">
                <i class="fas fa-check-circle me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="row">
            <!-- Profile Section -->
            <div class="col-xl-7">
                <div class="card-custom">
                    <div class="card-header-custom">
                        <i class="fas fa-user-edit"></i> Profile & Social Links
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-4">
                                <div class="col-md-3 text-center">
                                    @if(isset($profile) && $profile->profile_picture)
                                        <img src="{{ asset($profile->profile_picture) }}" class="profile-img-preview mb-3">
                                    @else
                                        <div class="profile-img-preview bg-light d-flex align-items-center justify-content-center mb-3 mx-auto">
                                            <i class="fas fa-camera text-muted fs-3"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <label class="form-label">Profile Picture</label>
                                    <input type="file" name="profile_picture" class="form-control">
                                    <small class="text-muted mt-1 d-block">Recommended size: 500x500px, max 2MB.</small>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">About Me Description</label>
                                <textarea name="description" class="form-control" rows="5" placeholder="Tuliskan deskripsi singkat tentang diri Anda...">{{ $profile->description ?? '' }}</textarea>
                            </div>

                            <h5 class="fw-bold mb-3 mt-4" style="font-family: 'Inter', sans-serif; font-size: 1rem; color: var(--grad-1);">Contact & Social Links</h5>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                        <input type="email" name="email" value="{{ $profile->email ?? '' }}" class="form-control border-start-0 ps-0" placeholder="your@email.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">GitHub URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fab fa-github text-muted"></i></span>
                                        <input type="url" name="github" value="{{ $profile->github ?? '' }}" class="form-control border-start-0 ps-0" placeholder="https://github.com/...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Instagram URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fab fa-instagram text-muted"></i></span>
                                        <input type="url" name="instagram" value="{{ $profile->instagram ?? '' }}" class="form-control border-start-0 ps-0" placeholder="https://instagram.com/...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Dribbble URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fab fa-dribbble text-muted"></i></span>
                                        <input type="url" name="dribbble" value="{{ $profile->dribbble ?? '' }}" class="form-control border-start-0 ps-0" placeholder="https://dribbble.com/...">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-gradient px-4"><i class="fas fa-save me-2"></i> Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="col-xl-5">
                <div class="card-custom">
                    <div class="card-header-custom">
                        <i class="fas fa-magic"></i> Manage Skills
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('skills.store') }}" method="POST" class="mb-4 bg-light p-3 rounded-3 border">
                            @csrf
                            <h6 class="mb-3 fw-semibold fs-6">Add New Skill</h6>
                            <div class="mb-3">
                                <label class="form-label">Skill Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Laravel" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select form-control">
                                    <option value="technical">Design & Tech</option>
                                    <option value="soft_skills">Soft Skills</option>
                                    <option value="scientific">Scientific Skills</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-gradient w-100"><i class="fas fa-plus me-1"></i> Add Skill</button>
                        </form>
                        
                        <h6 class="fw-semibold fs-6 mb-3 text-muted">Your Skills ({{ $skills->count() }})</h6>
                        <div class="list-group" style="max-height: 400px; overflow-y: auto; padding-right: 5px;">
                            @forelse($skills as $skill)
                            <div class="list-group-item">
                                <div>
                                    <span class="d-block fw-semibold text-dark">{{ $skill->name }}</span>
                                    <span class="badge-category mt-1 d-inline-block">{{ str_replace('_', ' ', ucwords($skill->category)) }}</span>
                                </div>
                                <form action="{{ route('skills.destroy', $skill) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-danger-light" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                            @empty
                            <div class="text-center p-4 text-muted border rounded-3 bg-light">
                                <i class="fas fa-folder-open fs-1 mb-3 opacity-50"></i>
                                <p class="mb-0">No skills added yet.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Education Section -->
            <div class="col-xl-4">
                <div class="card-custom">
                    <div class="card-header-custom">
                        <i class="fas fa-graduation-cap"></i> Education
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('educations.store') }}" method="POST" class="mb-4 bg-light p-3 rounded-3 border">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Institution</label>
                                <input type="text" name="institution" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Degree / Period</label>
                                <input type="text" name="degree" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-gradient w-100"><i class="fas fa-plus me-1"></i> Add Education</button>
                        </form>
                        
                        <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                            @foreach($educations as $edu)
                            <div class="list-group-item flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between mb-1">
                                    <h6 class="mb-0 fw-bold">{{ $edu->institution }}</h6>
                                    <form action="{{ route('educations.destroy', $edu) }}" method="POST" class="m-0">
                                        @csrf @method('DELETE')
                                        <button class="btn-danger-light py-0 px-2"><i class="fas fa-times"></i></button>
                                    </form>
                                </div>
                                <small class="text-primary fw-semibold">{{ $edu->degree }}</small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Experience Section -->
            <div class="col-xl-4">
                <div class="card-custom">
                    <div class="card-header-custom">
                        <i class="fas fa-briefcase"></i> Experience
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('experiences.store') }}" method="POST" enctype="multipart/form-data" class="mb-4 bg-light p-3 rounded-3 border">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" class="form-control" placeholder="e.g. Magang, Organisasi" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image (Optional)</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-gradient w-100"><i class="fas fa-plus me-1"></i> Add Experience</button>
                        </form>
                        
                        <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                            @foreach($experiences as $exp)
                            <div class="list-group-item flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between mb-1">
                                    <h6 class="mb-0 fw-bold">{{ $exp->title }}</h6>
                                    <form action="{{ route('experiences.destroy', $exp) }}" method="POST" class="m-0">
                                        @csrf @method('DELETE')
                                        <button class="btn-danger-light py-0 px-2"><i class="fas fa-times"></i></button>
                                    </form>
                                </div>
                                <small class="text-primary fw-semibold">{{ $exp->category }}</small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Section -->
            <div class="col-xl-4">
                <div class="card-custom">
                    <div class="card-header-custom">
                        <i class="fas fa-project-diagram"></i> Projects
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="mb-4 bg-light p-3 rounded-3 border">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" class="form-control" placeholder="e.g. Web Design" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-gradient w-100"><i class="fas fa-plus me-1"></i> Add Project</button>
                        </form>
                        
                        <div class="list-group" style="max-height: 400px; overflow-y: auto;">
                            @foreach($projects as $proj)
                            <div class="list-group-item flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between mb-1">
                                    <h6 class="mb-0 fw-bold">{{ $proj->title }}</h6>
                                    <form action="{{ route('projects.destroy', $proj) }}" method="POST" class="m-0">
                                        @csrf @method('DELETE')
                                        <button class="btn-danger-light py-0 px-2"><i class="fas fa-times"></i></button>
                                    </form>
                                </div>
                                <small class="text-primary fw-semibold">{{ $proj->category }}</small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
