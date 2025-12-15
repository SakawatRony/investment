<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ route('admin.dashboard')}}" class="brand-link">
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

            @if (checkUserPermission('dashboard', 'view'))
              <li class="nav-item">
                <a href="{{ route('admin.dashboard')}}" class="nav-link {{ isset($sidebar) && $sidebar == 'dashboard' ? 'active' : null }}">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            @endif
            @if (checkUserPermission('user', 'view') || checkUserPermission('user', 'create'))
              <li class="nav-item {{ isset($sidebar) && $sidebar == 'user' ? 'menu-open' : null }}">
                <a href="#" class="nav-link {{ isset($sidebar) && $sidebar == 'user' ? 'active' : null }}">
                  <i class="nav-icon bi bi-people-fill"></i>
                  <p>
                    User
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  @if (checkUserPermission('user', 'create'))
                  <li class="nav-item">
                    <a href="{{ route('admin.users.create')}}" class="nav-link {{ isset($sidebar) && isset($sidebar_sub) && $sidebar == 'user' && $sidebar_sub == 'users_create' ? 'active' : null }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add User</p>
                    </a>
                  </li>
                  @endif
                  @if (checkUserPermission('user', 'view'))
                  <li class="nav-item">
                    <a href="{{ route('admin.users')}}" class="nav-link {{ isset($sidebar) && isset($sidebar_sub) && $sidebar == 'user' && $sidebar_sub == 'users' ? 'active' : null }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Users</p>
                    </a>
                  </li>
                  @endif
                </ul>
              </li>
              @endif
              @if (checkUserPermission('unit', 'view') || checkUserPermission('unit', 'create'))
              <li class="nav-item {{ isset($sidebar) && $sidebar == 'unit' ? 'menu-open' : null }}">
                <a href="#" class="nav-link {{ isset($sidebar) && $sidebar == 'unit' ? 'active' : null }}">
                  <i class="nav-icon bi bi-info-circle"></i>
                  <p>
                    Unit
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @if (checkUserPermission('unit', 'create'))
                  <li class="nav-item">
                    <a href="{{ route('admin.units.user.create')}}" class="nav-link {{ isset($sidebar) && isset($sidebar_sub) && $sidebar == 'unit' && $sidebar_sub == 'unit_users_create' ? 'active' : null }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Create Unit PINs</p>
                    </a>
                  </li>
                  @endif
                  @if (checkUserPermission('user', 'view'))
                  <li class="nav-item">
                    <a href="{{ route('admin.units.user')}}" class="nav-link {{ isset($sidebar) && isset($sidebar_sub) && $sidebar == 'unit' && $sidebar_sub == 'unit_users' ? 'active' : null }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>User Unit PINs</p>
                    </a>
                  </li>
                  @endif
                </ul>
              </li>
              @endif
              @if (checkUserPermission('applicable_invoice', 'view'))
              <li class="nav-item">
                <a href="{{ route('admin.user.allCommission')}}" class="nav-link {{ isset($sidebar) && $sidebar == 'invoice' ? 'active' : null }}">
                  <i class="nav-icon bi bi-receipt"></i>
                  <p>Applicable Invoices</p>
                </a>
              </li>
              @endif
              @if (checkUserPermission('generated_invoice', 'view'))
              <li class="nav-item">
                <a href="{{ route('admin.user.invoices')}}" class="nav-link {{ isset($sidebar) && $sidebar == 'generate_invoice' ? 'active' : null }}">
                  <i class="nav-icon bi bi-receipt"></i>
                  <p>Generated Invoices</p>
                </a>
              </li>
              @endif
              @if(session()->get('role_id') == '1' || session()->get('role_id') == '2')
              <li class="nav-item {{ isset($sidebar) && $sidebar == 'settings' ? 'menu-open' : null }}">
                <a href="#" class="nav-link {{ isset($sidebar) && $sidebar == 'settings' ? 'active' : null }}">
                  <i class="nav-icon bi bi-gear-fill"></i>
                  <p>
                    Settings
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.settings')}}" class="nav-link {{ isset($sidebar) && isset($sidebar_sub) && $sidebar == 'settings' && $sidebar_sub == 'company' ? 'active' : null }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Company Details</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.settings.permission')}}" class="nav-link {{ isset($sidebar) && isset($sidebar_sub) && $sidebar == 'settings' && $sidebar_sub == 'permission' ? 'active' : null }}">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Permission</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
