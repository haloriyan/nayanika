@extends('layouts.page')

@section('title', "Get in Touch - ")

@section('head.dependencies')
<style>
    .tinggi-160 {
        display: none;
    }
    section.footer .customContent h3 {
        display: inline-block;
        font-size: 80px;
        margin-top: -120px;
        letter-spacing: 6px;
        background-color: #111;
        padding-right: 45px;
        position: relative;
        top: -65px;
    }
</style>
@endsection

@section('content')

<div class="tinggi-100"></div>
@include('./partials/Footer', ['customContent' => "<h3>LET'S</h3><br />
<h3>GET TO WORK</h3>"])

@endsection