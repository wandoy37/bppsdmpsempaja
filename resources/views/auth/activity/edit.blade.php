@extends('auth.layouts.app')

@section('title', 'Kegiatan')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Kegiatan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('auth.activity') }}">
                        <i class="icon-support"></i>
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
                    <span>{{ $activity->title }}</span>
                </li>
            </ul>
        </div>

        {{-- Notify --}}
        <div id="success" data-flash="{{ session('success') }}"></div>
        <div id="fails" data-flash="{{ session('fails') }}"></div>
        {{-- ====== --}}

        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('auth.activity') }}" class="btn btn-secondary btn-border btn-round">
                    <i class="fas fa-undo"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="row" style="padding-top: 2rem;">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('auth.activity.update', $activity->slug) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label for="title">Judul</label>
                                        <br>
                                        @error('title')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                        <input id="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            placeholder="Judul.." value="{{ old('title', $activity->title) }}">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <br>
                                        @error('thumbnail')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                        <input type="file" class="form-control-file" name="thumbnail">
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label>Kontent</label>
                                        <br>
                                        @error('content')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                        <textarea name="content" id="summernote" cols="30" rows="5">{!! $activity->content !!}</textarea>
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-secondary btn-round">
                                            <i class="fas fa-plus"></i>
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-2" style="margin-top: 5vh;">
                                    <div class="form-group">
                                        <label>Old Thumbnail</label>
                                        <br>
                                        <img src="{{ asset('/uploads/thumbnail/' . $activity->thumbnail) }}"
                                            class="img-fluid my-2" width="150px" alt="">
                                    </div>
                                </div>
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
        $('#summernote').summernote({
            placeholder: 'Konten...',
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
            tabsize: 2,
            height: 300
        });
    </script>
@endpush
