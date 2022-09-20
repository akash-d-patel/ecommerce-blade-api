{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $(function() {
    $('#datepicker').datepicker();
  });
</script>
<div class="card card-custom">
  <div class="card-header">
    <h3 class="card-title">
      Create Coupon
    </h3>
    <div class="card-toolbar">
      <div class="example-tools justify-content-center">
        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
    </div>
  </div>
  <!--begin::Form-->
  <form name="frmCoupon" id="frmCoupon" method="post" action="{{route('coupons.store')}}">
    @csrf
    <div class="card-body">

      <div class="form-group">
        <label for="client_id">Client<span class="text-danger">*</span></label>
        <select id="client_id" name="client_id" value="{{ old('client_id') }}" class="form-control @error('client_id') is-invalid @enderror">
          <option value="">---Select Client---</option>
          @foreach($clients as $client)
          <option value="{{$client->id}}" {{ (collect(old('client_id'))->contains($client->id)) ? 'selected':'' }}>{{$client->name}}</option>
          @endforeach
        </select>
        @error('client_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Coupon Code <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="Enter Coupon Code" />
        @error('code')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="status">Discount_Type<span class="text-danger">*</span></label>
        <select class="form-control @error('discount_type') is-invalid @enderror" id="discount_type" name="discount_type">
          <option value="">--Selected--</option>
          <option value="percent">Percent(%)</option>
          <option value="fixed">Fixed</option>
        </select>
        @error('discount_type')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>No Of Attempts <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('no_of_attemets') is-invalid @enderror" name="no_of_attemets" placeholder="Enter No of attempts" />
        @error('no_of_attemets')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Minimum_Order<span class="text-danger"></span></label>
        <input type="text" class="form-control @error('minimum_order_value') is-invalid @enderror" name="minimum_order_value" placeholder="Enter Minimum Order" />
        @error('minimum_order_value')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Maximum Discount<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('maximum_discount') is-invalid @enderror" name="maximum_discount" placeholder="Enter Maximum Discount " />
        @error('maximum_discount')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Expire Date<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('expire_date') is-invalid @enderror" id="datepicker" name="expire_date" placeholder="Enter Coupon Code" />
        @error('expire_date')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="status">Status<span class="text-danger"></span></label>
        <select class="form-control" id="status" name="status">
          <option>Active</option>
          <option>Inactive</option>
        </select>
      </div>

    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-light-primary mr-2">Add</button>
      <button type="reset" class="btn btn-light-primary">Cancel</button>
      <button type="button" onclick='window.location.href="{{route('coupons.index')}}"' class="btn btn-light-primary">Back</button>
    </div>
  </form>
  <!--end::Form-->
</div>
@endsection
{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
<!-- {{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection -->

{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

{{-- page scripts --}}
<script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection