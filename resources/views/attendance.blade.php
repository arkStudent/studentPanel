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
        // jQuery script to set minimum date for 'To Date' based on 'From Date'
        $(document).ready(function() {

            //from and to date change code
            $('#fdate').on('change', function() {
                var fromDate = $(this).val();
                $('#tdate').attr('min', fromDate);
            });

            //send api request to get data
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('attendForm');

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const fdate = document.getElementById('fdate').value;
                    const tdate = document.getElementById('tdate').value;

                    fetch('/api/attendDetails', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                fdate,
                                tdate
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(errorData => {
                                    throw errorData;
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            alert('Registered successfully');
                            location.reload();
                        })
                        .catch(error => {
                            const errorMessage = Object.values(error).flat().join('\n');
                            alert(errorMessage);
                            location.reload();
                        });
                });
            });

        });
    </script>
@endsection
