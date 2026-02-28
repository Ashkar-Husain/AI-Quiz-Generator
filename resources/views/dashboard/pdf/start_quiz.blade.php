<div class="container" style="max-width: 900px; margin-top: 40px;">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">📝 Quiz Started</h3>
                <span class="badge bg-primary fs-6">
                    Total Questions: {{ count($questions) }}
                </span>
            </div>

            <form method="POST" action="#">
                @csrf

                @foreach ($questions as $index => $q)
                    <div class="mb-4 p-4 border rounded-4 quiz-question">

                        {{-- Question --}}
                        <h5 class="mb-3">
                            Q{{ $index + 1 }}. {{ $q['question'] }}
                        </h5>

                        {{-- Options --}}
                        @foreach ($q['options'] as $optIndex => $option)
                            <div class="form-check mb-2">
                                <input class="form-check-input"
                                       type="radio"
                                       name="answers[{{ $index }}]"
                                       id="q{{ $index }}_{{ $optIndex }}"
                                       value="{{ $optIndex }}"
                                       required>

                                <label class="form-check-label"
                                       for="q{{ $index }}_{{ $optIndex }}">
                                    {{ chr(65 + $optIndex) }}. {{ $option }}
                                </label>
                            </div>
                        @endforeach

                    </div>
                @endforeach

                {{-- Submit --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        ✅ Submit Quiz
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
