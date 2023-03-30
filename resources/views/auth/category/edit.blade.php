@extends('auth.layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Kategori</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('auth.category') }}">
                        <i class="icon-tag"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('auth.category.edit', $category->slug) }}">Edit</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <span>{{ $category->title }}</span>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('auth.category') }}" class="btn btn-secondary btn-border btn-round">
                    <i class="fas fa-undo"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="row" style="padding-top: 2rem;">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('auth.category.update', $category->slug) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    placeholder="Title.." value="{{ old('title', $category->title) }}">
                                @error('title')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-secondary btn-round">
                                    <i class="fas fa-sync"></i>
                                    Ganti
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
        $('#basic-datatables').DataTable();
    </script>
@endpush
