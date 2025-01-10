@extends('backend.layouts.app')
@section('title', 'Payment Mode')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h5 class="content-header-title float-left pr-1 mb-0">Website Logo</h5>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb p-0 mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i
                                            class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active">Website Logo
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
                            <h4 class="card-title">Website Logo</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">

                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="tbl-datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td><img src="{{asset('/assets/images/' . $logo->logo_path)}}" alt="">
                                                </td>
                                                <td>
                                                    <!-- @can('Update') -->
                                                    <!-- @endcan -->
                                                    <a href="{{route('admin.homepagesections.logo.edit')}}"
                                                        class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                                                    <!-- @can('Delete') -->
                                                    <!-- @endcan -->

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
    $(document).ready(function () {

    });
</script>
@endsection