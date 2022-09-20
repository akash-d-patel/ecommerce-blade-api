{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')
<div class="card card-custom">
  <div class="card-header">
    <h3 class="card-title">
      Create Product
    </h3>
    <div class="card-toolbar">
      <div class="example-tools justify-content-center">
        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
    </div>
  </div>
  <!--begin::Form-->
  <form name="frmProduct" id="frmProduct" method="post" action="{{route('products.store')}}">
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
        <label for="brand_id">Product<span class="text-danger"></span></label>
        <select class="form-control" id="brand_id" name="brand_id">
          <option value="">---Select Brand---</option>
          @foreach($brands as $brand)
          <option value="{{$brand->id}}">{{$brand->name}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter product name" />
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group mb-1">
        <label for="exampleTextarea">Description <span class="text-danger">*</span></label>
        <textarea class="form-control @error('description') is-invalid @enderror"" id=" description" name="description" rows="3" placeholder="Enter product description"></textarea>
        @error('description')
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
      <button type="button" onclick='window.location.href="{{route('products.index')}}"' class="btn btn-light-primary">Back</button>

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