{{-- @extends('layouts.app') --}}


<div class="container" style="max-width: 600px; margin-top: 40px;">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            <h3 class="text-center mb-3">Quiz Setup</h3>

            <p class="text-center text-muted">
                We analyzed your PDF and can generate up to
                <strong>{{ session('max_questions') }}</strong> questions.
            </p>
{{--  --}}
            <form action="{{ route('quiz.start') }}" method="POST">
                @csrf

                {{-- Number of Questions --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Number of Questions</label>
                    <select name="total_questions" class="form-select" required>
                        @for ($i = 5; $i <= session('max_questions'); $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                {{-- Difficulty --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Difficulty Level</label>
                    <select name="difficulty" class="form-select" required>
                        <option value="easy">Easy</option>
                        <option value="medium" selected>Medium</option>
                        <option value="hard">Hard</option>
                    </select>
                </div>

                {{-- Submit --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg">
                        🚀 Start Quiz
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

