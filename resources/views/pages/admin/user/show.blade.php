@extends('layouts.admin')

@section('title', "Detail User")

@section('content')
  <div class="container">
    <h4 class="mb-4">{{$user->nama}}</h4>
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              Detail User
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-sm-3">Nama</dt>
              <dd class="col-sm-9">: {{$user->nama}}</dd>

              <dt class="col-sm-3">Username</dt>
              <dd class="col-sm-9">: {{$user->username}}</dd>

              <dt class="col-sm-3">Email</dt>
              <dd class="col-sm-9">: {{$user->email}}</dd>

              <dt class="col-sm-3">Level</dt>
              <dd class="col-sm-9">: {{$user->level->level}}</dd>

              <dt class="col-sm-3">Dibuat pada</dt>
              <dd class="col-sm-9">: {{$user->created_at->format("d F Y")}}</dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              Detail Golongan Tarif
            </h5>
          </div>
          <div class="card-body">
            <dl class="row">
              <dt class="col-sm-3">Golongan Tarif</dt>
              <dd class="col-sm-9">: </dd>

              <dt class="col-sm-3">Daya</dt>
              <dd class="col-sm-9">: </dd>

              <dt class="col-sm-3">Tarif Per KwH</dt>
              <dd class="col-sm-9">: </dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
@endpush