@extends('layouts.page')

@section('title', "What We Do -")

@section('head.dependencies')
<style>
    input.box {
        background-color: #111;
        color: #fff;
        height: 40px;
    }
    input.box:focus { box-shadow: none; }
    input.box.custom-lightMode {
        background-color: #fff;
        color: #111;
        border: 1px solid #ddd;
    }
    button.custom {
        border-radius: 0px;
        border: none;
    }
    .alacarte-item {
        display: inline-block;
        margin: -2px;
        padding: 10px 25px;
        border: 1px solid #fff;
        border-radius: 900px;
        margin-right: 15px;
        margin-bottom: 15px;
    }
    .service-item .containerList.selected,
    .alacarte-item.selected {
        background-color: #2ecc71 !important;
        color: #fff !important;
    }
    .service-item .containerList.selected .item {
        background-color: #2ecc71 !important;
        color: #fff !important;
    }
    @media (max-width: 480px) {
        .service-item {
            width: 25%;
        }
    }
</style>
@endsection

@section('content')
<div class="aboveTheFold">
    <h2>WHAT WE DO</h2>
</div>

@foreach ($categories as $category)
    <h3 class="mt-0">{{ $category->name }}</h3>
    @foreach ($category->services as $service)
        <div class="bagi bagi-6 service-item">
            <div class="wrap">
                <div class="containerList" onclick="selectService(this)">
                    <div class="item">{{ $service->name }}</div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="tinggi-40"></div>
@endforeach

<div class="tinggi-60"></div>

<div class="bagi bagi-2 desktop">
    <h3 class="mt-0">ALA CARTE</h3>
</div>
<div class="bagi bagi-2 desktop" style="font-size: 20px;">
    Custom your own service.<br />
    Choose one or more for the service you need for your business
</div>

<div class="tinggi-40"></div>

@foreach ($services as $service)
    <div class="alacarte-item pointer" onclick="chooseAlacarte(this)">{{ $service->name }}</div>
@endforeach

<div class="tinggi-60"></div>

<div class="bagi bagi-2 desktop">
    <h3>We'd love to be <br /> your partners!</h3>
</div>
<div class="bagi bagi-2 desktop">
    <form action="{{ route('user.service.sendMessage') }}" method="POST" id="orderForm">
        {{ csrf_field() }}
        <div class="border-putih rounded">
            <div class="wrap super">
                <input type="hidden" id="notifStatus" value="{{ $message }}">
                @if ($message != "")
                    <div class="bg-hijau-transparan rounded p-2 mb-3">
                        {{ $message }}
                    </div>
                @endif
                <div class="teks-besar">Fill in the field below and describe your needs. In return we will contact you and suggest solutions for your business needs.</div>
                <input type="hidden" name="services" id="selectedServices">
                <input type="hidden" name="alacartes" id="selectedAlaCartes">
                <div class="mt-2">
                    <div class="bagi lebar-30">
                        <div class="mt-2">Your name :</div>
                    </div>
                    <div class="bagi lebar-70">
                        <input type="text" class="box" name="name" required>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="bagi lebar-30">
                        <div class="mt-2">Email :</div>
                    </div>
                    <div class="bagi lebar-70">
                        <input type="email" class="box" name="email" required>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="bagi lebar-30">
                        <div class="mt-2">Phone number :</div>
                    </div>
                    <div class="bagi lebar-70">
                        <input type="text" class="box" name="phone" required>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="bagi lebar-30">
                        <div class="mt-2">City :</div>
                    </div>
                    <div class="bagi lebar-70">
                        <input type="text" class="box" name="city" required>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="bagi lebar-30">
                        <div class="mt-2">Company :</div>
                    </div>
                    <div class="bagi lebar-70">
                        <input type="text" class="box" name="company" required>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="bagi lebar-30">
                        <div class="mt-2">Industry field :</div>
                    </div>
                    <div class="bagi lebar-70">
                        <input type="text" class="box" name="industry_field" required>
                    </div>
                </div>
            </div>
        </div>
        <button class="mt-2 custom">SEND <i class="fas fa-angle-double-right"></i></button>
    </form>
</div>

@include('./partials/Footer')

@endsection

@section('javascript')
<script>
    let selectedServices = [];
    let selectedAlaCartes = [];

    const selectService = btn => {
        let service = btn.innerText;
        if (btn.classList.contains('selected')) {
            removeArray(service, selectedServices);
            btn.classList.remove('selected');
        } else {
            selectedServices.push(service);
            btn.classList.add('selected');
        }
        select("#selectedServices").value = selectedServices.join(',');
    }

    const chooseAlacarte = btn => {
        let alacarte = btn.innerText;
        if (btn.classList.contains('selected')) {
            removeArray(alacarte, selectedAlaCartes);
            btn.classList.remove('selected');
        } else {
            selectedAlaCartes.push(alacarte);
            btn.classList.add('selected');
        }
        select("#selectedAlaCartes").value = selectedAlaCartes.join(',');

    }
    
    if (select("#notifStatus").value != "") {
        scrollKe("#orderForm");
    }
</script>
@endsection