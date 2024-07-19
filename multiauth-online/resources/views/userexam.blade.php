@extends('userdashboard')

@section('details')
<div id="timer" style="font-size: 20px; font-weight: bold;"></div>
<p>Ready for the exam</p>

<form id="exam-form" action="{{ route('userdashboard.resultviews', ['exam' => $exams->first()->id ?? 0]) }}" method="POST">
    @csrf

    <!-- Hidden inputs to store choices from the session -->
    @foreach(session('choices', []) as $key => $choice)
        <input type="hidden" name="stored_choice[{{ $key }}]" value="{{ $choice }}">
    @endforeach

    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exams as $index => $exam)
            <tr>
                <td>
                    <div>
                        <h2>{{ $exam->title }}</h2>
                        <p>{{ $exam->question }}</p>
                    </div>
                </td>
                <td>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="exam_id[]" value="{{ $exam->exam_id }}">
                    <input type="hidden" name="key[{{ $index }}]" value="{{ $exam->key }}">

                    <div class="form-check">
                        <input type="radio" id="ch1_{{ $index }}" name="choice[{{ $index }}]" value="1" class="form-check-input">
                        <label for="ch1_{{ $index }}" class="form-check-label">{{ $exam->option1 }}</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="ch2_{{ $index }}" name="choice[{{ $index }}]" value="2" class="form-check-input">
                        <label for="ch2_{{ $index }}" class="form-check-label">{{ $exam->option2 }}</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="ch3_{{ $index }}" name="choice[{{ $index }}]" value="3" class="form-check-input">
                        <label for="ch3_{{ $index }}" class="form-check-label">{{ $exam->option3 }}</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="ch4_{{ $index }}" name="choice[{{ $index }}]" value="4" class="form-check-input">
                        <label for="ch4_{{ $index }}" class="form-check-label">{{ $exam->option4 }}</label>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="btn btn-primary">Save Answers</button>
</form>

<script>
    // Timer logic
    var timer = 60 * 5; // 5 minutes in seconds
    var timerDisplay = document.getElementById('timer');
    var interval = setInterval(function() {
        var minutes = Math.floor(timer / 60);
        var seconds = timer % 60;
        timerDisplay.textContent = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
        timer--;

        if (timer < 0) {
            clearInterval(interval);
            // You may want to auto-submit the form here when time is up
            // document.getElementById('exam-form').submit();
            alert("Time is up!");
        }
    }, 1000);
</script>
@endsection
