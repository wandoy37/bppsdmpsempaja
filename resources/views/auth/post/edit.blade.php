@extends('auth.layouts.app')

@section('title', 'Postingan')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Postingan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('auth.post') }}">
                        <i class="icon-note"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <span>Edit Postingan</span>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <span>{{ $post->title }}</span>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('auth.post') }}" class="btn btn-secondary btn-border btn-round">
                    <i class="fas fa-undo"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="row" style="padding-top: 2rem;">
            <div class="col-lg-12">
                <div class="form-group float-right">
                    <label>Status</label>
                    <small class="text-muted"><i>(Current Status)</i></small>
                    @if ($post->status == 'publish')
                        <span class="badge badge-secondary">{{ $post->status }}</span>
                    @else
                        <span class="badge badge-warning">{{ $post->status }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('auth.post.update', $post->slug) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="title">Judul</label>
                                        <br>
                                        @error('title')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                        <input id="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            placeholder="Judul.." value="{{ old('title', $post->title) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Kontent</label>
                                        <br>
                                        @error('content')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                        <textarea id="summernote-editor" name="content">{!! old('content', $post->content) !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <br>
                                        @error('category')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                        <select name="category" id="kategori" class="form-control">
                                            <option value="">--pilih kategori--</option>
                                            @foreach ($categories as $kategori)
                                                @if (old($kategori->id, $post->category_id) == $kategori->id)
                                                    <option value="{{ $kategori->id }}" selected>{{ $kategori->title }}
                                                    </option>
                                                @else
                                                    <option value="{{ $kategori->id }}">{{ $kategori->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="datepicker" name="tanggal"
                                                value="{{ old('tanggal', $post->created_at->format('d/m/y')) }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        <br>
                                        @error('category')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                        <input type="file" class="form-control-file" name="thumbnail">
                                        <div class="mt-4">
                                            <i>Old Thumbnail</i>
                                            <br>
                                            <img src="{{ asset('/uploads/thumbnail/' . $post->thumbnail) }}"
                                                class="img-fluid img-thumbnail my-2" width="150px" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                        <input type="submit" name="status" value="draft"
                                            class="btn btn-warning btn-round mr-2">
                                        <input type="submit" name="status" value="publish"
                                            class="btn btn-secondary btn-round">
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
    <script src="{{ asset('vendor') }}/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $(document).ready(function() {
            $('#datepicker').datetimepicker({
                format: 'MM/DD/YYYY',
            });

            $('#summernote-editor').summernote({
                height: 550,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'table', 'hr', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });
        });
    </script>
@endpush
