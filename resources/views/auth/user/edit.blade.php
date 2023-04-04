@extends('auth.layouts.app')

@section('title', 'Pengguna')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Pengguna</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('auth.user') }}">
                        <i class="icon-people"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <span>Edit</span>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <span>{{ $user->username }}</span>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('auth.user') }}" class="btn btn-secondary btn-border btn-round">
                    <i class="fas fa-undo"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="row" style="padding-top: 2rem;">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('auth.user.update', $user->username) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    placeholder="Nama.." value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    placeholder="Username.." value="{{ old('username', $user->username) }}">
                                @error('username')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <div class="input-icon">
                                    <input type="password" id="inputPassword"
                                        class="form-control @error('password') is-invalid @enderror" name="password">
                                    <span class="input-icon-addon" onclick="showPassword()" style="cursor: pointer;">
                                        <i class="icon-eye"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordConfirmation">Password Confirmation</label>
                                <div class="input-icon">
                                    <input type="password" id="inputPasswordConfirmation" class="form-control"
                                        name="password_confirmation">
                                    <span class="input-icon-addon" onclick="showPasswordConfirmation()"
                                        style="cursor: pointer;">
                                        <i class="icon-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pilih Role</label>
                                <select class="form-control" name="role">
                                    <option value="">-select roles-</option>
                                    <option value="admin" @if (old('role', $user->role) == 'admin') {{ 'selected' }} @endif>
                                        Admin</option>
                                    <option value="editor" @if (old('role', $user->role) == 'editor') {{ 'selected' }} @endif>
                                        Editor</option>
                                </select>
                                @error('role')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-secondary btn-round">
                                    <i class="fas fa-sync"></i>
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        function showPassword() {
            var x = document.getElementById("inputPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function showPasswordConfirmation() {
            var x = document.getElementById("inputPasswordConfirmation");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endpush
