@extends('layout')
@section('content')
<style>
    svg{
        width:80%;
        height:80%;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    #reader{
        margin-top:100px;
    }
</style>
<div id="reader" width="600px"></div>

<!-- //QrCode -->
{{QrCode::generate(Auth::user()->account_id);}}


<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script type="text/javascript">
  const html5QrCode = new Html5Qrcode("reader");
  function onScanSuccess(decodedText, decodedResult) {
    $id = document.getElementById("userID").value
    if($id === decodedText){
      alert('You showing your own account qr code.');
    }
    else{
      var text = "Successfully scan";
      if(confirm(text) == true){
        window.location.href = "transfer/" + decodedText;
      }
      else{
        location.reload();
      }
    }
  }
</script>
@endsection
