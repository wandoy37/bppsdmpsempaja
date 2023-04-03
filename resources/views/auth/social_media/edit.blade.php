@extends('auth.layouts.app')

@section('title', 'Sosial Media')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Sosial Media</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('auth.social.media') }}">
                        <i class="icon-globe"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('auth.social.media.edit', $social_media->slug) }}">Edit</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <span>{{ $social_media->title }}</span>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('auth.social.media') }}" class="btn btn-secondary btn-border btn-round">
                    <i class="fas fa-undo"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="row" style="padding-top: 2rem;">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('auth.social.media.update', $social_media->slug) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="title">Sosial Media</label>
                                <input id="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    placeholder="Title.." value="{{ old('title', $social_media->title) }}" disabled>
                                @error('title')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="link">link</label>
                                <input id="link" type="text"
                                    class="form-control @error('link') is-invalid @enderror" name="link"
                                    placeholder="link.." value="{{ old('link', $social_media->link) }}">
                                @error('link')
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
        $('#basic-datatables').DataTable();
    </script>
@endpush
