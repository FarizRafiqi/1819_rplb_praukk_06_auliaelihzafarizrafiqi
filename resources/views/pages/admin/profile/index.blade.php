@extends('layouts.admin')

@section('title', 'Profile')

@section('content')
  <div class="container w-md-50">
    <h4>Profile</h4>
    <div class="card card-profile mx-auto">
      <div class="card-body text-center">
        <img src="{{ auth()->user()->gambar ? Storage::url('img/avatar/'.auth()->id().'/'.auth()->user()->gambar) : "https://ui-avatars.com/api/?name=".auth()->user()->username }}" class="rounded-circle" alt="Avatar Default" width="120" height="120">
        <!-- icon user edit -->
        <a href="{{route('admin.profile.edit')}}" class="text-decoration-none shadow" data-toggle="tooltip" data-placement="top" title="Edit Profile">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#3F81BD" class="bi bi-pencil-square position-absolute" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
          </svg>
        </a>
        <div class="card-title">
          <div class="font-weight-bold mt-3">{{auth()->user()->nama}}</div>
          <div>{{auth()->user()->level->level}}</div>
          <div>{{auth()->user()->created_at}}</div>
        </div>
        <a href="#"data-toggle="tooltip" data-placement="top" title="{{auth()->user()->email}}">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#FF0000" class="bi bi-envelope-fill mt-4" viewBox="0 0 16 16">
            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
          </svg>
        </a>
      </div>
    </div>

  </div>
@endsection