@extends('dashboard.layout')

@section('title', 'Profile')

@section('content')

    <form action="{{ route('profile.update', $profile->id ?? 1) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $profile->name ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Fullstack Developer"
                        value="{{ $profile->title ?? '' }}">
                </div>

                <div class="mb-3">
                    <label>Bio</label>
                    <textarea name="bio" class="form-control" rows="5">{{ $profile->bio ?? '' }}</textarea>
                </div>

                <button type="submit" class="btn btn-success"><i class="ph-bold ph-floppy-disk"></i> Save Profile</button>
            </div>

            <div class="col-md-4 text-center">
                <label>Photo</label>
                
                <div class="mb-3">
                    <img id="preview"
                        src="{{ isset($profile->photo) ? asset('storage/' . $profile->photo) : 'https://via.placeholder.com/200' }}"
                        class="img-fluid rounded mb-2" style="max-height: 200px;">
                </div>

                <input type="file" name="photo" class="form-control" onchange="previewImage(event)">
            </div>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

@endsection
