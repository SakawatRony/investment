<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ route('user.dashboard')}}" class="brand-link">
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Welcome to the User</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item">
                <a href="{{ route('user.dashboard')}}" class="nav-link {{ isset($sidebar) && $sidebar == 'dashboard' ? 'active' : null }}">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.units')}}" class="nav-link {{ isset($sidebar) && $sidebar == 'unit' ? 'active' : null }}">
                  <i class="nav-icon bi bi-geo-fill"></i>
                  <p>Unit PINs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.commissions')}}" class="nav-link {{ isset($sidebar) && $sidebar == 'commission' ? 'active' : null }}">
                  <i class="nav-icon bi bi-cash-stack"></i>
                  <p>Commissions</p>
                </a>
              </li>
              {{-- <li class="nav-item {{ isset($sidebar) && $sidebar == 'user' ? 'menu-open' : null }}">
                <a href="#" class="nav-link {{ isset($sidebar) && $sidebar == 'user' ? 'active' : null }}">
                  <i class="nav-icon bi bi-people-fill"></i>
                  <p>
                    User
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.users.create')}}" class="nav-link {{ isset($sidebar) && isset($sidebar_sub) && $sidebar == 'user' && $sidebar_sub == 'users_create' ? 'active' : null }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.users')}}" class="nav-link {{ isset($sidebar) && isset($sidebar_sub) && $sidebar == 'user' && $sidebar_sub == 'users' ? 'active' : null }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Users</p>
                    </a>
                  </li>
                </ul>
              </li> --}}

              {{-- <li class="nav-item">
                <a href="{{ route('admin.dashboard')}}" class="nav-link {{ isset($sidebar) && $sidebar == 'settings' ? 'active' : null }}">
                  <i class="nav-icon bi bi-gear-fill"></i>
                  <p>Settings</p>
                </a>
              </li> --}}
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
