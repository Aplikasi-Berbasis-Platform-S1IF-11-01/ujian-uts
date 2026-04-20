@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center" style="min-height: 100vh; align-items: center;">
        <div class="col-md-5">
            <div class="card card-custom p-4">
                <h2 class="mb-4 text-center">Login Admin</h2>

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn btn-dark w-100">Login</button>
                </form>

                <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 mt-2">Kembali ke Portfolio</a>
            </div>
        </div>
    </div>
</div>
@endsection