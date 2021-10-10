@extends('layouts.admin')

@section('title', "Profile")

@section('content')
@if ($message != "")
    <div class="bg-hijau-transparan rounded p-2 mb-3">
        {{ $message }}
    </div>
@endif

<h2 class="mt-0">Informasi Dasar</h2>
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        <form action="{{ route('admin.profile.update') }}" method="POST">
            {{ csrf_field() }}
            <div class="mt-2">Nama :</div>
            <input type="text" class="box" name="name" value="{{ $myData->name }}" required>
            <div class="mt-2">Email :</div>
            <input type="text" class="box" name="email" value="{{ $myData->email }}" required>

            <button class="primer lebar-100 mt-3">Simpan Perubahan</button>
        </form>
    </div>
</div>

<h2>Ubah Password</h2>
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        <form action="{{ route('admin.profile.updatePassword') }}" method="POST">
            {{ csrf_field() }}
            <div class="mt-2">Buat Password Baru :</div>
            <input type="password" class="box" name="password" required>

            <div class="mt-1 teks-transparan">Anda akan logout setelah mengubah password</div>

            <button class="lebar-100 mt-3 primer">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection