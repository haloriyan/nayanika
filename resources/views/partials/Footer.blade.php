<div class="tinggi-160"></div>

<section class="footer">
    @isset($customContent)
        <div class="customContent">
            {!! $customContent !!}
        </div>
    @endisset
    <div class="desktop">
        <div class="bagi bagi-3 footer_a">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}">
            </div>
            <div><i class="fas fa-copyright"></i> {{ date('Y') }} NAYANIKA WORK</div>
        </div>
        <div class="bagi bagi-3 footer_b">
            <pre>{!! $writings['footer 1'] !!}</pre>
        </div>
        <div class="bagi bagi-3 footer_c">
            <pre>{!! $writings['footer 2'] !!}</pre>
        </div>
    </div>
    <div class="mobile">
        <div class="bagi bagi-2 footer_a">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}">
            </div>
            <div><i class="fas fa-copyright"></i> {{ date('Y') }} NAYANIKA WORK</div>
        </div>
        <div class="bagi bagi-2">
            <div class="footer_b">
                <pre>{!! $writings['footer 1'] !!}</pre>
            </div>
            <div class="footer_c">
                <pre>{!! $writings['footer 2'] !!}</pre>
            </div>
        </div>
    </div>
</section>