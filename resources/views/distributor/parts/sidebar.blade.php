<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <div class="logo-bg">
        <a href="{{ auth()->user()->isA('distributor')? '#': route('admin.dashboard') }}">
            <img src="{{ adminAsset('img/logo_m.png') }}" class="img-fluid w-40" alt="" />
        </a>

        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ isActiveRoute('distributor.dashboard') }}"
                href="{{ route('distributor.dashboard') }}">
                <i class="bi bi-search"></i>
                <span>Check Over Stock Products</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ isActiveRoute('distributor.products') }}" href="{{ route('distributor.products') }}">
                <i class="bi bi-basket"></i>
                <span>My Products</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('distributor.uploads*') || request()->routeIs('distributor.uploads*') ? 'active' : 'collapsed' }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-cloud-upload"></i><span>Uploads</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('distributor.uploads.manual') }}">
                        <i class="bi bi-circle"></i><span>Upload (Manual)</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('distributor.uploads.excel') }}">
                        <i class="bi bi-circle"></i><span>Upload (Excel)</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('distributor.uploads.history') }}">
                        <i class="bi bi-circle"></i><span>Upload History</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('distributor.uploads.manual_history') }}">
                        <i class="bi bi-circle"></i><span>Upload History (Manual)</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
<!-- End Sidebar-->
