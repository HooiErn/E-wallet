<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0ea31885d1.js" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
               <a href="/home"><i class="fas fa-arrow-left" style="float:left;margin-top:5px;color:white;"></i> </a> 
            <p style="margin-top:5px;font-weight:bold;font-size:18px;">Transfer</p>
        </div>
   
</div>
 </nav>
<br>

@if(Session::has('error'))
           <div class="alert" style="background-color:#F83030;">
                <span class="msg"  style="color:white;">{{Session::get('error')}}</span>
                <span class="crose" data-dismiss="alert">&times;</span>
            </div>
        @endif

<form class="search-bar" action="{{route('search.user')}}" method="POST" style="margin:auto;width:360px;">
                 @csrf   
                 <div class="input">
                 <input type="search" placeholder="Search..." name="keyword" style="width:250px; color:black;">
                 <button type="submit"><i class="fa fa-search"></i></button>
                 </div>               
</form>
 
<br>

<div class="contact">
         <h5>All Contact</h5>
         @foreach($users as $uaa)

         <div class="list">
                        <div class="section">
                            <div class="user-img">
                                <i class="fas fa-user"  style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="text"> 
                               
                                <div class="title"><a href="{{  url('transfer',['id'=> $uaa->account_id])}}" style="text-decoration: none;">{{$uaa -> name}}<a></div>
                                <div class="description">{{$uaa -> handphone_number}}</div>
                               
                            </div>
                        </div>
</div>

@endforeach
<br><br>

</body>
</html>