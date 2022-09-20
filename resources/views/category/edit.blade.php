{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')
<div class="card card-custom">
  <div class="card-header">
    <h3 class="card-title">
      Edit Category
    </h3>
    <div class="card-toolbar">
      <div class="example-tools justify-content-center">
        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
    </div>
  </div>
  <!--begin::Form-->
  <form name="frmProduct" id="frmProduct" method="post" action="{{route('categories.update', $category->id)}}">
    @csrf
    @method('PUT')
    <div class="card-body">

      <div class="form-group">
        <label for="client_id">Client<span class="text-danger">*</span></label>
        <select class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" value="{{old('client_id', $category->client_id)}}">
          <option value="">---Select Client---</option>
          @foreach($clients as $key => $client)
          @if ($client->id == old('client_id', $category->client_id))
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
        <label for="parent_id">Category<span class="text-danger"></span></label>
        <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
          <option value="">---Select Category---</option>
          @foreach($categories as $key => $parent_category)
          @if ($parent_category->id == $category->parent_id)
          <option value="{{ $parent_category->id }}" selected> {{ $parent_category->name}} </option>
          @else
          <option value="{{ $parent_category->id }}"> {{ $parent_category->name}} </option>
          @endif
          @endforeach
        </select>
        @error('parent_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $category->name)}}" placeholder="Enter category name" />
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group mb-1">
        <label for="exampleTextarea">Description <span class="text-danger">*</span></label>
        <textarea class="form-control @error('description') is-invalid @enderror"" id=" description" name="description" rows="3" placeholder="Enter category description">{{old('description', $category->description)}}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="status">Status<span class="text-danger"></span></label>
        <select class="form-control" id="status" name="status">
          <option value="Active" @if($category->status == 'Active') selected="selected" @endif>Active</option>
          <option value="Inactive" @if($category->status == 'Inactive') selected="selected" @endif>Inactive</option>
        </select>
      </div>
    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-light-primary mr-2">Update</button>
      <button type="reset" class="btn btn-light-primary">Cancel</button>
      <button type="Button" class="btn btn-light-primary" onclick='window.location.href="{{route('categories.index')}}"'>Back</button>

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