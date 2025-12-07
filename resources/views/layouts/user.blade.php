<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BRIVIBA')</title>

    {{-- CSS utama --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Boxicons Offline (HARUS pakai file lokal biar cepat) --}}
    <link rel="stylesheet" href="{{ asset('css/boxicons.min.css') }}">

    @stack('styles')

    <style>
        /* RESET */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        header {
            position: sticky;
            top: 0;
            display: grid;
            grid-template-columns: 1fr auto 1fr; /* kiri - tengah - kanan */
            align-items: center;
            padding: 20px 50px;
            background: #fff;
            border-bottom: 1px solid #eee;
            z-index: 10;
        }

        /* LOGO + MENU DI TENGAH */
        .header-left {
            grid-column: 2;
            display: flex;
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }

        .header-left nav ul {
            display: flex;
            justify-content: center;
            gap: 35px;
        }

        /* ICONS DI KANAN */
        .icons {
            grid-column: 3;
            display: flex;
            justify-content: flex-end;
            gap: 20px;
        }


        header .logo {
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            color: #000;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 40px;
        }

        nav a {
            color: #000;
            font-size: 14px;
            text-decoration: none;
            transition: .2s;
        }

        nav a:hover,
        nav a.active {
            color: #666;
        }

        /* ICONS */
        .icons {
            display: flex;
            gap: 20px;
        }

        .icons i {
            font-size: 20px;
            color: #000;
            transition: .2s;
        }

        .icons i:hover {
            color: #666;
        }

        /* MAIN */
        main {
            flex: 1;
            padding: 40px 50px;
        }

        /* FOOTER */
        footer {
            background: #f9f9f9;
            padding: 60px 50px;
            border-top: 1px solid #eee;
            margin-top: auto;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 60px;
            max-width: 1200px;
            margin: auto;
        }

        .footer-section h4 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li,
        .footer-section a {
            font-size: 14px;
            color: #666;
            text-decoration: none;
            margin-bottom: 10px;
            display: block;
        }

        .footer-section a:hover {
            color: #333;
        }

        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
            }
            nav ul {
                gap: 20px;
            }
            main {
                padding: 20px;
            }
            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            footer {
                padding: 40px 20px;
            }
        }

        .homepage-banner {
            margin-left: calc(-50px);
            margin-right: calc(-50px);
            width: calc(100% + 100px);
        }

    </style>
</head>

<body>

    {{-- HEADER --}}
    <header>

        <div class="header-left">
            <a href="{{ url('/') }}" class="logo">briviba</a>

            <nav>
                <ul>
                    <li><a href="{{ route('user.homepage') }}"
                        class="{{ request()->is('user/homepage') ? 'active' : '' }}">
                        Homepage</a>
                    </li>
                    <li><a href="{{ url('/user/best-seller') }}">Best Seller</a></li>
                    <li><a href="{{ url('/user/collection') }}">Collection</a></li>
                </ul>
            </nav>
        </div>

        <div class="icons">
            {{-- cart, search, profile --}}
            <a href="{{ route('user.cartpage') }}"><i class='bx bx-cart'></i></a>
            <a href="#" id="openSearch"><i class='bx bx-search'></i></a>

            @auth
                @php $initial = strtoupper(auth()->user()->name[0]); @endphp
                <a href="{{ route('user.profilepage') }}" 
                    style="width:28px;height:28px;border-radius:50%;background:#e5e5e5;display:flex;justify-content:center;align-items:center;font-weight:bold;color:#333;">
                    {{ $initial }}
                </a>
            @else
                <a href="{{ route('user-login') }}"><i class='bx bx-user'></i></a>
            @endauth
        </div>

    </header>

    {{-- SEARCH BAR SLIDE DOWN --}}
    <div id="searchBar" style="
        width: 100%;
        background: white;
        border-bottom: 1px solid #ddd;
        padding: 15px 50px;
        display: none; 
        align-items: center;
        gap: 10px;
        position: sticky;
        top: 70px;
        z-index: 50;
    ">
        <form id="searchForm" action="{{ route('user.search') }}" method="GET" 
            style="flex:1; display:flex; align-items:center; gap:10px;">

            <i class='bx bx-search' style="font-size:20px; color:#333;"></i>

            <input id="searchInput" 
                type="text" 
                name="q"
                placeholder="Search for..."
                style="flex:1; padding:10px; border:none; font-size:16px; outline:none;">

        </form>

        <i id="searchClose" class='bx bx-x' style="font-size:24px; cursor:pointer;"></i>
    </div>



    {{-- BREADCRUMB (optional per page) --}}
    @yield('breadcrumb')

    {{-- PAGE CONTENT --}}
    <main>
        @yield('content')
    </main>


    {{-- FOOTER --}}
    <footer>
        <div class="footer-content">

            <div class="footer-section">
                <h4>Account</h4>
                <ul>
                    @guest
                        <li><a href="{{ url('/user-login') }}">Login</a></li>
                        <li><a href="{{ url('/user-register') }}">Register</a></li>
                    @else
                        <li><a href="{{ route('user.profilepage') }}">Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>

            <div class="footer-section">
                <h4>Our Social Media</h4>
                <ul>
                    <li><a href="https://instagram.com"><i class='bx bxl-instagram'></i> Instagram</a></li>
                    <li><a href="https://tiktok.com"><i class='bx bxl-tiktok'></i> Tiktok</a></li>
                    <li><a href="https://youtube.com"><i class='bx bxl-youtube'></i> Youtube</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Contact Us</h4>
                <ul>
                    <li>+62 1234567890</li>
                    <li>email@gmail.com</li>
                </ul>
            </div>

        </div>
    </footer>

    @stack('scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const openSearch = document.getElementById("openSearch");
        const searchBar   = document.getElementById("searchBar");
        const searchClose = document.getElementById("searchClose");
        const searchInput = document.getElementById("searchInput");

        // Tampilkan search bar
        openSearch.addEventListener("click", (e) => {
            e.preventDefault();
            searchBar.style.display = "flex";
            searchInput.focus();
        });

        // Tutup search bar
        searchClose.addEventListener("click", () => {
            searchBar.style.display = "none";
            searchInput.value = "";
        });

        // Tekan Enter untuk search
        searchInput.addEventListener("keydown", function(e) {
            if (e.key === "Enter") {
                document.getElementById("searchForm").submit();
            }
        });
    });
    </script>

    

</body>
</html>
