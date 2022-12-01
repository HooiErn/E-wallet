<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0ea31885d1.js" crossorigin="anonymous"></script>
     <!-- Styles -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/Txhistory.css') }}" rel="stylesheet">
    <title>Transaction History</title>
</head>
<body>
    <div class="container">
        <nav>
        <div class="Txhistory">

            <div class="top-icon">
               <a href="/"><i class="fas fa-arrow-left" style="float:left;margin-top:5px;color:white;"></i> </a> 
            <p style="margin-top:5px;font-weight:bold;font-size:18px;">Transaction History</p>
        </div>
</div>
</nav>

<div class="content">

@foreach($walletHistory as $history)
<div class="list1">
                        <div class="section1">
                            <div class="icon up" style="color:red;">
                            {{$loop -> iteration}}
                            </div>
                            &nbsp;&nbsp;
                            <div class="text">
                          
                                <div class="title">{{$history -> type}}</div>
                              
                                <div class="description">{{$history -> created_at}}</div>
                            </div>
                        </div>

                        <div class="section2">
                        @if ($history -> type == 'deposit')
                        <span class="text-success">+{{$history -> amount}}</span> 
                      @else
                      <span class="text-danger">{{$history -> amount}}</span>
                      @endif
                        </div>      

</div>
@endforeach
</div>
</body>
</html>