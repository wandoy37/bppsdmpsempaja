@extends('auth.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('auth.dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                {{-- <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                </li> --}}
            </ul>
        </div>
    </div>
@endsection
