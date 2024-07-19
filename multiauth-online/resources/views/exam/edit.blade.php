@extends('dashboard')

@section('exam')
    <div class="container mt-5">
        <h1>Edit Exam</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('exams.update', ['exam' => $exams->id]) }}" method="POST">
            @csrf
            @method('PUT') {{-- or @method('PATCH') depending on your route definition --}}
            <input type="hidden" name="id" value="{{ $exams->id }}">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $exams->title }}" required>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">Starting Time</label>
                <input type="date" class="form-control" id="time" name="time" value="{{ $exams->time }}" required>
            </div>

            <div class="mb-3">
                <label for="completed" class="form-label">Completion Time</label>
                <input type="date" class="form-control" id="completed" name="completed" value="{{ $exams->completed }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Exam</button>
        </form>
    </div>
@endsection
