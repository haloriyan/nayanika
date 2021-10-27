@extends('layouts.page')

@section('head.dependencies')
<style>
    .aboveTheFold h3 {
        padding-bottom: 60px;
        border-bottom: 2px solid #fff;
    }
</style>
@endsection

@section('content')
<div class="aboveTheFold rata-tengah">
    <h3 class="judul">ABOUT US</h3>
</div>

<section class="rata-tengah">
    <div class="bagi lebar-70">
        <h3 style="margin-top: 0px" class="mb-2">{{ $writings['tagline'] }}</h3>
        <p>{{ $writings['about'] }}</p>

        <button>
            #DOMagnificent
        </button>
    </div>
</section>

<div class="tinggi-60 border-top-2 mt-6"></div>

@include('./partials/OurValue')
@include('./partials/CTA')
@include('./partials/Footer')

@endsection