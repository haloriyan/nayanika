<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fa/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('fonts/custicon/css/nayanika.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page.css') }}">
    @yield('head.dependencies')
</head>
<body>

<header class="header">
    <div class="logo">
        <a href="{{ route('user.index') }}">
            <img src="{{ asset('images/logo.png') }}">
        </a>
    </div>
    <nav>
        <a href="{{ route('user.contact') }}">
            <button class="item">
                Get in Touch
            </button>
        </a>
        <div class="item" id="menuBtn" onclick="toggleMenu(this)">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
</header>

<div class="content">
    @yield('content')
    @include('./partials/Menu')
</div>

<div id="colorModeButton" class="dark" onclick="toggleColorMode()">
    <i class="fas fa-moon"></i>
</div>

<script src="{{ asset('js/base.js') }}"></script>
<script>
    let header = select("header.header");
    let mainMenu = select("nav.main-menu");
    let state = {
        lightMode: localStorage.getItem('lightMode'),
        isMenuShowed: false
    }
    if (state.lightMode == null || state.lightMode == "false") {
        state.lightMode = false;
    } else if (state.lightMode == "true") {
        state.lightMode = true;
    }

    const squarize = () => {
        let doms = selectAll(".squarize");
        doms.forEach(dom => {
            let classes = dom.classList;
            let computedStyle = getComputedStyle(dom);
            if (classes.contains('rectangle')) {
                let width = computedStyle.width.split("px")[0];
                let widthRatio = parseFloat(width) / 16;
                let setHeight = 9 * widthRatio;
                dom.style.height = `${setHeight}px`;
            } else {
                if (classes.contains('use-lineHeight')) {
                    dom.style.lineHeight = computedStyle.width;
                } else {
                    dom.style.height = computedStyle.width;
                }
            }
        });
    }
    squarize();

    window.addEventListener('scroll', e => {
        let pos = this.scrollY;
        if (pos > 50) {
            header.classList.add("stick");
            mainMenu.classList.add("stick");
        } else {
            header.classList.remove("stick");
            mainMenu.classList.remove("stick");
        }
    });

    const toggleMenu = btn => {
        if (state.isMenuShowed) {
            mainMenu.style.display = "none";
            btn.innerHTML = "<i class='fas fa-bars'></i>";
        } else {
            mainMenu.style.display = "block";
            btn.innerHTML = "<i class='fas fa-times'></i>";
        }
        state.isMenuShowed = !state.isMenuShowed;
    }

    const toggleLightMode = (isInit = null) => {
        let colorButton = select("#colorModeButton");
        if (isInit != 1) {
            state.lightMode = !state.lightMode;
            console.log(`State setted to ${state.lightMode}`);
        }
        if (state.lightMode) {
            // to night
            select("header .logo img").setAttribute('src', "{{ asset('images/logo.png') }}");
            select(".footer .logo img").setAttribute('src', "{{ asset('images/logo.png') }}");
            select("body").style.backgroundColor = "#000";
            header.style.backgroundColor = "#000";
            mainMenu.style.backgroundColor = "#000";
            selectAll("p,div,a,h2,h3,h4,li,section,span").forEach(p => {
                p.style.color = "#fff";
                p.style.borderColor = "#fff";
                p.style.backgroundColor = "#000";
            });
            selectAll("button").forEach(btn => {
                btn.style.backgroundColor = "#000";
                btn.style.color = "#fff";
                btn.style.borderColor = "#fff";
            });
            selectAll(".custicon").forEach(custicon => {
                let icon = custicon.getAttribute('icon');
                custicon.setAttribute('bg-image', '{{ asset("images/external-link-white.png") }}');
            });
            selectAll("input").forEach(input => input.classList.remove('custom-lightMode'));
            colorButton.classList.add('dark')
            colorButton.innerHTML = "<i class='fas fa-moon'></i>";
        } else {
            // to light
            select("header .logo img").setAttribute('src', "{{ asset('images/logo-black.png') }}");
            select(".footer .logo img").setAttribute('src', "{{ asset('images/logo-black.png') }}");
            select("body").style.backgroundColor = "#fff";
            header.style.backgroundColor = "#fff";
            mainMenu.style.backgroundColor = "#fff";
            selectAll("p,div,a,h2,h3,h4,li,section,span").forEach(p => {
                p.style.color = "#000";
                p.style.borderColor = "#000";
                p.style.backgroundColor = "#fff";
            });
            selectAll("button,hr").forEach(btn => {
                btn.style.backgroundColor = "#fff";
                btn.style.color = "#000";
                btn.style.borderColor = "#000";
            });
            selectAll(".custicon").forEach(custicon => {
                let icon = custicon.getAttribute('icon');
                custicon.setAttribute('bg-image', '{{ asset("images/external-link-black.png") }}');
            });
            selectAll("input").forEach(input => input.classList.add('custom-lightMode'));
            colorButton.classList.remove('dark')
            colorButton.innerHTML = "<i class='fas fa-sun'></i>";
        }
        bindDivWithImage();
    }

    toggleLightMode(1);

    const toggleColorMode = () => {
        toggleLightMode();
        localStorage.setItem('lightMode', state.lightMode);
    }

    const custicon = () => {
        selectAll(".custicon").forEach(dom => {
            let icon = dom.getAttribute('icon');
            let size = dom.getAttribute('size');
            dom.style.display = "inline-block";
            dom.style.height = `${size}px`;
            dom.style.width = `${size}px`;
            dom.setAttribute('bg-image', `{{ asset('images/${icon}.png') }}`)
        });
        bindDivWithImage();
    }
</script>
@yield('javascript')

</body>
</html>