@extends('layout')
@include('sidenav')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top:20px;">
                @if(auth()->user()->isAdmin())
                <div class="card-header">{{ __('Admin Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }} 
                            
                        </div>
                        
                    @endif
  
                   You are Logged In
                    
                </div>
                @elseif(auth()->user()->isAgent())
                <div class="card-header">{{ __('Agent Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    You are Logged In as an agent. 
                    
                    
                 
                </div>
               
                @elseif(auth()->user()->isMember())
                <div class="card-header">{{ __('Members Dashboard') }}</div>
  
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        You are Logged In as an member. 
                        
                      
                    </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection