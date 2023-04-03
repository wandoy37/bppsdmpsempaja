@extends('auth.layouts.app')

@section('title', 'Sosial Media')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Sosial Media</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('auth.dashboard') }}">
                        <i class="icon-globe"></i>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Notify --}}
        <div id="success" data-flash="{{ session('success') }}"></div>
        <div id="fails" data-flash="{{ session('fails') }}"></div>
        {{-- ====== --}}

        {{-- <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('auth.category.create') }}" class="btn btn-secondary btn-round">
                    <i class="fas fa-plus"></i>
                    Kategori
                </a>
            </div>
        </div> --}}

        <div class="row" style="padding-top: 2rem;">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sosial Media</th>
                                    <th>link</th>
                                    <th width="10%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($social_media as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td><a href="{{ $item->link }}">{{ $item->link }}</a></td>
                                        <td class="text-center">
                                            <a href="{{ route('auth.social.media.edit', $item->slug) }}"
                                                class="text-primary">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $('#basic-datatables').DataTable();

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
