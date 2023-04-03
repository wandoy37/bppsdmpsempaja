@extends('auth.layouts.app')

@section('title', 'Video')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Video</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('auth.video') }}">
                        <i class="icon-social-youtube"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('auth.video.edit', $video->slug) }}">Edit</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <span>{{ $video->title }}</span>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('auth.video') }}" class="btn btn-secondary btn-border btn-round">
                    <i class="fas fa-undo"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="row" style="padding-top: 2rem;">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('auth.video.update', $video->slug) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    placeholder="Title.." value="{{ old('title', $video->title) }}">
                                @error('title')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="link">Link <small class="text-muted">Youtube Embed</small></label>
                                <input id="link" type="text"
                                    class="form-control @error('link') is-invalid @enderror" name="link"
                                    placeholder="Link.." value="{{ old('link', $video->link) }}">
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
