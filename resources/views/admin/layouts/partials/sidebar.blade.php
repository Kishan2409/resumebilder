 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-navy elevation-4 ">
     <!-- Brand Logo -->
     <a href="{{ route('admin.dashboard') }}" class="brand-link">
         @php
             $path = Helper::Settings() ? asset('public/storage/logo/' . Helper::Settings()->logo) : asset('public/admin/dist/img/no_image_available.png');
         @endphp
         <img src="{{ $path }}" alt="Logo File Not Found" class="brand-image img-circle elevation-3"
             style="opacity: .8">
         <span class="brand-text ">{{ Helper::Settings()->title ?? 'TEST' }}</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('public/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
             </div>
             <div class="info">
                 <a href="{{ route('admin.profile') }}" class="d-block ">{{ auth('admins')->user()->name }}</a>
             </div>
         </div>

         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" id="form-control-sidebar-search"
                     name="form-control-sidebar-search" type="search" placeholder="Search" aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">

                 <li class="nav-item">
                     <a href="{{ route('admin.dashboard') }}"
                         class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                             <span class="badge badge-light right">New</span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-header">Setting</li>
                 <li class="nav-item">
                     <a href="{{ route('web.index') }}"
                         class="nav-link {{ request()->is('admin/web-setting') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-toolbox"></i>
                         <p>
                             Web Setting
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('admin.profile') }}"
                         class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-user-cog"></i>
                         <p>
                             Profile Setting
                         </p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
