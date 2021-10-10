@extends('layouts.page')

@section('title', "Our Work -")

@section('head.dependencies')
<style>
    .aboveTheFold h2 {
        border: none;
        padding-bottom: 0px;
    }
    .category-menu li {
        float: left;
        list-style: none;
        font-size: 20px;
        margin-top: 20px;
        margin-right: 25px;
        padding-bottom: 10px;
    }
    .category-menu li.active {
        border-bottom: 2px solid #fff;
    }
    .portfolio-item p { font-size: 20px; }
    .portfolio-item a { text-decoration: none; }
    .portfolio-item .cover { height: 350px; }

    @media (max-width: 480px) {
        .portfolio-item {
            margin-top: 40px;
            padding-bottom: 40px;
        }
        .portfolio-item .cover { height: 250px; }
        .portfolio-item .bagi.bagi-2 {
            display: block;
            margin: 0px;
            width: 100%;
        }
        .portfolio-item h3 { font-size: 30px; }
        .portfolio-item p { font-size: 18px; }
        .portfolio-item .wrap { margin: 0% !important; }
    }
</style>
@endsection

@section('content')
<div class="aboveTheFold">
    <h2>OUR WORK</h2>
</div>
<div class="bagi bagi-2">
    <h3 class="mt-0">PROJECTS</h3>
</div>
<div class="bagi bagi-2">
    <div class="category-menu">
        <a href="{{ route('user.portfolio') }}">
            <li class="{{ $request->category == '' ? 'active' : '' }}">All</li>
        </a>
        @foreach ($categories as $category)
            <a href="{{ route('user.portfolio', ['category' => $category->name]) }}">
                <li class="{{ $request->category == $category->name ? 'active' : '' }}">{{ $category->name }}</li>
            </a>
        @endforeach
    </div>
</div>

@foreach ($portfolios as $portfolio)
    @php
        $portCategories = explode(",", $portfolio->categories);
    @endphp
    <div class="portfolio-item border-bottom">
        <div class="bagi bagi-2">
            <div class="wrap">
                <a href="{{ route('user.portfolio.detail', $portfolio->id) }}">
                    <div class="cover rounded" bg-image="{{ asset('storage/portfolio_images/'.$portfolio->featured_image) }}"></div>
                </a>
            </div>
        </div>
        <div class="bagi bagi-2 detail">
            <div class="wrap super">
                <a href="{{ route('user.portfolio.detail', $portfolio->id) }}">
                    <h3>{{ $portfolio->title }}
                        <i class="fas fa-external-link-alt ke-kanan teks-kecil mt-1"></i>
                    </h3>
                    <p>{{ $portfolio->description }}</p>
                </a>
                @foreach ($portCategories as $cat)
                    <a href="{{ route('user.portfolio', ['category' => $cat]) }}">
                        <div class="category-item">{{ $cat }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endforeach

@include('./partials/CTA')
@include('./partials/Footer')
@endsection