@extends('layouts.admin')

@section('title', 'Edit User')
@section('content')
  <div class="{{Cookie::get('enable_sidebar') ? 'container-fluid' : 'container container-edit-user'}}">
    <h3 class="mb-4">Edit User</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.users.update', $user->id)}}" method="POST">
        @csrf
        @method("PUT")
        <h4>Detail</h4>
        <div class="form-row">
          <input type="hidden" name="id" value="{{$user->id}}">
          <div class="form-group col-md-6">
            <label for="inputNama">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama')
              is-invalid  
            @enderror" id="inputNama" value="{{old('nama') ? old('nama') : $user->nama}}" placeholder="Masukkan nama">
            @error('nama')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control @error('username')
              is-invalid  
            @enderror" id="username" value="{{old('username') ? old('username') : $user->username}}" placeholder="Masukkan username">
            @error('username')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control @error('email')
              is-invalid  
            @enderror" id="email" value="{{$user->email}}" placeholder="Masukkan email">

            @error('email')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="selectLevel">Level</label>
            <select name="id_level" class="form-control @error('id_level') is-invalid @enderror" id="selectLevel">
              <option disabled>Pilih Level</option>
              @foreach($levels as $level)
                @if (old('id_level'))
                  <option value="{{$level->id}}" {{(old('id_level') == $level->id) ? 'selected' : ''}}>{{$level->level}}</option>
                @else
                  <option value="{{$level->id}}" {{($user->id_level == $level->id) ? 'selected' : ''}}>{{$level->level}}</option>
                @endif
              @endforeach
            </select>
            
            @error('id_level')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <h4>Atur Password</h4>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control @error('password')
               is-invalid 
            @enderror" id="password" placeholder="Masukkan password">
            @error('password')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="passwordConfirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation')
               is-invalid 
            @enderror" id="passwordConfirmation" placeholder="Konfirmasi password">
            @error('password_confirmation')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <a href="{{route('admin.users.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection
