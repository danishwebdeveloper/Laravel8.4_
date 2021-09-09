@extends('layouts.app')

@section('title', 'Register Page')

@section('content')

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form">
            <div class="note">
                <p>User Registration Form!!</p>
            </div>

            <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Your Name *" name="name" value="{{ old('name') }}"/>
                        
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
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
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password *" name="password_confirmation"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>

    </form>

@endsection
