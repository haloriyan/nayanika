@extends('layouts.page')

@section('title', "Get in Touch - ")

@section('head.dependencies')
<style>
    .tinggi-160 {
        display: none;
    }
    section.footer .customContent {
        position: relative;
        height: 300px;
        margin-bottom: 40px;
    }
    section.footer .customContent a { text-decoration: none !important; }
    section.footer .customContent h3 {
        display: inline-block;
        font-size: 80px;
        margin-top: -120px;
        letter-spacing: 3px;
        line-height: 20px;
        padding-right: 45px;
        position: absolute;
        z-index: 5;
        background-color: #000;
    }
    section.footer .customContent h3:nth-child(odd) {
        top: 40px;
    }
    section.footer .customContent h3:nth-child(even) {
        margin-top: 30px;
    }
    @media (max-width: 480px) {
        .content {
            top: -60px !important;
        }
        section.footer { border: none; }
        section.footer .bagi {
            display: block;
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')

<div class="tinggi-100"></div>
@include('./partials/Footer', ['customContent' => "<h3 class='tagline'>LET'S</h3>
<h3 class='tagline mt-5'>GET TO WORK <span class='icon-external-link-black custicon custicon-3'></span></h3>"])

@endsection

@section('javascript')
<script>
    state.headerCanScroll = false;
    let deviceWidth = screen.width;
    if (deviceWidth <= 480) {
        let content = select(".customContent");
        let text = content.innerText.split(/[\s\\n]+/);
        let toReplace = `<a href="{{ route('user.service') }}">${text[0]}<br />${text[1]}<br />${text[2]}<br />${text[3]}<br /><span class='icon-external-link-black custicon-2'></span></a>`;
        content.innerHTML = toReplace;

        let footerA = select("section.footer .mobile .footer_a");
        let footerLogo = select(".footer .mobile .footer_a .logo");
        footerA.remove();
        footerLogo.remove();
        footerA.style.marginTop = "10px";
        
        let footerB = select(".footer .mobile .footer_b");
        let footerBContent = footerB.childNodes[1].innerHTML.split("Jl")[1];
        footerB.style.marginBottom = '40px';
        footerB.innerHTML = `<pre>Jl${footerBContent}</pre>`;

        // select(".footer .mobile").appendChild(footerA);

        header.classList.add('stick');
    }
</script>
@endsection