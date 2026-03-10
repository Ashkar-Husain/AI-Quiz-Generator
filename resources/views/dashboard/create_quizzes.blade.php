@extends('dashboard.masterLayout.layout')

@section('title', 'Add Quiz')
@section('header-heading')
    Add New Quizzes
@endsection

@section('content')


    <div class="tabs">
        <button class="tab-btn " onclick="switchTab(this,'manual')">
            <i class="fas fa-pen-alt"></i>
            Manual Entry
        </button>
        <button class="tab-btn active" onclick="switchTab(this,'excel')">
            <i class="fas fa-file-excel"></i>
            Excel Upload
        </button>
    </div>



    <div class="card manual active">
        {{-- Add Topics --}}
        {{-- <div onclick="location.href='{{ route('admin.dashboard.add_new_topic') }}'" class="add-new-topics add"> --}}
       <div onclick="window.location='{{ route('admin.dashboard.add_new_topic') }}'" class="add-new-topics add">
            <div class="right-align">
                <span class="plus-icon">+</span>
                Add Topics
            </div>
        </div>
        <div class="quiz-content">
            {{-- ================= MANUAL FORM ================= --}}
            <div id="manual" class="tab-content">



                <form action="{{ route('admin.dashboard.create_quizzes_manual') }}" method="POST">
                    @csrf


                    {{-- Options --}}
                    <div class="row">

                        {{-- Topic --}}

                        <div class="form-group">
                            <label>Select Topic</label>
                            <select name="topic_id" class="form-control" required>
                                <option value="">-- Select Topic --</option>

                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->topic_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Question --}}
                        <div class="form-group">
                            <label>Question</label>
                            <textarea name="question" class="form-control" required></textarea>
                        </div>



                        <div class="col-md-6 form-group">
                            <label>Option 1</label>
                            <input type="text" name="option1" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Option 2</label>
                            <input type="text" name="option2" class="form-control" required>
                        </div>
                        <div class="col-md-6 mt-3 form-group">
                            <label>Option 3</label>
                            <input type="text" name="option3" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Option 4</label>
                            <input type="text" name="option4" class="form-control" required>
                        </div>

                        {{-- Correct Answer --}}
                        <div class="form-group">
                            <label>Correct Answer</label>
                            <select name="correct_answer" class="form-control" required>
                                <option value="">-- Select Correct Option --</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                                <option value="4">Option 4</option>
                            </select>
                        </div>


                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Submit</button>

                </form>
            </div>

        </div>

    </div>


    {{-- Card Excel --}}
    <div class="card excel">

        @if (session('success'))
            <div class="custom-alert success-alert">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="custom-alert error-alert">
                ❌ {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="custom-alert error-alert">
                <ul style="margin:0;padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <div class="tab-content">
            <div class="excel-box">

                <a href="{{ url('/download-template/xlsx') }}" class="btn download-btn">
                    📥 Download Excel (.xlsx)
                </a>

                <a href="{{ url('/download-template/csv') }}" class="btn download-btn">
                    📥 Download CSV (.csv)
                </a>


                <form action="{{ url('/quiz-import') }}" method="POST" enctype="multipart/form-data" class="drop-zone"
                    id="dropZone">
                    @csrf

                    <input type="file" name="excel_file" id="fileInput" hidden required accept=".xlsx,.xls,.csv">

                    <div class="upload-content">
                        <div class="upload-icon">
                            <span class="icon-excel">📊</span>
                        </div>

                        <h4>Upload your Excel file</h4>

                        <div class="upload-text">
                            <p class="drag-text">Drag & drop your file here</p>
                            <span class="separator">or</span>
                        </div>

                        <div class="file-input-wrapper">
                            <button type="button" onclick="document.getElementById('fileInput').click()"
                                class="choose-btn">
                                <span class="btn-icon">📂</span>
                                Browse Files
                            </button>
                            <span class="file-info">Supported: .xlsx, .xls, .csv</span>
                        </div>

                        <div id="fileName" class="file-name">
                            <span class="file-icon">📄</span>
                            <span class="file-text">No file chosen</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
