@extends('/dashboard/masterLayout/layout')

{{-- Dynamic Title --}}
@section('title')
    Dashboard - AI Quiz App
@endsection

@section('header-heading')
    Dashboard
@endsection

{{-- Dynamic Content --}}
@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #4f46e5;">
                <i class="fas fa-file-pdf"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">24</div>
                <div class="stat-label">PDFs Processed</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 12% from last month
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background-color: #10b981;">
                <i class="fas fa-question-circle"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">156</div>
                <div class="stat-label">Quizzes Generated</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 8% from last month
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background-color: #f59e0b;">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">342</div>
                <div class="stat-label">Active Students</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 15% from last month
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background-color: #ef4444;">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">92%</div>
                <div class="stat-label">Avg. Quiz Score</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 5% from last month
                </div>
            </div>
        </div>

        {{-- extra --}}
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #4f46e5;">
                <i class="fas fa-file-pdf"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">24</div>
                <div class="stat-label">PDFs Processed</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 12% from last month
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <div class="quick-action-btn">
            <i class="fas fa-file-upload"></i>
            <span>Upload PDF</span>
        </div>
        {{-- Create Quiz --}}
        <div onclick="location.href=' {{ route('admin.dashboard.add_quiz') }} '" class="quick-action-btn">
            <i class="fas fa-plus-circle"></i>
            <span>Create Quiz</span>
        </div>
        <div onclick="location.href=' {{ route('admin.dashboard.add_users') }} '"  class="quick-action-btn">
            <i class="fas fa-user-plus"></i>
            <span>Add Users</span>
        </div>
        <div class="quick-action-btn">
            <i class="fas fa-chart-pie"></i>
            <span>View Reports</span>
        </div>
    </div>

    <!-- Recent Quizzes -->
    <div class="section-header">
        <h2 class="section-title">Recent Quizzes</h2>
        <button class="btn-view-all">
            View All <i class="fas fa-arrow-right"></i>
        </button>
    </div>

    <div class="thumbnails-grid">
        <!-- Quiz 1 -->
        <div class="thumbnail-card">
            <div class="thumbnail-img">
                <i class="fas fa-history"></i>
                <div class="pdf-icon">PDF</div>
            </div>
            <div class="thumbnail-content">
                <h3 class="thumbnail-title">World History Quiz</h3>
                <p class="thumbnail-desc">A comprehensive quiz covering major world history events from
                    ancient civilizations to modern times.</p>
                <div class="thumbnail-meta">
                    <span><i class="fas fa-calendar"></i> 2 days ago</span>
                    <span><i class="fas fa-users"></i> 45 attempts</span>
                </div>
                <div class="thumbnail-actions">
                    <button class="btn-action btn-primary">
                        <i class="fas fa-play"></i> Take Quiz
                    </button>
                    <button class="btn-action btn-outline">
                        <i class="fas fa-chart-bar"></i> Analytics
                    </button>
                </div>
            </div>
        </div>

        <!-- Quiz 2 -->
        <div class="thumbnail-card">
            <div class="thumbnail-img">
                <i class="fas fa-flask"></i>
                <div class="pdf-icon">PDF</div>
            </div>
            <div class="thumbnail-content">
                <h3 class="thumbnail-title">Chemistry Basics</h3>
                <p class="thumbnail-desc">Test your knowledge of basic chemistry concepts including
                    elements, compounds, and reactions.</p>
                <div class="thumbnail-meta">
                    <span><i class="fas fa-calendar"></i> 1 week ago</span>
                    <span><i class="fas fa-users"></i> 78 attempts</span>
                </div>
                <div class="thumbnail-actions">
                    <button class="btn-action btn-primary">
                        <i class="fas fa-play"></i> Take Quiz
                    </button>
                    <button class="btn-action btn-outline">
                        <i class="fas fa-chart-bar"></i> Analytics
                    </button>
                </div>
            </div>
        </div>

        <!-- Quiz 3 -->
        <div class="thumbnail-card">
            <div class="thumbnail-img">
                <i class="fas fa-code"></i>
                <div class="pdf-icon">PDF</div>
            </div>
            <div class="thumbnail-content">
                <h3 class="thumbnail-title">JavaScript Fundamentals</h3>
                <p class="thumbnail-desc">Quiz covering JavaScript basics including variables, functions,
                    loops, and DOM manipulation.</p>
                <div class="thumbnail-meta">
                    <span><i class="fas fa-calendar"></i> 2 weeks ago</span>
                    <span><i class="fas fa-users"></i> 112 attempts</span>
                </div>
                <div class="thumbnail-actions">
                    <button class="btn-action btn-primary">
                        <i class="fas fa-play"></i> Take Quiz
                    </button>
                    <button class="btn-action btn-outline">
                        <i class="fas fa-chart-bar"></i> Analytics
                    </button>
                </div>
            </div>
        </div>

        {{-- extra quizzes --}}
        <!-- Quiz 2 -->
        <div class="thumbnail-card">
            <div class="thumbnail-img">
                <i class="fas fa-flask"></i>
                <div class="pdf-icon">PDF</div>
            </div>
            <div class="thumbnail-content">
                <h3 class="thumbnail-title">Chemistry Basics</h3>
                <p class="thumbnail-desc">Test your knowledge of basic chemistry concepts including
                    elements, compounds, and reactions.</p>
                <div class="thumbnail-meta">
                    <span><i class="fas fa-calendar"></i> 1 week ago</span>
                    <span><i class="fas fa-users"></i> 78 attempts</span>
                </div>
                <div class="thumbnail-actions">
                    <button class="btn-action btn-primary">
                        <i class="fas fa-play"></i> Take Quiz
                    </button>
                    <button class="btn-action btn-outline">
                        <i class="fas fa-chart-bar"></i> Analytics
                    </button>
                </div>
            </div>
        </div>

        <!-- Quiz 3 -->
        <div class="thumbnail-card">
            <div class="thumbnail-img">
                <i class="fas fa-code"></i>
                <div class="pdf-icon">PDF</div>
            </div>
            <div class="thumbnail-content">
                <h3 class="thumbnail-title">JavaScript Fundamentals</h3>
                <p class="thumbnail-desc">Quiz covering JavaScript basics including variables, functions,
                    loops, and DOM manipulation.</p>
                <div class="thumbnail-meta">
                    <span><i class="fas fa-calendar"></i> 2 weeks ago</span>
                    <span><i class="fas fa-users"></i> 112 attempts</span>
                </div>
                <div class="thumbnail-actions">
                    <button class="btn-action btn-primary">
                        <i class="fas fa-play"></i> Take Quiz
                    </button>
                    <button class="btn-action btn-outline">
                        <i class="fas fa-chart-bar"></i> Analytics
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="section-header">
        <h2 class="section-title">Recent Activity</h2>
        <button class="btn-view-all">
            View All <i class="fas fa-arrow-right"></i>
        </button>
    </div>

    <div class="activity-list">
        <div class="activity-item">
            <div class="activity-icon" style="background-color: #4f46e5;">
                <i class="fas fa-file-upload"></i>
            </div>
            <div class="activity-content">
                <div class="activity-title">Uploaded "Advanced Mathematics" PDF</div>
                <div class="activity-time">2 hours ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon" style="background-color: #10b981;">
                <i class="fas fa-question-circle"></i>
            </div>
            <div class="activity-content">
                <div class="activity-title">Generated quiz from "Biology Textbook"</div>
                <div class="activity-time">Yesterday, 3:42 PM</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon" style="background-color: #f59e0b;">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="activity-content">
                <div class="activity-title">Added 15 new students to "History Class"</div>
                <div class="activity-time">2 days ago</div>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon" style="background-color: #ef4444;">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="activity-content">
                <div class="activity-title">Viewed analytics for "Chemistry Basics" quiz</div>
                <div class="activity-time">3 days ago</div>
            </div>
        </div>
    </div>
@endsection
