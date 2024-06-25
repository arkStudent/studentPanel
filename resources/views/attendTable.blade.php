@extends('index')

@section('content')
    <div class="container mt-4 top-content">
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
        <center><h3>Attendance</h3></center>
        <table class="table table-striped table-bordered text-center mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Sl.no</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendance as $index => $record)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $record->date }}</td>
                        <td>{{ $record->std }}</td>
                        <td>{{ $record->atn === 1 ? 'Present' : 'Absent' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
