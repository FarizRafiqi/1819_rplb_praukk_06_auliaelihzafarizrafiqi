@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
  <div class="container w-50">
    <h3 class="mb-4">Edit Profile</h3>
    <div class="card mb-5">
      <div class="card-body">
        <form action="{{ route('admin.profile.update', $request->user()->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method("PUT")

          <h4 class="mb-3">Profile</h4>
          
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputNama">Nama</label>
              <input 
                    type="text" 
                    name="nama" 
                    class="form-control @error('nama') is-invalid @enderror" 
                    id="inputNama" 
                    value="{{ $request->user()->nama }}" 
                    placeholder="Masukkan nama"
              >
              @error('nama')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control @error('username')
                is-invalid  
              @enderror" id="username" value="{{ $request->user()->username }}" placeholder="Masukkan username">
              @error('username')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="text" name="email" class="form-control @error('email')
                is-invalid  
              @enderror" id="email" value="{{ $request->user()->email }}" placeholder="Masukkan email">
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            
            <div class="form-group col-md-6">
              <label for="level">Level</label>
              @if (auth()->user()->level->level === "administrator")
                <input type="hidden" 
                       name="id_level"
                       class="form-control @error('id_level') is-invalid @enderror" 
                       value="{{ $request->user()->id_level }}"
                >

                <input type="text" 
                       id="level"
                       class="form-control"
                       value="{{ $request->user()->level->level }}" 
                       readonly
                >

                @error('id_level')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              @else
                <select name="id_level" class="form-control @error('id_level') is-invalid @enderror" id="level">
                  <option selected disabled>Pilih Level</option>
                  @foreach($levels as $level)
                    <option value="{{ $level->id }}"  
                      {{ ($level->id === auth()->user()->id_level) ? 'selected' : '' }}
                    >{{ $level->level }}</option>
                  @endforeach
                </select>
                @error('id_level')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="gambar">Avatar</label>
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input 
                        type="file" 
                        class="custom-file-input @error('gambar') is-invalid @enderror" 
                        id="gambar" 
                        name="gambar"
                  >
                  <label class="custom-file-label" for="gambar">Pilih avatar</label>
                </div>
              </div>
              @error('gambar')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <h4 class="mb-3">Atur Password</h4>
          <div class="form-group">
            <label for="currentPassword">Password Saat Ini</label>
            <input 
                  type="password" 
                  name="current_password" 
                  class="form-control @error('current_password') is-invalid @enderror" 
                  id="currentPassword" 
                  placeholder="Password saat ini"
            >
            @error('current_password')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="new_password">Password Baru</label>
            <input 
                  type="password" 
                  name="password" 
                  class="form-control @error('password') is-invalid @enderror" 
                  id="newPassword" 
                  placeholder="Password baru"
            >
            @error('password')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="passwordConfirmation">Konfirmasi Password Baru</label>
            <input 
                  type="password" 
                  name="password_confirmation" 
                  class="form-control @error('password_confirmation') is-invalid @enderror" 
                  id="passwordConfirmation" 
                  placeholder="Konfirmasi password baru"
            >
            @error('password_confirmation')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          
          <a href="{{ route('admin.profile.index') }}" class="btn btn-danger">Batal</a>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection
