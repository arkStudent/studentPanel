@extends('index')

@section('content')

    <div class="container">
        <div class="container row">
            <div>
                <span>Student Id: {{ session()->get('user.student_id') }}</span>
            </div>
            <div>
                <span>Student Name: {{ session()->get('user.name') }}</span>
            </div>
        </div>
        <div class="container row">
            <div>
                <span>Standard: </span>
            </div>
            <div>
                <span>Division: </span>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <h3>Time Table</h3>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Period</th>
                    <th>Day</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($timetable as $time) --}}
                <tr>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                </tr>
                <tr>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                </tr>
                <tr>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>


@endsection