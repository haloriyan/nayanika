@extends('layouts.page')

@section('head.dependencies')
<style>
    .aboveTheFold h3 {
        padding-bottom: 60px;
        border-bottom: 2px solid #fff;
    }
    button#cta  {
        border-width: 1px;
        padding: 0px 13px;
        padding-bottom: 5px;
        height: 40px;
        font-size: 20px;
    }
</style>
@endsection

@section('content')
<div class="aboveTheFold rata-tengah">
    <h2>ABOUT US</h2>
</div>

<section class="rata-tengah">
    <div class="bagi lebar-70">
        <h3 style="margin-top: 0px" class="mb-2">{{ $writings['tagline'] }}</h3>
        <p>{{ $writings['about'] }}</p>

        <button id="cta">
            #DoMagnificent
        </button>
    </div>
</section>

<div class="tinggi-60 border-top-2 mt-6"></div>

@include('./partials/OurValue', ['notUsingShowMore' => 1])
@include('./partials/CTA')
@include('./partials/Footer')

@endsection