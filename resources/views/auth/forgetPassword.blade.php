@extends('layout')
@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">   
                    
                @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>  
                        @endif
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">
             

                        <form action="{{ route('forget.password.post') }}" method="POST">
                            @csrf
                            <div>
                                <b><p>Enter your email address and  we will send you a link to reset your password.</p></b>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control" name="email" required autofocus>
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                            <div class="col-md-6 offset-md-4 mt-3" >
                            <a href="{{route('login')}}" style="text-decoration:none;">Login</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection