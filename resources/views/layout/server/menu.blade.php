<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name; }}</a> <a href="./logout" class="text-danger"> (Sign out)</a>

        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('cauhinh.panel')}}" class="nav-link">
              <i class="nav-icon fa fa-chevron-right"></i>
              <p>
                Cấu hình
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('quanlytaikhoan.panel')}}" class="nav-link">
              <i class="nav-icon fa fa-chevron-right"></i>
              <p>
                Quản lý tài khoản
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('menu.panel')}}" class="nav-link">
              <i class="nav-icon fa fa-chevron-right"></i>
              <p>
               Quản lý Menu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-chevron-right"></i>
              <p>
                Quản lý xe
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('quanlydongxe.panel')}}" class="nav-link">
                  <i class="fa fa-caret-right nav-icon"></i>
                  <p>Dòng xe</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('tinxe.panel')}}" class="nav-link">
                  <i class="fa fa-caret-right nav-icon"></i>
                  <p>Tin xe</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('xe.panel')}}" class="nav-link">
                  <i class="fa fa-caret-right nav-icon"></i>
                  <p>Xe</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('vitrixe.panel')}}" class="nav-link">
                  <i class="fa fa-caret-right nav-icon"></i>
                  <p>Vị trí xe</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('tintuc.panel')}}" class="nav-link">
              <i class="nav-icon fa fa-chevron-right"></i>
              <p>
                Quản lý tin tức
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('slider.panel')}}" class="nav-link">
              <i class="nav-icon fa fa-chevron-right"></i>
              <p>
                Quản lý slider
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('thuthap.panel')}}" class="nav-link">
              <i class="nav-icon fa fa-chevron-right"></i>
              <p>
                Data khách hàng
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('luutru.panel')}}" class="nav-link">
              <i class="nav-icon fa fa-chevron-right"></i>
              <p>
                Quản lý lưu trữ
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{route('tuyendung.panel')}}" class="nav-link">
              <i class="nav-icon fa fa-chevron-right"></i>
              <p>
                Tuyển dụng
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple link
                <span class="right badge badge-danger badge-xs">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                More links
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Module 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Module 2</p>
                </a>
              </li>
            </ul>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Main Sidebar Container -->