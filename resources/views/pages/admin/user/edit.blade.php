@extends('layouts.admin')

@section('title', 'Edit User')
@push('addon-style')
  <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-select-1.13.9/css/bootstrap-select.min.css')}}">
@endpush
@section('content')
  <div class="container w-50">
    <h3 class="mb-4">Edit User</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.users.update', $user->id)}}" method="POST">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputNama">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama')
              is-invalid  
            @enderror" id="inputNama" value="{{$user->nama}}" placeholder="Masukkan nama">
            @error('nama')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control @error('username')
              is-invalid  
            @enderror" id="username" value="{{$user->username}}" placeholder="Masukkan username">
            @error('username')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="selectLevel">Level</label>
          <select name="id_level" class="form-control @error('id_level')
             is-invalid 
          @enderror" id="selectLevel">
            <option selected>Pilih Level</option>
            @foreach($levels as $level)
              <option value="{{$level->id}}" {{($level->id == $user->id_level) ? 'selected' : ''}}>{{$level->level}}</option>
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
