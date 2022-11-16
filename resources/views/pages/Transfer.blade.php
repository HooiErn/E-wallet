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
    <title>Transaction History</title>
</head>
<body>
    <div class="container">
        <nav>
        <div class="Transfer">

            <div class="top-icon">
               <a href="{{route('home')}}"><i class="fas fa-arrow-left" style="float:left;margin-top:5px;color:white;"></i> </a> 
            <p style="margin-top:5px;font-weight:bold;font-size:18px;">Transfer</p>
        </div>
   
</div>
 </nav>

<div class="content">
    
<div class="col-md-10" style="max-width:99% !important;">
<select name="phoneNumber" id="phoneNumber" style="float:left;">
    <option>
       +60
    </option>
    <option>
       +65
    </option>
</select>
            <input type="search" id="search" name="search" placeholder="Enter phone number.." style="float:left;">
         </div>        
</div>  

<div class="recently">
         <h5>Recently</h5>
         <div class="list">
                        <div class="section">
                            <div class="user-img">
                                <i class="fas fa-user"  style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="text">
                                <div class="title">Name</div>
                                <div class="description">+6012334566</div>
                            </div>
                        </div>
</div>
<div class="contact">
         <h5>All Contact</h5>
         <div class="list">
                        <div class="section">
                            <div class="user-img">
                                <i class="fas fa-user"  style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="text">
                                <div class="title">Name (html sample)</div>
                                <div class="description">+6012334566</div>
                            </div>
                        </div>
                        <br>
                        <div class="list">
                        <div class="section">
                            <div class="user-img">
                                <i class="fas fa-user"  style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="text">
                                <div class="title">Name</div>
                                <div class="description">+6012334566</div>
                            </div>
                        </div>
                        <br>
                        <div class="list">
                        <div class="section">
                            <div class="user-img">
                                <i class="fas fa-user"  style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="text">
                                <div class="title">Name</div>
                                <div class="description">+6012334566</div>
                            </div>
                        </div>
                        
        </div>
</div>



</body>
</html>