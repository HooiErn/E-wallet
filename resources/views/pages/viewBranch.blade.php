@extends('layout')
@section('content')
<style>
    table{
        margin-top:10px;
    }
    th{
        background-color:#31718d;
        color:white;
    }
</style>
<div class="container">
    <div class="list">
        <table class="table table-bordered">
            <thead>
                <th>Name</th>
                <th>Account_id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Mobile No.</th>
                <th>IC No.</th>
                <th>Base Currency</th>
                <th>Balance</th>
                <th>Address</th>
                <th>Join Date</th>
                <th>Created_by</th>
                <th>Action</th>
                            
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style='white-space: nowrap'>
                    <a href="#"  style="font-size:11px;" class="btn btn-warning btn-xs">Edit</a>
                    <a href="#"  style="font-size:11px;" class="btn btn-danger btn-xs"  
                    onClick="return confirm('Are you sure to delete?')">Delete</a>
                </td>
                </tr>
            </tbody>
        </table>

    </div>

</div>
@endsection
