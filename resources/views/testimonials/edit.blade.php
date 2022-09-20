{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')


<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: '#description'
  });
</script>
</script>


<div class="card card-custom">
  <div class="card-header">
    <h3 class="card-title">
      Edit Testimonial
    </h3>
    <div class="card-toolbar">
      <div class="example-tools justify-content-center">
        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
    </div>
  </div>
  <!--begin::Form-->
  <form name="frmTestimonial" id="frmTestimonial" method="post" action="{{route('testimonials.update', $testimonial->id)}}">
    @csrf
    @method('PUT')
    <div class="card-body">

      <div class="form-group">
        <label for="client_id">Client<span class="text-danger">*</span></label>
        <select class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" value="{{old('client_id', $testimonial->client_id)}}">
          <option value="">---Select Client---</option>
          @foreach($clients as $key => $client)
          @if ($client->id == old('client_id', $testimonial->client_id))
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
        <label>Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title', $testimonial->title)}}" placeholder="Enter Attribute name" />
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group mb-1">
        <label for="exampleTextarea">Short Description <span class="text-danger">*</span></label>
        <textarea class="form-control @error('shortdescription') is-invalid @enderror" id="shortdescription" name="shortdescription" rows="3" placeholder="Enter Add Your Short Description">{{old('shortdescription', $testimonial->shortdescription)}}</textarea>
        @error('shortdescription')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group mb-1">
        <label for="exampleTextarea">Description <span class="text-danger">*</span></label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter Add Your Description">{{old('description', $testimonial->description)}}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="status">Status<span class="text-danger"></span></label>
        <select class="form-control" id="status" name="status">
          <option value="Active" @if($testimonial->status == 'Active') selected="selected" @endif>Active</option>
          <option value="Inactive" @if($testimonial->status == 'Inactive') selected="selected" @endif>Inactive</option>
        </select>
      </div>

    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-light-primary mr-2">Update</button>
      <button type="reset" class="btn btn-light-primary">Cancel</button>
      <a class="btn btn-light-primary" href="{{route('testimonials.index')}}">Back</a>
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