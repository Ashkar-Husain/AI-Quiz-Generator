@extends('dashboard.masterLayout.layout')

@section('title', 'Add Topics')
@section('header-heading', 'Add New Topics')

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
        <div class="quiz-content">
            {{-- ================= MANUAL FORM ================= --}}
            <div id="manual" class="tab-content">

                @if (session('success'))
                    <div style="color: green">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.create.add_new_user') }}" method="POST" autocomplete="off">
                    @csrf

                    <div class="row">

                        {{-- Topic --}}
                        <div class="form-group">
                            <label>Topic<span class="error">*</span></label>
                            <input autocomplete="off" name="topic"
                                class="form-control @error('topic') is-invalid @enderror" value="{{ old('topic') }}"
                                placeholder="eg. Advanced Calculous">

                            @error('topic')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Subject --}}
                        <div class="col-md-6 form-group">
                            <label>Subject<span class="error">*</span></label>
                            <input autocomplete="off" type="text" name="subject"
                                class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}"
                                placeholder="eg. Mathematics">

                            @error('subject')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Difficulty --}}
                        <div class="col-md-6 form-group">
                            <label>Difficulty<span class="error">*</span></label>
                            <select name="difficulty" autocomplete="off"
                                class="form-control @error('difficulty') is-invalid @enderror">

                                <option value="">-- Select --</option>

                                @foreach ($difficulties as $difficulty)
                                    <option value="{{ $difficulty['difficulty_id'] }}">
                                        {{ $difficulty['difficulty'] }}
                                    </option>
                                @endforeach

                            </select>
                            @error('difficulty')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Font Icon --}}
                        <div class="col-md-6 mt-3 form-group">
                            <label>Icon<small class="error"> (Font Awesome 6.4.0)</small></label>
                            <input type="text" name="font_icon" class="form-control" autocomplete="off"
                                placeholder='<i class="fa-solid fa-calculator"></i>'>
                        </div>

                        <div class="col-md-12 mt-3 form-group full">
                            <label>
                                Description
                                <small class="error">*</small>
                            </label>

                            <textarea name="description" class="form-control" autocomplete="off"
                                placeholder="Enter description here..."></textarea>
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
