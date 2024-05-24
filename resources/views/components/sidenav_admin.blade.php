@php
    $accountType = 'admin';
@endphp

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled mt-2" id="side-menu">
                <li>
                    <a href="/{{ $accountType }}/dashboard" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboard">Dashboards</span>
                    </a>
                </li>

                <li class="menu-title" key="t-pages">Settings</li>

                <li>
                    <a href="/{{ $accountType }}/password" class="waves-effect">
                        <i class="bx bx-key"></i>
                        <span key="t-dashboards">Password</span>
                    </a>
                </li>

                <li>
                    <a href="/logout" class="waves-effect">
                        <i class="bx bx-power-off"></i>
                        <span key="t-dashboards">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
