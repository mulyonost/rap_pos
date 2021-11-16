  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Rajawali Aluminium</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>          
        </div>
        <div>
          <a href="#" onclick="document.getElementById('logout-form').submit()" class="btn btn-block btn-primary btn-sm">Logout</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fa fa-tachometer"></i>
            <p>
            Dashboard
            </p>
        </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus-circle"></i>
              <p>
                Input Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('master_aluminiumbase.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aluminium Base</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('master_aluminium.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aluminium</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('master_items.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bahan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('master_avalan.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Avalan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('master_customers.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('master_suppliers.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('master_avalansupplier.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Harga Avalan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-paste"></i>
              <p>
                Input Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Peleburan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Billet</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('laporan_produksi.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Produksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('laporan_anodizing.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Anodizing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('laporan_packing.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Packing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('laporan_pengambilan.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Pengambilan Bahan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Pembelian
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input PO Pembelian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pembelian_bahan.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input Pembelian Bahan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pembelian_avalan.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input Pembelian Avalan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-arrow-down"></i>
              <p>
                Penjualan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PO Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('penjualan_aluminium.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nota Penjualan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Kas Kecil
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('kas.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input Kas Kecil</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('reports_produksi.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Produksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('reports_anodizing.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Anodizing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('reports_packing.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Packing</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <form action="{{ route('logout') }}" method="post" id="logout-form" style="display:none;">
  @csrf
  </form>