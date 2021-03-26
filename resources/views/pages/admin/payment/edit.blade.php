@extends('layouts.admin')

@section('title', 'Edit Pembayaran')

@section('content')
  <div class="container">
    <h3 class="mb-4">Edit Pembayaran</h3>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <form action="{{route('admin.payments.update', $payment->id)}}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="selectStatusPembayaran">Status Pembayaran</label>
                <select name="status" class="form-control" id="selectStatusPembayaran">
                  <option selected>Pilih Status</option>
                  @foreach(config('enum.payment_status') as $status)
                    <option value="{{$status}}" {{$status == $payment->status ? 'selected' : ''}}>{{$status}}</option>
                  @endforeach
                </select>
              </div>
              <a href="{{route('admin.payments.index')}}" class="btn btn-danger">Batal</a>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
<script>

</script>
@endpush