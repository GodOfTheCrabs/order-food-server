<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/js/app.js', 'resources/css/main.css', 'resources/css/form.css', 'resources/css/show.css', 'resources/js/echo.js'])
</head>
<body>  
    <div class="title">
        @auth
            Admin Menu Current user: {{ Auth::user()->email }}
        @endauth
        @guest
            Admin Menu
        @endguest
    </div>
    <div class="container-main">
        <nav class="menu item-left">
            <div class="menu-item" id="hide-menu"><i class='fas fa-arrow-left icon toggle-icon'></i> Hide menu</div>
            @guest
                <a class="menu-item"  id="login-menu" href={{route('login')}}> <i class="fas fa-sign-in icon"></i> Login</a>
                <a class="menu-item"  id="login-menu" href={{route('register')}}> <i class="fas fa-sign-in icon"></i> Register</a>
            @endguest
            @auth
            <a class="menu-item" id="foods-menu" href={{route('foods.index')}}> <i class='fas fa-hamburger icon'></i> Foods</a>
            <a class="menu-item"  id="users-menu" href={{route('users.index')}}> <i class='fas fa-user-alt icon'></i> Users</a>
            <a class="menu-item"  id="orders-menu" href={{route('orders.index')}}>  <i class='fas fa-shopping-cart icon'></i> Orders</a>
            <a class="menu-item"  id="roles-menu" href={{route('roles.index')}} > <i class='fas fa-address-card icon'></i> Roles</a>
            <a class="menu-item"  id="categories-menu" href={{route('categories.index')}} > <i class="fas fa-newspaper icon"></i> Categories</a>
            <a class="menu-item"  id="report-menu" href={{route('reports.create')}} > <i class="fas fa-newspaper icon"></i> Create Report</a>
            <a class="menu-item" id="logout-menu" href="{{ route('logout') }}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-in icon"></i> 
                Logout
            </a>
        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth
        </nav>
        <section class="item-center">
            @yield('content')
        </section>
    </div>
</body>
</html>