<div class="sidebar px-4 py-4 py-md-5 me-0">
    <div class="d-flex flex-column h-100">
        <a href="{{ route('admin.dashboard') }}" class="mb-0 brand-icon">
            <span class="logo-icon">
                <svg width="35" height="35" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                    <path
                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                    <path
                        d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                </svg>
            </span>
            <span class="logo-text">My-Task</span>
        </a>
        <!-- Menu: main ul -->

        <ul class="menu-list flex-grow-1 mt-3">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="m-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}" id="dashboard-link">
                    <i class="icofont-home fs-5"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="">
                <a class="m-link" href="#" data-bs-toggle="collapse" data-bs-target="#emp-Components">
                    <i class="icofont-users-alt-5"></i> <span>Employees</span>
                    <span class="arrow icofont-dotted-down ms-auto text-end fs-5" data-bs-toggle="collapse"
                        data-bs-target="#emp-Components"></span>
                </a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="emp-Components">
                    <li><a class="ms-link {{ request()->routeIs('positions.index') ? 'active' : '' }}"
                            href="{{ route('positions.index') }}"> <span>Position</span></a></li>
                    <li><a class="ms-link {{ request()->routeIs('departments.index') ? 'active' : '' }}"
                            href="{{ route('departments.index') }}"> <span>Department</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
