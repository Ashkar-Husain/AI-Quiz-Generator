<div class="container">
    <div class="upload-card">
        <h2>Upload PDF for Quiz</h2>

        <form action="{{ route('admin.dashboard.upload_pdf.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="upload-box">
                <input type="file" name="pdf" accept="application/pdf" required>
                <p>Only PDF allowed (Max 10MB)</p>
            </div>

            <button class="btn-primary">Upload & Analyze</button>
        </form>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
</div>
