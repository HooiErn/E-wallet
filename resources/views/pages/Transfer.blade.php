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
    <title>Transfer</title>
</head>
<body>
    <div class="container">
        <div class="profile">
            <div class="top-icon">
                <div>
                   <a href="/home"><i class="fas fa-arrow-left" style="color:white;"></i></a> 
                </div>
                <div>
                    <h3>Transfer</h3>
                </div>
                <div>
                <a href="{{route('logout')}}" onclick="return confirm('Are you sure you want to logout?')"><i class="fa fa-solid fa fa-right-to-bracket"  style="color:white;"></i></a>
                </div>
            </div>
            <br>
           
            <div class="transfer">
    <form action="{{ url('check-out/transfer') }}" method="POST">
        @csrf
        @foreach($users as $user)
        <input type="hidden" name="userID" id="userID" value="{{$user -> id}}">
        <div class="form-group">
            <input type="text" name="userName" id="userName" value="{{$user -> name}}" readonly>
        </div>
        <div class="form-group">
            <label for="amount">Transfer Amount: </label>
            <input type="number" name="amount" id="amount" class="form-control">
        </div>
        @endforeach
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>


</body>
</html>