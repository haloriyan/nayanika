<div class="tinggi-160"></div>

<section class="footer font-reg">
    @isset($customContent)
        <div class="customContent font-reg">
            <a href="{{ route('user.service') }}">
                {!! $customContent !!}
            </a>
        </div>
    @endisset
    <div class="desktop">
        <div class="bagi bagi-3 footer_a">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}">
            </div>
            <div class="tinggi-60"></div>
            <div>COPYRIGHT NAYANIKA WORK {{ date('Y') }}</div>
        </div>
        <div class="bagi bagi-3 footer_b rata-tengah">
            <div class="bagi rata-kiri">
                <pre>{!! $writings['footer 1'] !!}</pre>
            </div>
        </div>
        <div class="bagi bagi-3 footer_c rata-kanan">
            <pre>{!! $writings['footer 2'] !!}</pre>
        </div>
    </div>
    <div class="mobile">
        <div class="bagi bagi-2 footer_a">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}">
            </div>
        </div>
        <div class="bagi bagi-2 rata-kanan">
            <div class="footer_b">
                <pre>{!! $writings['footer 1'] !!}</pre>
            </div>
            <div class="footer_c ">
                <pre>{!! $writings['footer 2'] !!}</pre>
            </div>
        </div>
        <div class="bagi" style="position: relative;top: -15px;">COPYRIGHT NAYANIKA WORK {{ date('Y') }}</div>
    </div>
</section>