<!-- INI Pengaturan Menu -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('template/dist/img/logounsri.png') }}" alt="unsri Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">MENU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item {{Request::is('transformasi','/','normalisasi')?'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link {{Request::is('transformasi','/','normalisasi')?'active':''}}">
                      <i class="nav-icon fas fa-chart-pie"></i>
                      <p>
                        Kelola Data
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="/" class="nav-link {{Request::is('/')?'active':''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Gejala Awal</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/transformasi" class="nav-link {{Request::is('transformasi')?'active':''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Transformasi</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/normalisasi" class="nav-link {{Request::is('normalisasi')?'active':''}}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Normalisasi</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                <li class="nav-item">
                    <a href="/bobotawal" class="nav-link {{Request::is('bobotawal')?'active':''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Bobot Awal
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pelatihan" class="nav-link {{Request::is('pelatihan')?'active':''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Pelatihan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengujian" class="nav-link {{Request::is('pengujian')?'active':''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Pengujian
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
