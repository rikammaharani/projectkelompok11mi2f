<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ url('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LMS Polinema</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('assets/dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">NAVIGATION</li>
                @can('administrator')
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kelas') }}" class="nav-link {{ Route::is('kelas') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Data Kelas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('matkul') }}" class="nav-link {{ Route::is('matkul') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Data Mata Kuliah
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dosen') }}" class="nav-link {{ Route::is('dosen') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Data Dosen
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mahasiswa') }}" class="nav-link {{ Route::is('mahasiswa') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Data Mahasiswa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user') }}" class="nav-link {{ Route::is('user') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Sistem User
                            </p>
                        </a>
                    </li>
                @endcan
                @can('dosen')
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('biodataDosen', $id) }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Data Diri Dosen
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penilaian') }}" class="nav-link">
                            <i class="nav-icon fas fa-star"></i>
                            <p>
                                Penilaian
                            </p>
                        </a>
                    </li>
                @endcan
                @can('mahasiswa')
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('biodataMahasiswa', $id) }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Data Diri Mahasiswa
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('nilaiMahasiswa') }}" class="nav-link">
                            <i class="nav-icon fas fa-star"></i>
                            <p>
                                Nilai
                            </p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
