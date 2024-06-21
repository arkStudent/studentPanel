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
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            //from and to date change code
            $('#fdate').on('change', function() {
                var fromDate = $(this).val();
                $('#tdate').attr('min', fromDate);
            });

            //send api request to get data
            $('#attendForm').on('submit', function(e) {
                e.preventDefault();

                const fdate = $('#fdate').val();
                const tdate = $('#tdate').val();

                fetch('/api/attendTable', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        fdate,
                        tdate
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert('Data fetched successfully');
                    console.log(data);  // handle the data as needed
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
            });
        });
    </script>
@endsection
