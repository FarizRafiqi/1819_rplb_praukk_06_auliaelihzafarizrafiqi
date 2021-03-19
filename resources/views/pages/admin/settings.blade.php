@extends('layouts.admin')

@section('title', 'Dashboard Setting')

@section('content')
  <div class="container">
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <strong>Bosan dengan navbar?</strong>
      Cobain sidebar deh!.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="card">
      <div class="card-header">Settings</div>
      <div class="card-body">
        <form action="{{route('admin.settings')}}">
          <label for="switchNavbar">Navigasi</label>
          @livewire('toggle-button')
        </form>
      </div>
    </div>
  </div>
@endsection