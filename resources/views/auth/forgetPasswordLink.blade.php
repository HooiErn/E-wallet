@extends('layout')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="jquery.3.4.1.js"></script>
        <script src="all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link 
  href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
  rel="stylesheet"  type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<script type="text/javascript">
$(document).on('click', '.toggle-password', function() {

$(this).toggleClass(" fa-eye fa-eye-slash");

var input = $("#password");
input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')

});

$(document).on('click', '.toggle-passwords', function() {

$(this).toggleClass(" fa-eye fa-eye-slash");

var input = $("#password-confirm");
input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')

});
</script>
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                  @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>  
                        @endif
            <div class="card">  
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">
                        <form action="{{ route('reset.password.post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                          

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control" name="email" required autofocus>
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6"> 
                                    <i toggle="#password-field" class="fa-fw fa fa-eye-slash field_icon toggle-password" 
                              style="position:absolute;margin-left:20.5rem;margin-top:0.7rem;color:grey;"></i>
                                    <input type="password" id="password" class="form-control" name="password" required autofocus>
                                   
                             
                                </div>
                            </div>
                         
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                <i toggle="#password-field" class="fa-fw fa fa-eye-slash field_icon toggle-passwords" 
                              style="position:absolute;margin-left:20.5rem;margin-top:0.7rem;color:grey;"></i>
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                   
                                    @if($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                        @if($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div> 
                                 
                            </div>
                      

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection