@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
  <div class="container w-50">
    <h3 class="mb-4">Edit Profile</h3>
    <div class="card mb-5">
      <div class="card-body">
      <form action="{{route('admin.profile.update', $request->user()->id)}}" method="POST">
        @csrf
        @method("PUT")
        <h4 class="mb-3">Profile</h4>
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
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control @error('email')
              is-invalid  
            @enderror" id="email" value="{{$request->user()->email}}" placeholder="Masukkan email">
            @error('email')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="level">Level</label>
            <div class="d-flex align-items-center h-50">
              <span class="align-middle" id="level">{{$request->user()->level->level}}</span>
            </div>
          </div>
        </div>
        <h4 class="mb-3">Atur Password</h4>
        <div class="form-group">
          <label for="currentPassword">Password Saat Ini</label>
          <input type="password" name="current_password" class="form-control @error('current_password')
             is-invalid 
          @enderror" id="currentPassword" placeholder="Password saat ini">
          @error('current_password')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="new_password">Password Baru</label>
          <input type="password" name="new_password" class="form-control @error('new_password')
             is-invalid 
          @enderror" id="newPassword" placeholder="Password baru">
          @error('new_password')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="passwordConfirmation">Konfirmasi Password Baru</label>
          <input type="password" name="password_confirmation" class="form-control @error('password_confirmation')
             is-invalid 
          @enderror" id="passwordConfirmation" placeholder="Konfirmasi password baru">
          @error('password_confirmation')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <a href="{{route('admin.profile.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection
