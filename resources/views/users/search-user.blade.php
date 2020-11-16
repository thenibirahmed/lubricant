@extends('layouts.dash')

@section('custom-header')
<link rel="stylesheet" href="{{ asset('assets/vendor/c3/c3.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}"> --}}
    <style>
        .card .body, .card .card-body {
            padding: 18px!important;
        }
        @media all and (max-height: 1000px){
            div.dataTables_wrapper div.dataTables_filter{
                margin-top: -35px!important;
            }
        }
    </style>
@endsection

@section('title')
   Search User
@endsection 

@section('block-header')
    <div class="block-header">

        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>Seach user</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Lubricant</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Seach user</li>
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
                    <i class="fa fa-check-circle"></i> User Deleted Sucessfully
                </div>
            @endif 
            <div class="card">                    
                <div class="tab-content">

                    <div class="" id="">
                        <div class="body mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-left">
                                        <button type="button" class="btn btn-sm mb-1 btn-outline-primary" data-toggle="modal" data-target="#exampleModal">Select Address</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body mb-3">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="button" class="btn btn-sm mb-1 btn-filter btn-outline-secondary" data-target="all">All</button>
                                        @if ( isset($roles) )
                                            @foreach ($roles as $role)
                                                <button type="button" class="btn btn-sm mb-1 btn-filter btn-outline-primary" data-target="{{ $role->name }}">{{ $role->name }}</button>
                                            @endforeach
                                        @endif
                                        <a href="{{ route('user.search') }}" class="btn btn-sm mb-1 btn-filter btn-outline-secondary">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover dataTable js-exportable table-custom spacing5">
                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th class="w60"><b> Name</b></th>
                                        <th><b>Role</b></th>
                                        <th><b>Division</b></th>
                                        <th><b>Cell No.</b></th>
                                        <th><b>Created Date</b></th>
                                        <th class="w100"><b> Action</b></th>
                                    </tr>
                                </thead>
                                @if( isset($users) )
                                    @if ( count($users) > 0 )
                                        <tbody> 
                                            @foreach ($users as $user)    
                                                <tr data-status="{{ $user->role ? $user->role->name : ''  }}">
                                                    <td>
                                                        <img src="{{ $user->media && $user->media->id != 0 ? $user->media->path : '//via.placeholder.com/50' }}" data-toggle="tooltip" data-placement="top" title="{{ $user->f_name ." ". $user->l_name }}" class="w35 h35 rounded">
                                                    </td>
                                                    <td>
                                                        <p class="mb-0"><b>{{ $user->name ?? 'Not Found' }}</b></p>
                                                        <span>{{ $user->email ?? 'Not Found' }}</span>
                                                    </td>
                                                    <td><span class="badge {{ $user->role ? 'badge-info' : 'badge-danger' }}">{{ $user->role->name ?? 'Not Defined' }}</span></td>
                                                    <td>{{ $user->division ?? "Not Found" }}</td>
                                                    <td>{{ $user->cell_no ?? 'Not Found' }}</td>
                                                    <td>{{ $user->created_at ? $user->created_at->diffForHumans() : "Not Found" }}</td>
                                                    <td>
                                                        <a href="{{ route('users.edit',['user'=>$user->id]) }}" type="button" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-edit"></i></a>
                                                        {{-- <button type="button" class="btn btn-sm btn-default js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button> --}}
                                                    </td>
                                                </tr>                 
                                            @endforeach
                                        </tbody>
                                    @endif
                                @endif
                                
                                
                            </table>
                        </div>
                    </div>

                </div> 
            </div>
        </div>
    </div>






        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Search User Credentials</b></h5>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)    
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <i class="fa fa-times-circle"></i> {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    
                    <div class="modal-body">
                        {!! Form::open(['method'=>'GET']) !!}
                            <div class="form-group">
                                <b>{!! Form::label('division', 'Division'); !!}</b>
                                {!! Form::select('division',\App\Models\User::divisions ?? [],null,['class'=>($errors->has('division')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'Select Division']) !!} 
                            </div>
                            <div class="form-group">
                                <b>{!! Form::label('district', 'District'); !!}</b>
                                {!! Form::select('district', \App\Models\User::districts ?? [], null,['class'=>($errors->has('district')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'Select District']) !!} 
                            </div>
                            <div class="form-group">
                                <b>{!! Form::label('subdistrict', 'subdistrict'); !!}</b>
                                {!! Form::select('subdistrict', App\Models\User::upazilas ?? [], null, ['class'=>($errors->has('subdistrict')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'Select Subistrict']) !!} 
                            </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('home') }}" class="btn btn-round btn-default">Cancel</a>
                        {!! Form::submit('Search',['class'=>'btn btn-round btn-primary']) !!}
                        {{-- <button type="button" class="btn btn-round btn-primary">Generate</button> --}}
                        {!! Form::close() !!}
                    </div>
                    
                </div>
            </div>
        </div>
@endsection

@section('custom-footer-prepend')


{{-- Data Table --}}
<script src="{{ asset('html/assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script> 
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script> 
{{-- <script src="{{ asset('js/buttons.flash.min.js') }}"></script> --}}
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script> 
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script> 
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script> 

{{-- Filter --}}
<script src="{{ asset('html/assets/js/pages/tables/table-filter.js') }}"></script>

    
    
@endsection


@section('custom-footer-append')


    <script>

        ;$(document).ready(function(){
            
            // jquery Tables   
            $('.js-exportable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        //fade: true
                    }
                ]
            });

            @if( isset($usermodal) && $usermodal ==  true )
                $('#exampleModal').modal({
                    backdrop: 'static',
                });
            @endif
            

            
        });
        
    </script>
    
    
@endsection


    
