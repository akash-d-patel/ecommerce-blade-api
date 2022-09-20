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
      Edit Coupon
    </h3>
    <div class="card-toolbar">
      <div class="example-tools justify-content-center">
        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
    </div>
  </div>
  <!--begin::Form-->
  <form name="frmProduct" id="frmProduct" method="post" action="{{route('coupons.update', $coupon->id)}}">
    @csrf
    @method('PUT')
    <div class="card-body">

      <div class="form-group">
        <label for="client_id">Client<span class="text-danger">*</span></label>
        <select class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" value="{{old('client_id', $coupon->client_id)}}">
          <option value="">---Select Client---</option>
          @foreach($clients as $key => $client)
          @if ($client->id == old('client_id', $coupon->client_id))
          <option value="{{$client->id}}" selected>{{$client->name}}</option>
          @else
          <option value="{{ $client->id }}"> {{ $client->name}} </option>
          @endif
          @endforeach
        </select>
        @error('client_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Coupon Code <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{old('code', $coupon->code)}}" placeholder="Enter Coupon code" />
        @error('code')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="discount_type">Discount_Type<span class="text-danger">*</span></label>
        <select class="form-control @error('discount_type') is-invalid @enderror" id="discount_type" name="discount_type">
          <option value="">--Selected--</option>
          @if ($coupon->discount_type == old('discount_type',$coupon->discount_type))
          <option value="percent" @if($coupon->discount_type == 'percent') selected="selected" @endif >percent(%)</option>
          <option value="fixed" @if($coupon->discount_type == 'fixed') selected="selected" @endif>fixed</option>
          @else
          <option value="percent" @if($coupon->discount_type == 'percent') @endif >percent(%)</option>
          <option value="fixed" @if($coupon->discount_type == 'fixed') @endif>fixed</option>
          @endif
        </select>
        @error('discount_type')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>No Of Attempts <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('no_of_attemets') is-invalid @enderror" name="no_of_attemets" value="{{old('no_of_attemets', $coupon->no_of_attemets)}}" placeholder="Enter no of attemets" />
        @error('no_of_attemets')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Minimum_Order <span class="text-danger"></span></label>
        <input type="text" class="form-control @error('minimum_order_value') is-invalid @enderror" name="minimum_order_value" value="{{old('minimum_order_value', $coupon->minimum_order_value)}}" placeholder="Enter minimum order value" />
        @error('minimum_order_value')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Maximum Discount <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('maximum_discount') is-invalid @enderror" name="maximum_discount" value="{{old('maximum_discount', $coupon->maximum_discount)}}" placeholder="Enter maximum discount" />
        @error('maximum_discount')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Expire Date <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('expire_date') is-invalid @enderror" id="datepicker" name="expire_date" value="{{old('expire_date', $coupon->expire_date)}}" placeholder="Enter Expire Date" />
        @error('expire_date')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="status">Status<span class="text-danger"></span></label>
        <select class="form-control" id="status" name="status">
          <option value="Active" @if($coupon->status == 'Active') selected="selected" @endif>Active</option>
          <option value="Inactive" @if($coupon->status == 'Inactive') selected="selected" @endif>Inactive</option>
        </select>
      </div>

    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-light-primary mr-2">Update</button>
      <button type="reset" class="btn btn-light-primary">Cancel</button>
      <button type="button" onclick='window.location.href="{{route('coupons.index')}}"' class="btn btn-light-primary">Back</button>

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