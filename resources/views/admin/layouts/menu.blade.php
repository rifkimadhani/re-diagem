<ul class="nav-main">
    <li>
        <a class="{{ Request::is('admin/beranda') ? 'active' : null }}" href="{{ route('admin.beranda') }}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Beranda</span></a>
    </li>
    <li class="{{ Request::is('admin/produk/*','admin/produk') ? 'open' : null }}">
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-social-dropbox"></i><span class="sidebar-mini-hide">Produk</span></a>
        <ul>
            <li>
                <a class="{{ Request::is('admin/produk/tambah', 'admin/produk/tambah') ? 'active' : null }}" href="{{ route('admin.produk.tambah') }}">Tambah Produk Baru</a>
            </li>
            <li>
                <a class="{{ Request::is('admin/produk', 'admin/produk/edit/*') ? 'active' : null }}" href="{{ route('admin.produk') }}">Kelola Produk</a>
            </li>
            <li>
                <a class="{{ Request::is('admin/produk/kategori') ? 'active' : null }}" href="{{ route('admin.kategori') }}">Kelola Kategori</a>
            </li>
        </ul>
    </li>
    
    <li>
        <a class="{{ Request::is('admin/order', 'admin/order/*') ? 'active' : null }}" href="{{ route('admin.order') }}?status=terbaru">
            <i class="si si-people"></i>Order</span>
        </a>
    </li>
    <li class="{{ Request::is('admin/promo/*') ? 'open' : null }}">
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-tags"></i><span class="sidebar-mini-hide">Promo</span></a>
        <ul>
            <li>
                <a class="{{ Request::is('admin/promo/tambah') ? 'active' : null }}" href="{{ route('admin.promo.tambah') }}">Tambah Promo</a>
            </li>
            <li>
                <a class="{{ Request::is('admin/promo') ? 'active' : null }}" href="{{ route('admin.promo') }}">Daftar Promo</a>
            </li>
        </ul>
    </li>
    <li>
        <a class="{{ Request::is('admin/pesanan', 'admin/pesanan/*') ? 'active' : null }}" href="{{ route('admin.order') }}?status=terbaru">
            <i class="si si-people"></i>User</span>
        </a>
    </li>
    <li class="{{ Request::is('admin/keuangan/*','admin/keuangan') ? 'open' : null }}">
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-wallet"></i>Keuangan</span></a>
        <ul>
            <li>
                <a class="{{ Request::is('admin/keuangan/rekening-bank') ? 'active' : null }}" href="{{ route('admin.rekening') }}">Rekening Bank</a>
            </li>
        </ul>
    </li>
    <li class="{{ Request::is('admin/penjualan/*','admin/penjualan') ? 'open' : null }}">
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-social-dropbox"></i><span class="sidebar-mini-hide">Promo</span></a>
        <ul>
            <li>
                <a class="{{ Request::is('admin/produk') ? 'active' : null }}" href="{{ route('admin.produk') }}">Tambah Promo Baru</a>
            </li>
            <li>
                <a class="{{ Request::is('admin/produk/kategori') ? 'active' : null }}" href="{{ route('admin.kategori') }}">Daftar Promo</a>
            </li>
        </ul>
    </li>
</ul>
