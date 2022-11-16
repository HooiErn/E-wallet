<style>
    #reader{
        height: 100%;
    }
    #reader__scan_region{
        height:80%;
        margin-top:100px;
    }
    #reader__header_message{
        font-size:35px !important;
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
        font-size:28px;
        width:500px;
        margin-top:10px;
        margin-bottom:10px;
    }
    #qr-shaded-region{
        border-width: 336px 56px !important;
    }
    video{
        height:100% !important;
    }
    #html5-qrcode-anchor-scan-type-change{
        font-size:40px;
        text-decoration:none !important;
    }
    #html5-qrcode-anchor-scan-type-change:hover{
        color:blue;
    }
</style>
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