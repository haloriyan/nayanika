@extends('layouts.page')

@section('content')
<div class="aboveTheFold">
    <h2 class="tagline mb-4">TURNING YOUR IDEAS <br />INTO MAGNIFICENT VISUALS</h2>
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
    <h3 class="judul">OUR WORK</h3>
    <div id="items">
        <div id="loadPortfolio"></div>
        <br />
        <div class="item"></div>
        <div class="item">
            <h4 class="pointer sub-judul garis-bawah" id="loadMore" onclick="loadMore()">
                Load More
            </h4>
            <h4 class="pointer sub-judul d-none garis-bawah" id="toPortfolio">
                <div class="border-bottom-2 d-inline-block">
                    <a href="{{ route('user.portfolio') }}">
                        All Work <span class="icon-external-link-black custicon custicon-2"></span>
                    </a>
                </div>
            </h4>
        </div>
    </div>
</section>

<div class="tinggi-160"></div>
<section class="service">
    <div class="bagi bagi-2">
        <h3 class="judul">WHAT WE DO</h3>
        <p class="lebar-80 deskripsi">{{ $writings['service'] }}.
            <span class="border-bottom">
                <a href="{{ route('user.service') }}">
                    SHOW MORE
                    <span class="icon-external-link-black custicon"></span>
                </a>
            </span>
        </p>
    </div>
    <div class="bagi bagi-2" id="items">
        @foreach ($categories as $category)
            <h3 class="mt-0 sub-judul">{{ $category->name }}</h3>
            @foreach ($category->services as $service)
                <div class="bagi bagi-4">
                    <div class="wrap">
                        <div class="containerList squarize rounded-more" style="height: 150px;">
                            <div class="item capitalize  teks-kecil deskripsi">{{ $service->name }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('user.service') }}">
                <div class="bagi bagi-4">
                    <div class="wrap">
                        <div class="containerList squarize rounded-more" style="height: 150px;">
                            <div class="item garis-bawah teks-kecil deskripsi">SHOW MORE <span class="icon-external-link-black custicon"></span></div>
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

@section('javascript')
<script>
    let toLoad = 5;
    let loadedDataId = [];

    const loadPortfolio = () => {
        let req = post("{{ route('api.portfolio.load') }}", {
            count: toLoad
        })
        .then(res => {
            let datas = res.datas;
            if (datas.length < toLoad) {
                console.log(datas);
                select("#loadMore").classList.add('d-none');
                select("#toPortfolio").classList.remove('d-none');
            }
            datas.forEach(portfolio => {
                if (!inArray(portfolio.id, loadedDataId)) {
                    createElement({
                        el: "div",
                        attributes: [
                            ['class', 'portfolio-item item mb-4 pb-4']
                        ],
                        html: `<div class="wrap small">
    <div class="cover rounded-more squarize rectangle" bg-image="{{ asset('storage/portfolio_images') }}/${portfolio.featured_image}"></div>
    <h3 class="sub-judul font-reg mb-0 mt-1">${portfolio.title}</h3>
    <div id="categoriesArea${portfolio.id}"></div>
</div>`,
                        createTo: '#loadPortfolio'
                    });

                    let categories = portfolio.categories.split(",");
                    categories.forEach(category => {
                        createElement({
                            el: 'a',
                            attributes: [
                                ['href', `{{ route('user.portfolio') }}?category=${category}`]
                            ],
                            html: `<div class="font-reg category-item">${category}</div>`,
                            createTo: `#categoriesArea${portfolio.id}`
                        });
                    });
                }
                loadedDataId.push(portfolio.id);
            });
            bindDivWithImage();
            squarize();
            custicon();
            toggleLightMode(1);
        });
    }
    loadPortfolio();

    const loadMore = () => {
        toLoad += 5;
        loadPortfolio();
    }
</script>
@endsection
