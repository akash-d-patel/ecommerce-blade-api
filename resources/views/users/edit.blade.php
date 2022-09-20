{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')


<div class="card card-custom">
  <div class="card-header">
    <h3 class="card-title">
      Edit User Profile
    </h3>
    <div class="card-toolbar">
      <div class="example-tools justify-content-center">
        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
      </div>
    </div>
  </div>
  <!--begin::Form-->
  <form name="frmuser" id="frmUser" method="post" action="{{route('users.update', $user->id)}}">
    @csrf
    @method('PUT')
    <div class="card-body">

      <div class="form-group">
        <label for="client_id">Client<span class="text-danger">*</span></label>
        <select class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" value="{{old('client_id', $user->client_id)}}">
          <option value="">---Select Client---</option>
          @foreach($clients as $key => $client)
          @if ($client->id == old('client_id', $user->client_id))
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
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $user->name)}}" placeholder="Enter user name" />
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Email <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email', $user->email)}}" placeholder="Enter email" />
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>Password <span class="text-danger">*</span></label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password', $user->password)}}" placeholder="Enter password" />
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="status">Status<span class="text-danger">*</span></label>
        <select class="form-control" id="status" name="status">
          <option value="Active" @if($user->status == 'Active') selected="selected" @endif>Active</option>
          <option value="Inactive" @if($user->status == 'Inactive') selected="selected" @endif>Inactive</option>
        </select>
      </div>

    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-light-primary mr-2">Update</button>
      <button type="reset" class="btn btn-light-primary">Cancel</button>
      <button type="button" onclick='window.location.href="{{route('users.index')}}"' class="btn btn-light-primary">Back</button>
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