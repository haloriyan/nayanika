@extends('layouts.admin')

@section('title', "Services")

@section('header.action')
<button class="primer rounded-none" onclick="munculPopup('#addService')">
    <i class="fas fa-plus mr-1"></i> Baru
</button>
@endsection

@section('content')
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        @if ($message != "")
            <div class="bg-hijau-transparan rounded p-2 mb-3">
                {{ $message }}
            </div>
        @endif

        @if ($services->count() == 0)
            <h3 class="rata-tengah">Tidak ada data</h3>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nama Service</th>
                        <th>Kategori</th>
                        <th class="lebar-20"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->category->name }}</td>
                            <td>
                                <span class="bg-hijau-transparan rounded p-1 pl-2 pr-2 pointer" onclick="edit('{{ $service }}')">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="bg-merah-transparan rounded p-1 pl-2 pr-2 pointer ml-1" onclick="hapus('{{ $service }}')">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="addService">
    <div class="popup">
        <div class="wrap">
            <h3>Tambah Service Baru
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#addService')"></i>
            </h3>
            <form action="{{ route('admin.service.store') }}" method="POST" class="wrap super">
                {{ csrf_field() }}
                <div class="mt-2">Kategori :</div>
                <select name="category_id" id="category" class="box" required>
                    <option value="">-- PILIH KATEGORI --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <div class="mt-2">Nama Layanan :</div>
                <input type="text" class="box" name="name" id="name" required>

                <button class="lebar-100 mt-3 primer">Tambahkan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="editService">
    <div class="popup">
        <div class="wrap">
            <h3>Edit Service
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#editService')"></i>
            </h3>
            <form action="{{ route('admin.service.update') }}" method="POST" class="wrap super">
                {{ csrf_field() }}
                <input type="hidden" id="id" name="id">
                <div class="mt-2">Kategori :</div>
                <select name="category_id" id="category_id" class="box" required>
                    <option value="">-- PILIH KATEGORI --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <div class="mt-2">Nama Layanan :</div>
                <input type="text" class="box" name="name" id="name" required>

                <button class="lebar-100 mt-3 primer">Tambahkan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="deleteService">
    <div class="popup">
        <div class="wrap">
            <h3>Hapus Service
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#deleteService')"></i>
            </h3>
            <form action="{{ route('admin.service.delete') }}" method="POST" class="wrap super">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                Yakin ingin menghapus service <b id="name"></b> ?

                <button class="lebar-100 mt-3 primer">Ya, hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const hapus = data => {
        data = JSON.parse(data);
        munculPopup("#deleteService");
        select("#deleteService #id").value = data.id;
        select("#deleteService #name").innerText = data.name;
    }

    const edit = data => {
        data = JSON.parse(data);
        munculPopup("#editService");
        select("#editService #id").value = data.id;
        select("#editService #name").value = data.name;
        select(`#editService #category_id option[value='${data.category_id}']`).selected = true;
    }
</script>
@endsection