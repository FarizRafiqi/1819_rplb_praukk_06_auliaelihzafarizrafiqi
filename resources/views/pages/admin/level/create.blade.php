@extends('layouts.admin')

@section('title', 'Tambah Level')
@section('content')
  <div class="container">
    <h3 class="mb-4">Tambah Level</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{ route('admin.levels.store') }}" method="POST" class="form-row">
        @csrf
        <div class="col-12">
          <div class="form-group">
            <label for="level">Level <span class="text-danger">*</span></label>
            <input type="level" name="level" class="form-control @error('level') is-invalid @enderror" id="level" placeholder="Masukkan level"></input>

            @error('level')
                <span class="text-danger">
                  <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="permissions">Hak Akses <span class="text-danger">*</span></label>
            <select name="permissions[]" class="selectpicker form-control @error('permissions') is-invalid @enderror @error('permissions.*') is-invalid @enderror" id="permissions" multiple data-actions-box="true" title="Pilih hak akses">
              @foreach ($permissions as $permission)
                  <option value="{{$permission->id}}">{{ $permission->title }}</option>
              @endforeach
            </select>

            @error('permissions')
                <span class="text-danger">
                  <strong>{{ $message }}</strong>
                </span>
            @enderror

            @error('permissions.*')
                <span class="text-danger">
                  <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <a href="{{ route('admin.levels.index') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary ml-2">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection
