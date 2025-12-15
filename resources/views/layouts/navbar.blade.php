<nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span class="d-none d-md-inline">{{ auth()->user()->full_name }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <p>
                    {{ auth()->user()->full_name }}
                    <small>Member since {{ timeZoneformatDate(auth()->user()->created_at) .' '. timeZonegetTime(auth()->user()->created_at) }}</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                @if (checkUserPermission('user', 'update'))
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-12 text-center"><a href="{{ session()->get('role_id') != 3 ? route('admin.users.edit', auth()->user()->id) :  route('user.profile.edit') }}">Profile</a></div>
                  </div>
                  <!--end::Row-->
                </li>
                @endif
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="{{ session()->get('role_id') != 3 ? route('admin.change.password') :  route('user.change.password') }}" class="btn btn-default btn-flat">Change Password</a>
                  <a href="{{ session()->get('role_id') != 3 ? route('admin.logout') :  route('user.logout')}}" class="btn btn-default btn-flat float-end">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
