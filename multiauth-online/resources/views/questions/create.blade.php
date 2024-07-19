@extends('layout')

@section('content')
    <div class="container mt-5">
        <h1>Add Question to Exam: {{ $exams->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('questions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="question_text" class="form-label">Question</label>
                <input type="text" class="form-control" id="question" name="question" required>
            </div>
            <input type="hidden" name="exam_id" value="{{$exams->id}}">
            <div class="mb-3">
                <label for="question_text" class="form-label">Option 1</label>
                <input type="text" class="form-control" id="option_1" name="option1" required>
            </div>
             <div class="mb-3">
                <label for="question_text" class="form-label">Option 2</label>
                <input type="text" class="form-control" id="option_2" name="option2" required>
            </div>
             <div class="mb-3">
                <label for="question_text" class="form-label">Option 3</label>
                <input type="text" class="form-control" id="option_3" name="option3" required>
            </div>
             <div class="mb-3">
                <label for="question_text" class="form-label">Option 4</label>
                <input type="text" class="form-control" id="option_4" name="option4" required>
            </div>
             <div class="mb-3">
                <label for="question_text" class="form-label">Answer key</label>
                <input type="text" class="form-control" id="key" name="key" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Question</button>
        </form>
    </div>
@endsection
