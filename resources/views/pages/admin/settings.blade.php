@extends('layouts.admin')

@section('title', 'Dashboard Setting')

@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">Settings</div>
      <div class="card-body">
        <form action="{{route('admin.settings')}}">
          <label for="switchNavbar">Navigasi</label>
          <div class="custom-control custom-switch">
            <input type="hidden" name="enable_sidebar" value="0">
            <input type="checkbox" name="enable_sidebar" value="1" class="custom-control-input" id="switchNavbar" {{Cookie::get('enable_sidebar') === "1" ? 'checked' : ''}}>
            <label class="custom-control-label" for="switchNavbar">sidebar</label>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection