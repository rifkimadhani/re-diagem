
<aside class="card d-none d-lg-block">
    <div class="card-body shadow">
        <ul id="sidebarNav" class="user-menu">
            <li>
                <a href="{{ route('user.profil') }}" class="{{ Request::is('user/profil') ? 'active' : null }}">
                    Profil
                </a>
            </li>
            <li>
                <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav1Collapse" data-target="#sidebarNav1Collapse">
                    Pesanan
                </a>
                <div id="sidebarNav1Collapse" class="collapse {{ Request::is('user/pembayaran', 'user/ordering') ? 'show' : null }}" data-parent="#sidebarNav">
                    <ul id="sidebarNav1" class="user-menu dropdown-list">
                        <!-- Menu List -->
                        <li><a class="{{ Request::is('user/pembayaran') ? 'active' : null }}" href="{{ route('user.belum_bayar') }}">Menunggu Pembayaran</a></li>
                        <li><a class="{{ Request::is('user/ordering') ? 'active' : null }}" href="{{ route('user.pesanan') }}">Daftar Transaksi</a></li>
                        <!-- End Menu List -->
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ route('user.alamat') }}" class="{{ Request::is('user/alamat') ? 'active' : null }}">
                    Buku Alamat
                </a>
            </li>
            <li>
                <a href="" class="{{ Request::is('user/kupon-saya') ? 'active' : null }}">
                    Keluar
                </a>
            </li>
        </ul>
        {{-- <ul class="user-menu">
            <li class="user-menu_item">
                <a href="{{ route('user.profil') }}" class="{{ Request::is('user/profil') ? 'active' : null }}">
                    <i class="mr-2 fas fa-angle-right"></i> Profil
                </a>
            </li>
            <li class="user-menu_item">
                <a href="#" class="user-menu_submenu {{ Request::is('user/ordering') ? 'active' : null }}" data-toggle="dropdown">
                    <i class="mr-2 fas fa-angle-right"></i> Pesanan
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="" href="">Tambah Produk</a>
                    </li>
                    <li>
                        <a class="" href="">Katalog Produk</a>
                    </li>
                </ul>
            </li>
            <li class="user-menu_item">
                <a href="" class="{{ Request::is('user/wishlist') ? 'active' : null }}">
                    <i class="mr-2 fas fa-angle-right"></i> Wishlist
                </a>
            </li>
            <li class="user-menu_item">
                <a href="" class="{{ Request::is('user/ulasan') ? 'active' : null }}">
                    <i class="mr-2 fas fa-angle-right"></i> Ulasan
                </a>
            </li>
            <li class="user-menu_item">
                <a href="" class="{{ Request::is('user/chat') ? 'active' : null }}">
                    <i class="mr-2 fas fa-angle-right"></i> Chat
                </a>
            </li>
            <li class="user-menu_item">
                <a href="" class="{{ Request::is('user/alamat-saya') ? 'active' : null }}">
                    <i class="mr-2 fas fa-angle-right"></i> Buku Alamat
                </a>
            </li>
            <li class="user-menu_item">
                <a href="" class="{{ Request::is('user/kupon-saya') ? 'active' : null }}">
                    <i class="mr-2 fas fa-angle-right"></i> Kupon Saya
                </a>
            </li>
        </ul> --}}
    </div>
</aside>
