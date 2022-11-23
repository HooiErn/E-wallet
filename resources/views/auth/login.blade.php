@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="Username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="row mb-3">
                              <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                              <div class="col-md-6">
                              <input type="text" id="username" class="form-control" name="username" placeholder="Your Username" required @if(Cookie::has('username')) value="{{Cookie::get('username')}}" @endif>
                                  @if ($errors->has('username'))
                                      <span class="text-danger">{{ $errors->first('username') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6" style='white-space: nowrap'>
                              <i toggle="#password-field" class="fa-fw fa fa-eye-slash field_icon toggle-password" 
                              style="position:absolute;margin-left:24rem;margin-top:0.7rem;color:grey;"></i>
                              <input type="password" id="password" class="form-control" name="password" placeholder="Password" required @if(Cookie::has('password')) value="{{Cookie::get('password')}}" @endif>
                           
                            
                              @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection