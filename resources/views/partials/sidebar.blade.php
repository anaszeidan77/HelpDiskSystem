<!-- resources/views/partials/sidebar.blade.php -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <!-- شعار القالب هنا -->
            {{-- <span class="app-brand-logo demo">
              <!-- SVG الشعار -->
              <!-- (احتفظ بالـ SVG كما هو أو قم بتعديله حسب الحاجة) -->
          </span> --}}
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Help Diak</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">


        <!-- عناصر القائمة بناءً على دور المستخدم -->
        @auth
            @if (Auth::user()->role === 'admin')
                <!-- عناصر القائمة العامة للجميع -->
                <li class="menu-item active">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>
                <!-- عناصر خاصة بالـ Admin -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-layout"></i>
                        <div data-i18n="Users">Help Disk System</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('users.index') }}" class="menu-link">
                                <div data-i18n="User Manager">User Manager</div>
                                
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('categories.index') }}" class="menu-link">
                                <div data-i18n="Categories">Categories</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('tickets.index') }}" class="menu-link">
                                <div data-i18n="Tickets">Tickets</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('comments.index') }}" class="menu-link">
                                <div data-i18n="Comments">Comments</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif (Auth::user()->role === 'user')
                <!-- عناصر خاصة بالمستخدم العادي -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-help-circle"></i>
                        <div data-i18n="Support">Support</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('tickets.index') }}" class="menu-link">
                                <div data-i18n="My Tickets">My Tickets</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('comments.index') }}" class="menu-link">
                                <div data-i18n="My Comments">My Comments</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        @endauth

        <!-- عناصر القائمة الخاصة بالضيوف -->
        @guest
            <li class="menu-item">
                <a href="{{ route('login') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-log-in-circle"></i>
                    <div data-i18n="Login">Login</div>
                </a>
            </li>
        @endguest
    </ul>
</aside>
