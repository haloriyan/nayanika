@extends('layouts.admin')

@section('header.beforeTitle')
    <i class="pointer fas fa-angle-left mr-1" onclick="window.history.back(-1)"></i>
@endsection

@section('title', "Gambar untuk ".$portfolio->title)

@section('header.action')
<button class="primer rounded-none" onclick="triggerUpload()">
    <i class="fas fa-upload mr-1"></i> Upload
</button>
@endsection

@section('content')
<input type="file" name="image" class="d-none" id="inputImage" onchange="doUpload(this)">
<div class="bg-putih rounded bayangan-5 smallPadding">
    <div class="wrap">
        <input type="hidden" id="portfolioID" value="{{ $portfolio->id }}">
        <div id="renderArea"></div>
    </div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="seeImage">
    <div class="popup" style="width: 70%">
        <div class="wrap">
            <img class="lebar-100">

            <button class="lebar-100 mt-3 merah" onclick="deleteImage()">
                <i class="fas fa-trash mr-1"></i> Hapus
            </button>
            <button class="lebar-100 mt-2 teks-primer" onclick="hilangPopup('#seeImage')">Tutup</button>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/masonry.js') }}"></script>
<script>
    let portfolioID = select("#portfolioID").value;
    let imageID = null;

    const loadImages = () => {
        let req = post("{{ route('api.portfolio.images') }}", {
            portfolioID: portfolioID
        })
        .then(res => {
            console.log(res);
            if (res.length == 0) {
                select("#renderArea").innerHTML = "<h3 class='rata-tengah'>Tidak ada data</h3>";
            } else {
                select("#renderArea").innerHTML = "";
                res.forEach(item => {
                    createElement({
                        el: 'div',
                        attributes: [['class', 'masonry-item']],
                        html: `<div class="wrap"><img onclick="seeImage(this, ${item.id})" src="{{ asset('storage/portfolio_images') }}/${item.filename}" class="lebar-100 pointer"></div>`,
                        createTo: '#renderArea'
                    });
                });

                new Masonry({
                    items: '.masonry-item',
                    container: '#renderArea',
                    dividedBy: 4
                })
            }
        })
    }

    loadImages();

    const triggerUpload = () => {
        select("#inputImage").click();
    }
    const doUpload = input => {
        let formData = new FormData();
        formData.append('portfolio_id', portfolioID);
        formData.append('image', input.files[0]);

        let req = fetch("{{ route('api.portfolio.images.upload') }}", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            console.log(res);
            loadImages();
        });
    }

    const seeImage = (img, itemID) => {
        let src = img.getAttribute('src');
        imageID = itemID;
        munculPopup("#seeImage");
        select("#seeImage img").setAttribute('src', src);
    }

    const deleteImage = () => {
        let req = post("{{ route('api.portfolio.images.delete') }}", {
            id: imageID
        })
        .then(res => {
            hilangPopup("#seeImage");
            loadImages();
        });
    }
</script>
@endsection