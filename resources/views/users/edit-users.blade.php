@extends('layouts.dash')

@section('title')
    Edit {{ $user->username ?? '' }} User
@endsection

@section('custom-header')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
@endsection

@section('block-header')
    <div class="block-header">

        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>User</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">PRHR</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
            @if ($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-times-circle"></i> {{ $error }}
                </div>
                @endforeach
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> User created Sucessfully
                </div>
            @elseif (session('update'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> User Updated Sucessfully
                </div>
            @endif
            <div class="card">
                <div class="header"><h1>Edit User</h1></div>
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>                    
                <div class="body">
                    {!! Form::model( $user, ['route'=>['users.update', $user->id],'method'=>'PATCH','files'=>true]) !!}
                    
                    
						<div class="form-row">
							<div class="col">
                                <b>{!! Form::label('name', 'Full Name'); !!}</b><span class="text-danger">*</span>
                                {!! Form::text('name',old('name'),['class'=>($errors->has('name')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'First Name']) !!}
                                @error('name')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror 
							</div>
							<div class="col">
                                <b>{!! Form::label('fathers_name', 'Fathers Name'); !!}</b>
                                {!! Form::text('fathers_name',old('fathers_name'),['class'=>($errors->has('fathers_name')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'John Doe']) !!}
                                @error('fathers_name')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
						<div class="form-row mt-4">
							
							<div class="col">
                                <b>{!! Form::label('email', 'Email'); !!}</b>
                                {!! Form::email('email',old('email'),['class'=>($errors->has('email')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'email@example.com']) !!}
                                @error('email')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col">
                                <b>{!! Form::label('dob', 'Date of Birth'); !!}</b>
                                {!! Form::date('dob',old('dob'),['class'=>($errors->has('dob')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'Date of Birth']) !!}
                                @error('dob')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror 
							</div>

                            <div class="col">
                                <b>{!! Form::label('nid', 'National ID'); !!}</b>
                                {!! Form::text('nid',old('nid'),['class'=>($errors->has('nid')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'National ID']) !!}                                  
                            </div>
                            @error('nid')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror

                            {{-- <div class="col">
                                <b>{!! Form::label('name', 'Full Name'); !!}</b>
                                {!! Form::text('name',old('name'),['class'=>($errors->has('name')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'First Name']) !!}
                                @error('name')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror 
							</div> --}}
						</div>

						

						
                        
                        <div class="form-row">
						    <div class="form-group col-md-4 col-6 mt-4">
                                <b>{!! Form::label('role_id', 'Role'); !!}</b>
                                {!! Form::select('role_id',['0'=>'Select Role'] + $roles ,null,['class'=>($errors->has('role_id')) ? 'form-control parsley-error' : 'form-control']) !!}
                                @error('role_id')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
						    </div>
						    <div class="form-group col-md-4 col-6 mt-4">
                                <b>{!! Form::label('cell_no', 'Cell No'); !!}</b><span class="text-danger">*</span>
                                {!! Form::text('cell_no',null,['class'=>($errors->has('cell_no')) ? 'form-control parsley-error' : 'form-control']) !!}
                                @error('cell_no')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror  
						    </div>
						    <div class="form-group col-md-4 col-6 mt-4">
                                <b>{!! Form::label('is_active', 'Is Active'); !!}</b><span class="text-danger">*</span>
                                {!! Form::select('is_active',['0'=>'Not Active','1'=>'Active'],null,['class'=>'form-control']) !!}  
                            </div>
                        </div>
                        
                        {{-- <div class="form-group">
                            <b>{!! Form::label('address', 'Address.'); !!}</b>
                            {!! Form::text('address',old('address'),['class'=>($errors->has('address')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'1234 Main St']) !!}
                            @error('address')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        
                        <b>{!! Form::label('address', 'Address'); !!}</b><span class="text-danger">*</span>
                        {!! Form::text('address',old('address'),['class'=>($errors->has('address')) ? 'form-control parsley-error mb-3' : 'form-control mb-3']) !!}
                        @error('address')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                        
						<div class="form-row mt-2">
						    <div class="form-group col-md-4">
                                <b>{!! Form::label('division', 'Division.'); !!}</b><span class="text-danger">*</span>
                                {!! Form::select('division',\App\Models\User::divisions,old('division'),['class'=>($errors->has('division')) ? 'form-control parsley-error select2' :'form-control select2']) !!}
                                @error('division')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
						    </div>
						    <div class="form-group col-md-4">
                                <b>{!! Form::label('district', 'District'); !!}</b><span class="text-danger">*</span>
                                {!! Form::select('district',\App\Models\User::districts,old('district'),['class'=>($errors->has('district')) ? 'states form-control parsley-error select2' : 'states form-control select2']) !!}
                                @error('district')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
						    </div>
						    <div class="form-group col-md-4">
                                <b>{!! Form::label('subdistrict', 'Subdistrict'); !!}</b><span class="text-danger">*</span>
                                {!! Form::select('subdistrict',\App\Models\User::upazilas,old('subdistrict'),['class'=>($errors->has('subdistrict')) ? 'states form-control parsley-error select2' : 'states form-control select2']) !!}
                                @error('subdistrict')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
						    </div>
                        </div>
                        <p class="text-info">These address credentials cannot be changed.</p>

                        <div class="form-row">
						    <div class="form-group col-md-4 col-6">
                                <b>{!! Form::label('shop_name', 'Shop Name'); !!}</b>
                                {!! Form::text('shop_name', old('shop_name'), ['class'=>($errors->has('shop_name')) ? 'form-control parsley-error' : 'form-control']) !!}
                                @error('shop_name')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
						    </div>
						    <div class="form-group col-md-4 col-6">
                                <b>{!! Form::label('trade_lisence', 'Trade Lisence'); !!}</b>
                                {!! Form::file('trade_lisence',['id'=>'file-1','class'=>($errors->has('trade_lisence')) ? 'form-control form-control-file parsley-error' : 'form-control form-control-file']) !!}
                                @error('trade_lisence')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror  
						    </div>
						    <div class="form-group col-md-4 col-6">
                                <b>{!! Form::label('shop_image', 'Shop Image'); !!}</b>
                                {!! Form::file('shop_image',['id'=>'file-2','class'=>'form-control form-control-file']) !!}  
                            </div>
                        </div>
                        <p class="text-info">These fields are optional fields if the role "Shop owner" or "Service Center"</p>

						<div class="form-row mt-3">
							<div class="col">
                                <b>{!! Form::label('password', 'Password'); !!}</b></b>
                                {!! Form::password('password',['class'=>($errors->has('password')) ? 'form-control parsley-error' : 'form-control','placeholder'=>'Password']) !!}  
                                @error('password')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
							</div>
							<div class="col">
								<b>{!! Form::label('password_confirmation', 'Confirm Password'); !!}</b></b>
                                {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Confirm Password']) !!}  
							</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <label><b>Trade Lisence</b></label><br>
                                <img class="img-fluid" style="height: 500px" src="{{ $user->lisence ? $user->lisence->path : "//via.placeholder.com/150" }}" alt="">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label><b>Shop Image</b></label><br>
                                <img class="img-fluid" style="height: 500px" src="{{ $user->shop_img ? $user->shop_img->path : "//via.placeholder.com/150" }}" alt="">
                            </div>
                        </div>


                        {{-- <div class="form-row mt-4">
                            <div class="col-6  mt-4">
                                <b>{!! Form::label('img_id','Profile Picture') !!}</b>
                                <div class="input-group mb-3">                                    
                                    <div class="custom-file">
                                        <!-- <input type="file" class="custom-file-input" id="inputGroupFile01"> -->
                                        {!! Form::file('img_id',['class'=>'custom-file-input']) !!}
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                @error('img_id')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-6 text-right"><img width="150px" class="img img-fluid" id="pr" src="https://via.placeholder.com/150" alt=""></div>
                        </div> --}}

                        <div class="form-row mt-4">
                            <div class="col-6">
                                {!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Go Back</a>
                            </div>
                        </div>
						
						

                    {!! Form::close() !!}
                    
                    {!! Form::open(['route'=>['users.update', $user->id],'method'=>'DELETE']) !!}
                        {!! Form::submit('Delete',['class'=>'btn btn-danger mt-4','onclick'=>'return confirm("Are you sure you want to delete this Profile?")']) !!}
                    {!! Form::close() !!}

                </div>  
            </div>
        </div>
    </div>
@endsection



@section('custom-footer-prepend')
    {{-- <script src="{{ asset("js/crs.min.js") }}"></script> --}}
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.select2').select2();
			$('input#img_id').change(function(){

				if (this.files && this.files[0]) {

			        var reader = new FileReader();
			        reader.onload = function (e) {
			            $('#pr').attr('src',e.target.result);
			        };
                    reader.readAsDataURL(this.files[0]);
                    
			    }

			});
		});
    </script>
@endsection