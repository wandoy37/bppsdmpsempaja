@extends('auth.layouts.app')

@section('title', 'Kategori')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Kategori</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('auth.dashboard') }}">
                        <i class="icon-tag"></i>
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
                <a href="{{ route('auth.category.create') }}" class="btn btn-secondary btn-round">
                    <i class="fas fa-plus"></i>
                    Kategori
                </a>
            </div>
        </div>

        <div class="row" style="padding-top: 2rem;">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    @foreach ($categories as $kategori)
                                        <?php $no++; ?>
                                        <tr>
                                            <th>{{ $no }}</th>
                                            <th>{{ $kategori->title }}</th>
                                            <th>{{ $kategori->slug }}</th>
                                            <th class="form-inline">
                                                <a href="{{ route('auth.category.edit', $kategori->slug) }}"
                                                    class="text-primary">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <form id="form-delete-{{ $kategori->id }}"
                                                    action="{{ route('auth.category.delete', $kategori->slug) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-link text-danger"
                                                    onclick="btnDelete( {{ $kategori->id }} )">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
