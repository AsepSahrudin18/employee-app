 <!-- Sidebar scroll-->
 <div>
     <div class="brand-logo d-flex align-items-center justify-content-between">
         <h5 class="text-center"><span class="fw-lighter">Employee</span>.<span class="text-secondary fw-bolder">App</span>
         </h5>
         <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
             <i class="ti ti-x fs-8"></i>
         </div>
     </div>
     <!-- Sidebar navigation-->
     <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
         <ul id="sidebarnav">
             <li class="nav-small-cap">
                 <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                 <span class="hide-menu">Home</span>
             </li>
             <li class="sidebar-item">
                 <a class="sidebar-link" href="#" aria-expanded="false">
                     <span>
                         <i class="ti ti-layout-dashboard"></i>
                     </span>
                     <span class="hide-menu">Dashboard</span>
                 </a>
             </li>

             <li class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('employees.index') }}" aria-expanded="false">
                     <span>
                         <i class="ti ti-album"></i>
                     </span>
                     <span class="hide-menu">Manage Employees</span>
                 </a>
             </li>

             <li class="sidebar-item">
                 <a class="sidebar-link" href="{{ route('change.password') }}" aria-expanded="false">
                     <span>
                         <i class="ti ti-brand-samsungpass"></i>
                     </span>
                     <span class="hide-menu">Change Password</span>
                 </a>
             </li>
         </ul>
     </nav>
     <!-- End Sidebar navigation -->
 </div>
 <!-- End Sidebar scroll-->
