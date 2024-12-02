@extends('backend.layouts.app')
@section('title', 'Special Deals')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Special Deals</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Special Deals
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Special Deals</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="col-12 text-right">
                        {{-- <a href="{{ route('admin.specialdeals.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a> --}}

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table zero-configuration" id="tbl-datatable">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                        <td>1</td>
                                                        <td>{{ $speacialDeal->start_date}}</td>
                                                        <td>{{ $speacialDeal->end_date}}</td>
                                                        
                                                        <td><a href="{{ url('admin/specialdeals/edit/'.$speacialDeal->id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a></td>
                                                    </tr>
                                           
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>

    <script>
        $(document).ready(function()
        {

        });
    </script>
@endsection
