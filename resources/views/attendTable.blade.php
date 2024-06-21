@extends('index')

@section('content')
    <div class="container">
        <h5 class="text-center">Attendance Details</h5>
        <div id="attendanceTable">
            <table class="table">
                <thead>
                    <tr>
                        <th>sl.no</th>
                        <th>date</th>
                        <th>dayname</th>
                        <th>attn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendance as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->date)->toDateString() }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->date)->locale('en-US')->dayName }}</td>
                            <td>{{ $item->atn == 1 ? 'present' : 'absent' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
