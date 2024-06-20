@extends('index')

@section('content')

    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col">
                <span><strong>Student ID:</strong> {{ session()->get('student_id') }}</span>
            </div>
            <div class="col">
                <span><strong>Student Name:</strong> {{ session()->get('name') }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span><strong>Standard:</strong> {{ session()->get('std') }}</span>
            </div>
            <div class="col">
                <span><strong>Division:</strong> {{ session()->get('dv') }}</span>
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
                @foreach ($timetable as $time)
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Incrementing serial number -->
                        <td>{{ $time->period }}</td>
                        <td>{{ $time->day }}</td>
                        <td>{{ $time->sname }}</td>
                        <td>{{ $time->teacher_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
