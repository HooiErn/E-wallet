@extends('layout')
@section('content')
Hello
<button style="width:50px;height:30px; font-size:12px;padding:0;" class="btn btn-primary" onclick= "window.location.href = '/BranchRegistration';">Create Branches</button>
<button style="width:50px;height:30px; font-size:12px;padding:0;" class="btn btn-primary" onclick= "window.location.href = '/AdminsRegistration';">Create Admins</button>
@endsection