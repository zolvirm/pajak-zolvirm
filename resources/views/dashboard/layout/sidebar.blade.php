    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dash') ? 'active' : ' ' }}" aria-current="page" href="/dash">
                        <span data-feather="home" class="align-text-bottom"></span>
                        DASHBOARD
                    </a>
                </li>
            </ul>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dash/pemby*') ? 'active' : ' ' }}" aria-current="page"
                        href="/dash/pemby">
                        <span data-feather="dollar-sign" class="align-text-bottom"></span>
                        PEMBAYARAN
                    </a>
                </li>
            </ul>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dash/pajaks*') ? 'active' : ' ' }}" aria-current="page"
                        href="/dash/pajaks">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        PAJAK
                    </a>
                </li>
            </ul>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dash/pemiliks*') ? 'active' : ' ' }}" aria-current="page"
                        href="/dash/pemiliks">
                        <span data-feather="users" class="align-text-bottom"></span>
                        PEMILIK PAJAK
                    </a>
                </li>
            </ul>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <form action="/logout" method="post" class="nav-link" aria-current="page">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <span data-feather="log-out" class="align-text-bottom"></span>
                            <strong class="text-danger">Logout</strong></button>
                    </form>
                    {{-- <a class="nav-link {{ Request::is('dash/pemiliks*') ? 'active' : ' ' }}" aria-current="page"
                        href="/dash/pemiliks">
                        <span data-feather="users" class="align-text-bottom"></span>
                        PEMILIK PAJAK
                    </a> --}}
                </li>
            </ul>


            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                <span>DATA TERHAPUS</span>
            </h6>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dash/trash-pajak*') ? 'active' : ' ' }}" aria-current="page"
                        href="/dash/trash-pajak">
                        <span data-feather="trash" class="align-text-bottom"></span>
                        PAJAK
                    </a>
                </li>
            </ul>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dash/trash-pemilik*') ? 'active' : ' ' }}" aria-current="page"
                        href="/dash/trash-pemilik">
                        <span data-feather="trash" class="align-text-bottom"></span>
                        PEMILIK
                    </a>
                </li>
            </ul>




            {{--  <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Current month
            </a>
          </li>
        </ul> --}}
        </div>
    </nav>
