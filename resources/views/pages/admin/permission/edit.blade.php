@extends('layouts.admin')

@section('title', 'Edit Hak Akses')
@section('content')
  <div class="container container-edit-user">
    <h3 class="mb-4">Edit Hak Akses</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.permissions.update', $permission->id)}}" method="POST">
        @csrf
        @method("PUT")
        <div class="form-row">
          <div class="form-group col-12">
            <label for="inputTitle">Title</label>
            <input type="text" name="title" class="form-control @error('title')
              is-invalid  
            @enderror" id="inputTitle" value="{{$permission->title}}" placeholder="Masukkan title">
            @error('title')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <a href="{{route('admin.permissions.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection
