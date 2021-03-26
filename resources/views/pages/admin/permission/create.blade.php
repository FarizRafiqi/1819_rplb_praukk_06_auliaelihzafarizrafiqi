@extends('layouts.admin')

@section('title', 'Tambah Hak Akses')

@section('content')
  <div class="container">
    <h3 class="mb-4">Tambah Hak Akses</h3>
    <div class="card">
      <div class="card-body">
        @livewire('admin.permission.permission-create')
      </div>
    </div>
  </div>
@endsection