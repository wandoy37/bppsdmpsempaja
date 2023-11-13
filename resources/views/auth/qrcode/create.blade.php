@extends('auth.layouts.app')

@section('title', 'Generate QRCODE')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Generate QRCODE</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('auth.qrcode') }}">
                        <i class="icon-tag"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('auth.qrcode.create') }}">Tambah QRCODE</a>
                </li>
            </ul>
        </div>

        {{-- Notify --}}
        <div id="success" data-flash="{{ session('success') }}"></div>
        <div id="fails" data-flash="{{ session('fails') }}"></div>
        {{-- ====== --}}

        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('auth.qrcode') }}" class="btn btn-secondary btn-border btn-round">
                    <i class="fas fa-undo"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="row" style="padding-top: 2rem;">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('auth.qrcode.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    placeholder="Title.." value="{{ old('title') }}" required>
                                @error('title')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="links">Links</label>
                                <input id="links" type="text"
                                    class="form-control @error('links') is-invalid @enderror" name="links"
                                    placeholder="Links.." value="{{ old('links') }}" required>
                                @error('links')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan <span class="text-muted">(Opsional)</span></label>
                                <input id="keterangan" type="text"
                                    class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                    placeholder="Opsional.." value="{{ old('keterangan') }}">
                                @error('keterangan')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-secondary btn-round">
                                    <i class="fas fa-plus"></i>
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
