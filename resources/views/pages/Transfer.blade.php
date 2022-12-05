<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0ea31885d1.js" crossorigin="anonymous"></script>
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
     <!-- Styles -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/Txhistory.css') }}" rel="stylesheet">
    <title>Transfer</title>
</head>
<body>
<nav>
        <div class="Txhistory">

            <div class="top-icon">
               <a href="{{route('home')}}"><i class="fas fa-arrow-left" style="float:left;margin-top:5px;color:white;"></i> </a> 
            <p style="margin-top:5px;font-weight:bold;font-size:18px;">Transaction History</p>
        </div>
</div>
</nav>
<br><br>

<div class="container" style="margin-left:20px;">
<H5>Transfer to:</H5>

<div class="transfer">
    <form action="{{ url('check-out/transfer') }}" method="POST">
        @csrf

        <input type="hidden" name="userID" id="userID" value="{{$users -> account_id}}">
        <div class="form-group">
            <h3 style="color:blue;"> {{$users -> name}}</h3>
        </div>
        <div class="form-group col-11" style="padding-left:0 !important;">
            <label for="amount">Transfer Amount: </label>
            <input type="number" min="0" step="0.01" class="form-control" name="amount" id="amount">
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Confirm
</button>
        <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <label for="">Please Enter Your Password</label>
        <input type="password" name="password" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
    </form>
</div>
</div>
</body>
</html>    

