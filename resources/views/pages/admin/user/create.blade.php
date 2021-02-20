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
            @enderror" id="inputNama" placeholder="Masukkan nama">
            @error('nama')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control @error('username')
                is-invalid
            @enderror" id="username" placeholder="Masukkan username">
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
          @enderror" id="passwordConfirmation" placeholder="Konfirmasi password">
          @error('password_confirmation')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="selectGolonganTarif">Level</label>
          <select name="id_level" class="form-control @error('id_level')
              is-invalid
          @enderror" id="selectGolonganTarif">
            <option selected>Pilih Level</option>
            @foreach($levels as $level)
              <option value="{{$level->id}}">{{$level->level}}</option>
            @endforeach
          </select>
          @error('id_level')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <a href="{{route('admin.users.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection