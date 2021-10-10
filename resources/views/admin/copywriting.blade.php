@extends('layouts.admin')

@section('title', "Copywriting")

@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        @if ($message != "")
            <div class="bg-hijau-transparan rounded p-2 mb-3">
                {{ $message }}
            </div>
        @endif
        <form action="{{ route('admin.copywriting.update') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="code" value="{{ $writing->item_code }}">
            <h2>{{ ucwords($writing->item_code) }}</h2>
            <textarea name="body" class="box" required>{{ $writing->body }}</textarea>

            <button class="lebar-100 mt-3 primer">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection