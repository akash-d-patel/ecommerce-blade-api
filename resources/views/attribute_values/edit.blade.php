{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')


<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Edit Value
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    <form name="frmProduct" id="frmProduct" method="post" action="{{route('attribute-value.update',[$attribute->id, $attributeValue->id])}}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Value <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{old('value', $attributeValue->value)}}" placeholder="Enter Value">
                @error('value')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-light-primary mr-2">Update</button>
            <button type="reset" class="btn btn-light-primary">Cancel</button>
            <button type="button" onclick='window.location.href="{{route('attribute-value.index',$attribute->id)}}"' class="btn btn-light-primary">Back</button>
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