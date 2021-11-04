@extends('layouts.page')

@section('title', "What We Do -")

@section('head.dependencies')
<style>
    .group {
        position: relative;
    }
    label {
        position: absolute;
        top: 20px;left: 16px;
        transition: 0.4s;
    }
    input.box {
        background-color: #000;
        color: #fff;
        height: 40px;
        box-shadow: none !important;
    }
    input.box:focus ~ label,input.box:valid ~ label {
        top: -14px;left: 0px;
        font-size: 15px;
    }
    input.box.custom-lightMode {
        background-color: #fff;
        color: #000;
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
        background-color: #fff !important;
        color: #000 !important;
    }
    .service-item .containerList.selected .item {
        background-color: #fff !important;
        color: #000 !important;
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
    <h3 class="mt-0 judul">{{ $category->name }}</h3>
    @foreach ($category->services as $service)
        <div class="bagi bagi-6 service-item">
            <div class="wrap">
                <div class="containerList squarize rounded-more" onclick="selectService(this)">
                    <div class="item teks-kecil deskripsi">{{ strtoupper($service->name) }}</div>
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
    <div class="alacarte-item pointer" onclick="chooseAlacarte(this)">{{ strtoupper($service->name) }}</div>
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
                <div class="teks-besar mb-3">Fill in the field below and describe your needs. In return we will contact you and suggest solutions for your business needs.</div>
                <input type="hidden" name="services" id="selectedServices">
                <input type="hidden" name="alacartes" id="selectedAlaCartes">

                <div class="mt-2 group">
                    <input type="text" class="box" name="name" id="name" required>
                    <label for="name">Your name :</label>
                </div>
                <div class="mt-2 group">
                    <input type="text" class="box" name="email" id="email" required>
                    <label for="name">Email :</label>
                </div>
                <div class="mt-2 group">
                    <input type="text" class="box" name="phone" id="phone" required>
                    <label for="name">Phone number :</label>
                </div>
                <div class="mt-2 group">
                    <input type="text" class="box" name="city" id="city" required>
                    <label for="name">City :</label>
                </div>
                <div class="mt-2 group">
                    <input type="text" class="box" name="company" id="company" required>
                    <label for="name">Company :</label>
                </div>
                <div class="mt-2 group">
                    <input type="text" class="box" name="industry_field" id="industry_field" required>
                    <label for="name">Industry field :</label>
                </div>
            </div>
        </div>

        <div class="garis-bawah mt-3 pointer bagi" onclick="kirim()">
            SEND <span class="icon-external-link-black custicon"></span>
        </div>
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

    const kirim = () => {
        select("#orderForm").submit();
    }
</script>
@endsection