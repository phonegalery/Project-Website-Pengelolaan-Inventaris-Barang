<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px; /* Sesuaikan dengan lebar sidebar Anda */
        overflow-y: auto;
        z-index: 1000; /* Pastikan sidebar berada di atas elemen lain */
    }

    .content-wrapper {
        margin-left: 180px; /* Sesuaikan dengan lebar sidebar */
        padding: 20px; /* Opsional: Tambahkan padding untuk konten */
    }

    /* Tambahan untuk memastikan tombol toggle bekerja dengan baik */
    .sidebar.collapsed {
        width: 0;
        transition: width 0.3s;
    }

    .content-wrapper.collapsed {
        margin-left: 0;
        transition: margin-left 0.3s;
    }
</style>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laptop"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Inventaris Barang</div>
    </a>
    <hr class="sidebar-divider my-0">

    <!-- Menu untuk Admin -->
    <?php if ($this->session->login['role'] == 'admin'): ?>
        <li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('dashboard') ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Informasi Akun
        </div>

        <li class="nav-item <?= $aktif == 'barang' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('barang') ?>">
                <i class="fas fa-fw fa-box"></i>
                <span>Barang</span>
            </a>
        </li>
        
        <li class="nav-item <?= $aktif == 'pemeliharaan' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('pemeliharaan') ?>">
                <i class="fas fa-fw fa-tools"></i>
                <span>Pemeliharaan</span>
            </a>
        </li>
        <li class="nav-item <?= $aktif == 'kategori' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('kategori') ?>">
                <i class="fas fa-fw fa-box"></i>
                <span>Kategori</span>
            </a>
        </li>

        <li class="nav-item <?= $aktif == 'penerimaan' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('penerimaan') ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Penerimaan Data Barang</span>
            </a>
        </li>
        <li class="nav-item <?= $aktif == 'admin' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin') ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Manajemen Admin</span>
            </a>
        </li>

        <li class="nav-item <?= $aktif == 'petugas' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('petugas') ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Petugas</span>
            </a>
        </li>

        
        <li class="nav-item <?= $aktif == 'pengelola' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('pengelola') ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Pengelola</span>
            </a>
        </li>
    <?php endif; ?>

    <!-- Menu untuk pengelola -->
    <?php if ($this->session->login['role'] == 'pengelola'): ?>
        <div class="sidebar-heading">
            Master
        </div>

        <li class="nav-item <?= $aktif == 'barang' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('barang') ?>">
                <i class="fas fa-fw fa-box"></i>
                <span>Barang</span>
            </a>
        </li>

        <li class="nav-item <?= $aktif == 'kategori' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('kategori') ?>">
                <i class="fas fa-fw fa-box"></i>
                <span>Kategori</span>
            </a>
        </li>

        <li class="nav-item <?= $aktif == 'penerimaan' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('penerimaan') ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Penerimaan Data Barang</span>
            </a>
        </li>


    <?php endif; ?>

    <!-- Menu untuk Petugas -->
    <?php if ($this->session->login['role'] == 'petugas'): ?>
        <div class="sidebar-heading">
            Data Pemeliharaan
        </div>

        <li class="nav-item <?= $aktif == 'pemeliharaan' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('pemeliharaan') ?>">
                <i class="fas fa-fw fa-tools"></i>
                <span>Pemeliharaan</span>
            </a>
        </li>
    <?php endif; ?>

    <!-- Logout -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>


<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Konten halaman utama -->
</div>

