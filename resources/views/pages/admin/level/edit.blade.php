@extends('layouts.admin')

@section('title', 'Edit Level')
@push('addon-style')
  <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-select-1.13.9/css/bootstrap-select.min.css')}}">
@endpush
@section('content')
  <div class="container w-50">
    <h3 class="mb-4">Edit Level</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.level.update', $level->id)}} method="POST">
        @csrf
        @method("PUT")
        <div class="form-group">
          <label for="level">Level</label>
          <input type="level" name="level" class="form-control" id="level" value="{{$level->level}}" placeholder="Masukkan level"></input>
        </div>
        <a href="{{route('admin.level.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection
