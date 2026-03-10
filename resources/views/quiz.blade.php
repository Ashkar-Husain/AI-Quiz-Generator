<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quizData[0]->topic_name ?? 'Quiz' }} - Smart Quiz AI</title>
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
            --secondary-dark: #0d9488;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --light-color: #f8fafc;
            --dark-color: #1e293b;
            --gray-color: #64748b;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --card-bg: #ffffff;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            color: var(--dark-color);
        }

        .quiz-container {
            width: 100%;
            max-width: 900px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            backdrop-filter: blur(10px);
            animation: slideUp 0.5s ease;
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

        /* Quiz Header */
        .quiz-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .quiz-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .quiz-header-content {
            position: relative;
            z-index: 1;
        }

        .quiz-topic {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .topic-icon {
            width: 50px;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            backdrop-filter: blur(5px);
        }

        .topic-name {
            font-size: 2rem;
            font-weight: 700;
        }

        .quiz-meta {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background-color: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-size: 0.95rem;
            backdrop-filter: blur(5px);
        }

        .topic-description {
            margin-top: 1rem;
            font-size: 1rem;
            opacity: 0.9;
            max-width: 80%;
        }

        /* Quiz Progress */
        .quiz-progress {
            background-color: white;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .progress-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .question-counter {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .score-display {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 30px;
            font-weight: 600;
            box-shadow: var(--shadow);
        }

        .progress-bar-container {
            width: 100%;
            height: 8px;
            background-color: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 4px;
            transition: width 0.3s ease;
            width: 20%;
        }

        /* Quiz Body */
        .quiz-body {
            padding: 2rem;
        }

        /* Question Card */
        .question-card {
            background-color: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .question-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            line-height: 1.4;
        }

        .question-badge {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        /* Options Grid */
        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .option-item {
            background-color: var(--light-color);
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            overflow: hidden;
        }

        .option-item:hover:not(.disabled) {
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .option-item.selected {
            border-color: var(--primary-color);
            background-color: rgba(79, 70, 229, 0.1);
        }

        .option-item.correct {
            border-color: var(--secondary-color);
            background-color: rgba(16, 185, 129, 0.1);
            animation: pulse 0.5s ease;
        }

        .option-item.incorrect {
            border-color: var(--danger-color);
            background-color: rgba(239, 68, 68, 0.1);
            animation: shake 0.5s ease;
        }

        .option-item.disabled {
            cursor: not-allowed;
            opacity: 0.8;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .option-prefix {
            width: 35px;
            height: 35px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--primary-color);
            box-shadow: var(--shadow);
            flex-shrink: 0;
        }

        .option-text {
            flex: 1;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .option-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .option-icon.correct i {
            color: var(--secondary-color);
            font-size: 1.2rem;
        }

        .option-icon.incorrect i {
            color: var(--danger-color);
            font-size: 1.2rem;
        }

        /* Quiz Footer */
        .quiz-footer {
            padding: 2rem;
            background-color: white;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            padding: 0.8rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-option {
            background: none;
            border: none;
            color: var(--gray-color);
            font-size: 1rem;
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.2s;
        }

        .btn-option:hover {
            color: var(--primary-color);
        }

        /* Result Modal */
        .result-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .result-modal.show {
            opacity: 1;
            visibility: visible;
        }

        .result-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px;
            padding: 3rem;
            max-width: 500px;
            width: 90%;
            text-align: center;
            color: white;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .result-modal.show .result-content {
            transform: scale(1);
        }

        .result-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
        }

        .result-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .result-score {
            font-size: 4rem;
            font-weight: 800;
            margin: 1.5rem 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .result-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 2rem 0;
        }

        .stat-circle {
            text-align: center;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .result-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .result-btn {
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-size: 1rem;
        }

        .result-btn-primary {
            background-color: white;
            color: var(--primary-color);
        }

        .result-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .result-btn-outline {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .result-btn-outline:hover {
            background-color: white;
            color: var(--primary-color);
        }

        /* Timer */
        .timer-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .timer {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--light-color);
            padding: 0.5rem 1.2rem;
            border-radius: 30px;
            color: var(--dark-color);
            font-weight: 600;
        }

        .timer.warning {
            color: var(--warning-color);
            animation: pulse 1s infinite;
        }

        .timer.danger {
            color: var(--danger-color);
            animation: pulse 0.5s infinite;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .options-grid {
                grid-template-columns: 1fr;
            }

            .quiz-header {
                padding: 1.5rem;
            }

            .topic-name {
                font-size: 1.5rem;
            }

            .quiz-meta {
                flex-direction: column;
                gap: 0.5rem;
            }

            .topic-description {
                max-width: 100%;
            }

            .quiz-footer {
                flex-direction: column;
                gap: 1rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .result-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    @php
        $topic = $quizData[0] ?? null;
        $totalQuestions = count($quizData);
        $questions = $quizData;
    @endphp

    <div class="quiz-container">
        <!-- Quiz Header -->
        <div class="quiz-header">
            <div class="quiz-header-content">
                <div class="quiz-topic">
                    <div class="topic-icon">
                        <i class="fas {{ $topic->topic_icon ?? 'fa-book-open' }}"></i>
                    </div>
                    <h1 class="topic-name">{{ $topic->topic_name ?? 'Quiz' }}</h1>
                </div>

                <div class="quiz-meta">
                    <div class="meta-item">
                        <i class="fas fa-book"></i>
                        <span>{{ $topic->subject ?? 'General' }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-signal"></i>
                        <span>
                            @switch($topic->difficulty_id ?? 1)
                                @case(1)
                                    Beginner
                                    @break
                                @case(2)
                                    Intermediate
                                    @break
                                @case(3)
                                    Advanced
                                    @break
                                @default
                                    Mixed
                            @endswitch
                        </span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span>{{ $totalQuestions * 1.5 }} mins</span>
                    </div>
                </div>

                @if(!empty($topic->topic_description))
                <p class="topic-description">
                                    <i class="fas fa-info-circle"></i>
                                    {{ $topic->topic_description }}
                                </p>
                @endif
            </div>
        </div>

        <!-- Quiz Progress -->
        <div class="quiz-progress">
            <div class="progress-stats">
                <div class="question-counter">
                    Question <span id="current-question">1</span> of {{ $totalQuestions }}
                </div>
                <div class="score-display" id="score-display">
                    Score: <span id="score">0</span>/{{ $totalQuestions }}
                </div>
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar-fill" id="progress-bar" style="width: {{ (1/$totalQuestions)*100 }}%"></div>
            </div>
        </div>

        <!-- Quiz Body -->
        <div class="quiz-body" id="quiz-body">
            <!-- Questions will be dynamically loaded here -->
        </div>

        <!-- Quiz Footer -->
        <div class="quiz-footer">
            <button class="btn-outline" id="prevBtn" disabled>
                <i class="fas fa-arrow-left"></i> Previous
            </button>

            <div class="timer-container">
                <div class="timer" id="timer">
                    <i class="fas fa-hourglass-half"></i>
                    <span id="timer-display">15:00</span>
                </div>
            </div>

            <button class="btn-primary" id="nextBtn">
                Next <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>

    <!-- Result Modal -->
    <div class="result-modal" id="resultModal">
        <div class="result-content">
            <div class="result-icon">
                <i class="fas fa-trophy"></i>
            </div>
            <h2 class="result-title">Quiz Completed!</h2>
            <div class="result-score" id="result-score">0/{{ $totalQuestions }}</div>
            <div class="result-stats">
                <div class="stat-circle">
                    <div class="stat-value" id="correct-count">0</div>
                    <div class="stat-label">Correct</div>
                </div>
                <div class="stat-circle">
                    <div class="stat-value" id="incorrect-count">0</div>
                    <div class="stat-label">Incorrect</div>
                </div>
                <div class="stat-circle">
                    <div class="stat-value" id="accuracy">0%</div>
                    <div class="stat-label">Accuracy</div>
                </div>
            </div>
            <div class="result-actions">
                <button class="result-btn result-btn-primary" >
                    <i class="fas fa-home"></i> Go to Dashboard
                </button>
                <button class="result-btn result-btn-outline" onclick="location.reload()">
                    <i class="fas fa-redo"></i> Try Again
                </button>
            </div>
        </div>
    </div>

    <script>
        //* Quiz data from Laravel
        const quizData = @json($quizData);
        console.log(quizData);

        const totalQuestions = {{ $totalQuestions }};

        // Quiz state
        let currentQuestionIndex = 0;
        let score = 0;
        let userAnswers = new Array(totalQuestions).fill(null);
        console.log(userAnswers);

        let quizCompleted = false;

        // Timer
        let timeLeft = totalQuestions * 90; // 1.5 minutes per question in seconds
        let timerInterval;

        // DOM elements
        const quizBody = document.getElementById('quiz-body');
        const currentQuestionSpan = document.getElementById('current-question');
        const scoreSpan = document.getElementById('score');
        const progressBar = document.getElementById('progress-bar');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const timerDisplay = document.getElementById('timer-display');
        const timerElement = document.querySelector('.timer');
        const resultModal = document.getElementById('resultModal');

        // Initialize quiz
        function initQuiz() {
            displayQuestion(currentQuestionIndex);
            startTimer();
            updateNavButtons();
        }

        // Display question
        function displayQuestion(index) {
            const question = quizData[index];

            let options = [
                { text: question.option_1, value: 1 },
                { text: question.option_2, value: 2 },
                { text: question.option_3, value: 3 },
                { text: question.option_4, value: 4 }
            ];

            let optionsHtml = '';
            const letters = ['A', 'B', 'C', 'D'];

            options.forEach((option, i) => {
                const isSelected = userAnswers[index] == option.value;
                const isCorrect = option.value == question.correct_option;
                const showResult = userAnswers[index] !== null;

                let optionClass = 'option-item';
                if (showResult) {
                    if (isCorrect) {
                        optionClass += ' correct';
                    } else if (isSelected && !isCorrect) {
                        optionClass += ' incorrect';
                    }
                } else if (isSelected) {
                    optionClass += ' selected';
                }

                if (showResult) {
                    optionClass += ' disabled';
                }

                let iconHtml = '';
                if (showResult) {
                    if (isCorrect) {
                        iconHtml = '<div class="option-icon correct"><i class="fas fa-check-circle"></i></div>';
                    } else if (isSelected && !isCorrect) {
                        iconHtml = '<div class="option-icon incorrect"><i class="fas fa-times-circle"></i></div>';
                    }
                }

                optionsHtml += `
                    <div class="${optionClass}" onclick="selectOption(${index}, ${option.value})">
                        <div class="option-prefix">${letters[i]}</div>
                        <div class="option-text">${option.text}</div>
                        ${iconHtml}
                    </div>
                `;
            });

            const questionHtml = `
                <div class="question-card">
                    <span class="question-badge">Question ${index + 1}</span>
                    <h2 class="question-text">${question.question}</h2>
                    <div class="options-grid">
                        ${optionsHtml}
                    </div>
                </div>
            `;

            quizBody.innerHTML = questionHtml;
            currentQuestionSpan.textContent = index + 1;
            updateProgressBar();
        }

        // Select option
        window.selectOption = function(questionIndex, optionValue) {
            if (userAnswers[questionIndex] !== null || quizCompleted) return;

            const question = quizData[questionIndex];

            // Save answer
            userAnswers[questionIndex] = optionValue;

            // Update score if correct
            if (optionValue == question.correct_option) {
                score++;
                scoreSpan.textContent = score;
            }

            // Redisplay question with results
            displayQuestion(questionIndex);

            // Auto advance after 1.5 seconds
            if (questionIndex < totalQuestions - 1) {
                setTimeout(() => {
                    if (questionIndex == currentQuestionIndex) {
                        nextQuestion();
                    }
                }, 1500);
            } else {
                setTimeout(() => {
                    if (questionIndex == currentQuestionIndex) {
                        finishQuiz();
                    }
                }, 1500);
            }
        };

        // Next question
        function nextQuestion() {
            if (currentQuestionIndex < totalQuestions - 1) {
                currentQuestionIndex++;
                displayQuestion(currentQuestionIndex);
                updateNavButtons();
            } else if (currentQuestionIndex === totalQuestions - 1 && !quizCompleted) {
                finishQuiz();
            }
        }

        // Previous question
        function previousQuestion() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                displayQuestion(currentQuestionIndex);
                updateNavButtons();
            }
        }

        // Update navigation buttons
        function updateNavButtons() {
            prevBtn.disabled = currentQuestionIndex === 0;

            if (currentQuestionIndex === totalQuestions - 1) {
                nextBtn.innerHTML = 'Finish <i class="fas fa-check-circle"></i>';
            } else {
                nextBtn.innerHTML = 'Next <i class="fas fa-arrow-right"></i>';
            }

            // Disable next button if current question not answered
            nextBtn.disabled = userAnswers[currentQuestionIndex] === null && !quizCompleted;
        }

        // Update progress bar
        function updateProgressBar() {
            const progress = ((currentQuestionIndex + 1) / totalQuestions) * 100;
            progressBar.style.width = `${progress}%`;
        }

        // Start timer
        function startTimer() {
            timerInterval = setInterval(() => {
                if (quizCompleted) {
                    clearInterval(timerInterval);
                    return;
                }

                timeLeft--;

                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

                // Warning classes
                if (timeLeft <= 60) {
                    timerElement.classList.add('danger');
                } else if (timeLeft <= 180) {
                    timerElement.classList.add('warning');
                }

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    finishQuiz();
                }
            }, 1000);
        }

        // Finish quiz
        function finishQuiz() {
            quizCompleted = true;
            clearInterval(timerInterval);

            // Calculate final stats
            const correctAnswers = userAnswers.filter((answer, index) =>
                answer == quizData[index].correct_option
            ).length;

            const incorrectAnswers = userAnswers.filter(answer => answer !== null).length - correctAnswers;
            const accuracy = Math.round((correctAnswers / totalQuestions) * 100);

            // Update result modal
            document.getElementById('result-score').textContent = `${correctAnswers}/${totalQuestions}`;
            document.getElementById('correct-count').textContent = correctAnswers;
            document.getElementById('incorrect-count').textContent = incorrectAnswers;
            document.getElementById('accuracy').textContent = `${accuracy}%`;

            // Show modal
            resultModal.classList.add('show');
        }

        // Event listeners
        prevBtn.addEventListener('click', previousQuestion);
        nextBtn.addEventListener('click', nextQuestion);

        // Initialize quiz
        initQuiz();
    </script>
</body>

</html>
