<!-- Register Branch Modal -->
<form action="{{ url('post-registration') }}" method="POST" class="form-horizontal form-material">
    {{ csrf_field() }}
    <input type="hidden" name="account_id" id="account_id" value="1" min="0">
    <input type="hidden" name="currency" id="currency" value="MYR">
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Register Branch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="loginID">Login ID</label>
                                <input type="text" name="loginID" id="loginID" class="form-control form-control-line" placeholder="Enter Your User Name Here">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control form-control-line" placeholder="Enter Your Email Here">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-line" placeholder="Enter Your Password Here">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="passwordConfirm">Confirm Password</label>
                                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control form-control-line" placeholder="Confirm YourPassword">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date">Created Date</label>
                                <input type="date" name="join_date" id="date" class="form-control form-control-line" readonly value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="created-by">Created By</label>
                                <input type="text" name="created_by" class="form-control form-control-line" readonly @if(Session::has('adminData')) value="1" @endif>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="creditLimit">Credit Limit</label>
                                <input type="number" name="credit_limit" id="credit_limit" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="accountLevel">Role</label>
                            <select name="accountLevel" id="accountLevel" class="form-control form-control-line">
                                @if(auth()->user()->isAdmin())
                                    <option value="10">Sub Account</option>
                                    <option value="2">Branch</option>
                                @elseif(auth()->user()->isBranch())
                                    <option value="10">Sub Account</option>
                                    <option value="3">Agent</option>
                                @elseif(auth()->user()->isAgent())
                                    <option value="10">Sub Account</option>
                                    <option value="4" selected="">Member</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-md-12">
                            <div class="page-permission table-responsive">
                                <h3>Page Permission</h3>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox">Deposit</td>
                                            <td><input type="checkbox">Withdraw</td>
                                            <td><input type="checkbox">Transfer</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>