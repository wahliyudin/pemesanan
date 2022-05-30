<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('profile.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.transaksi.index') || request()->routeIs('admin.transaksi.data.skip') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link  {{ request()->routeIs('admin.transaksi.index') || request()->routeIs('admin.transaksi.data.skip') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.transaksi.index') }}"
                                class="nav-link {{ request()->routeIs('admin.transaksi.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pembayaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.transaksi.data.skip') }}"
                                class="nav-link {{ request()->routeIs('admin.transaksi.data.skip') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pesanan dilewat</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan') }}"
                        class="nav-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.categories.index') || request()->routeIs('admin.accounts.index') || request()->routeIs('admin.products.index') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link  {{ request()->routeIs('admin.categories.index') || request()->routeIs('admin.accounts.index') || request()->routeIs('admin.products.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}"
                                class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.accounts.index') }}"
                                class="nav-link {{ request()->routeIs('admin.accounts.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Akun Rekening</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}"
                                class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
