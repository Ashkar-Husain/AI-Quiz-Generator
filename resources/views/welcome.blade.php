<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Quiz AI - PDF to Quiz Generator</title>
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
            --gray-color: #64748b;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            background-color: #f1f5f9;
            color: var(--dark-color);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        header {
            background-color: white;
            padding: 1rem 5%;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
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
        }

        .app-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-size: 1rem;
        }

        .btn-login {
            background-color: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-signup {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-login:hover,
        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Main Content */
        main {
            flex: 1;
            padding: 2rem 5%;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .hero-section {
            text-align: center;
            padding: 3rem 0;
            max-width: 800px;
            margin: 0 auto 3rem;
        }

        .hero-title {
            font-size: 2.8rem;
            margin-bottom: 1rem;
            color: var(--primary-dark);
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--gray-color);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .highlight {
            color: var(--primary-color);
            font-weight: 700;
        }

        /* Thumbnails Grid */
        .thumbnails-section {
            margin-bottom: 3rem;
        }

        .section-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--dark-color);
        }

        .thumbnails-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .thumbnail-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .thumbnail-card:hover {
            transform: translateY(-8px);
        }

        .thumbnail-img {
            height: 180px;
            background-color: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .thumbnail-img i {
            font-size: 4rem;
            color: var(--primary-color);
        }

        .pdf-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .thumbnail-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .thumbnail-title {
            font-size: 1.3rem;
            margin-bottom: 0.8rem;
            color: var(--dark-color);
        }

        .thumbnail-desc {
            color: var(--gray-color);
            margin-bottom: 1.5rem;
            flex: 1;
        }

        .thumbnail-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .tag {
            background-color: #e0e7ff;
            color: var(--primary-color);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .btn-generate {
            background-color: var(--secondary-color);
            color: white;
            width: 100%;
            padding: 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            display: block;
            text-decoration: none;
        }

        /* Features Section */
        .features-section {
            background-color: white;
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            margin-top: 2rem;
        }

        .features-title {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: var(--primary-dark);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature-item {
            text-align: center;
            padding: 1rem;
        }

        .feature-icon {
            background-color: #e0e7ff;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--primary-color);
            font-size: 1.8rem;
        }

        .feature-title {
            font-size: 1.2rem;
            margin-bottom: 0.8rem;
            color: var(--dark-color);
        }

        /* Footer */
        footer {
            background-color: var(--dark-color);
            color: white;
            text-align: center;
            padding: 2rem 5%;
            margin-top: 3rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: white;
        }

        .copyright {
            color: #cbd5e1;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .thumbnails-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 1.5rem;
            }

            .auth-buttons {
                gap: 0.5rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .features-section {
                padding: 1.5rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .thumbnails-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.6rem;
            }

            .app-name {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
   <header>
        <nav class="navbar">
            <div class="logo-container">
                <div class="logo">SQ</div>
                <h1 class="app-name">Smart Quiz AI</h1>
            </div>
            <div class="auth-buttons">
                <button onclick="window.location.href = '{{ route('login') }}'" class="btn btn-login">Login</button>
                <button onclick="window.location.href = '{{ route('signup') }}'" class="btn btn-signup">Sign Up</button>
            </div>
        </nav>
    </header>




    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero-section">
            <h2 class="hero-title">Transform Your PDFs into Interactive Quizzes</h2>
            <p class="hero-subtitle">Upload any PDF document and let our AI generate customized quizzes for education,
                training, or assessment in seconds.</p>
        </section>

        <!-- Thumbnails Section -->
        <section class="thumbnails-section">
            <h2 class="section-title">Recent Quiz Generations</h2>
            <div class="thumbnails-grid">
                <!-- Thumbnail 1 -->
                <div class="thumbnail-card">
                    <div class="thumbnail-img">
                        <i class="fas fa-file-alt"></i>
                        <div class="pdf-icon">PDF</div>
                    </div>
                    <div class="thumbnail-content">
                        <h3 class="thumbnail-title">History of Ancient Civilizations</h3>
                        <p class="thumbnail-desc">A comprehensive quiz covering ancient Egyptian, Greek, and Roman
                            civilizations with multiple choice and true/false questions.</p>
                        <div class="thumbnail-tags">
                            <span class="tag">History</span>
                            <span class="tag">15 Questions</span>
                            <span class="tag">Medium Difficulty</span>
                        </div>
                        <a href="#" class="btn btn-generate">Generate Similar Quiz</a>
                    </div>
                </div>

                <!-- Thumbnail 2 -->
                <div class="thumbnail-card">
                    <div class="thumbnail-img">
                        <i class="fas fa-flask"></i>
                        <div class="pdf-icon">PDF</div>
                    </div>
                    <div class="thumbnail-content">
                        <h3 class="thumbnail-title">Basic Chemistry Concepts</h3>
                        <p class="thumbnail-desc">Test your knowledge of atomic structure, chemical bonds, and reactions
                            with this interactive quiz.</p>
                        <div class="thumbnail-tags">
                            <span class="tag">Chemistry</span>
                            <span class="tag">20 Questions</span>
                            <span class="tag">Advanced</span>
                        </div>
                        <a href="#" class="btn btn-generate">Generate Similar Quiz</a>
                    </div>
                </div>

                <!-- Thumbnail 3 -->
                <div class="thumbnail-card">
                    <div class="thumbnail-img">
                        <i class="fas fa-code"></i>
                        <div class="pdf-icon">PDF</div>
                    </div>
                    <div class="thumbnail-content">
                        <h3 class="thumbnail-title">JavaScript Fundamentals</h3>
                        <p class="thumbnail-desc">A quiz for beginners covering variables, functions, loops, and basic
                            DOM manipulation in JavaScript.</p>
                        <div class="thumbnail-tags">
                            <span class="tag">Programming</span>
                            <span class="tag">10 Questions</span>
                            <span class="tag">Beginner</span>
                        </div>
                        <a href="#" class="btn btn-generate">Generate Similar Quiz</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <h2 class="features-title">Why Choose Smart Quiz AI?</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3 class="feature-title">AI-Powered Generation</h3>
                    <p>Our advanced AI analyzes your PDF content and creates relevant, accurate quiz questions
                        automatically.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="feature-title">Fast Processing</h3>
                    <p>Generate quizzes from your PDFs in under 60 seconds. No manual question creation needed.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                    <h3 class="feature-title">Customizable Output</h3>
                    <p>Adjust difficulty, number of questions, and question types to match your specific needs.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Performance Analytics</h3>
                    <p>Track quiz results and participant performance with detailed analytics and reporting.</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-logo">Smart Quiz AI</div>
            <p>Transform your documents into engaging learning experiences</p>
            <p class="copyright">© <?= date('Y') ?> Smart Quiz AI - PDF to Quiz Generator. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
