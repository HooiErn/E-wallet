<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0ea31885d1.js" crossorigin="anonymous"></script>
     <!-- Styles -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <title>Profile</title>
</head>
<body>
    <div class="container">
        <div class="profile">
            <div class="top-icon">
                <div>
                   <a href="/home"><i class="fas fa-arrow-left" style="color:white;"></i></a> 
                </div>
                <div>
                    <h3>Test</h3>
                </div>
                <div>
                <a href="{{route('logout')}}" onclick="return confirm('Are you sure you want to logout?')"><i class="fa fa-solid fa fa-right-to-bracket"  style="color:white;"></i></a>
                </div>
            </div>
            
            <div class="col-1">
            <label for="">Action</label>
            <span>
              <a href="{{url('deposit')}}" class="btn btn-primary">Deposit</a>
              <br><br>
              <a href="{{url('withdraw')}}" class="btn btn-primary">Withdraw</a>
            </span>
          </div>

</body>
</html>
