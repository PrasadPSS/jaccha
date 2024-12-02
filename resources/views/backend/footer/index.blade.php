@extends('backend.layouts.app')
@section('title', 'Footer')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Footer</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Footer
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
                                <h4 class="card-title">Footer</h4>
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
                                                <th>Catogory Title</th>
                                                <th>Image1</th>
                                                <th>Image2</th>
                                                <th>Image3</th>
                                                <th>Image4</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($footer) && count($footer)>0)
                                                @php $srno = 1; @endphp
                                                @foreach($footer as $footers)
                                                    <tr>
                                                        <td>{{ $srno }}</td>
                                                        <td>{{ $footers->footer_category_description}}</td>
                                                        <td><img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/footer-assets/above_category_image')}}/{{ $footers->footer_image1 }}" alt="footer image1"></td>
                                                        <td><img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/footer-assets/left_image1')}}/{{ $footers->footer_image2 }}" alt="footer image2"></td>
                                                        <td><img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/footer-assets/left_image2')}}/{{ $footers->footer_image3 }}" alt="footer image3"></td>
                                                        <td><img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/footer-assets/right_image')}}/{{ $footers->footer_image4 }}" alt="footer image4"></td>
                                                        <td>

                                                            <a href="{{ url('admin/footer/edit/'.$footers->id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>

                                                            {!! Form::open([
                                                                'method'=>'GET',
                                                                'url' => ['admin/footer/delete', $footers->id],
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
