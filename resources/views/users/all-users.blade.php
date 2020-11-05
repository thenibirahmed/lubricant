@extends('layouts.dash')

@section('title')
    All Users
@endsection

@section('custom-header')   
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}"> --}}
    <style>
        .light_version .card .body, .light_version .card .card-body {
            background: transparent!important;
        }
    </style>
@endsection

@section('block-header')
    <div class="block-header">

        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>Users</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">PRHR</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Users</li>
                    </ol>
                </nav>
            </div>            
            {{-- <div class="col-md-6 col-sm-12 text-right hidden-xs">
                <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="">Create Campaign</a>
                <a href="#" class="btn btn-sm btn-success" title="Themeforest"><i class="icon-basket"></i>Fun?</a>
            </div> --}}
        </div>
    </div>
@endsection


@section('main-content')
    <div class="row clearfix">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> User created Sucessfully
                </div>
            @endif
            @if (session('delete'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-times-circle"></i> User deleted Sucessfully
                </div>
            @endif
            <div class="card">
                <div class="header">All Users</div>
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                            <thead>
                                <tr>
                                    <th><b>#</b></th>
                                    <th class="w60"><b> Name</b></th>
                                    <th><b>Role</b></th>
                                    {{-- <th><b>Username</b></th> --}}
                                    <th><b>Cell No.</b></th>
                                    <th><b>Created Date</b></th>
                                    <th class="w100"><b> Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <img src="{{ $user->media && $user->media->id != 0 ? $user->media->path : '//via.placeholder.com/50' }}" data-toggle="tooltip" data-placement="top" title="{{ $user->f_name ." ". $user->l_name }}" class="w35 h35 rounded">
                                        </td>
                                        <td>
                                            <p class="mb-0"><b>{{ $user->name }}</b></p>
                                            <span>{{ $user->email }}</span>
                                        </td>
                                        <td><span class="badge {{ $user->role ? 'badge-info' : 'badge-danger' }}">{{ $user->role->name ?? 'Not Defined' }}</span></td>
                                        {{-- <td>{{ $user->username }}</td> --}}
                                        <td>{{ $user->cell_no }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('users.edit',['user'=>$user->id]) }}" type="button" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a>
                                            {{-- <button type="button" class="btn btn-sm btn-default js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button> --}}
                                        </td>
                                    </tr>                            
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection


@section('custom-footer-append')
    <script src="{{ asset('html/assets/bundles/datatablescripts.bundle.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script> --}}
@endsection

@section('custom-footer-prepend')
    {{-- Data tables --}}
    <script src="{{ asset('html/assets/js/pages/tables/jquery-datatable.js') }}"></script>

@endsection


