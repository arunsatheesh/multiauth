@extends('dashboard')
@section('exam')
<p>hi this is <a href="{{route('exam.create')}}" class="btn btn-primary mb-3" >create</a>exam from index</p>

    <div class="container mt-5">
        <h1>Exams</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Question</th>
                    <th>Time</th>
                    <th>Completed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($exams as $exam)
                    <tr>
                        <td>{{ $exam->id }}</td>
                        <td>{{ $exam->title }}</td>
                        <td><a href="{{ route('questions.index', ['id' => $exam->id]) }}" class="btn btn-warning">create question</a></td>
                        <td>{{ $exam->time }}</td>
                        <td>{{ $exam->completed }}</td>
                        <td>
                            <a href="{{ route('exams.edit',['exam' => $exam->id]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('exams.destroy', $exam->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
