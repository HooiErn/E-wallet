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

<style>
    .top-profile{
    text-align: left;
    width: 100%;
    padding: 12px 12px 80px 12px;
    box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
    height: 100%;
    border-radius: 5px;
    background: #24a0ed;
    margin-bottom:10px;
    }

    .my-button1{
    border-radius: 15px;
    border: 1px solid #000;
    padding: 2px 5px;
    background: #C5C5C5;
    font-size: 1em;
    cursor: pointer;
    }
    .my-button2{
    border-radius: 15px;
    border: 1px solid #000;
    padding: 2px 5px;
    background: #C5C5C5;
    font-size: 1em;
    cursor: pointer;
    }
    .my-button3{
    border-radius: 15px;
    border: 1px solid #000;
    padding: 2px 5px;
    background: #C5C5C5;
    font-size: 1em;
    cursor: pointer;
    }
    .my-button4{
    border-radius: 15px;
    border: 1px solid #000;
    padding: 2px 5px;
    background: #C5C5C5;
    font-size: 1em;
    cursor: pointer;
    }
    .my-button5{
    border-radius: 15px;
    border: 1px solid #000;
    padding: 2px 5px;
    background: #C5C5C5;
    font-size: 1em;
    cursor: pointer;
    }

    .btn-primary{
        border-radius: 15px;
        color: white;
        width: 300px;
    }

    .search{
        border-radius: 15px;
    }
</style>


<script>
function myFunction1() {
  document.getElementById("amount").value = 20;
}
function myFunction2() {
  document.getElementById("amount").value = 50;
}
function myFunction3() {
  document.getElementById("amount").value = 100;
}
function myFunction4() {
  document.getElementById("amount").value = 150;
}
function myFunction5() {
  document.getElementById("amount").value = 200;
}
</script>

<body>
    <div class="container">
        <nav>
        <div class="Transfer">

            <div class="top-icon">
               <a href="{{route('transfer')}}"><i class="fas fa-arrow-left" style="float:left;margin-top:5px;color:white;"></i> </a> 
            <p style="margin-top:5px;font-weight:bold;font-size:18px;">Transfer Money</p>
        </div>
   
</div>
 </nav>
<br>
 <h5>Transfer To</h5>
 <div class="top-profile" style="height:80px;">
            <h2 style="color:white;">Danny</h2>
            <span style="color:white;">+60 16-543 3202</span>
        </div>
<div class="content" >
            <input type="search" id="amount" class="search" placeholder="Amount" style="width:350px;" required>
            <center><h6 style="color:red;"> You can transfer up to RM 2000</h6></center>
        
             &nbsp; &nbsp; &nbsp; &nbsp; <button class="my-button1" onclick="myFunction1()">RM20</button>
             <button class="my-button2" onclick="myFunction2()">RM50</button>
             <button class="my-button3" onclick="myFunction3()">RM100</button>
             <button class="my-button4" onclick="myFunction4()">RM150</button>
             <button class="my-button5" onclick="myFunction5()">RM200</button>
</div>  

            <div class="content">
            <input type="search" id="search" class="search" placeholder="What's the transfer for?" style="width:350px;" required>
        </div>  
     
           <br><br><br>
           <!-- Button trigger modal -->
        <center><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal9">Confirm Transfer</button></center>
       
        <!-- Modal -->
        <div class="modal fade" id="exampleModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel9" aria-hidden="true" style="width:350px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel9">Please enter your password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              
              <div class="modal-body">
              <input type="search" id="search" class="search" placeholder="Password" style="width:290px;" required>
              </div>

              <div class="modal-footer">
           <button type="button" class="btn btn-success">Confirm</button>
              </div>
              
            </div>
          </div>
        </div>     
       

</body>
</html>

@include('auth.money')
@endsection