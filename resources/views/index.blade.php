@extends('layouts.page')

@section('content')
<div class="aboveTheFold">
    <h2>TURNING YOUR IDEAS<br /> INTO MAGNIFICENT VISUALS</h2>
    <div class="desktop">
        <section class="footer">
            <div class="bagi bagi-3">
                <div>#DoMagnificent</div>
            </div>
            <div class="bagi bagi-3">
                <pre>{!! $writings['footer 1'] !!}</pre>
            </div>
            <div class="bagi bagi-3">
                <pre>{!! $writings['footer 2'] !!}</pre>
            </div>
        </section>
    </div>
    <div class="mobile">
        <section class="footer">
            <div class="bagi bagi-2">
                <div class="lebar-90">
                    <div>#DoMagnificent</div>
                    <pre>{!! $writings['footer 1'] !!}</pre>
                </div>
            </div>
            <div class="bagi bagi-2 rata-kanan">
                <pre>{!! $writings['footer 2'] !!}</pre>
            </div>
        </section>
    </div>
</div>

<div class="tinggi-160"></div>
@include('partials/OurValue')

<div class="tinggi-160"></div>
<section class="portfolio">
    <h3>OUR WORK</h3>
    <div id="items">
        @foreach ($portfolios as $portfolio)
            @php
                $portoCategories = explode(",", $portfolio->categories);
            @endphp
            <div class="item">
                <div class="image" bg-image="{{ asset('storage/portfolio_images/'.$portfolio->featured_image) }}"></div>
                <div class="detail">
                    <h4>{{ $portfolio->title }}</h4>
                    @foreach ($portoCategories as $key => $category)
                        <div class="tags">{{ $category }}</div>
                    @endforeach
                </div>
            </div>
        @endforeach
        
        <div class="item"></div>
        <div class="item">
            <h4>
                <a href="#">All Work <i class="ml-2 fas fa-link-external"></i></a>
            </h4>
        </div>
    </div>
</section>

<div class="tinggi-160"></div>
<section class="service">
    <div class="bagi bagi-2">
        <h3>WHAT WE DO</h3>
        <p class="lebar-80">{{ $writings['service'] }}</p>
    </div>
    <div class="bagi bagi-2" id="items">
        @foreach ($categories as $category)
            <h3 class="mt-0">{{ $category->name }}</h3>
            @foreach ($category->services as $service)
                <div class="bagi bagi-4">
                    <div class="wrap">
                        <div class="containerList" style="height: 150px;">
                            <div class="item">{{ $service->name }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('user.service') }}">
                <div class="bagi bagi-4">
                    <div class="wrap">
                        <div class="containerList" style="height: 150px;">
                            <div class="item">SHOW MORE <br /> <i class="fas fa-external-link-alt"></i></div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="tinggi-40"></div>
        @endforeach
    </div>
</section>

@include('./partials/CTA')
@include('./partials/Footer')

@endsection
