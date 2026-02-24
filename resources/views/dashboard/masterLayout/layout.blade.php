<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart Quiz AI')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('assets/admin/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/style.css') }}" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">SQ</div>
                <div class="logo-text">Smart Quiz AI</div>
            </div>

            <div class="toggle-btn" id="toggleSidebar">
                <i class="fas fa-chevron-left"></i>
            </div>

            <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                    <i class="fas fa-home"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-file-upload"></i>
                    <span class="sidebar-text">Upload PDF</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-question-circle"></i>
                    <span class="sidebar-text">My Quizzes</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span class="sidebar-text">Analytics</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span class="sidebar-text">Students</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span class="sidebar-text">Settings</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-question"></i>
                    <span class="sidebar-text">Help & Support</span>
                </a>
            </div>

            <div class="sidebar-footer">
                <div class="user-avatar">AS</div>
                <div class="user-info">
                    <div class="user-name">{{ Auth::User()->user_name }}</div>
                    <div class="user-role">{{ Str::ucfirst(Auth::User()->role) }}</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Header -->
            <header class="top-header">
                <div class="header-left">
                    <div class="mobile-toggle" id="mobileToggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1>
                         @yield('header-heading')
                    </h1>
                </div>

                <div class="header-right">
                    <div class="header-icons">
                        <div class="icon-btn">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="icon-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </div>
                        <div class="icon-btn">
                            <i class="fas fa-envelope"></i>
                            <span class="notification-badge">5</span>
                        </div>
                    </div>

                    <!-- User Dropdown -->
                    <div class="user-dropdown">
                        <div class="dropdown-toggle" id="dropdownToggle">
                            <div class="dropdown-avatar">AJ</div>
                            <div class="dropdown-name">{{ Auth::User()->user_name }}</div>
                            <div class="dropdown-caret">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>

                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>My Profile</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Account Settings</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-key"></i>
                                <span>Change Password</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-chart-line"></i>
                                <span>Usage Analytics</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-question-circle"></i>
                                <span>Help & Support</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <!-- Logout Form -->
                            <form action="{{ route('logout') }}" method="POST" style="display: contents;">
                                @csrf
                                <button type="submit" class="dropdown-item"
                                    style="background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                {{-- Dynamic Content --}}
                <div class="dynamic-content">
                    @yield('content')
                </div>

                <!-- Footer -->
                <div class="dashboard-footer">
                    <div class="footer-logo">Smart Quiz AI</div>
                    <p>Transform your documents into engaging learning experiences</p>
                    <p class="copyright">© <?= date('Y') ?> Smart Quiz AI - PDF to Quiz Generator. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/admin/js/layout.js') }}"></script>
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>
</body>

</html>
