<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="<?= base_url('assets/AdminLTE') ?>/f_dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><?= ucwords(session()->get('user')['name']) ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="<?= base_url('home') ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>
                        Penjualan
                    </p>
                </a>
            </li>
            <li class="nav-item  <?= $menu == 'master_data' ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= $menu == 'master_data' ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Master Data
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url('core/store') ?>" class="nav-link <?= $submenu == 'store' ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Toko</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('core/user') ?>" class="nav-link <?= $submenu == 'user' ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengguna</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('logout') ?>" class="nav-link <?= $menu == 'setting' ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Keluar
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>