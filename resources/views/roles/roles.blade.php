@extends('layouts.dash')

@section('custom-header')   
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}"> --}}
    <style>
        .light_version .card .custom, .light_version .card .custom {
            background: #f8f8f8!important;
        }
    </style>
@endsection

@section('block-header')
    <div class="block-header">

        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>Roles</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">PRHR</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Role</li>
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
    <div class="col-md-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <i class="fa fa-check-circle"></i> Role Created Sucessfully
            </div>
        @elseif(session('update'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <i class="fa fa-check-circle"></i> Role Updates Sucessfully
            </div>
        @elseif(session('delete'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <i class="fa fa-check-circle"></i> Role Deleted Sucessfully
            </div>
        @elseif(session('notAllowed'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <i class="fa fa-check-circle"></i> Admisitrator Cannot Be Added Twice
            </div>
        @endif
        
        @if(isset($role))
            <div class="card">
                <div class="header"><h4>Edit Role</h4></div>
                <div class="body">
                    {!! Form::model( $role, ['route'=>['role.update', $role->id],'method'=>'PATCH']) !!}

                        <b>{!! Form::label('name', 'Role Name'); !!}</b>
                        {!! Form::text('name',null,['class'=>($errors->has('name')) ? 'form-control parsley-error' : 'form-control']) !!} 
                        @error('name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror 
                        
                        <b>{!! Form::label('priority', 'Priority',['class'=>'mt-4']); !!}</b>
                        {!! Form::select('priority',['1'=>'Admin','2'=>'Author','3'=>'Manager','4'=>'HR','5'=>'Accountant','6'=>'Employee','7'=>'Client'],'6',['class'=>($errors->has('priority')) ? 'form-control parsley-error' : 'form-control']) !!} 
                        @error('priority')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror 

                        {!! Form::submit('Update Role',['class'=>'btn btn-primary mt-4']) !!}      

                    {!! Form::close() !!}
                    
                    {{-- Delete Form --}}
                    {!! 
                        Form::open([
                            'method'    => 'DELETE',
                            'route'     => ['role.destroy',$role->id],
                            'class'     => 'mt-4'
                        ]) 
                    !!}
                        <div class="form-row">
                            <div class="col-6">
                                {!! Form::submit('Delete Role',['class'=>'btn btn-danger']) !!}
                            </div>
                            <div class="col-6 text-right">
                                <div class="col text-right">
                                    <a href="{{ route('roles') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}                    
                </div>
            </div>
        @else
            <div class="card">
                <div class="header">
                    <h4>Create Role</h4>
                </div>
                <div class="body" id="custom">
                    {!! Form::open(['action'=>'RoleController@store']) !!}

                        <b>{!! Form::label('name', 'Role Name'); !!}</b>
                        {!! Form::text('name',null,['class'=>($errors->has('name')) ? 'form-control parsley-error' : 'form-control']) !!} 
                        @error('name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror 
                        
                        <b>{!! Form::label('priority', 'Priority',['class'=>'mt-4']); !!}</b>
                        {!! Form::select('priority',['1'=>'Admin','2'=>'Author','3'=>'Manager','4'=>'HR','5'=>'Accountant','6'=>'Employee','7'=>'Client'],'6',['class'=>($errors->has('priority')) ? 'form-control parsley-error' : 'form-control']) !!}  
                        @error('priority')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror 

                        {!! Form::submit('Create Role',['class'=>'btn btn-primary mt-4']) !!}

                    {!! Form::close() !!}


                    
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-7">
        <div class="card mt-3">
            <div class="header">
                <h4>All Roles</h4>
            </div>
            <div class="body custom">
                <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                    <thead>
                        <tr>
                            <th><b>Id</b></th>
                            <th><b>Role Name</b></th>
                            <th><b>Priority</b></th>
                            <th><b>Created At</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($roles))
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td><div class="font-15"><b><a class="text-dark" href="#">{{ $role->name }}</a></b></div></td>
                                    <td>{{ $role->priority }}</td>
                                    <td>{{ $role->created_at ? $role->created_at->diffForHumans() : 'Not Available' }}</td>
                                    <td>
                                        <a href="{{ route('role.edit',$role->id) }}" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a>
                                        {{-- <button type="button" class="btn btn-sm btn-default js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>  --}}  
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p>No Roles Found</p>
                        @endif
                        
                    </tbody>
                </table>
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