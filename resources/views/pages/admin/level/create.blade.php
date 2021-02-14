@extends('layouts.admin')

@section('title', 'Tambah Level')
@push('addon-style')
  <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-select-1.13.9/css/bootstrap-select.min.css')}}">
@endpush
@section('content')
  <div class="container">
    <h3 class="mb-4">Tambah Level</h3>
    <div class="card">
      <div class="card-body">
      <form>
        <div class="form-group">
          <label for="level">Level</label>
          <input type="level" name="level" class="form-control" id="level" placeholder="Masukkan level"></input>
        </div>
        <a href="{{route('admin.level.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
  <script src="{{asset('assets/plugin/bootstrap-select-1.13.9/js/bootstrap-select.min.js')}}"></script>
@endpush