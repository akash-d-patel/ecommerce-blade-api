{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')
<div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Create SEO
     </h3>
     <div class="card-toolbar">
      <div class="example-tools justify-content-center">
       <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
       <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
     </div>
    </div>
    <!--begin::Form-->
    <form  name="frmSeo" id="frmSeo" method="post" action="{{ route('products.seo.store',$product->id)}}">
    @csrf
     <div class="card-body">

      <div class="form-group">
       <label>Title <span class="text-danger">*</span></label>
       <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter seo title"/>
        @error('title')
             <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group mb-1">
        <label for="exampleTextarea">Description <span class="text-danger">*</span></label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description"  name="description"  rows="3" placeholder="Enter seo description"></textarea>
        @error('description')
             <div class="invalid-feedback">{{ $message }}</div>
        @enderror
     </div>
     <div class="form-group">
       <label>Robot <span class="text-danger">*</span></label>
       <input type="text" class="form-control @error('robots') is-invalid @enderror" name="robots" placeholder="Enter seo robots"/>
        @error('robots')
             <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
       <label>View Port <span class="text-danger">*</span></label>
       <input type="text" class="form-control @error('view_port') is-invalid @enderror" name="view_port" placeholder="Enter seo view port"/>
        @error('view_port')
             <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
       <label>Character Set <span class="text-danger">*</span></label>
       <input type="text" class="form-control @error('charset') is-invalid @enderror" name="charset" placeholder="Enter seo character set"/>
        @error('charset')
             <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
       <label>Refresh Redirect <span class="text-danger">*</span></label>
       <input type="text" class="form-control @error('refresh_redirect') is-invalid @enderror" name="refresh_redirect" placeholder="Enter seo refresh redirect"/>
        @error('refresh_redirect')
             <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
     <div class="card-footer">
      <button type="submit" class="btn btn-light-primary mr-2">Add</button>
      <button type="reset" class="btn btn-light-primary">Cancel</button>
      <button type="button"  onclick='window.location.href="{{route('products.index',$product->id)}}"' class="btn btn-light-primary">Back</button>
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
