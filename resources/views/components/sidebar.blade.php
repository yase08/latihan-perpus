<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard-ecommerce.html">Stisla Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard-ecommerce.html">SA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class="{{ Request::is('dashboard/book*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('book') }}"><i class="fas fa-book"></i> <span>Book</span></a></li>
            <li class="{{ Request::is('dashboard/return-book*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('return') }}"><i class="fas fa-clock"></i> <span>Return Book</span></a>
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('staff'))
            <li class="{{ Request::is('dashboard/user*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('user') }}"><i class="fas fa-user"></i> <span>User</span></a></li>
            <li class="{{ Request::is('dashboard/category*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('category') }}"><i class="fas fa-list"></i> <span>Category</span></a></li>
            </li>
            @endif
        </ul>
    </aside>
</div>
