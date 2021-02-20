@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
  <div class="container w-50">
    <h3 class="mb-4">Edit Profile</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.profile.update', $request->user()->id())}}" method="POST">
        @csrf
        @method("PUT")
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputNama">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama')
              is-invalid  
            @enderror" id="inputNama" value="{{$request->user()->nama}}" placeholder="Masukkan nama">
            @error('nama')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control @error('username')
              is-invalid  
            @enderror" id="username" value="{{$request->user()->username}}" placeholder="Masukkan username">
            @error('username')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control @error('password')
             is-invalid 
          @enderror" id="password" placeholder="Masukkan password">
          @error('password')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="passwordConfirmation">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" class="form-control @error('password_confirmation')
             is-invalid 
          @enderror" id="password" placeholder="Konfirmasi password">
          @error('password_confirmation')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <a href="{{route('admin.profile')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection
