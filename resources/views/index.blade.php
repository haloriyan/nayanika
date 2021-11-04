@extends('layouts.page')

@section('head.dependencies')
<style>
    .portfolio-item .categories { margin-top: 3px; }
    .category-item {
        float: left;
        font-family: GrotesqueSemiBold;
    }
    h4#toPortfolio {
        margin-top: -20px;
    }
    @media (max-width: 480px) {
        .category-item {
            float: right;
            padding: 2px 5px;
            font-size: 11px;
            margin-right: 0px;
            margin-left: 5px;
        }
        .portfolio-item .title {
            letter-spacing: 1.5px;
        }
    }
</style>
@endsection

@section('content')
<div class="aboveTheFold">
    <h2 class="tagline mb-4">TURNING YOUR IDEAS <br />INTO MAGNIFICENT VISUALS</h2>
    <div class="desktop">
        <section class="footer">
            <div class="bagi bagi-3 footer_a">
                <div>#DoMagnificent</div>
            </div>
            <div class="bagi bagi-3 footer_b">
                <pre>{!! $writings['footer 1'] !!}</pre>
            </div>
            <div class="bagi bagi-3 footer_c">
                <pre>{!! $writings['footer 2'] !!}</pre>
            </div>
        </section>
    </div>
    <div class="mobile">
        <section class="footer">
            <div class="bagi bagi-2 footer_a">
                <div class="lebar-90">
                    <div style="margin-top: -13px">#DoMagnificent</div>
                    <pre>{!! $writings['footer 1'] !!}</pre>
                </div>
            </div>
            <div class="bagi bagi-2 footer_b rata-kanan">
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
        <div class="item desktop"></div>
        <div class="item p-0">
            <h4 class="pointer m-0 sub-judul garis-bawah" id="loadMore" onclick="loadMore()" style="margin-top: -30px;">
                Load More
            </h4>
            <h4 class="pointer m-0 sub-judul d-none garis-bawah" id="toPortfolio" style="margin-top: -30px;">
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
        <p class="lebar-80 deskripsi">{{ $writings['service'] }}.</p>
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
                            <div class="item garis-bawah teks-kecil deskripsi">SHOW <div class="mobile"></div> MORE <span class="icon-external-link-black custicon"></span></div>
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
    let deviceWidth = screen.width;

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
                            ['class', 'portfolio-item item mb-4 pb-2']
                        ],
                        html: `<div class="wrap small">
    <a href="{{ route('user.portfolio.detail') }}/${portfolio.id}">
        <div class="cover rounded-more squarize rectangle" bg-image="{{ asset('storage/portfolio_images') }}/${portfolio.featured_image}"></div>
        <h3 class="sub-judul title font-reg mb-0 mt-1">${portfolio.title}</h3>
        <div class="categories" id="categoriesArea${portfolio.id}"></div>
    </a>
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
                            html: `<div class="category-item d-inline-block">${category}</div>`,
                            createTo: `#categoriesArea${portfolio.id}`
                        });
                    });
                }
                loadedDataId.push(portfolio.id);
            });
            if (deviceWidth < 480) {
                selectAll(".portfolio-item .title").forEach(item => {
                    item.style.width = "50%";
                    item.style.float = "left";
                });
                selectAll(".portfolio-item .categories").forEach(item => {
                    item.style.width = "50%";
                    item.style.float = "right";
                });
            }

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

    if (deviceWidth < 480) {
        let tagline = select(".aboveTheFold h2.tagline");
        let text = tagline.innerText.split(/[\s\\n]+/);
        let toReplace = `${text[0]} ${text[1]}<br />${text[2]} ${text[3]}<br />${text[4]} ${text[5]}`;
        tagline.innerHTML = toReplace;
        tagline.style.padding = "0px";
        tagline.classList.remove('mb-4');

        let footerAtasB = select(".aboveTheFold .mobile .footer_a pre");
        let footerAtasBContent = footerAtasB.innerHTML.split("Jl.")[0];
        let textAtas = footerAtasBContent.split(/[\s\\n]+/);
        let replaceFooterAtas = `${textAtas[0]}<br />${textAtas[1]}<br />${textAtas[2]} ${textAtas[3]}`;
        footerAtasB.innerHTML = replaceFooterAtas;
    }
</script>
@endsection
