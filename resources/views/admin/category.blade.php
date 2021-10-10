@extends('layouts.admin')

@section('title', "Kategori")

@section('header.action')
<button class="primer rounded-none" onclick="munculPopup('#addCategory')">
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

        @if ($categories->count() == 0)
            <h3 class="rata-tengah">Tidak ada data</h3>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>digunakan</th>
                        <th class="lebar-20"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->count }} kali</td>
                            <td>
                                <span class="bg-hijau-transparan rounded p-1 pl-2 pr-2 pointer" onclick="edit('{{ $category }}')">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="bg-merah-transparan rounded p-1 pl-2 pr-2 pointer ml-1" onclick="hapus('{{ $category }}')">
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
<div class="popupWrapper" id="addCategory">
    <div class="popup">
        <div class="wrap">
            <h3>Tambah Kategori Baru
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#addCategory')"></i>
            </h3>
            <form action="{{ route('admin.category.store') }}" method="POST" class="wrap super">
                {{ csrf_field() }}
                <div class="mt-2">Nama Kategori :</div>
                <input type="text" class="box" name="name" id="name" required>

                <button class="mt-3 lebar-100 primer">Tambahkan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="editCategory">
    <div class="popup">
        <div class="wrap">
            <h3>Edit Kategori
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#editCategory')"></i>
            </h3>
            <form action="{{ route('admin.category.update') }}" method="POST" class="wrap super">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <div class="mt-2">Nama Kategori :</div>
                <input type="text" class="box" name="name" id="name" required>

                <button class="mt-3 lebar-100 primer">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="deleteCategory">
    <div class="popup">
        <div class="wrap">
            <h3>Hapus Kategori
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#deleteCategory')"></i>
            </h3>
            <form action="{{ route('admin.category.delete') }}" method="POST" class="wrap super">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                Yakin ingin menghapus kategori <b id="name"></b> ?

                <button class="mt-3 lebar-100 primer">Ya, hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const edit = data => {
        data = JSON.parse(data);
        munculPopup("#editCategory");
        select("#editCategory #id").value = data.id;
        select("#editCategory #name").value = data.name;
    }

    const hapus = data => {
        data = JSON.parse(data);
        munculPopup("#deleteCategory");
        select("#deleteCategory #id").value = data.id;
        select("#deleteCategory #name").innerHTML = data.name;
    }
</script>
@endsection