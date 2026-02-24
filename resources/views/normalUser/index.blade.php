<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Smart Quiz AI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #4f46e5;
            --primary-dark: #3730a3;
            --secondary-color: #10b981;
            --light-color: #f8fafc;
            --dark-color: #1e293b;
            --sidebar-bg: #1e293b;
            --sidebar-text: #cbd5e1;
            --sidebar-active: #4f46e5;
            --gray-color: #64748b;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --card-bg: #ffffff;
            --transition-speed: 0.3s;
            --success-light: #d1fae5;
            --warning-light: #fed7aa;
            --info-light: #dbeafe;
        }

        body {
            background-color: #f1f5f9;
            color: var(--dark-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Layout Container */
        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles - User Version */
        .sidebar {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: var(--sidebar-text);
            width: 250px;
            min-height: 100vh;
            transition: all var(--transition-speed) ease;
            position: fixed;
            z-index: 100;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .sidebar-text {
            display: none;
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar.collapsed .menu-item {
            justify-content: center;
        }

        .sidebar.collapsed .user-info {
            display: none;
        }

        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
            transition: opacity var(--transition-speed);
        }

        .sidebar-menu {
            padding: 1.5rem 0;
            flex: 1;
            overflow-y: auto;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.9rem 1.25rem;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: white;
            border-left: 3px solid var(--secondary-color);
        }

        .menu-item.active {
            background-color: rgba(16, 185, 129, 0.1);
            color: white;
            border-left: 3px solid var(--secondary-color);
        }

        .menu-item i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-footer .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            flex-shrink: 0;
        }

        .user-info {
            flex: 1;
            overflow: hidden;
        }

        .user-name {
            font-weight: 600;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.8rem;
            color: var(--secondary-color);
            font-weight: 500;
        }

        /* Toggle Button */
        .toggle-btn {
            position: absolute;
            right: -12px;
            top: 20px;
            background-color: var(--secondary-color);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow);
            transition: all var(--transition-speed);
            z-index: 101;
        }

        .toggle-btn:hover {
            background-color: #0d9488;
            transform: scale(1.1);
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 250px;
            transition: margin-left var(--transition-speed);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed~.main-content {
            margin-left: 70px;
        }

        /* Top Header */
        .top-header {
            background-color: white;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-left h1 {
            font-size: 1.5rem;
            color: var(--primary-dark);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        /* Header Icons */
        .header-icons {
            display: flex;
            gap: 1rem;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-color);
            color: var(--gray-color);
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .icon-btn:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .dropdown-toggle:hover {
            background-color: var(--light-color);
        }

        .dropdown-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .dropdown-name {
            font-weight: 600;
            color: var(--dark-color);
        }

        .dropdown-caret {
            color: var(--gray-color);
            transition: transform 0.2s;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            min-width: 220px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 1000;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--dark-color);
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: var(--light-color);
        }

        .dropdown-item i {
            width: 20px;
            color: var(--gray-color);
        }

        .dropdown-divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 0.5rem 0;
        }

        /* Dashboard Content */
        .dashboard-content {
            flex: 1;
            padding: 1.5rem;
        }

        /* Welcome Banner */
        .welcome-banner {
            background: linear-gradient(135deg, #4f46e5 0%, #10b981 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
        }

        .welcome-text h2 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .welcome-text p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .welcome-stats {
            display: flex;
            gap: 2rem;
        }

        .welcome-stat {
            text-align: center;
        }

        .welcome-stat .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
        }

        .welcome-stat .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        /* Stats Cards - User Version */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-info {
            flex: 1;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color);
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--gray-color);
            font-size: 0.9rem;
        }

        /* Section Header */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 2rem 0 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-view-all {
            background-color: transparent;
            color: var(--secondary-color);
            border: none;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-view-all:hover {
            background-color: rgba(16, 185, 129, 0.1);
        }

        /* Quiz Cards - User Version */
        .quiz-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .quiz-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .quiz-card:hover {
            transform: translateY(-8px);
        }

        .quiz-header {
            height: 120px;
            background: linear-gradient(135deg, #4f46e5 0%, #10b981 100%);
            padding: 1.25rem;
            color: white;
            position: relative;
        }

        .quiz-category {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            backdrop-filter: blur(5px);
        }

        .quiz-header h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            padding-right: 80px;
        }

        .quiz-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .quiz-content {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .quiz-description {
            color: var(--gray-color);
            font-size: 0.95rem;
            margin-bottom: 1rem;
            flex: 1;
        }

        .quiz-stats {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 1rem;
        }

        .quiz-stat {
            text-align: center;
        }

        .quiz-stat i {
            color: var(--secondary-color);
            margin-right: 0.25rem;
        }

        .quiz-difficulty {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .difficulty-beginner {
            background-color: #d1fae5;
            color: #10b981;
        }

        .difficulty-intermediate {
            background-color: #fed7aa;
            color: #f59e0b;
        }

        .difficulty-advanced {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .btn-start {
            background-color: var(--secondary-color);
            color: white;
            padding: 0.8rem;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-start:hover {
            background-color: #0d9488;
            transform: translateY(-2px);
        }

        /* Progress Section */
        .progress-section {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .progress-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .progress-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .progress-item {
            text-align: center;
        }

        .progress-circle {
            width: 100px;
            height: 100px;
            margin: 0 auto 1rem;
            position: relative;
        }

        .progress-circle svg {
            width: 100px;
            height: 100px;
            transform: rotate(-90deg);
        }

        .progress-circle circle {
            fill: none;
            stroke-width: 8;
            stroke-linecap: round;
        }

        .progress-bg {
            stroke: #e2e8f0;
        }

        .progress-fill {
            stroke: var(--secondary-color);
            stroke-dasharray: 283;
            stroke-dashoffset: calc(283 - (283 * 75) / 100);
            transition: stroke-dashoffset 0.5s;
        }

        .progress-percent {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .progress-label {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .progress-sub {
            font-size: 0.85rem;
            color: var(--gray-color);
        }

        /* Achievement Badges */
        .badges-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .badge-item {
            background-color: var(--light-color);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            transition: transform 0.2s;
        }

        .badge-item:hover {
            transform: scale(1.05);
        }

        .badge-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5, #10b981);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
            color: white;
            font-size: 1.5rem;
        }

        .badge-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--dark-color);
        }

        .badge-desc {
            font-size: 0.8rem;
            color: var(--gray-color);
        }

        /* Upcoming Quizzes */
        .upcoming-list {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
        }

        .upcoming-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .upcoming-item:last-child {
            border-bottom: none;
        }

        .upcoming-date {
            background-color: var(--light-color);
            padding: 0.5rem;
            border-radius: 8px;
            text-align: center;
            min-width: 60px;
        }

        .upcoming-day {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 1;
        }

        .upcoming-month {
            font-size: 0.8rem;
            color: var(--gray-color);
        }

        .upcoming-info {
            flex: 1;
        }

        .upcoming-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .upcoming-meta {
            font-size: 0.85rem;
            color: var(--gray-color);
            display: flex;
            gap: 1rem;
        }

        .btn-reminder {
            color: var(--secondary-color);
            background: none;
            border: 1px solid var(--secondary-color);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-reminder:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        /* Footer */
        .dashboard-footer {
            text-align: center;
            padding: 1.5rem;
            color: var(--gray-color);
            font-size: 0.9rem;
            border-top: 1px solid #e2e8f0;
            margin-top: 2rem;
        }

        .footer-logo {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        /* Mobile Toggle Button */
        .mobile-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background-color: var(--light-color);
            color: var(--primary-color);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.2rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                width: 70px;
            }

            .sidebar .sidebar-text,
            .sidebar .logo-text,
            .sidebar .user-info {
                display: none;
            }

            .sidebar .menu-item {
                justify-content: center;
            }

            .main-content {
                margin-left: 70px;
            }

            .welcome-banner {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 250px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar .sidebar-text,
            .sidebar .logo-text,
            .sidebar .user-info {
                display: block;
            }

            .sidebar .menu-item {
                justify-content: flex-start;
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: flex;
            }

            .header-left h1 {
                font-size: 1.2rem;
            }

            .dropdown-name {
                display: none;
            }

            .welcome-stats {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar - User Version -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">SQ</div>
                <div class="logo-text">Smart Quiz AI</div>
            </div>

            <div class="toggle-btn" id="toggleSidebar">
                <i class="fas fa-chevron-left"></i>
            </div>

            <div class="sidebar-menu">
                <a href="#" class="menu-item active">
                    <i class="fas fa-home"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-tasks"></i>
                    <span class="sidebar-text">My Quizzes</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-line"></i>
                    <span class="sidebar-text">My Progress</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-trophy"></i>
                    <span class="sidebar-text">Achievements</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-bookmark"></i>
                    <span class="sidebar-text">Saved Quizzes</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-history"></i>
                    <span class="sidebar-text">Quiz History</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span class="sidebar-text">Settings</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-question-circle"></i>
                    <span class="sidebar-text">Help</span>
                </a>
            </div>

            <div class="sidebar-footer">
                <div class="user-avatar">
                    {{ collect(explode(' ', trim(Auth::user()->user_name)))->take(2)->map(fn($word) => strtoupper(substr($word, 0, 1)))->implode('') }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ Auth::User()->user_name ?? 'User' }}</div>
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
                    <h1>My Dashboard</h1>
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
                            <span class="notification-badge">2</span>
                        </div>
                    </div>

                    <!-- User Dropdown -->
                    <div class="user-dropdown">
                        <div class="dropdown-toggle" id="dropdownToggle">
                            <div class="dropdown-avatar">
                                {{ collect(explode(' ', trim(Auth::user()->user_name)))->take(2)->map(fn($word) => strtoupper(substr($word, 0, 1)))->implode('') }}
                            </div>
                            <div class="dropdown-name">{{ Auth::User()->user_name ?? 'User' }}</div>
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
                                <span>My Performance</span>
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
                <!-- Welcome Banner -->
                <div class="welcome-banner">
                    <div class="welcome-text">
                        <h2>Welcome back, {{ Auth::User()->user_name ?? 'User' }}! 👋</h2>
                        <p>Ready to test your knowledge? You have 3 pending quizzes.</p>
                    </div>
                    <div class="welcome-stats">
                        <div class="welcome-stat">
                            <div class="stat-value">85%</div>
                            <div class="stat-label">Avg. Score</div>
                        </div>
                        <div class="welcome-stat">
                            <div class="stat-value">24</div>
                            <div class="stat-label">Quizzes Taken</div>
                        </div>
                        <div class="welcome-stat">
                            <div class="stat-value">5</div>
                            <div class="stat-label">Achievements</div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards - User Version -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #10b981;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-value">24</div>
                            <div class="stat-label">Completed Quizzes</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #f59e0b;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-value">3</div>
                            <div class="stat-label">Pending Quizzes</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #4f46e5;">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-value">1560</div>
                            <div class="stat-label">Total Points</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #ef4444;">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-value">7</div>
                            <div class="stat-label">Day Streak</div>
                        </div>
                    </div>
                </div>

                <!-- Progress Section -->
                <div class="progress-section">
                    <div class="progress-header">
                        <h3 class="progress-title">Your Learning Progress</h3>
                        <button class="btn-view-all">
                            View Details <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="progress-grid">
                        <div class="progress-item">
                            <div class="progress-circle">
                                <svg>
                                    <circle class="progress-bg" cx="50" cy="50" r="45"></circle>
                                    <circle class="progress-fill" cx="50" cy="50" r="45"
                                        style="stroke-dashoffset: 70.75;"></circle>
                                </svg>
                                <div class="progress-percent">75%</div>
                            </div>
                            <div class="progress-label">Mathematics</div>
                            <div class="progress-sub">12 quizzes completed</div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-circle">
                                <svg>
                                    <circle class="progress-bg" cx="50" cy="50" r="45"></circle>
                                    <circle class="progress-fill" cx="50" cy="50" r="45"
                                        style="stroke-dashoffset: 113.2; stroke: #f59e0b;"></circle>
                                </svg>
                                <div class="progress-percent">60%</div>
                            </div>
                            <div class="progress-label">Science</div>
                            <div class="progress-sub">8 quizzes completed</div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-circle">
                                <svg>
                                    <circle class="progress-bg" cx="50" cy="50" r="45"></circle>
                                    <circle class="progress-fill" cx="50" cy="50" r="45"
                                        style="stroke-dashoffset: 141.5; stroke: #4f46e5;"></circle>
                                </svg>
                                <div class="progress-percent">50%</div>
                            </div>
                            <div class="progress-label">History</div>
                            <div class="progress-sub">6 quizzes completed</div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-circle">
                                <svg>
                                    <circle class="progress-bg" cx="50" cy="50" r="45"></circle>
                                    <circle class="progress-fill" cx="50" cy="50" r="45"
                                        style="stroke-dashoffset: 198.1; stroke: #ef4444;"></circle>
                                </svg>
                                <div class="progress-percent">30%</div>
                            </div>
                            <div class="progress-label">Programming</div>
                            <div class="progress-sub">4 quizzes completed</div>
                        </div>
                    </div>
                </div>

                <!-- Recommended Quizzes -->
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-star" style="color: #f59e0b;"></i>
                        Recommended for You
                    </h2>
                    <button class="btn-view-all">
                        View All <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                <div class="quiz-grid">
                    <!-- Quiz 1 -->
                    <div class="quiz-card">
                        <div class="quiz-header">
                            <span class="quiz-category">Mathematics</span>
                            <h3>Advanced Calculus</h3>
                            <div class="quiz-meta">
                                <span><i class="fas fa-clock"></i> 30 mins</span>
                                <span><i class="fas fa-question-circle"></i> 25 Qs</span>
                            </div>
                        </div>
                        <div class="quiz-content">
                            <p class="quiz-description">
                                Test your knowledge of derivatives, integrals, and advanced calculus concepts.
                            </p>
                            <div class="quiz-stats">
                                <div class="quiz-stat">
                                    <i class="fas fa-users"></i> 1.2k taken
                                </div>
                                <div class="quiz-stat">
                                    <i class="fas fa-star"></i> 4.8
                                </div>
                                <span class="quiz-difficulty difficulty-advanced">Advanced</span>
                            </div>
                            <button class="btn-start">
                                <i class="fas fa-play"></i> Start Quiz
                            </button>
                        </div>
                    </div>

                    <!-- Quiz 2 -->
                    <div class="quiz-card">
                        <div class="quiz-header">
                            <span class="quiz-category">Science</span>
                            <h3>Human Anatomy</h3>
                            <div class="quiz-meta">
                                <span><i class="fas fa-clock"></i> 20 mins</span>
                                <span><i class="fas fa-question-circle"></i> 20 Qs</span>
                            </div>
                        </div>
                        <div class="quiz-content">
                            <p class="quiz-description">
                                Explore the human body systems, organs, and their functions.
                            </p>
                            <div class="quiz-stats">
                                <div class="quiz-stat">
                                    <i class="fas fa-users"></i> 3.4k taken
                                </div>
                                <div class="quiz-stat">
                                    <i class="fas fa-star"></i> 4.9
                                </div>
                                <span class="quiz-difficulty difficulty-intermediate">Intermediate</span>
                            </div>
                            <button class="btn-start">
                                <i class="fas fa-play"></i> Start Quiz
                            </button>
                        </div>
                    </div>

                    <!-- Quiz 3 -->
                    <div class="quiz-card">
                        <div class="quiz-header">
                            <span class="quiz-category">Programming</span>
                            <h3>Python Basics</h3>
                            <div class="quiz-meta">
                                <span><i class="fas fa-clock"></i> 15 mins</span>
                                <span><i class="fas fa-question-circle"></i> 15 Qs</span>
                            </div>
                        </div>
                        <div class="quiz-content">
                            <p class="quiz-description">
                                Learn Python fundamentals including variables, loops, and functions.
                            </p>
                            <div class="quiz-stats">
                                <div class="quiz-stat">
                                    <i class="fas fa-users"></i> 5.6k taken
                                </div>
                                <div class="quiz-stat">
                                    <i class="fas fa-star"></i> 4.7
                                </div>
                                <span class="quiz-difficulty difficulty-beginner">Beginner</span>
                            </div>
                            <button class="btn-start">
                                <i class="fas fa-play"></i> Start Quiz
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Two Column Layout -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 2rem;">
                    <!-- Achievements -->
                    <div>
                        <div class="section-header">
                            <h2 class="section-title">
                                <i class="fas fa-trophy" style="color: #f59e0b;"></i>
                                Recent Achievements
                            </h2>
                            <button class="btn-view-all">
                                View All <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="badges-grid">
                            <div class="badge-item">
                                <div class="badge-icon">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div class="badge-name">Speed Demon</div>
                                <div class="badge-desc">Completed 5 quizzes in a day</div>
                            </div>
                            <div class="badge-item">
                                <div class="badge-icon">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <div class="badge-name">Perfect Score</div>
                                <div class="badge-desc">100% on 3 quizzes</div>
                            </div>
                            <div class="badge-item">
                                <div class="badge-icon">
                                    <i class="fas fa-fire"></i>
                                </div>
                                <div class="badge-name">7 Day Streak</div>
                                <div class="badge-desc">Taken quiz for 7 days</div>
                            </div>
                            <div class="badge-item">
                                <div class="badge-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="badge-name">Top Performer</div>
                                <div class="badge-desc">Top 10% this month</div>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Quizzes -->
                    <div>
                        <div class="section-header">
                            <h2 class="section-title">
                                <i class="fas fa-calendar" style="color: #4f46e5;"></i>
                                Upcoming Deadlines
                            </h2>
                            <button class="btn-view-all">
                                View All <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="upcoming-list">
                            <div class="upcoming-item">
                                <div class="upcoming-date">
                                    <div class="upcoming-day">15</div>
                                    <div class="upcoming-month">MAR</div>
                                </div>
                                <div class="upcoming-info">
                                    <div class="upcoming-title">World History Final</div>
                                    <div class="upcoming-meta">
                                        <span><i class="fas fa-clock"></i> 45 mins</span>
                                        <span><i class="fas fa-question-circle"></i> 50 Qs</span>
                                    </div>
                                </div>
                                <button class="btn-reminder">
                                    <i class="fas fa-bell"></i>
                                </button>
                            </div>
                            <div class="upcoming-item">
                                <div class="upcoming-date">
                                    <div class="upcoming-day">18</div>
                                    <div class="upcoming-month">MAR</div>
                                </div>
                                <div class="upcoming-info">
                                    <div class="upcoming-title">Chemistry Quiz</div>
                                    <div class="upcoming-meta">
                                        <span><i class="fas fa-clock"></i> 30 mins</span>
                                        <span><i class="fas fa-question-circle"></i> 25 Qs</span>
                                    </div>
                                </div>
                                <button class="btn-reminder">
                                    <i class="fas fa-bell"></i>
                                </button>
                            </div>
                            <div class="upcoming-item">
                                <div class="upcoming-date">
                                    <div class="upcoming-day">20</div>
                                    <div class="upcoming-month">MAR</div>
                                </div>
                                <div class="upcoming-info">
                                    <div class="upcoming-title">JavaScript Basics</div>
                                    <div class="upcoming-meta">
                                        <span><i class="fas fa-clock"></i> 20 mins</span>
                                        <span><i class="fas fa-question-circle"></i> 20 Qs</span>
                                    </div>
                                </div>
                                <button class="btn-reminder">
                                    <i class="fas fa-bell"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="dashboard-footer">
                    <div class="footer-logo">Smart Quiz AI</div>
                    <p>Transform your learning experience with interactive quizzes</p>
                    <p class="copyright">© <?= date('Y') ?> Smart Quiz AI - Learn smarter, not harder</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        const mobileToggle = document.getElementById('mobileToggle');

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            const icon = this.querySelector('i');
            if (sidebar.classList.contains('collapsed')) {
                icon.classList.remove('fa-chevron-left');
                icon.classList.add('fa-chevron-right');
            } else {
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-left');
            }
        });

        // Mobile Toggle
        mobileToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768 && !sidebar.contains(event.target) && !mobileToggle.contains(event
                    .target)) {
                sidebar.classList.remove('active');
            }
        });

        // Dropdown Toggle
        const dropdownToggle = document.getElementById('dropdownToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownCaret = dropdownToggle.querySelector('.dropdown-caret i');

        dropdownToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');

            if (dropdownMenu.classList.contains('show')) {
                dropdownCaret.classList.remove('fa-chevron-down');
                dropdownCaret.classList.add('fa-chevron-up');
            } else {
                dropdownCaret.classList.remove('fa-chevron-up');
                dropdownCaret.classList.add('fa-chevron-down');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            dropdownMenu.classList.remove('show');
            dropdownCaret.classList.remove('fa-chevron-up');
            dropdownCaret.classList.add('fa-chevron-down');
        });

        // Prevent dropdown from closing when clicking inside it
        dropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Menu item active state
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                menuItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');

                // Close sidebar on mobile after clicking a menu item
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('active');
                }
            });
        });

        // Start Quiz buttons
        const startBtns = document.querySelectorAll('.btn-start');
        startBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const quizTitle = this.closest('.quiz-card').querySelector('h3').textContent;
                alert(`Starting "${quizTitle}" quiz!`);
            });
        });

        // Reminder buttons
        const reminderBtns = document.querySelectorAll('.btn-reminder');
        reminderBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const quizTitle = this.closest('.upcoming-item').querySelector('.upcoming-title')
                    .textContent;
                alert(`Reminder set for "${quizTitle}"!`);
            });
        });
    </script>
</body>

</html>
