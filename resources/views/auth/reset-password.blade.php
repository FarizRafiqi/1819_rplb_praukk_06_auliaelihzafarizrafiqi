@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')
  <div class="container">
    <div div class="card mt-4 mx-auto p-3 card-reset-password">
      <div class="card-body">
        <form action="{{route('password.update')}}" method="POST" class="form-row">
          @csrf
          <div class="col-12">
            {{-- Password Reset Token --}}
            <input type="hidden" name="token" value="{{$request->token}}">
  
            {{-- Email Address --}}
            <div class="form-group mt-4 mb-3">
              <input type="email" name="email" class="form-control @error('email')
                is-invalid    
              @enderror" placeholder="Email" autofocus>
              @error('email')
                <span class="invalid-feedback">{{$message}}</span>    
              @enderror
            </div>
  
            {{-- Password --}}
            <div class="form-group mb-3">
              <input type="password" name="password" class="form-control @error('password')
                is-invalid    
              @enderror" placeholder="Password">
              @error('password')
                <span class="invalid-feedback">{{$message}}</span>    
              @enderror
            </div>
  
            {{-- Confirm Password --}}
            <div class="form-group mb-3">
              <input type="password" name="password_confirmation" class="form-control @error('password_confirmation')
                is-invalid    
              @enderror" placeholder="Konfirmasi password">
              @error('password_confirmation')
                <span class="invalid-feedback">{{$message}}</span>    
              @enderror
            </div>
            <button class="btn btn-primary-custom btn-block" type="submit">Reset Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection