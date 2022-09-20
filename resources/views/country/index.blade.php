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
        <div class="card-toolbar    ">
            <!--begin::Dropdown-->
            <div>

            </div>
            <div class="dropdown dropdown-inline mr-2">
                <!-- <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md">
                       
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                            </g>
                        </svg>
                       
                    </span>Export
                </button> -->
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-print"></i>
                                </span>
                                <span class="navi-text">Print</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-copy"></i>
                                </span>
                                <span class="navi-text">Copy</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-excel-o"></i>
                                </span>
                                <span class="navi-text">Excel</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-text-o"></i>
                                </span>
                                <span class="navi-text">CSV</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-pdf-o"></i>
                                </span>
                                <span class="navi-text">PDF</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>


            <!--end::Dropdown-->
            <!--begin::Button-->
            <a href="{{ route('countries.create')}}" class="btn btn-light-primary px-6 font-weight-bold">Create Country</a>
            <!--end::Button-->
        </div>

    </div>

    <div class="card-body">
        <!--begin::Search Form-->
        <form name="frmSearch" id="frmSearch" method="get" action="{{route('countries.index')}}">
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
                                <button type="reset" onclick="window.location.href='{{route('countries.index')}}'" class="btn btn-light-primary">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Search Form-->
        <table class="table table-bordered table-hover" id="kt_datatable">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Client</td>
                    <td>
                        @if(!empty(request()->sort) && in_array('name,asc', request()->sort))
                        <a href="{{route('countries.index')}}?sort[]=name,desc">Name</a>
                        @else
                        <a href="{{route('countries.index')}}?sort[]=name,asc">Name</a>
                        @endif
                    </td>
                    <th>status</th>
                    <th>Created At</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($countries as $country)
                <tr>
                    <td>{{$country['id']}}</td>
                    <td>{{$country->client->name}}</td>
                    <td>{{$country['name']}}</td>
                    <td>{{$country['status']}}</td>
                    <td>{{$country->created_at->diffForHumans()}}</td>
                    <td>{{$country['Created']}}</td>
                    <td>
                        <form action="{{ route('countries.destroy',$country->id) }}" method="POST">
                            <a href="{{route('countries.edit',$country->id)}}" class="btn btn-icon btn-light btn-sm mx-3"> {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-md svg-icon-primary") }}</a>
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
            {{$countries->links("pagination::bootstrap-4")}}
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