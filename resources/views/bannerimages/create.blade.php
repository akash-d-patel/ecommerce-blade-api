{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')
<div class="card card-custom">
     <div class="card-header">
          <h3 class="card-title">
               Create Image
          </h3>
          <div class="card-toolbar">
               <div class="example-tools justify-content-center">
                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
               </div>
          </div>
     </div>
     <!--begin::Form-->
     <form name="frmBanner" id="frmBanner" method="post" action="{{route('banners.images.store',$banner->id)}}" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
               <div class="form-group">
                    <label>Title<span class="text-danger"></span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter Title" />
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
               </div>
               <div class="form-group">
                    <label>Alt<span class="text-danger"></span></label>
                    <input type="text" class="form-control @error('alt') is-invalid @enderror" name="alt" placeholder="Enter Alt" />
                    @error('alt')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
               </div>
               <div class="form-group">
                    <label>Select Brand Image<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('path') is-invalid @enderror" name="path" placeholder="select your image" />
                    @error('path')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
               </div>
               <div class="card-footer">
                    <button type="submit" class="btn btn-light-primary mr-2">Add</button>
                    <button type="reset" class="btn btn-light-primary">Cancel</button>
                    <button type="Button" class="btn btn-light-primary" onclick='window.location.href="{{route('banners.images.index',$banner->id)}}"'>Back</button>
               </div>
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