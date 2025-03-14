<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box text-lg-start">
                <a href="/{{ Session::get('user_path') }}/dashboard" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/assets/images/logo.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/logoWithText.png" alt="" height="60">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Session: {{ Session::get('academic_session') }} <i
                        class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    @php
                        $startYear = 2015;
                        $currentYear = date('Y');
                        $years = [];

                        // Generate academic years in reverse order
                        for ($year = $currentYear; $year > $startYear; $year--) {
                            $prevYear = $year - 1;
                            $years[] = "$prevYear/$year";
                        }
                    @endphp
                    @foreach ($years as $academicYear)
                        <!-- item-->
                        <a href="/set_default_session?session={{ urlencode($academicYear) }}"
                            class="dropdown-item notify-item" data-lang="en">
                            <span class="align-middle">{{ $academicYear }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="/assets/images/users/avatar.jpg"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-loggedUser">{{ Auth::user()->sname }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="/{{ Session::get('user_path') }}/password"><i
                            class="bx bx-key font-size-16 align-middle me-1"></i> <span
                            key="t-password">Password</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="/logout"><i
                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                            key="t-logout">Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</header>
