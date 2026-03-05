<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'AI Quiz App') . ' - Page Unavailable')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS (optional - include if you use Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .container {
            max-width: 800px;
            padding: 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-wrapper {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(102, 126, 234, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }

        .icon-wrapper i {
            font-size: 60px;
            color: white;
        }

        h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .message {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            color: #667eea;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
            border: 1px solid rgba(102, 126, 234, 0.2);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #f8f9ff;
            transform: translateY(-2px);
        }

        .progress-container {
            margin: 30px 0;
            text-align: left;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
        }

        .progress-bar {
            height: 8px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .eta-info {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9ff;
            border-radius: 10px;
            font-size: 14px;
            color: #666;
        }

        .eta-info i {
            color: #667eea;
            margin-right: 8px;
        }

        .footer-links {
            margin-top: 30px;
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #667eea;
        }

        .notification-preferences {
            margin-top: 20px;
            padding: 15px;
            background: #f0f3ff;
            border-radius: 10px;
            display: none;
        }

        .notification-preferences.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .email-input {
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            width: 250px;
            margin-right: 10px;
            font-size: 14px;
        }

        .email-input:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-notify {
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-notify:hover {
            background: #5a6fd8;
        }

        .success-message {
            color: #10b981;
            margin-top: 10px;
            font-size: 14px;
            display: none;
        }

        @media (max-width: 768px) {
            .card {
                padding: 30px 20px;
            }

            h1 {
                font-size: 32px;
            }

            .message {
                font-size: 16px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="icon-wrapper">
                <i class="fas fa-tools"></i>
            </div>

            <div class="status-badge">
                <i class="fas fa-code-branch"></i> Under Development
            </div>

            <h1>{{ $title ?? 'Coming Soon!' }}</h1>

            <div class="message">
                {{ $message ?? 'We\'re working hard to bring you something amazing. This page is currently under construction.' }}
            </div>

            @if (isset($estimatedTime) || isset($progress))
                <div class="progress-container">
                    @if (isset($progress))
                        <div class="progress-label">
                            <span>Progress</span>
                            <span>{{ $progress }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $progress }}%"></div>
                        </div>
                    @endif

                    @if (isset($estimatedTime))
                        <div class="eta-info">
                            <i class="far fa-clock"></i>
                            Estimated completion: <strong>{{ $estimatedTime }}</strong>
                        </div>
                    @endif
                </div>
            @endif

            <div class="action-buttons">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Go Back
                </a>
                @if (auth()->user()->role == 'admin')
                    :
                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-home"></i> Return Home
                    </a>
                @else:
                    <a href="{{ url('/user/dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-home"></i> Return Home
                    </a>
                @endif;
                <button class="btn btn-secondary" onclick="toggleNotification()">
                    <i class="far fa-bell"></i> Notify Me
                </button>
            </div>

            <div class="notification-preferences" id="notificationPrefs">
                <p style="margin-bottom: 15px; color: #333;">
                    <i class="far fa-envelope"></i>
                    Get notified when this feature is ready:
                </p>
                <div style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
                    <input type="email" class="email-input" id="notifyEmail" placeholder="Enter your email"
                        value="{{ auth()->check() ? auth()->user()->email : '' }}">
                    <button class="btn-notify" onclick="subscribeNotification()">
                        <i class="fas fa-paper-plane"></i> Subscribe
                    </button>
                </div>
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    Thanks! We'll notify you when this feature is ready.
                </div>
            </div>

            <div class="footer-links">
                <a>
                    <i class="far fa-question-circle"></i> Need Help?
                </a>
                <a>
                    <i class="far fa-comment"></i> Send Feedback
                </a>
                <a>
                    <i class="fas fa-chart-line"></i> System Status
                </a>
            </div>
        </div>
    </div>

    <script>
        function toggleNotification() {
            const prefs = document.getElementById('notificationPrefs');
            prefs.classList.toggle('show');
        }

        function subscribeNotification() {
            const email = document.getElementById('notifyEmail').value;
            const successMsg = document.getElementById('successMessage');

            if (!email) {
                alert('Please enter your email address');
                return;
            }

            if (!isValidEmail(email)) {
                alert('Please enter a valid email address');
                return;
            }

            // Here you would typically make an AJAX call to your backend
            console.log('Subscribing email:', email);

            // Show success message
            successMsg.style.display = 'block';

            // Clear input
            document.getElementById('notifyEmail').value = '';

            // Hide after 5 seconds
            setTimeout(() => {
                successMsg.style.display = 'none';
                document.getElementById('notificationPrefs').classList.remove('show');
            }, 5000);

            // You can uncomment this to make an actual API call
            /*
            fetch('/api/notify-subscribe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    email: email,
                    page: window.location.pathname
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    successMsg.style.display = 'block';
                }
            });
            */
        }

        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Auto-hide notification panel when clicking outside
        document.addEventListener('click', function(event) {
            const prefs = document.getElementById('notificationPrefs');
            const notifyBtn = event.target.closest('.btn-secondary');

            if (!prefs.contains(event.target) &&
                !notifyBtn &&
                prefs.classList.contains('show')) {
                prefs.classList.remove('show');
            }
        });

        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Optional: Add countdown timer if estimated time is provided
        @if (isset($estimatedTimestamp))
            function updateCountdown() {
                const targetDate = new Date('{{ $estimatedTimestamp }}').getTime();
                const now = new Date().getTime();
                const distance = targetDate - now;

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Update countdown display if you have one
            }

            // Update every second
            setInterval(updateCountdown, 1000);
        @endif
    </script>
</body>

</html>
