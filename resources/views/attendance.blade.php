@extends('index')

@section('content')
    <div class="container">
        <h5 class="text-center">ATTENDANCE</h5>
        <form id="attendForm">
            @csrf <!-- This will generate the CSRF token field -->
            <div class="mb-3">
                <label for="fdate" class="form-label">From Date</label>
                <input type="date" class="form-control" id="fdate" name="fdate">
            </div>
            <div class="mb-3">
                <label for="tdate" class="form-label">To Date</label>
                <input type="date" class="form-control" id="tdate" name="tdate">
            </div>
            <div class="mb-3">
                <center><button type="submit" class="btn btn-primary">Submit</button></center>
            </div>
        </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
@endsection
