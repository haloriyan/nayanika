@extends('layouts.page')

@section('title', $portfolio->title)

@section('head.dependencies')
<style>
    .aboveTheFold h2 {
        padding-bottom: 40px;
        border-bottom: 2px solid #fff;
    }
    @media (max-width: 480px) {
        .main-cover {
            height: 250px;
        }
        .cover { height: 120px; }
        .bagi.bagi-2.desktop {
            display: block;
            margin: 0;
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="aboveTheFold">
    <h2>{{ $portfolio->title }}</h2>
</div>

<div class="main-cover squarize rectangle rounded mt-4" bg-image="{{ asset('storage/portfolio_images/'.$portfolio->featured_image) }}"></div>

<div class="tinggi-60"></div>
<div class="bagi bagi-2 desktop">
    <h3 class="mt-0">ABOUT</h3>
</div>
<div class="bagi bagi-2 desktop">
    <div class="teks-besar">{{ $portfolio->description }}</div>
</div>

<div class="tinggi-60"></div>

@isset($portfolio->images[0])
<div class="bagi bagi-2">
    <div class="wrap">
        <div class="cover squarize rectangle rounded" bg-image="{{ asset('storage/portfolio_images/'.$portfolio->images[0]->filename) }}"></div>
    </div>
</div>
@endif

@isset($portfolio->images[1])
<div class="bagi bagi-2">
    <div class="wrap">
        <div class="cover squarize rectangle rounded" bg-image="{{ asset('storage/portfolio_images/'.$portfolio->images[1]->filename) }}"></div>
    </div>
</div>
@endif

<div class="tinggi-60"></div>
<div class="bagi bagi-2 desktop">
    <h3 class="mt-0">PROBLEM & SOLVE</h3>
</div>
<div class="bagi bagi-2 desktop">
    <div class="teks-besar">{{ $portfolio->task }}</div>
</div>

<div class="tinggi-60"></div>

<div class="gallery">
    @php
        $images = json_decode(json_encode($portfolio->images));
        array_splice($images, 0, 2);
    @endphp
    @foreach ($images as $image)
        <div class="item">
            <div class="wrap">
                <img src="{{ asset('storage/portfolio_images/'.$image->filename) }}" class="lebar-100 rounded">
            </div>
        </div>
    @endforeach
</div>

@include('./partials/CTA')
@include('./partials/Footer')
@endsection

@section('javascript')
<script src="{{ asset('js/masonry.js') }}"></script>
<script>
    let generateMasonry = new Masonry({
        container: '.gallery',
        items: '.gallery .item',
        dividedBy: 2
    })
</script>
@endsection