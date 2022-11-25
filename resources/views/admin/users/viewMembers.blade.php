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
        <table class="table table-bordered" id="dataTable">
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
            @foreach($users as $user)
                <tr>
                    <td>{{$user -> name}}</td>
                    <td>{{$user -> account_id}}</td>
                    <td>{{$user -> username}}</td>
                    <td>{{$user -> email}}</td>
                    <td>{{$user -> handphone_number}}</td>
                    <td>{{$user -> ic}}</td>
                    <td>{{$user -> base_currency}}</td>
                    <td>{{$user -> credit_available}}</td>
                    <td>{{$user -> address}}</td>
                    <td>{{$user -> join_date}}</td>
                    <td>{{$user -> created_by}}</td>
                 <td style='white-space: nowrap;width:100px;'>
                   <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#exampleModal" style="margin-right:5px;font-size:11px;float:left;">
                Edit
                </button>

                <div class="modal fade"  class="btn" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">

                    <div class="modal-content"  style="width:650px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
          <form method="POST" action="{{ route('user.update',['id'=>$user->id])  }}">
                   {{ csrf_field() }} 
                    <div class="modal-body">
                        
                    <main class="register-form">
                    <div class="container" style="overflow-x:hidden">
                    <div class="row justify-content-right ml-5">
                            <div class="col-md-10">
                                <br>
                
                   
                  <div class="column" style=" float: left; width: 20%;">
                <!-- hidden -->
                <input type="hidden" id="created_by" class="form-control" name="created_by"  value="{{$user -> created_by}}" required >

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Full Name"
                         id="name" name="name" style="width:160px;" value="{{$user -> name}}" required autofocus>
 
                    </div>

                    <div class="form-group">
                        <label for="username">Login ID:</label>
                        <input type="text" class="form-control" placeholder="Enter Username"
                         id="username" name="username" style="width:160px;"  value="{{$user -> username}}"  required autofocus>
 
                    </div>

                    <div class="form-group"  style="margin-top:20px;">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Email" 
                        id="email" name="email" style="width:160px;"  value="{{$user -> email}}" required autofocus>
 
                    </div>
                    

                    <div class="form-group"   style="margin-top:20px;">
                        <label for="ic">IC Number:</label>
                        <input type="text" class="form-control" placeholder="eg.991114-07-7777" id="ic" name="ic"
                        pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" style="width:160px;"  value="{{$user -> ic}}" required autofocus>

                    </div> 

                    <div class="form-group">
                        <label for="accountID">Account ID:</label>
                        <input type="text" class="form-control" placeholder="Enter accountID"
                         id="accountID" name="accountID" style="width:160px;"  value="{{$user -> account_id}}"  required readonly>
 
                    </div>

                    <div class="form-group">
                        <label for="remark">Remark:</label>
                        <input type="text" class="form-control" placeholder="Enter remark"
                         id="remark" name="remark" style="width:160px;"  value="{{$user -> remark}}"  required autofocus>
 
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" placeholder="Enter address"
                         id="address" name="address" style="width:160px;"  value="{{$user -> address}}"  required autofocus>
                    </div>

                  </div>

        <!--Column 2-->
                <div class="column" style=" float: left;width: 20%;margin-left:120px; padding-top:1px;"  required autofocus>
                <div class="form-group">
                <label for="currency">Currency:</label>
                <label for="base_currency">Base Currency:</label><br>
                        <select id="base_currency" name="base_currency" style="width:100%;height:28px;border:white 1px solid;;box-shadow:#d0d6dc 0.5px 0.5px 0.5px 2px;font-size:15px;">
                            <option value="MYR">MYR</option>
                        </select>

                    </div>
               
                <div class="form-group">
                <label for="status">Status:</label>
                        <input type="text" class="form-control" placeholder="Enter status" value="{{$user -> status}}" id="status" name="status" style="width:160px;" required autofocus>
                       <!-- <p style="margin:1px;font-size:9px;">*No Score, Poor, Low, Fair, Good, Very Good, &nbspExcellent</p>-->
                    </div>
      
                    
                    <div class="form-group">
                     <label for="contactNumber">Contact Number:</label>
                        <input type="tel" class="form-control" placeholder="Contact Number" 
                        id="handphone_number" name="handphone_number" 
                        pattern="[0-9]{3}-[0-9]{7}|[0-9]{3}-[0-9]{8}" style="width:160px;"  value="{{$user ->handphone_number }}" required autofocus>
                        <p style="margin:1px;font-size:9px;">*Format: 123-4567890</p>

                    </div> 
              
              
                   <div class="form-group" style="margin-top:20px;">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control"
                         placeholder="Password" id="password" name="password" 
                         value="{{$user -> password}}" style="width:160px;" required autofocus>

                    </div>

                    <div class="form-group">
                        <label for="Account Level">Account Level:</label>
                        <input type="number" id="account_level" class="form-control" name="account_level"  value="{{$user -> account_level}}" min="1" max="5" style="width:160px;" required readonly >
                    </div>
                  
                    <div class="form-group">
                        <label for="creditAvailable">Credit Available:</label>
                        <input type="number" id="credit_available" class="form-control" name="credit_available"  value="{{$user -> credit_available}}" min="1" max="2000" style="width:160px;" required readonly>

                    </div>

                    <div class="form-group">
                        <label for="creditLimit">Credit Limit:</label>
                        <input type="number" id="credit_limit" class="form-control" name="credit_limit"  value="{{$user -> credit_limit}}" max="2000" style="width:160px;" required>

                    </div>

                    <div class="form-group" style="text-align:right;"><br>
                        <button  type="submit" class="btn btn-primary">Submit</button>
                    </div>
                 
                </form>
                
        </div>
        </div>
        </div>
        </div>
        </main>
                 
                    </div>
                    </div>
                </div>
                </div>
                    <br><br>
                    <a href="#"  style="font-size:11px;" class="btn btn-danger btn-xs"  
                    onClick="return confirm('Are you sure to delete?')">Delete</a>
                </td> 
              
                </tr>
                 @endforeach
            </tbody>
        </table>

    </div>

</div>
{{-- pop model end here  --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script type="text/javascript">

    $(document).ready(function(){
        var table =$('#dataTable').DataTable();

        //Start Edit Record
        table.on('click','.edit',function(){
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
        $tr= $tr.prev('.parent');
        }

        var data =table.row($tr).data();
        console.log(data);

        $('#name').val(data[1]);
        $('#username').val(data[2]);
        $('#email').val(data[3]);

        $('#editForm').attr('action','/update'+data[0]);
        $('editModal').modal('show');

        });
    });
    
     
</script> -->
@endsection
