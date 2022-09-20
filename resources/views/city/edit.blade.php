{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')
<div class="card card-custom">
  <div class="card-header">
    <h3 class="card-title">
      Edit City
    </h3>
    <div class="card-toolbar">
      <div class="example-tools justify-content-center">
        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      </div>
    </div>
  </div>
  <!--begin::Form-->
  <form name="frmCity" id="frmCity" method="post" action="{{route('cities.update', $city->id)}}">
    @csrf
    @method('PUT')
    <div class="card-body">

      <div class="form-group">
        <label for="client_id">Client<span class="text-danger">*</span></label>
        <select class="form-control @error('client_id') is-invalid @enderror" id="client_id" name="client_id" value="{{old('client_id', $city->client_id)}}">
          <option value="">---Select Client---</option>
          @foreach($clients as $key => $client)
          @if ($client->id == old('client_id', $city->client_id))
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
        <label for="country_id">Country<span class="text-danger">*</span></label>
        <select class="form-control @error('country_id') is-invalid @enderror" id="country_id" name="country_id">
          <option value="">---Select Country---</option>
          @foreach($countries as $key => $country)
          @if ($country->id == old('country_id', $city->state->country_id))
          <option value="{{ $country->id }}" selected> {{ $country->name}} </option>
          @else
          <option value="{{ $country->id }}"> {{ $country->name}} </option>
          @endif
          @endforeach
        </select>
        @error('country_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="state_id">State<span class="text-danger">*</span></label>
        <select class="form-control @error('state_id') is-invalid @enderror" id="state_id" name="state_id">
          <option value="">---Select State---</option>
          @foreach($states as $key => $state)
          @if ($state->id == old('state_id', $city->state_id))
          <option value="{{ $state->id }}" selected> {{ $state->name}} </option>
          @else
          <option value="{{ $state->id }}"> {{ $state->name}} </option>
          @endif
          @endforeach
        </select>
        @error('state_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label>City<span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $city->name)}}" placeholder="Enter city name" />
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-light-primary">Update</button>
      <button type="reset" class="btn btn-light-primary">Cancel</button>
      <button type="button" onclick='window.location.href="{{route('cities.index')}}"' class="btn btn-light-primary">Back</button>
    </div>
  </form>
  <!--end::Form-->
</div>
<script type=text/javascript>
  $('#country_id').change(function() {
    // alert('hi');
    var countryID = $(this).val();
    if (countryID) {
      $.ajax({
        type: "GET",
        url: "{{route('states.list')}}?country_id=" + countryID,
        success: function(res) {
          if (res) {
            $("#state_id").empty();
            $("#state_id").append('<option>Select</option>');
            $.each(res, function(key, value) {
              $("#state_id").append('<option value="' + key + '">' + value + '</option>');
            });

          } else {
            $("#state_id").empty();
          }
        }
      });
    } else {
      $("#state_id").empty();
      $("#city_id").empty();
    }
  });
  $('#state_id').on('change', function() {
    var stateID = $(this).val();
    if (stateID) {
      $.ajax({
        type: "GET",
        url: "{{url('get-city-list')}}?state_id=" + stateID,
        success: function(res) {
          if (res) {
            $("#city_id").empty();
            $.each(res, function(key, value) {
              $("#city_id").append('<option value="' + key + '">' + value + '</option>');
            });

          } else {
            $("#city_id").empty();
          }
        }
      });
    } else {
      $("#city_id").empty();
    }

  });
</script>
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