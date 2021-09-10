@extends('layouts.app')

@section('title', 'Register Page')

@section('content')

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form">
            <div class="note">
                <p>Login Form!!</p>
            </div>

            <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Your Email *" name="email" value="{{ old('email') }}"/>
                        
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Your Password *" name="password"/>
                        
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-2 form-group">
                            <input type="checkbox" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="remember"
                            value="{{ old('remember') ? 'checked' : '' }}"/> <label>Remeber Me</label>
                        </div>
                    </div>
                    
                       
                   
                 
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>

    </form>

@endsection
