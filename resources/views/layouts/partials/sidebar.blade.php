 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-navy elevation-4 ">
     <!-- Brand Logo -->
     <a href="{{ route('dashboard') }}" class="brand-link">
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
                 <a href="{{ route('profile.edit') }}" class="d-block ">{{ auth()->user()->name }}</a>
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
                     <a href="{{ route('dashboard') }}"
                         class="nav-link {{ request()->is('user/dashboard') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                             <span class="badge badge-light right">New</span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('user.hero.index') }}"
                         class="nav-link {{ request()->is('user/hero') ? 'active' : '' }}">
                         <i class="nav-icon fa-solid fa-house"></i>
                         <p>
                             Hero
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('user.about.index') }}"
                         class="nav-link {{ request()->is('user/about') ? 'active' : '' }}">
                         <i class="nav-icon fa-solid fa-address-card"></i>
                         <p>
                             About
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('user.experience.index') }}"
                         class="nav-link {{ request()->is('user/experience*') ? 'active' : '' }}">
                         <i class="nav-icon fa-solid fa-star"></i>
                         <p>
                             Experience
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('user.service.index') }}"
                         class="nav-link {{ request()->is('user/service*') ? 'active' : '' }}">
                         <i class="nav-icon fa-solid fa-list-check"></i>
                         <p>
                             Service
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('dashboard') }}"
                         class="nav-link {{ request()->is('user/portfolio') ? 'active' : '' }}">
                         <i class="nav-icon fa-solid fa-file-zipper"></i>
                         <p>
                             Portfolio
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('dashboard') }}"
                         class="nav-link {{ request()->is('user/contact') ? 'active' : '' }}">
                         <i class="nav-icon fa-solid fa-envelope"></i>
                         <p>
                             Contact
                         </p>
                     </a>
                 </li>
                 <li class="nav-header">Setting</li>
                 <li class="nav-item">
                     <a href="{{ route('profile.edit') }}"
                         class="nav-link {{ request()->is('user/profile') ? 'active' : '' }}">
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
