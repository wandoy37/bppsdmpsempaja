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
            </ul>
        </div>

        {{-- Notify --}}
        <div id="success" data-flash="{{ session('success') }}"></div>
        <div id="fails" data-flash="{{ session('fails') }}"></div>
        {{-- ====== --}}

        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('auth.video.create') }}" class="btn btn-secondary btn-round">
                    <i class="fas fa-plus"></i>
                    Video
                </a>
            </div>
        </div>

        <div class="row" style="padding-top: 2rem;">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($videos as $video)
                                <div class="col-sm-4 my-4">
                                    <iframe width="500" height="250" src="{{ $video->link }}">
                                    </iframe>
                                    <h3 class="text-uppercase">{{ $video->title }}</h3>
                                    <div class="float-right">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('auth.video.edit', $video->slug) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form id="form-delete-{{ $video->id }}"
                                                action="{{ route('auth.video.delete', $video->slug) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="btnDelete( {{ $video->id }} )">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        // Notify
        var flash = $('#success').data('flash');
        if (flash) {
            $.notify({
                // options
                icon: 'fas fa-check',
                title: 'Berhasil',
                message: '{{ session('success') }}',
            }, {
                // settings
                type: 'success',
            });
        }
        var flash = $('#fails').data('flash');
        if (flash) {
            $.notify({
                // options
                icon: 'fas fa-ban',
                title: 'Gagal',
                message: '{{ session('fails') }}',
            }, {
                // settings
                type: 'danger',
            });
        }

        function btnDelete(id) {
            swal({
                title: 'Apa anda yakin?',
                text: "Data tidak dapat di kembalikan setelah ini !!!",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Ya, hapus sekarang',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $('#form-delete-' + id).submit();
                } else {
                    swal.close();
                }
            });
        }
    </script>
@endpush
