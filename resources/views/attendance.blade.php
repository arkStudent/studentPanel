@extends('index')

@section('content')
    <div class="container">
        <h5 class="text-center">ATTENDANCE</h5>
        <form id="attendForm">
            <div class="mb-3">
                <label for="fdate" class="form-label">From Date</label>
                <input type="date" class="form-control" id="fdate" name="fdate" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="tdate" class="form-label">To Date</label>
                <input type="date" class="form-control" id="tdate" name="tdate">
            </div>
            <div class="mb-3">
                <center><button type="submit" class="btn btn-primary">Submit</button></center>
            </div>
        </form>

        <!-- Table to display attendance -->
        <div id="attendanceTable"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            // From and to date change code
            $('#fdate').on('change', function() {
                var fromDate = $(this).val();
                $('#tdate').attr('min', fromDate);
            });

            // Send API request to get data and render table
            $('#attendForm').on('submit', function(e) {
                e.preventDefault();

                const fdate = $('#fdate').val();
                const tdate = $('#tdate').val();

                axios.post('/api/attendTable', {
                    fdate: fdate,
                    tdate: tdate
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(function(response) {
                    console.log(response.data);
                    // Handle the data and render table
                    renderAttendanceTable(response.data);
                })
                .catch(function(error) {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
            });

            // Function to render the attendance table
            function renderAttendanceTable(data) {
                let tableHtml = '<table class="table"><thead><tr><th>sl.no</th><th>date</th><th>dayname</th><th>attn</th></tr></thead><tbody>';
                
                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(function(item, index) {
                        // Determine attendance status
                        let attnStatus = (item.atn === 1) ? 'present' : 'absent';

                        // Format date
                        let dateObj = new Date(item.date);
                        let formattedDate = dateObj.toDateString();
                        let dayName = dateObj.toLocaleDateString('en-US', { weekday: 'long' });

                        // Add row to table
                        tableHtml += `<tr><td>${index + 1}</td><td>${formattedDate}</td><td>${dayName}</td><td>${attnStatus}</td></tr>`;
                    });
                } else {
                    tableHtml += `<tr><td colspan="4">No attendance data found</td></tr>`;
                }

                tableHtml += '</tbody></table>';

                // Display the table
                $('#attendanceTable').html(tableHtml);
            }
        });
    </script>
@endsection
