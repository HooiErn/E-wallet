@extends('layouts.user')
@section('content')

<style>
</style>

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
    <title>Pay</title>
</head>
<body>
    <div class="container">
        <div class="profile">
            <div class="top-icon">
                <div>
                   <a href="/home"><i class="fas fa-arrow-left" style="color:white;"></i></a> 
                </div>
                <div>
                    <h3>Pay</h3>
                </div>
                <div>
                <a href="#"><i class="fa fa-solid fa fa-right-to-menu"  style="color:white;"></i></a>
                </div>
            </div>
            <br><br><br>
    
<button type="button" data-toggle="modal" data-target="#exampleModal">
{{QrCode::generate($user -> id)}}
</button>
<br><br>
<h6>MY Balance: RM{{$wallet -> balance}}</h6>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:black;">My Qr Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 style="color:black;">user Name: {{$user -> name}}</h5>
        <h5 style="color:black;">userID: {{$user -> id}}</h5>
      </div>
     
    </div>
  </div>
</div>

</body>
</html>
@endsection