{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<div class="card card-custom">
    @if(Session::has('message'))
    <div class="alert alert-custom alert-outline-success fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">
            {{ Session::get('message') }}
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
    @endif
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">

        </div>
        <div class="card-toolbar">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->

            <!--begin::Button-->
            <a href="{{ route('clients.create')}}" class="btn btn-light-primary px-6 font-weight-bold">Create Client</a>
            <!--end::Button-->
        </div>
    </div>

    <div class="card-body">

        <!--begin::Search Form-->
        <form name="frmSearch" id="frmSearch" method="get" action="{{route('clients.index')}}">
            <div class="mt-2 mb-5 mt-lg-5 mb-lg-10">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="search_txt" name="search_txt" value="{{old('search_txt', request('search_txt'))}}" />
                                    <span><i class="flaticon2-search-1 text-muted"></i></span>
                                </div>
                            </div>

                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                    <select class="form-control" name="status" id="kt_datatable_search_status">
                                        <option value="Active,Inactive">All</option>
                                        <option value="Active" @if(request()->status == 'Active') selected="selected" @endif>Active</option>
                                        <option value="Inactive" @if(request()->status == 'Inactive') selected="selected" @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4 mt-5 mt-lg-0">
                                <button class="btn btn-light-primary px-6 font-weight-bold">Search</button>
                                <button type="reset" onclick="window.location.href='{{route('clients.index')}}'" class="btn btn-light-primary">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Search Form-->

        <table class="table table-bordered table-hover" id="kt_datatable">
            <a class="datatable-pager-link datatable-pager-link-number datatable-pager-link-active" data-page="1" title="1"></a>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>
                        @if(!empty(request()->sort) && in_array('name,asc', request()->sort))
                        <a href="{{route('clients.index')}}?sort[]=name,desc">Client</a>
                        @else
                        <a href="{{route('clients.index')}}?sort[]=name,asc">Client</a>
                        @endif
                    </th>
                    <th>Status</th>
                    <th>
                        @if(!empty(request()->sort) && in_array('created_at,asc', request()->sort))
                        <a href="{{route('clients.index')}}?sort[]=created_at,desc">Created At</a>
                        @else
                        <a href="{{route('clients.index')}}?sort[]=created_at,asc">Created At</a>
                        @endif
                    </th>
                    <th>Created By</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>

                @forelse ($clients as $client)
                <tr>
                    <td>{{$client->id}}</td>
                    <td>{{$client->name}}</td>
                    <td>{{$client->status}}</td>
                    <td>{{$client->created_at->diffForHumans()}}</td>
                    <td>
                        @if(!is_null($client->created_by))
                        {{$client->created}}
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('clients.destroy',$client->id) }}" method="POST">
                            <a href="{{route('clients.edit',$client->id)}}" class="btn btn-icon btn-light btn-sm mx-3"> {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-md svg-icon-primary") }}</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-icon btn-light btn-sm">{{ Metronic::getSVG("media/svg/icons/General/Trash.svg", "svg-icon-md svg-icon-primary") }}</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <center><strong>Currently, Record not available.</strong></center>
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
        <div class="btn-group pull-right">
            {{$clients->links("pagination::bootstrap-4")}}
        </div>
    </div>

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