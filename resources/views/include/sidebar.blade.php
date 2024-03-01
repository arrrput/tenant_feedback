<nav id="sidebar">
    <ul class="list-unstyled menu-categories" id="accordionExample">
        {{-- <li class="menu">
            <a href="#dashboard" data-active="{{ is_active_route(['dashboard/*']) }}" data-toggle="collapse" aria-expanded="{{ is_active_route(['dashboard/*']) }}" class="dropdown-toggle">
                <div class="">
                    <i class="las la-home"></i>
                    <span>{{__('Dashboards')}}</span>
                </div>
                <div>
                    <i class="las la-angle-right sidemenu-right-icon"></i>
                </div>
            </a>
            <ul class="submenu list-unstyled collapse {{ show_class(['dashboard/*']) }}" id="dashboard" data-parent="#accordionExample">
                <li class=" {{ active_class(['dashboard/dashboard1']) }}">
                    <a data-active="{{ is_active_route(['dashboard/dashboard1']) }}" href="{{ url('/dashboard/dashboard1') }}"> {{__('Dashboard 1')}} </a>
                </li>
                <li class=" {{ active_class(['dashboard/dashboard2']) }}">
                    <a data-active="{{ is_active_route(['dashboard/dashboard2']) }}" href="{{ url('/dashboard/dashboard2') }}"> {{__('Dashboard 2')}} </a>
                </li>
                <li class=" {{ active_class(['dashboard/dashboard3']) }}">
                    <a data-active="{{ is_active_route(['dashboard/dashboard3']) }}" href="{{ url('/dashboard/dashboard3') }}"> {{__('Dashboard 3')}} </a>
                </li>
                <li class=" {{ active_class(['dashboard/dashboard4']) }}">
                    <a data-active="{{ is_active_route(['dashboard/dashboard4']) }}" href="{{ url('/dashboard/dashboard4') }}"> {{__('Dashboard 4')}} </a>
                </li>
                <li class=" {{ active_class(['dashboard/dashboard5']) }}">
                    <a data-active="{{ is_active_route(['dashboard/dashboard5']) }}" href="{{ url('/dashboard/dashboard5') }}"> {{__('Dashboard 5')}} </a>
                </li>
                <li class=" {{ active_class(['dashboard/dashboard-social']) }}">
                    <a data-active="{{ is_active_route(['dashboard/dashboard-social']) }}" href="{{ url('/dashboard/dashboard-social') }}"> {{__('Dashboard Social')}} </a>
                </li>
            </ul>
        </li> --}}
        <li class="menu {{ active_class(['dashboard']) }}">
            <a data-active="{{ is_active_route(['dashboard']) }}" href="{{ url('/dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <i class="las la-home"></i>
                    <span> {{__('Dashboard')}}</span>
                </div>
            </a>
        </li>
        @role('tenant')
        {{-- <li class="menu {{ active_class(['request']) }}">
            <a data-active="{{ is_active_route(['request']) }}" href="{{ url('/request') }}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <i class="las la-plus"></i>
                    <span> {{__('Add Request')}}</span>
                </div>
            </a>
        </li> --}}

        <li class="menu {{ active_class(['request/*']) }}">
            <a data-active="{{ is_active_route(['request/*']) }}" href="{{ url('/request/list') }}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <i class="las la-table"></i>
                    <span> {{__('My Request')}}</span>
                </div>
            </a>
        </li>
        @endrole

        @role('user')
        <li class="menu {{ active_class(['department']) }}">
            <a data-active="{{ is_active_route(['department']) }}" href="{{ url('/department') }}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <i class="las la-layer-group"></i>
                    <span> {{__('Request Tenants')}}</span>
                </div>
            </a>
        </li>
        
        <li class="menu {{ active_class(['admin/report','admin/report.*']) }}">
            <a data-active="{{ is_active_route(['admin/report', 'admin/report/*']) }}" href="{{ url('/admin/report') }}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <i class="las la-chalkboard"></i>
                    <span> {{__('Report')}}</span>
                </div>
            </a>
        </li>
        @endrole

        @role('admin')
        <li class="menu {{ active_class([route('admin.user.index')]) }}">
            <a data-active="{{ is_active_route(['admin/user_management']) }}" href="{{ url('admin/user_management') }}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <i class="las la-users"></i>
                    <span> {{__('User Management')}}</span>
                </div>
            </a>
        </li>
        @endrole
        <li class="menu-title">{{__('Manage My Profile')}}</li>
        <li class="menu {{ active_class([route('profile.index')]) }}">
            <a data-active="{{ is_active_route(['profile']) }}" href="{{ url('profile') }}" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <i class="las la-user"></i>
                    <span> {{__('Profile')}}</span>
                </div>
            </a>
        </li>
        
        
    </ul>
</nav>
