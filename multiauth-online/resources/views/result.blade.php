@extends('userdashboard')

@section('details')
<p>Hi, are you ready for your exam score?</p>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
</style>

<table>
    <thead>
        <tr>
            <th>SI.No</th>
            <th>User ID</th>
            <th>Exam ID</th>
            <th>Score</th>
            <th>Time</th>
        </tr>
    </thead>
    @foreach($results as $result)
    <tbody>
        <tr>
            <td>{{ $result->id }}</td>
            <td>{{ $result->user_id }}</td>
            <td>{{ $result->exam }}</td>
            <td>{{ $result->score }}</td>
            <td>{{ $result->created_at }}</td>
        </tr>
    </tbody>
    @endforeach
</table>

@endsection
