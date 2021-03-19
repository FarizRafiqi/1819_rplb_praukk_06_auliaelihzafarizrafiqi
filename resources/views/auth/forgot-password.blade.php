@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
  <div class="container">
    <div class="card mt-4 mx-auto card-forgot-password">
      <div class="card-body">
        Lupa password? Nggak masalah. Berikan email kamu kepada kami, nanti akan kami kirim link reset password ke emailmu
        <form action="{{route('password.email')}}" method="POST">
          @csrf
          {{-- Email Address --}}
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                   id="email" 
                   placeholder="Masukkan email..."
                   required
                   autofocus>
            @error('email')
              <span class="invalid-feedback">{{$message}}</span>    
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
@endsection