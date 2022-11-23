@extends('auth.layout')
@section('content')




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0ea31885d1.js" crossorigin="anonymous"></script>
     <!-- Styles -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/Transfer.css') }}" rel="stylesheet">
    <title>Transfer</title>
</head>


 

<body>
    <div class="container">
        <nav>
        <div class="Transfer">

            <div class="top-icon">
               <a href="{{route('transfer.money')}}"><i class="fas fa-arrow-left" style="float:left;margin-top:5px;color:white;"></i> </a> 
            <p style="margin-top:5px;font-weight:bold;font-size:18px;">Confirm Password</p>
        </div>
   

        
</div>
 </nav>
<br>
 <br>
<div class="content" >
<center>
<h5>Please enter your password</h5>
<form action="{{route('home')}}"> 
              <input type="password" id="password" class="password" placeholder="Password" style="width:290px;" required>
              <br><br>
               <button class="btn btn-success" type="submit">Confirm</button>
 </form>
 </center>
 </div>
</body>
</html>

@include('auth.money')
@endsection