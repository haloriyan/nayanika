@extends('layouts.admin')

@section('title', "Portfolio")

@section('header.action')
<button class="primer rounded-none" onclick="munculPopup('#addPortfolio')">
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

        @if ($portfolios->count() == 0)
            <h3 class="rata-tengah">Tidak ada data</h3>
        @else
            @foreach ($portfolios as $item)
                <div class="bordered mb-3">
                    <div 
                        class="bagi lebar-30 tinggi-210 corner-top-left corner-bottom-left" 
                        bg-image="{{ asset('storage/portfolio_images/'.$item->featured_image) }}"
                    ></div>
                    <div class="bagi lebar-70">
                        <div class="wrap">
                            <h3 class="m-0 mb-1">{{ $item->title }}</h3>
                            <div class="mb-2">{{ $item->description }}</div>
                            <a href="{{ route('admin.portfolio.images', $item->id) }}" class="bg-primer-transparan p-1 pl-2 pr-2 rounded mr-1">
                                <i class="fas fa-images"></i>
                            </a>
                            <span class="bg-hijau-transparan pointer p-1 pl-2 pr-2 rounded mr-1" onclick="edit('{{ $item }}')">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="bg-merah-transparan pointer p-1 pl-2 pr-2 rounded" onclick="hapus('{{ $item }}')">
                                <i class="fas fa-trash"></i>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="rata-tengah">
                {{ $portfolios->links() }}
            </div>
        @endif
    </div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="addPortfolio">
    <div class="popup">
        <div class="wrap">
            <h3>Tambah Portfolio Baru
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#addPortfolio')"></i>
            </h3>
            <form action="{{ route('admin.portfolio.store') }}" method="POST" class="wrap super" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mt-2">Kategori :</div>
                <input type="hidden" name="categories" id="categories" required>
                @foreach ($categories as $category)
                    <div class="category-item" onclick="chooseCategory(this, '#addPortfolio')">{{ $category->name }}</div>
                @endforeach

                <div class="mt-2">Judul :</div>
                <input type="text" class="box" name="title" id="title" required>
                <div class="mt-2">Deskripsi :</div>
                <textarea name="description" id="description" class="box" required></textarea>
                <div class="mt-2">Task (Problem & Solve) :</div>
                <textarea name="task" id="task" class="box" required></textarea>
                <div class="mt-2">Featured Image :</div>
                <input type="file" class="box withPreview mt-2" onchange="inputFile(this, '#addPortfolio .uploadArea')" name="featured_image" required>
                <div class="uploadArea">
                    <i class="fas fa-upload"></i> 
                    <div class="mt-1">Drop File Here</div>
                </div>

                <button class="lebar-100 mt-3 primer">Tambahkan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="editPortfolio">
    <div class="popup">
        <div class="wrap">
            <h3>Ubah Data Portfolio
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#editPortfolio')"></i>
            </h3>
            <form action="{{ route('admin.portfolio.update') }}" method="POST" class="wrap super" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <div class="mt-2">Kategori :</div>
                <input type="hidden" name="categories" id="categories" required>
                @foreach ($categories as $category)
                    <div class="category-item" onclick="chooseCategory(this, '#editPortfolio')">{{ $category->name }}</div>
                @endforeach

                <div class="mt-2">Judul :</div>
                <input type="text" class="box" name="title" id="title" required>
                <div class="mt-2">Deskripsi :</div>
                <textarea name="description" id="description" class="box" required></textarea>
                <div class="mt-2">Task (Problem & Solve) :</div>
                <textarea name="task" id="task" class="box" required></textarea>
                <div class="mt-2">Featured Image :</div>
                <input type="file" class="box withPreview mt-2" onchange="inputFile(this, '#addPortfolio .uploadArea')" name="featured_image">
                <div class="uploadArea">
                    <i class="fas fa-upload"></i> 
                    <div class="mt-1">Drop File Here</div>
                </div>
                <div class="mt-1 teks-transparan">Klik area untuk mengganti gambar</div>

                <button class="lebar-100 mt-3 primer">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="deletePortfolio">
    <div class="popup">
        <div class="wrap">
            <h3>Hapus Item Portfolio
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#deletePortfolio')"></i>
            </h3>
            <form action="{{ route('admin.portfolio.delete') }}" method="POST" class="wrap super">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                Yakin ingin menghapus portfolio <b id="title"></b> ?

                <button class="lebar-100 mt-3 primer">Ya, hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    let selectedCategories = [];

    const chooseCategory = (btn, prefix) => {
        let category = btn.innerText;
        if (inArray(category, selectedCategories)) {
            btn.classList.remove('active');
            removeArray(category, selectedCategories);
        } else {
            btn.classList.add('active');
            selectedCategories.push(category);
        }
        select(`${prefix} #categories`).value = selectedCategories.join(",");
    }

    const edit = data => {
        data = JSON.parse(data);
        let uploadArea = select("#editPortfolio .uploadArea");
        let categories = data.categories.split(",");
        selectedCategories = categories;

        munculPopup("#editPortfolio");
        select("#editPortfolio #id").value = data.id;
        select("#editPortfolio #title").value = data.title;
        select("#editPortfolio #categories").value = data.categories;
        select("#editPortfolio #description").value = data.description;
        select("#editPortfolio #task").value = data.task;
        uploadArea.innerText = "";
        uploadArea.setAttribute('bg-image', `{{ asset('storage/portfolio_images') }}/${data.featured_image}`);

        selectAll("#editPortfolio .category-item").forEach(item => {
            if (inArray(item.innerText, selectedCategories)) {
                item.classList.add('active');
            }
        });

        bindDivWithImage();
    }

    const hapus = data => {
        data = JSON.parse(data);
        munculPopup("#deletePortfolio");
        select("#deletePortfolio #id").value = data.id;
        select("#deletePortfolio #title").innerText = data.title;
    }
</script>
@endsection