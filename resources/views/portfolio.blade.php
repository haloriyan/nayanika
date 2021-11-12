@extends('layouts.page')

@section('title', "Our Work -")

@section('head.dependencies')
<style>
    .aboveTheFold h2 {
        border: none;
        padding-bottom: 0px;
    }
    .category-menu {
        position: absolute;
        z-index: 4;
        background: none !important;
    }
    .category-menu li {
        float: left;
        list-style: none;
        font-size: 20px;
        margin-top: 50px;
        margin-right: 25px;
        padding-bottom: 15px;
    }
    .category-menu li.active {
        border-bottom: 3px solid #fff;
    }
    .category-menu .categoryCounter {
        display: inline-block;
        font-size: 16px;
        position: relative;
        top: -8px;left: -4px;
    }
    .portfolio-item p { font-size: 20px; }
    .portfolio-item a { text-decoration: none; }
    .portfolio-item .cover { height: 350px; }
    .portfolio-item .detail h3 {
        margin-bottom: 0px;
        font-family: GrotesqueSemiBold !important;
    }

    .topSeparator {
        position: relative;
        top: -20px;
        margin-top: -20px;
    }

    @media (max-width: 480px) {
        h3.title { font-size: 20px;margin-top: 40px; }
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
        .portfolio-item .detail .wrapper {
            padding: 20px 0px;
        }

        .topSeparator { top: 10px; }
    }
</style>
@endsection

@section('content')
<div class="aboveTheFold">
    <h2>OUR WORK</h2>
</div>
<div class="tinggi-40"></div>
<div class="bagi bagi-2 desktop">
    <h3 class="mt-0 judul">PROJECTS</h3>
</div>
<div class="bagi bagi-2 desktop">
    <div class="category-menu ml-4">
        <a href="{{ route('user.portfolio') }}">
            <li class="{{ $request->category == '' ? 'active' : '' }}">All</li>
        </a>
        @foreach ($categories as $category)
            <a href="{{ route('user.portfolio', ['category' => $category->name]) }}">
                <li class="{{ $request->category == $category->name ? 'active' : '' }}">{{ $category->name }} <div class="categoryCounter">{{ $category->portfolio_count }}</div></li>
            </a>
        @endforeach
    </div>
</div>
<div class="tinggi-100 mobile"></div>
<hr size="1" color="#888" class="topSeparator" />

<div id="loadArea"></div>

<div class="desktop">
    <div class="bagi bagi-2"></div>
    <div class="bagi bagi-2">
        <div class="wrap">
            <div class="ml-1 border-bottom d-inline-block deskripsi pointer loadMoreBtn" onclick="loadMore(this)">
                SHOW MORE <span class="icon-external-link-black custicon rotateToBottom"></span>
            </div>
        </div>
    </div>
</div>
<div class="mobile rata-tengah">
    <div class="ml-1 garis-bawah deskripsi pointer loadMoreBtn" onclick="loadMore(this)">
        SHOW MORE <span class="icon-external-link-black custicon rotateToBottom"></span>
    </div>
</div>

@include('./partials/CTA')
@include('./partials/Footer')
@endsection

@section('javascript')
<script>
    let toLoad = 3;
    let loadedDataId = [];
    let url = new URL(document.URL);
    let category = url.searchParams.get('category');

    const load = (customCallback = null) => {
        let req = post("{{ route('api.portfolio.load') }}", {
            count: toLoad,
            category: category
        })
        .then(res => {
            let datas = res.datas;
            datas.forEach(portfolio => {
                let description = portfolio.description;
                let desc = description.split(" ");
                let displayDescription = "";
                if (desc.length > 35) {
                    for (let i = 0; i < 35; i++) {
                        displayDescription += desc[i] + " ";
                    }
                    // displayDescription += `<span class="garis-bawah">SHOW MORE <span class="icon-external-link-black custicon"></span></span>`;
                } else {
                    displayDescription += description;
                }

                if (!inArray(portfolio.id, loadedDataId)) {
                    createElement({
                        el: "div",
                        attributes: [
                            ['class', 'portfolio-item']
                        ],
                        html: `<div class="bagi bagi-2">
        <div class="wrap ml-0">
            <a href="{{ route('user.portfolio.detail') }}/${portfolio.id}">
                <div class="cover squarize rectangle rounded" bg-image="{{ asset('storage/portfolio_images') }}/${portfolio.featured_image}"></div>
            </a>
        </div>
    </div>
    <div class="bagi bagi-2 detail">
        <div class="ml-0 p-4 wrapper">
            <a href="{{ route('user.portfolio.detail') }}/${portfolio.id}">
                <h3>${portfolio.title}
                    <div class="custicon ke-kanan mt-1" size="30" icon="external-link-white"></div>
                </h3>
                <p>${displayDescription}</p>
            </a>
            <div id="categoriesArea${portfolio.id}"></div>
        </div>
    </div>
    <br />
    <hr size="1" color="#888" />`,
                        createTo: '#loadArea'
                    });

                    let categories = portfolio.categories.split(",");
                    categories.forEach(category => {
                        createElement({
                            el: 'a',
                            attributes: [
                                ['href', `{{ route('user.portfolio') }}?category=${category}`]
                            ],
                            html: `<div class="category-item">${category}</div>`,
                            createTo: `#categoriesArea${portfolio.id}`
                        });
                    });
                    loadedDataId.push(portfolio.id);
                }
            });
            bindDivWithImage();
            squarize();
            custicon();
            toggleLightMode(1);

            if (customCallback != null) {
                customCallback();
            }
        });
    }
    load();
    const loadMore = (btn) => {
        btn.innerHTML = "<i class='fas fa-spinner'></i> loading...";
        toLoad += 3;
        load(() => {
            if (loadedDataId.length < toLoad) {
                btn.remove();
            } else {
                console.log(`loaded : ${loadedDataId.length}`);
                console.log(`toLoad : ${toLoad}`);
                btn.innerHTML = `SHOW MORE <span class="icon-external-link-black custicon rotateToBottom"></span>`;
            }
        });
    }
</script>
@endsection