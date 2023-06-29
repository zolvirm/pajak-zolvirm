<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/dash">ZOLVIRM APP</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    {{-- <div class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Selamat datang, {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" style="position: absolute" aria-labelledby="navbarDropdown">
                <li>
                    <a class="dropdown-item" href="/dash">
                        <i class="bi bi-layout-text-sidebar-reverse"></i>DASHBOARD
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    </div> --}}
</header>
