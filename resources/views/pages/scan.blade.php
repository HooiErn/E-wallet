<style>
    #reader{
        height: 60%;
    }
    #reader__scan_region{
        height:80%;
        margin-top:100px;
    }
    #reader__header_message{
        font-size:20px !important;
    }
    #reader__scan_region img{
        width:80% !important;
        height:80%;
    }
    #reader__dashboard_section_csr span{
        font-size:40px !important;
    }
    #reader__dashboard_section_csr select{
        font-size:30px !important;
        height:32px;
    }
    /*Button */
    #html5-qrcode-button-camera-start{
        height:55px;
        font-size:28px;
        width:300px;
        margin-top:10px;
        margin-bottom:10px;
    }
    #html5-qrcode-button-camera-permission{
        height:55px;
        font-size:18px;
        width:300px;
        margin-top:10px;
        margin-bottom:10px;
    }
    #qr-shaded-region{
        border-width: 36px 56px !important;
    }
    video{
        width:-webkit-fill-available !important;
        height:100% !important;
    }
    #html5-qrcode-anchor-scan-type-change{
        font-size:28px;
        text-decoration:none !important;
    }
    #html5-qrcode-anchor-scan-type-change:hover{
        color:blue;
    }
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
    <title>Scan</title>
</head>
<body>
    <div class="container">
        <div class="profile">
            <div class="top-icon">
                <div>
                   <a href="/home"><i class="fas fa-arrow-left" style="color:white;"></i></a> 
                </div>
                <div>
                    <h3>Scan</h3>
                </div>
                <div>
                <a href="{{route('logout')}}" onclick="return confirm('Are you sure you want to logout?')"><i class="fa fa-solid fa fa-right-to-bracket"  style="color:white;"></i></a>
                </div>
            </div>
            
            <div id="reader" width="60px"></div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
    function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
  console.log(`Code matched = ${decodedText}`, decodedResult);
}

function onScanFailure(error) {
  // handle scan failure, usually better to ignore and keep scanning.
  // for example:
  console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>




</body>
</html>