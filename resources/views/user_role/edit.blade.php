{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Edit User Role
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    <form name="frmState" id="frmState" method="post" action="{{route('user_roles.update', $userRole->id)}}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="user_id">User<span class="text-danger">*</span></label>
                <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                    <option value="">---Select User---</option>
                    @foreach($users as $key => $user)
                    @if ($user->id == old('user_id',$userRole->user_id))
                    <option value="{{ $user->id }}" selected> {{ $user->name}} </option>
                    @else
                    <option value="{{ $user->id }}"> {{ $user->name}} </option>
                    @endif
                    @endforeach
                </select>
                @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role_id">Role<span class="text-danger">*</span></label>
                <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                    <option value="">---Select Role---</option>
                    @foreach($roles as $key => $role)
                    @if ($role->id == old('role_id',$userRole->role_id))
                    <option value="{{ $role->id }}" selected> {{ $role->name}} </option>
                    @else
                    <option value="{{ $role->id }}"> {{ $role->name}} </option>
                    @endif
                    @endforeach
                </select>
                @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-light-primary">Update</button>
            <button type="reset" class="btn btn-light-primary">Cancel</button>
            <button type="button" onclick='window.location.href="{{route('user_roles.index')}}"' class="btn btn-light-primary">Back</button>
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