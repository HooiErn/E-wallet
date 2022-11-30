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
    <title>Transaction</title>
</head>
<body>
    <div class="container">
        <nav>
        <div class="Transfer">

            <div class="top-icon">
               <a href="/"><i class="fas fa-arrow-left" style="float:left;margin-top:5px;color:white;"></i> </a> 
            <p style="margin-top:5px;font-weight:bold;font-size:18px;">Transfer</p>
        </div>
   
</div>
 </nav>
<br>

@if(Session::has('error'))
    <div class="alert" id="error">
        <i class="fa fa-times-circle"></i>
        <h4 class="msg">{{Session::get('error')}}</h4>
        <a href="#" data-dismiss="alert" class="btn">Close</a>
    </div>
@endif



<form class="search-bar" action="{{route('search.user')}}" method="POST" style="margin:auto;width:360px;">
                 @csrf   
                 <div class="input">
                 <input type="search" placeholder="Search..." name="keyword" style="width:250px; color:black;">
                 <button type="submit"><i class="fa fa-search"></i></button>
                 </div>               
</form>
 
<br><br>


<div class="contact">
         <h5>All Contact</h5>
         @foreach($users as $uaa)

         <div class="list">
                        <div class="section">
                            <div class="user-img">
                                <i class="fas fa-user"  style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="text"> 
                               
                                <div class="title"><a href="{{  url('transfer',['id'=> $uaa->id])}}" style="text-decoration: none;">{{$uaa -> name}}<a></div>
                                <div class="description">{{$uaa -> handphone_number}}</div>
                               
                            </div>
                        </div>
</div>

@endforeach
<br><br>

</body>
</html>