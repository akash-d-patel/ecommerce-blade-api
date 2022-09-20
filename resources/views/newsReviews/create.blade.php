{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Create Review
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    <form name="frmFile" id="frmFile" method="post" action="{{route('news.reviews.store',$news->id)}}" >
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Content <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('content') is-invalid @enderror" name="content" placeholder="Enter content" />
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Rating <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('rate') is-invalid @enderror" name="rate" placeholder="Enter rating" />
                @error('rate')
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
            <a class="btn btn-light-primary" href="{{ route('news.reviews.index',$news->id)}}">Back</a>

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