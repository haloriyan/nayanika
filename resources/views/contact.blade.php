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
        section.footer .customContent h3:nth-child(odd) {
            top: 43px;
        }
        section.footer .customContent h3:nth-child(even) {
            margin-top: -20px;
            width: 90%;
            line-height: 90px;
        }
    }
</style>
@endsection

@section('content')

<div class="tinggi-100"></div>
@include('./partials/Footer', ['customContent' => "<h3 class='tagline'>LET'S</h3>
<h3 class='tagline mt-5'>GET TO WORK <span class='icon-external-link-black custicon custicon-3'></span></h3>"])

@endsection