<html>
<head></head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h2>Congratulations!</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h4>Account Info</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <p>Full Name : {{ $data['full_name'] }}</p>
            </div>
            <div class="col-sm-4 col-sm-offset-1">
                <p>Email Address : {{ $data['email'] }}</p>
            </div>
            <div class="col-sm-4 col-sm-offset-1">
                <p>Phone Number : {{ $data['phone_number'] }}</p>
            </div>
        </div>
    </div>
</body>
</html>
