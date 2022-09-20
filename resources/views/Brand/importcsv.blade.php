{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')

<div class="card card-custom">
    <div class="card-header">
     <h3 class="card-title">
      Import Brand
     </h3>
     <div class="card-toolbar">
      <div class="example-tools justify-content-center">
       <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
       <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
     </div>
    </div>
    <!--begin::Form-->
     <div class="card-body">

      <div class="form-group">
        <form method="POST" enctype="multipart/form-data" action="{{route('import.brands')}}">
            @csrf
            <div class="form-group">
                <label>Choose CSV<span class="text-danger">*</span></label>
                <!-- <input type="file" name="file" class="form-control"> -->
                <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" placeholder="Choose CSV"/>
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="card-footer">
            <button type="submit" class="btn btn-light-primary">Submit</button>
            <button type="reset" class="btn btn-light-primary">Cancel</button>
            <button type="button"  onclick='window.location.href="{{route('brands.index')}}"' class="btn btn-light-primary">Back</button>
            </div>
        </form> 
      </div>
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



