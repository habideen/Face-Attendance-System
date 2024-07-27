@php
    $accountType = 'adviser';
@endphp

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled mt-2" id="side-menu">
                <li>
                    <a href="javascript: void(0)" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboard">Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="/{{ $accountType }}/students" class="waves-effect">
                        <i class="bx bxs-user"></i>
                        <span key="t-view_student">View student</span>
                    </a>
                </li>
                <li>
                    <a href="/{{ $accountType }}/courses" class="waves-effect">
                        <i class="bx bx-book"></i>
                        <span key="t-view_course">View courses</span>
                    </a>
                </li>

                <li class="menu-title" key="t-pages">Settings</li>
                <li>
                    <a href="/{{ $accountType }}/profile" class="waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-profile">My Profile</span>
                    </a>
                </li>
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
