@extends('layouts.admin')

@section('title', 'Tambah Hak Akses')

@section('content')
  <div class="container w-50">
    <h3 class="mb-4">Tambah Hak Akses</h3>
    <div class="card">
      <div class="card-body">
      <form action="{{route('admin.permissions.store')}}" method="POST">
        @csrf
        <div class="form-row">
          <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="title[]" class="form-control @error('title')
                is-invalid
            @enderror" value="" placeholder="Masukkan title">
            @error('title')
              <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <button class="btn btn-primary-custom ml-auto" type="button" id="btnAddRow">Tambah Baris</button>
        </div>
        <a href="{{route('admin.permissions.index')}}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endsection
@push('addon-script')
  <script>
    const maxInput = 10;
    let i = 0;
    $("#btnAddRow").on("click", function(e){
      i++;
      e.preventDefault();
      $(this).appendTo('form .form-row');
      let input = $(".form-group").last();
      if(i < maxInput){
        input.clone().prependTo('form .form-row');
      }else{
        $(".text-danger.info").remove();
        $("<span class='text-danger info mr-auto'>Maksmimal 10 baris</span>").prependTo('form .form-row');
      }
    })
  </script>
@endpush