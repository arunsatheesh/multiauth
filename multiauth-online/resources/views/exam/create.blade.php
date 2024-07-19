@extends('dashboard')
@section('exam')
<p>hi this is create exam from create</p>
    <div class="container mt-5">
        <h1>Create Exam</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('exams.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
             <div class="mb-3">
                <label for="name" class="form-label">starting</label>
                <input type="date" class="form-control" id="time" name="time" required>
            </div>
             <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="date" class="form-control" id="name" name="completed" required>
            </div>
           
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
