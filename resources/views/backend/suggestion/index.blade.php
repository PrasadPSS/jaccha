@extends('backend.layouts.app')
@section('title', 'Suggestion')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Suggestion</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Suggestion
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
                                <h4 class="card-title">Suggestion</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="col-12 text-right">
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table zero-configuration" id="tbl-datatable">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User Name</th>
                                                <th>Message</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($suggestions) && count($suggestions)>0)
                                                @php $srno = 1; @endphp
                                                @foreach($suggestions as $suggestion)
                                                    <tr>
                                                        <td>{{ $srno }}</td>
                                                        <td>{{$suggestion->name}}</td>
                                                        <td>{{Str::limit($suggestion->message,30)}}</td>
                                                        <td>
                                                          <a href="{{url('admin/suggestion/'.$suggestion->id)}}"
                                                           class="btn btn-primary">View</a>
                                                           {!! Form::open([
                                                               'method'=>'GET',
                                                               'url' => ['admin/suggestion/delete', $suggestion->id],
                                                               'style' => 'display:inline'
                                                           ]) !!}
                                                               {!! Form::button('<i class="bx bx-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
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
        $(document).ready(function()
        {

        });
    </script>
@endsection
