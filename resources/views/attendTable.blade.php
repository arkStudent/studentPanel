@extends('index')

@section('content')
    <table class="table table-striped table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>Sl.no</th>
                <th>Date</th>
                <th>Day</th>
                <th>Attendance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendance as $index => $record)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $record->date }}</td>
                    <td>{{ $record->std }}</td>
                    <td>{{ $record->atn === 1 ? 'Present' : 'Absent'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
