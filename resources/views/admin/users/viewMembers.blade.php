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
                   <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#exampleModal" style="margin-right:5px;font-size:11px;float:left;">
                Edit
                </button>

                <!-- Modal -->
                <div class="modal fade"  class="btn" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content"  style="width:650px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                    <main class="register-form">
  <div class="cotainer" style="overflow-x:hidden">
  <div class="row justify-content-right ml-5">
          <div class="col-md-10">
            <br>
            <div class="column" style=" float: left; width: 20%;">
             
            
              
                <!-- hidden -->
                <input type="hidden" id="created_by" class="form-control" name="created_by"  value="" required >

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Full Name"
                         id="name" name="name"  value="" style="width:160px;" required autofocus>
 
                    </div>

                    <div class="form-group">
                        <label for="username">Login ID:</label>
                        <input type="text" class="form-control" placeholder="Enter Username"
                         id="username" name="username" style="width:160px;"  value=""  required autofocus>
 
                    </div>

                    <div class="form-group"  style="margin-top:20px;">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Email" 
                        id="email" name="email" style="width:160px;"  value="" required autofocus>
 
                    </div>
                    

                    <div class="form-group"   style="margin-top:20px;">
                        <label for="ic">IC Number:</label>
                        <input type="text" class="form-control" placeholder="eg.991114-07-7777" id="ic" name="ic"
                        pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" style="width:160px;"  value="" required autofocus>

                    </div> 

                    <div class="form-group">
                        <label for="accountID">Account ID:</label>
                        <input type="text" class="form-control" placeholder="Enter accountID"
                         id="accountID" name="accountID" style="width:160px;"  value=""  required autofocus>
 
                    </div>

                    <div class="form-group">
                        <label for="remark">Remark:</label>
                        <input type="text" class="form-control" placeholder="Enter remark"
                         id="remark" name="remark" style="width:160px;"  value=""  required autofocus>
 
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" placeholder="Enter address"
                         id="address" name="address" style="width:160px;"  value=""  required autofocus>
                    </div>

                  </div>

        <!--Column 2-->
                <div class="column" style=" float: left;width: 20%;margin-left:120px; padding-top:1px;"  required autofocus>
                <div class="form-group">
                <label for="currency">Currency:</label>
                        <input type="text" class="form-control"  placeholder="Enter currency"
                        id="currency" name="currency"  style="width:160px;" value="" required autofocus>

                    </div>
               
                <div class="form-group">
                <label for="status">Status:</label>
                        <input type="text" class="form-control" placeholder="Enter status" value="" id="status" name="status" style="width:160px;" required autofocus>
                       <!-- <p style="margin:1px;font-size:9px;">*No Score, Poor, Low, Fair, Good, Very Good, &nbspExcellent</p>-->
                    </div>
      
                    
                    <div class="form-group">
                     <label for="contactNumber">Contact Number:</label>
                        <input type="tel" class="form-control" placeholder="Contact Number" 
                        id="handphone_number" name="handphone_number" 
                        pattern="[0-9]{3}-[0-9]{7}|[0-9]{3}-[0-9]{8}" style="width:160px;"  value="" required autofocus>
                        <p style="margin:1px;font-size:9px;">*Format: 123-4567890</p>

                    </div> 
              
              
                   <div class="form-group" style="margin-top:20px;">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control"
                         placeholder="Password" id="password" name="password" 
                         value="" style="width:160px;" required autofocus>

                    </div>

                    <div class="form-group">
                        <label for="Account Level">Account Level:</label>
                        <input type="number" id="AccountLevel" class="form-control" name="AccountLevel"  value="" min="1" max="5" style="width:160px;" required >
                         <p style="margin:1px;font-size:9px;">*1= Admin *2= Agent...</p>
                    </div>
                  
                    <div class="form-group">
                        <label for="creditAvailable">Credit Available:</label>
                        <input type="number" id="creditAvailable" class="form-control" name="creditAvailable"  value="" min="1" max="2000" style="width:160px;" required >

                    </div>

                    <div class="form-group">
                        <label for="creditLimit">Credit Limit:</label>
                        <input type="number" id="creditLimit" class="form-control" name="creditLimit"  value="" max="2000" style="width:160px;" required >

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
                    <a href="#"  style="font-size:11px;" class="btn btn-danger btn-xs"  
                    onClick="return confirm('Are you sure to delete?')">Delete</a>
                </td>
                </tr>
            </tbody>
        </table>

    </div>

</div>
@endsection
