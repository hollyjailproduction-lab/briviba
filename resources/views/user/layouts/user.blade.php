<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BRIVIBA')</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
    <style>
        * {
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
        
        header {
            position: sticky;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background: #fff;
            border-bottom: 1px solid #eee;
            z-index: 10;
        }
        
        header a.logo {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            text-decoration: none;
        }
        
        header nav ul {
            display: flex;
            list-style: none;
            gap: 40px;
        }
        
        header nav a {
            text-decoration: none;
            color: #000;
            font-size: 14px;
            transition: color 0.3s;
        }
        
        header nav a:hover {
            color: #666;
        }
        
        header .icons {
            display: flex;
            gap: 20px;
        }
        
        header .icons a {
            color: #000;
            font-size: 20px;
            transition: color 0.3s;
        }
        
        header .icons a:hover {
            color: #666;
        }
        
        /*main content*/
        main {
            flex: 1;
            padding: 40px 50px;
        }
        
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
            margin: 0 auto;
        }
        
        .footer-section h4 {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section li {
            margin-bottom: 12px;
            color: #666;
            font-size: 14px;
        }
        
        .footer-section a {
            text-decoration: none;
            color: #666;
            font-size: 14px;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: #333;
        }
        
        .footer-section i {
            margin-right: 8px;
        }
        
        @media (max-width: 768px) {
            header {
                padding: 15px 20px;
            }
            header nav ul {
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
    </style>
</head>

<body>
    <header>
        <a href="{{ url('/') }}" class="logo">briviba</a>

        <nav>
            <ul>
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Homepage</a></li>
                <li><a href="{{ url('/best-seller') }}" class="{{ request()->is('best-seller') ? 'active' : '' }}">Best Seller</a></li>
                <li><a href="{{ url('/collection') }}" class="{{ request()->is('collection') ? 'active' : '' }}">Collection</a></li>
            </ul>
        </nav>

        <div class="icons">
            <a href="{{ url('/cart') }}"><i class='bx bx-cart'></i></a>
            <a href="#" id="search-toggle"><i class='bx bx-search'></i></a>
            @auth
                <a href="{{ url('/profile') }}"><i class='bx bx-user'></i></a>
            @else
                <a href="{{ url('/login') }}"><i class='bx bx-user'></i></a>
            @endauth
        </div>
    </header>

    <!-- page content disini-->
    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Account</h4>
                <ul>
                    @guest
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li><a href="{{ url('/profile') }}">Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
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
                    <li><a href="https://instagram.com" target="_blank" rel="noopener"><i class='bx bxl-instagram'></i> Instagram</a></li>
                    <li><a href="https://tiktok.com" target="_blank" rel="noopener"><i class='bx bxl-tiktok'></i> Tiktok</a></li>
                    <li><a href="https://youtube.com" target="_blank" rel="noopener"><i class='bx bxl-youtube'></i> Youtube</a></li>
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
</body>
</html>