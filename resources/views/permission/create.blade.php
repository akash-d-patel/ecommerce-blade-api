{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')
<div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Create Permission
     </h3>
     <div class="card-toolbar">
      <div class="example-tools justify-content-center">
       <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
       <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
     </div>
    </div>
    <!--begin::Form-->
    <form  name="frmPermission" id="frmPermission" method="post" action="{{ route('permissions.index')}}">
    @csrf
     <div class="card-body">

      <div class="form-group">
        <label for="parent_id">Permission<span class="text-danger">*</span></label>
        <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
          <option value="">---Select Permission---</option>
          @foreach($permissions as $permission)
          <option value="{{$permission->id}}">{{$permission->name}}</option>
          @endforeach
        </select>
        @error('parent_id')
             <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
       <label>Name <span class="text-danger">*</span></label>
       <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter permission name"/>
        @error('name')
             <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
       <label>Label <span class="text-danger">*</span></label>
       <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" placeholder="Enter permission label"/>
        @error('label')
             <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

     <div class="card-footer">
      <button type="submit" class="btn btn-light-primary mr-2">Add</button>
      <button type="reset" class="btn btn-light-primary">Cancel</button>
      <button type="button"  onclick='window.location.href="{{route('permissions.index')}}"' class="btn btn-light-primary">Back</button>
     </div>
    </form>
     <!--end::Form-->
   </div>
@endsection
{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
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