@extends('layouts.admin')

@section('title', "Dashboard")

@section('head.dependencies')
<style>
    .card-item a {
        color: #444;
    }
    .card-item .icon { font-size: 30px; }
    .card-item .text { font-size: 20px; }
</style>
@endsection

@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        <p class="teks-besar">
            Selamat datang, <b>{{ $myData->first_name }}</b>!
        </p>
    </div>
</div>

<div class="bagi bagi-4 mt-1">
    <div class="wrap">
        <a href="{{ route('admin.category') }}">
            <div class="bg-primer rounded smallPadding mt-4 card-item">
                <div class="wrap super">
                    <div class="icon"><i class="fas fa-tags"></i></div>
                    <div class="text mt-1">Kategori</div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="bagi bagi-4 mt-1">
    <div class="wrap">
        <a href="{{ route('admin.service') }}">
            <div class="bg-primer rounded smallPadding mt-4 card-item">
                <div class="wrap super">
                    <div class="icon"><i class="fas fa-cogs"></i></div>
                    <div class="text mt-1">Services</div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="bagi bagi-4 mt-1">
    <div class="wrap">
        <a href="{{ route('admin.portfolio') }}">
            <div class="bg-primer rounded smallPadding mt-4 card-item">
                <div class="wrap super">
                    <div class="icon"><i class="fas fa-briefcase"></i></div>
                    <div class="text mt-1">Portfolio</div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="bagi bagi-4 mt-1">
    <div class="wrap">
        <a href="{{ route('admin.admin') }}">
            <div class="bg-primer rounded smallPadding mt-4 card-item">
                <div class="wrap super">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <div class="text mt-1">User Administrator</div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection