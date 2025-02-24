<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= $adminURL ?>administrators">
                        <i class="bi bi-circle"></i><span>Admin</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $adminURL ?>roles">
                        <i class="bi bi-circle"></i><span>Roles</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $adminURL ?>user-types">
                        <i class="bi bi-circle"></i><span>Add User Types</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Teachers</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Parents</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $adminURL ?>students">
                        <i class="bi bi-circle"></i><span>Students</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Accountants</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Librarian</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>List group</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $adminURL ?>template">
                        <i class="bi bi-circle"></i><span>Template</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#system-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>System Commons</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="system-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= $adminURL ?>countries">
                        <i class="bi bi-circle"></i><span>Countries</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $adminURL ?>states">
                        <i class="bi bi-circle"></i><span>States</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $adminURL ?>genders">
                        <i class="bi bi-circle"></i><span>Genders</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $adminURL ?>departments">
                        <i class="bi bi-circle"></i><span>Departments</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $adminURL ?>designations">
                        <i class="bi bi-circle"></i><span>Designations</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link collapsed" data-bs-target="#academic-nav" data-bs-toggle="collapse">
                <i class="bx bx-book"></i><span>Academic</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="nav-content collapse" id="academic-nav" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= $adminURL ?>classes">
                        <i class="bi bi-circle"></i><span>Classes</span>
                    </a>
                </li>
                <li>
                    <a href="<?= $adminURL ?>sections">
                        <i class="bi bi-circle"></i><span>Class Sections</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Daily Attendance</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>Class Sections</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= $adminURL ?>login">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li><!-- End Login Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-error-404.html">
                <i class="bi bi-dash-circle"></i>
                <span>Error 404</span>
            </a>
        </li><!-- End Error 404 Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
