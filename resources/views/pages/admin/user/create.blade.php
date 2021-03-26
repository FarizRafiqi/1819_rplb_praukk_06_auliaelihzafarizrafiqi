@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
  <div class="container">
    <h3 class="mb-4">Tambah User</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.users.store')}}" method="POST">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputNama">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama')
                is-invalid
            @enderror" id="inputNama" value="{{old('nama')}}" placeholder="Masukkan nama">
            @error('nama')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control @error('username')
                is-invalid
            @enderror" id="username" value="{{old('username')}}" placeholder="Masukkan username">
            @error('username')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="text" name="email" class="form-control @error('email')
                is-invalid
            @enderror" id="inputEmail" value="{{ old('email') }}" placeholder="Masukkan email">
            @error('email')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="selectLevel">Level</label>
            <select name="id_level" class="form-control @error('id_level')
                is-invalid
            @enderror" id="selectLevel">
              <option selected>Pilih Level</option>
              @foreach($levels as $level)
                <option value="{{ $level->id }}" {{($level->id == old('id_level') ? 'selected' : '')}}>{{$level->level}}</option>
              @endforeach
            </select>
            @error('id_level')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control @error('password')
                is-invalid
            @enderror" id="password" placeholder="Masukkan password">
            @error('password')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="passwordConfirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="passwordConfirmation" placeholder="Konfirmasi password">
            @error('password_confirmation')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection