<style>
    .app-header {
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 10px 20px;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0;
    }

    .brand-logo img {
        height: 35px;
    }

    .nav-link img {
        border-radius: 50%;
        border: 2px solid #eee;
        transition: 0.3s;
    }

    .nav-link img:hover {
        border-color: #6a11cb;
    }

    .dropdown-menu {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        padding: 10px;
    }

    .btn-outline-primary {
        border-radius: 8px;
    }
</style>

<header class="app-header">
    <nav class="navbar navbar-expand-lg">

        <!-- Logo -->
        <div class="brand-logo d-flex align-items-center gap-2">
            <a href="#" class="text-nowrap logo-img">
                <img src="{{ asset('backend/images/logos/logo.svg') }}" alt="Logo" />
            </a>
        </div>

        <!-- Right Menu -->
        <div class="d-flex align-items-center ms-auto">
            <ul class="navbar-nav flex-row align-items-center">

                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center" href="#" id="drop2" data-bs-toggle="dropdown">
                        <img src="{{ asset('backend/images/profile/user-1.jpg') }}" width="35" height="35">
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="btn btn-outline-primary w-100"
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>
        </div>

    </nav>
</header>