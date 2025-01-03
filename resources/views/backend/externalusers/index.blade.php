@extends('backend.layouts.app')
@section('title', 'External Users')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">External Users</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                                class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">External Users
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
                                <h4 class="card-title">External Users</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="col-12 text-right">
                                        @can('Create External Users')
                                            <!-- <a href="{{ route('admin.externalusers.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a> -->
                                        @endcan
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table zero-configuration" id="tbl-datatable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile No</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($externalusers) && count($externalusers) > 0)
                                                    @php $srno = 1; @endphp
                                                    @foreach ($externalusers as $user)
                                                        <tr>
                                                            <td>{{ $srno }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->mobile_no }}</td>
                                                            <td>{{ $user->account_status == 1 ? 'Active' : 'Inactive' }}</td>
                                                            <td>
                                                                @can('Update External Users')
                                                                    <a href="{{ url('admin/externalusers/editstatus/' . $user->id) }}"
                                                                        class="btn btn-primary"><i class="bx bx-lock"></i></a>
                                                                @endcan
                                                                <!-- @can('Update External Users')
        <a href="{{ url('admin/externalusers/edit/' . $user->id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
    @endcan -->
                                                                {!! Form::open([
                                                                    'method' => 'GET',
                                                                    'url' => ['admin/externalusers/delete', $user->id],
                                                                    'style' => 'display:inline',
                                                                ]) !!}
                                                                @can('Delete External Users')
                                                                    {!! Form::button('<i class="bx bx-trash"></i>', [
                                                                        'type' => 'submit',
                                                                        'class' => 'btn btn-danger',
                                                                        'onclick' => "return confirm('Are you sure you want to Delete this Entry ?')",
                                                                    ]) !!}
                                                                @endcan
                                                                {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                        @php $srno++; @endphp
                                                    @endforeach
                                                @endif
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
        $(document).ready(function() {

        });
    </script>
@endsection
