@extends('userdashboard')
@section('details')
<p>hi are you ready for exam </p>
@foreach($exams as $exam)
<a href="{{route('userdashboard.exam',['exam' => $exam->id])}}" class="form-control">{{$exam->title}}</a>
@endforeach
@endsection