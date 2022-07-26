<div class="app-menu navbar-menu">
    
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('theme/dist/default/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('theme/dist/default/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('theme/dist/default/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('theme/dist/default/assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"> </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}" role="button">
                        <i class="ri-home-smile-line"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('users') ? 'active' : '' }}" href="{{route('users.edit', Auth::user()->id )}}?tab=personaldetails_edit" ><i class="las la-user"></i> <span data-key="t-user-profile">User Profile</span>
                    </a>
                </li>

                @role('admin')

                 <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('shareholders') ? 'active' : '' }}" href="{{ route('shareholders.index') }}" ><i class="las la-user"></i> <span data-key="t-user-profile">Investors</span>
                    </a>
                </li>

                @endrole
                <?php /*

                 @role('admin|investors')

                 <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('interests') ? 'active' : '' }}" href="{{ route('interests.index') }}" >
                        <i class="las la-user"></i>
                        <span data-key="t-user-profile">Investors Interests</span>
                    </a>
                </li>

                @endrole

                */?>

                @role('admin')

                 <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('entrepreneurs') ? 'active' : '' }}" href="{{ route('entrepreneurs.index') }}" >
                        <i class="las la-user"></i>
                        <span data-key="t-user-profile">Entrepreneurs</span>
                    </a>
                </li>

                @endrole

                <li class="nav-item">
    
                    @role('admin|entrepreneur')
                    <a class="nav-link menu-link" href="#sidebarProject" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProject">
                        <i class="las la-project-diagram"></i>
                        <span data-key="t-multi-level">Projects</span>
                    </a>

                    <div class="collapse menu-dropdown" id="sidebarProject">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('projects.index') }}" class="nav-link" data-key="t-dashboards"> Manage Projects
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endrole
                </li>

                @role('admin')

                 <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('blogs') ? 'active' : '' }}" href="{{ route('blogs.index') }}" >
                        <i class="las la-blog"></i>
                        <span data-key="t-blogs">Blogs</span>
                    </a>
                </li>
                    @endrole

                    <li class="nav-item">

                    @role('admin')
                    <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMultilevel"> <i class="ri-settings-2-fill"></i> <span data-key="t-multi-level">Setup</span> </a>
                    <div class="collapse menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"> <a href="{{ route('user-types.index') }}" class="nav-link" data-key="t-dashboards">
                            User Types </a> </li>

                            <li class="nav-item"> <a href="{{ route('staff.index') }}" class="nav-link" data-key="t-dashboards">
                            Staff</a> </li>

                            <li class="nav-item"> <a href="{{ route('volunteers.index') }}" class="nav-link" data-key="t-dashboards">
                            Volunteer</a> </li>

                            <li class="nav-item"> <a href="{{ route('countries.index') }}" class="nav-link" data-key="t-dashboards">
                            Countries </a> </li>
                            <li class="nav-item"> <a href="{{ route('cities.index') }}" class="nav-link" data-key="t-crypto">
                            Cities </a> </li>
                            <li class="nav-item"> <a href="{{ route('sectors.index') }}" class="nav-link" data-key="t-dashboards">
                            Sectors </a> </li>
                            <li class="nav-item"> <a href="{{ route('expertises.index') }}" class="nav-link" data-key="t-dashboards">
                            Expertises </a> </li>
                            <li class="nav-item"> <a href="{{ route('investment-ranges.index') }}" class="nav-link" data-key="t-dashboards">
                            Investment Ranges </a> </li>
                            <li class="nav-item"> <a href="{{ route('deal-types.index') }}" class="nav-link" data-key="t-dashboards">
                            Deal Types</a> </li>
                            <li class="nav-item"> <a href="{{ route('partnership-types.index') }}" class="nav-link" data-key="t-dashboards">
                            Partnership Types</a> </li>
                            <li class="nav-item"> <a href="{{ route('project-stages.index') }}" class="nav-link" data-key="t-dashboards">
                            Project Stages</a> </li>
                            <li class="nav-item"> <a href="{{ route('sustainable-development-goals.index') }}" class="nav-link" data-key="t-dashboards">
                            Sustainable Development Goals(SDG)</a> </li>
                        </ul>
                    </div>
                    @endrole
                </li>
                
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarRolePermission" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarRolePermission">
                    <i class="ri-dashboard-2-line"></i>
                    <span data-key="t-dashboards">Roles & Permissions</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarRolePermission">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link" data-key="t-analytics"> Users </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles-permission-assignment-list') }}" class="nav-link" data-key="t-analytics"> Roles Assignment </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link" data-key="t-analytics"> Roles </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link" data-key="t-analytics"> Permissions </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endrole
        </ul>
    </div>
</div>
</div>