<!DOCTYPE html>
<html>
    <head>
        <title>E-Wallet</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <style type="text/css">
           @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
  
            body{
                margin: 0;
                font-size: .9rem;
                font-weight: 400;
                line-height: 1.6;
                color: #212529;
                text-align: left;
                background-color: #f5f8fa;
                width:100%;
            }
            .navbar-laravel
            {
                box-shadow: 0 2px 4px rgba(0,0,0,.04);
                
            }
            .navbar-brand , .nav-link, .my-form, .login-form,.topnav-link
            {
                font-family: Raleway, sans-serif;
                
            }
            .navbar>.container{
                justify-content:start !important;
            }
            .sidenav{
            height: 100%; 
            width: 0; 
            position: fixed; 
            z-index: 1; /* Stay on top */
            top: 0; 
            left: 0;
            background-color: #000;
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            overflow-x: hidden; 
            padding-top: 60px;
            transition: 0.5s; 
            }

            .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            margin-top:0.5rem;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
            }

            .sidenav li:hover {
            background-color:grey;
            transition: 0.5s; 
            color:white;
            }

            .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
            }
            .my-form
            {
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }
            .my-form .row
            {
                margin-left: 0;
                margin-right: 0;
            }
            .login-form
            {
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }
            .login-form .row
            {
                margin-left: 0;
                margin-right: 0;
            }
            .img-circle{
                border-radius: 50%;
            }
            .topnav-link{
                font-size:16px;
            }
            .topnav-link:hover{
                color: grey;
                text-decoration: none;
            }

            .dropdown .dropbtn {
            font-size: 18px !important;
            border: none;
            outline: none;
            color: white;
            padding: 10px 14px;
            background-color: inherit;
            font-family: inherit; /* Important for vertical align on mobile phones */
            margin: 0; /* Important for vertical align on mobile phones */
            }


            .dropdown-content {
            display: none;
            position: absolute;
            background-color: #266b89;
            min-width: 180px;
            border-radius:6px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            }

            .dropdown-content a {
            float: none;
            color: white !important;
            padding: 12px 16px;
            text-decoration: none !important;
            display: block;
            text-align: left;
            font-size:18px !important;
            }

            .dropdown-content a:hover {
            background-color: #4b8c99;
            border-radius:6px;
            }

            .dropdown:hover .dropdown-content {
            display: block;
            }
        </style>
        <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>

    <body>
  
    <nav class="navbar navbar-expand-lg navbar-laravel" style=" background-image: linear-gradient(to right, #156184, #37758f,#4c8d99);">
        <div class="container">
        @if(Auth::check())
        <span style="font-size:20px;cursor:pointer;margin-right:5px;margin-bottom:2px;color:white;" onclick="openNav()">&#9776;</span>
            <div id="mySideNav" class="sidenav">
            <ul style="padding-left:10px;">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>     
           
            </ul>
            </div>
            @endif
        <!--TopNav-->
        <a class="navbar-brand" href="#" style="color:white;">E-Wallet</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

        
                <div class="dropdown">
                <button class="dropbtn">Register 
                <i class="fa fa-caret-down"></i>
                </button>
               <div class="dropdown-content">
               <a  href="#"
                 style="color: white;"> Create Branch </a>
                 <a  href="#"
                 style="color: white;"> Create Agents </a>
                 <a  href="#"
                 style="color: white;"> Create Members </a>
               </div>
                    </div>
           
            
        <!--Login & Logout-->
                <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                    <ul class="navbar-nav ml-auto" >   
                        @guest
                       
                            <li class="nav-item" >
                                <a class="nav-link" href="{{ route('login') }}" style="color:white;">Login</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"style="color:white;">Logout</a>
                            </li>
                        @endguest
                        
                        <!--Sample profile-->
                        @if(Auth::check())
                        <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.view') }}" style="color:white;"> Profile </a>
                        </li>
                        @endif
                    </ul>
        
                </div>
            </div>
        </nav>
        </div>
        </nav>
        @yield('content')
        <script>
            function openNav() {
            document.getElementById("mySideNav").style.width = "250px";
            }

            function closeNav() {
            document.getElementById("mySideNav").style.width = "0";
            }
            </script>
   
    </body>
</html>