@extends('layout')
@section('content')
<style>
    .dashboard{
        margin:20px;
    }
</style>
<div class="content">
    <div class="dashboard">

   
<h4>Hello Admin</h4>

<button style="width:100px;height:30px; font-size:12px;padding:0;" class="btn btn-primary" onclick= "window.location.href = '/BranchRegistration';">Create Branches</button>
<button style="width:90px;height:30px; font-size:12px;padding:0;" class="btn btn-primary" onclick= "window.location.href = '/AdminsRegistration';">Create Admins</button>
<button style="width:100px;height:30px; font-size:12px;padding:0;" class="btn btn-primary" onclick= "window.location.href = '/viewMembers';">View Members</button>
<button style="width:90px;height:30px; font-size:12px;padding:0;" class="btn btn-primary" onclick= "window.location.href = '/home';">Homepage</button>

<table class="table-bordered">
    <thead>
            <th></th>
            <th></th>
            <th></th>
    </thead>
    <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
    </tbody>

</table>
</div> <!-- container -->
</div>

@endsection