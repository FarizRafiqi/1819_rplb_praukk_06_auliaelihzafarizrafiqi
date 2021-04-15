@extends('layouts.admin')

@section('title', 'Edit Level')
@push('addon-style')
  <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-select-1.13.9/css/bootstrap-select.min.css')}}">
@endpush
@section('content')
  <div class="container">
    <h3 class="mb-4">Edit Level</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{ route('admin.levels.update', $level->id) }}" method="POST">
        @csrf
        @method("PUT")
        <div class="col-12">
          <div class="form-group">
            <label for="level">Level <span class="text-danger">*</span></label>
            <input type="level" name="level" class="form-control @error('level') is-invalid @enderror" id="level" placeholder="Masukkan level" value="{{ old('level', $level->level) }}"></input>

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
                  <option value="{{ $permission->id }}" {{ optional($level->permissions()->find($permission->id))->id == $permission->id ? 'selected' : '' }}>{{ $permission->title }}</option>
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
        <a href="{{route('admin.levels.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection
