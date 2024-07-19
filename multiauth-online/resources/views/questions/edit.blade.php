@extends('layout')

@section('content')
    <div class="container mt-5">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('questions.update',['question' => $question->id]) }}" method="POST">
             @csrf
            @method('PUT') {{-- or @method('PATCH') depending on your route definition --}}
            <input type="hidden" name="id" value="{{ $question->question }}" >
            <input type="hidden" name="exam_id" value="{{ $question->exam_id }}" >
            <div class="mb-3">
                <label for="question_text" class="form-label">Question</label>
                <input type="text" class="form-control" id="question" name="question" value="{{ $question->question }}" required>
            </div>
            <div class="mb-3">
                <label for="question_text" class="form-label">Option 1</label>
                <input type="text" class="form-control" id="option_1" name="option1"  value="{{ $question->option1 }}" required>
            </div>
             <div class="mb-3">
                <label for="question_text" class="form-label">Option 2</label>
                <input type="text" class="form-control" id="option_2" name="option2" value="{{ $question->option2 }}" required>
            </div>
             <div class="mb-3">
                <label for="question_text" class="form-label">Option 3</label>
                <input type="text" class="form-control" id="option_3" name="option3" value="{{ $question->option3 }}" required>
            </div>
             <div class="mb-3">
                <label for="question_text" class="form-label">Option 4</label>
                <input type="text" class="form-control" id="option_4" name="option4" value="{{ $question->option4 }}"required>
            </div>
             <div class="mb-3">
                <label for="question_text" class="form-label">Answer key</label>
                <input type="text" class="form-control" id="key" name="key" value="{{ $question->key }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Question</button>
        </form>
    </div>
@endsection
