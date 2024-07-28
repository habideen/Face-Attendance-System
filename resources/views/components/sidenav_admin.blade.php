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
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-book"></i>
                        <span key="t-courses">Courses</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/{{ Session::get('user_path') }}/courses/load_course" key="t-load_course">Load
                                courses with
                                file</a></li>
                        <li><a href="/{{ Session::get('user_path') }}/courses/add_course" key="t-add_course">Add
                                course</a></li>
                        <li><a href="/{{ Session::get('user_path') }}/courses" key="t-view_course">View courses</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-user-badge"></i>
                        <span key="t-staff">Staff</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/{{ Session::get('user_path') }}/staff/load_staff" key="t-load_staff">Load staff
                                with
                                file</a></li>
                        <li><a href="/{{ Session::get('user_path') }}/staff/create" key="t-add_staff">Add staff</a></li>
                        <li><a href="/{{ Session::get('user_path') }}/staff" key="t-view_staff">View staff</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-user"></i>
                        <span key="t-student">Student</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/{{ Session::get('user_path') }}/students/load_student" key="t-load_student">Load
                                students with
                                file</a></li>
                        <li><a href="/{{ Session::get('user_path') }}/students/create" key="t-add_student">Add
                                student</a></li>
                        <li><a href="/{{ Session::get('user_path') }}/students" key="t-view_student">View student</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/{{ Session::get('user_path') }}/session" class="waves-effect">
                        <i class="bx bx-timer"></i>
                        <span key="t-profile">Set Session</span>
                    </a>
                </li>

                <li class="menu-title" key="t-pages">Settings</li>
                <li>
                    <a href="/{{ Session::get('user_path') }}/profile" class="waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-profile">My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="/{{ Session::get('user_path') }}/password" class="waves-effect">
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
