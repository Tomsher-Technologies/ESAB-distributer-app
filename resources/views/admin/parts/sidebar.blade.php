<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <div class="logo-bg">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ adminAsset('img/logo_m.png') }}" class="img-fluid w-40" alt="" />
        </a>

        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ isActiveRoute('admin.dashboard*') }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        @if (auth()->user()->can('manage-distributor') ||
                auth()->user()->can('view-distributor') ||
                auth()->user()->can('create-distributor') ||
                auth()->user()->can('edit-distributor') ||
                auth()->user()->can('delete-distributor'))
            <li class="nav-item">
                <a class="nav-link {{ isActiveRoute('admin.distributor*') }}"
                    href="{{ route('admin.distributor.index') }}">
                    <i class="bi bi-shop"></i>
                    <span> Distributor</span>
                </a>
            </li>
        @endif


        <!-- End F.A.Q Page Nav -->

        @if (auth()->user()->can('view-products') ||
                auth()->user()->can('create-products') ||
                auth()->user()->can('edit-products') ||
                auth()->user()->can('delete-products') ||
                auth()->user()->can('view-upload-history') ||
                auth()->user()->can('upload-products'))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : 'collapsed' }}"
                    data-bs-target="#forms-nav1" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-cloud-upload"></i><span>Uploads</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>

                <ul id="forms-nav1"
                    class="nav-content {{ request()->routeIs('admin.products*') ? 'active' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav1">
                    @if (auth()->user()->can('create-products'))
                        <li>
                            <a href="{{ route('admin.products.create') }}">
                                <i class="bi bi-circle"></i><span>Upload (Manual)</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->can('upload-products'))
                        <li>
                            <a href="{{ route('admin.products.import') }}">
                                <i class="bi bi-circle"></i><span>Upload (Excel)</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->can('view-upload-history'))
                        <li>
                            <a href="{{ route('admin.products.history') }}">
                                <i class="bi bi-circle"></i><span>Upload History</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->can('view-products'))
                        <li>
                            <a href="{{ route('admin.products.index') }}">
                                <i class="bi bi-circle"></i><span>Uploaded Products</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End Forms Nav -->
        @if (auth()->user()->can('manage-request'))
            <li class="nav-item">
                <a class="nav-link {{ isActiveRoute('admin.requests*') }} collapsed"
                    href="{{ route('admin.requests') }}">
                    <i class="bi bi-person-plus"></i>
                    <span> Requests</span>
                </a>
            </li>
        @endif
        <!-- End F.A.Q Page Nav -->
        @if (auth()->user()->can('manage-roles') ||
                auth()->user()->can('manage-users'))
            <li class="nav-item">
                <a class="nav-link  {{ request()->routeIs('admin.users*') || request()->routeIs('admin.roles*') ? 'active' : 'collapsed' }}"
                    data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav"
                    class="nav-content {{ request()->routeIs('admin.users*') || request()->routeIs('admin.roles*') ? 'active' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">
                    @if (auth()->user()->can('manage-roles'))
                        <li>
                            <a href="{{ route('admin.roles.index') }}">
                                <i class="bi bi-circle"></i><span>Admin Roles</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->can('manage-users'))
                        <li>
                            <a href="{{ route('admin.users.index') }}">
                                <i class="bi bi-circle"></i><span>Admin Users</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End Forms Nav -->
    </ul>
</aside>
<!-- End Sidebar-->
