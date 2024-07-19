@extends('layout')

@section('content')
    <div class="container mt-5">
            <h1>Questions for Exam: {{ $exams->title }}</h1>
            <a href="{{ route('questions.create', ['exams' => $exams->id]) }}" class="btn btn-primary mb-3">Add Question</a>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($questions->isNotEmpty())
                    @foreach($questions as $question)
                        <tr>
                            <td>{{ $question->id }}</td>
                            <td>{{ $question->question }}</td>
                            <td>
                                <a href="{{ route('questions.edit', [ 'question' => $question->id]) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('questions.destroy', ['exams' => $exams->id, 'question' => $question->id]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No questions are created for this exam.</td>
                    </tr>
                @endif
            </tbody>
        </table>
       
    </div>
@endsection
