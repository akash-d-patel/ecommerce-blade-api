{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')


<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#content'
    });
</script>
</script>


<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Edit Email Template
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    <form name="frmEmailTemplate" id="frmEmailTemplate" method="post" action="{{route('email_templates.update', $emailTemplate->id)}}">
        @csrf
        @method('PUT')
        <div class="card-body">

            <div class="form-group">
                <label for="client_id">Client<span class="text-danger">*</span></label>
                <select class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" value="{{old('client_id', $emailTemplate->client_id)}}">
                    <option value="">---Select Client---</option>
                    @foreach($clients as $key => $client)
                    @if ($client->id == old('client_id', $emailTemplate->client_id))
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
                <label>Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $emailTemplate->name)}}" placeholder="Enter name" />
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Subject<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{old('subject', $emailTemplate->subject)}}" placeholder="Enter subject" />
                @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-1">
                <label>Content<span class="text-danger">*</span></label>
                <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="3" placeholder="Enter content">{{old('content', $emailTemplate->content)}}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-light-primary mr-2">Update</button>
            <button type="reset" class="btn btn-light-primary">Cancel</button>
            <a class="btn btn-light-primary" href="{{ route('email_templates.index') }}">Back</a>
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