<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/bo">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Backoffice</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Orders
    </div>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-truck"></i>
            <span>Cargo</span>
        </a>
    </li>

    @canany(['view cost rate', 'add cost rate', 'edit cost rate', 'delete cost rate', 
    'view cost rate', 'add cost rate', 'edit cost rate', 'delete cost rate',
    'view partner', 'add partner', 'edit partner', 'delete partner',
    'view warehouse', 'add warehouse', 'edit warehouse', 'delete warehouse'])
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Master Data
        </div>

        @canany(['view cost rate', 'add cost rate', 'edit cost rate', 'delete cost rate'])
            <li class="nav-item">
                <a class="nav-link {{ request()->is('bo/cost-rates*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseCostRate"
                    aria-expanded="{{ request()->is('bo/cost-rates*') ? 'true' : 'false' }}" aria-controls="collapseCostRate">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Cost Rates</span>
                </a>
                <div id="collapseCostRate" class="collapse {{ request()->is('bo/cost-rates*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('add admin')
                            <a class="collapse-item {{ request()->is('bo/cost-rates/create') ? 'active' : '' }}" href="{{ route('cost-rates.create') }}">New</a>
                        @endcan

                        @canany(['view admin', 'edit admin', 'delete admin'])
                            <a class="collapse-item {{ request()->is('bo/cost-rates') ? 'active' : '' }}" href="{{ route('cost-rates') }}">List</a>
                        @endcan
                    </div>
                </div>
            </li>
        @endcan

        @canany(['view partner', 'add partner', 'edit partner', 'delete partner'])
            <li class="nav-item">
                <a class="nav-link {{ request()->is('bo/partners*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapsePartner"
                    aria-expanded="{{ request()->is('bo/partners*') ? 'true' : 'false' }}" aria-controls="collapsePartner">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Partners</span>
                </a>
                <div id="collapsePartner" class="collapse {{ request()->is('bo/partners*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('add admin')
                            <a class="collapse-item {{ request()->is('bo/partners/create') ? 'active' : '' }}" href="{{ route('partners.create') }}">New</a>
                        @endcan

                        @canany(['view admin', 'edit admin', 'delete admin'])
                            <a class="collapse-item {{ request()->is('bo/partners') ? 'active' : '' }}" href="{{ route('partners') }}">List</a>
                        @endcan
                    </div>
                </div>
            </li>
        @endcan

        @canany(['view warehouse', 'add warehouse', 'edit warehouse', 'delete warehouse'])
            <li class="nav-item">
                <a class="nav-link {{ request()->is('bo/warehouses*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseWarehouse"
                    aria-expanded="{{ request()->is('bo/warehouses*') ? 'true' : 'false' }}" aria-controls="collapseWarehouse">
                    <i class="fas fa-fw fa-warehouse"></i>
                    <span>Warehouses</span>
                </a>
                <div id="collapseWarehouse" class="collapse {{ request()->is('bo/warehouses*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('add admin')
                            <a class="collapse-item {{ request()->is('bo/warehouses/create') ? 'active' : '' }}" href="{{ route('warehouses.create') }}">New</a>
                        @endcan

                        @canany(['view admin', 'edit admin', 'delete admin'])
                            <a class="collapse-item {{ request()->is('bo/warehouses') ? 'active' : '' }}" href="{{ route('warehouses') }}">List</a>
                        @endcan
                    </div>
                </div>
            </li>
        @endcan
    @endcan

    @canany(['view admin', 'add admin', 'edit admin', 'delete admin', 'view admin role', 'manage admin role'])
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Account Management
        </div>

        @canany(['view admin', 'add admin', 'edit admin', 'delete admin'])
            <li class="nav-item">
                <a class="nav-link {{ request()->is('bo/users*') ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseUser"
                    aria-expanded="{{ request()->is('bo/users*') ? 'true' : 'false' }}" aria-controls="collapseUser">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
                <div id="collapseUser" class="collapse {{ request()->is('bo/users*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('add admin')
                            <a class="collapse-item {{ request()->is('bo/users/create') ? 'active' : '' }}" href="{{ route('users.create') }}">New</a>
                        @endcan

                        @canany(['view admin', 'edit admin', 'delete admin'])
                            <a class="collapse-item {{ request()->is('bo/users') ? 'active' : '' }}" href="{{ route('users') }}">List</a>
                        @endcan
                    </div>
                </div>
            </li>
        @endcan
        
        @canany(['view admin role', 'manage admin role'])
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles') }}">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Roles</span>
                </a>
            </li>
        @endcan
    @endcan

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>