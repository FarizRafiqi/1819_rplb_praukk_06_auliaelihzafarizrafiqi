@extends('layouts.admin')

@section('title', 'Tambah Level')
@section('content')
  <div class="container w-50">
    <h3 class="mb-4">Tambah Level</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.levels.store')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="level">Level</label>
          <input type="level" name="level" class="form-control" id="level" placeholder="Masukkan level"></input>
        </div>
        <a href="{{route('admin.levels.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection
