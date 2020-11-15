@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        {{-- @if ( $errors->any() )
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reg.front') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fathers_name" class="col-md-4 col-form-label text-md-right">{{ __('Fathers Name') }}</label>

                            <div class="col-md-6">
                                <input id="fathers_name" type="text" class="form-control @error('fathers_name') is-invalid @enderror" name="fathers_name" value="{{ old('fathers_name') }}">

                                @error('fathers_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cell_no" class="col-md-4 col-form-label text-md-right">{{ __('Cell No') }}</label>

                            <div class="col-md-6">
                                <input id="cell_no" type="text" class="form-control @error('cell_no') is-invalid @enderror" name="cell_no" value="{{ old('cell_no') }}">

                                @error('cell_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nid" class="col-md-4 col-form-label text-md-right">{{ __('National Id (NID)') }}</label>

                            <div class="col-md-6">
                                <input id="nid" type="text" class="form-control @error('nid') is-invalid @enderror" name="nid" value="{{ old('nid') }}">

                                @error('nid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}"> --}}

                                {{-- <select name="role_id" id="role" class="form-control">
                                    <option value="dealer">Dealer</option>
                                    <option value="shop_owner">Shop Owner</option>
                                    <option value="service_center">Service Center</option>
                                    <option value="sales_representative">Sales Representative</option>
                                    <option value="divisional_manager">Divisional Manager</option>
                                </select> --}}

                                {!! Form::select('role_id', $roles, old('role_id'), ['class'=>'form-control','placeholder'=>'Choose Role']) !!}

                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="division" class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>

                            <div class="col-md-6">
                                {!! Form::select('division',\App\Models\User::divisions,null,['class'=>'form-control select2','placeholder'=>'Select Division']) !!}

                                @error('division')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                            <div class="col-md-6">
                                {!! Form::select('district',\App\Models\User::districts,null,['class'=>'form-control select2','placeholder'=>'Select District']) !!}

                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if( $errors->any() )
                            @foreach ($errors->all() as $item)
                                {{ $item }}
                            @endforeach
                        @endif
                        {!! Form::hidden('is_active',0) !!}
                        <div class="form-group row">
                            <label for="subdistrict" class="col-md-4 col-form-label text-md-right">{{ __('Subdistrict') }}</label>

                            <div class="col-md-6">
                                {!! Form::select('subdistrict',\App\Models\User::upazilas,null,['class'=>'form-control select2','placeholder'=>'Select Subdistrict']) !!}

                                @error('subdistrict')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <p>
                                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        Shop Owner/ Service Center form
                                    </button>
                                </p>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">

                                        <div class="form-group row">
                                            <label for="shop_name" class="col-md-4 col-form-label text-md-right">{{ __('Shop Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="shop_name" type="text" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ old('shop_name') }}">

                                                @error('shop_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="trade_lisence" class="col-md-4 col-form-label text-md-right">{{ __('Trade Lisence') }}</label>

                                            <div class="col-md-6">
                                                <input id="trade_lisence" type="file" class="form-control-file @error('trade_lisence') is-invalid @enderror" name="trade_lisence" value="{{ old('trade_lisence') }}">

                                                @error('trade_lisence')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="shop_image" class="col-md-4 col-form-label text-md-right">{{ __('Shop Image') }}</label>

                                            <div class="col-md-6">
                                                <input id="shop_image" type="file" class="form-control-file @error('shop_image') is-invalid @enderror" name="shop_image" value="{{ old('shop_image') }}">

                                                @error('shop_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6 text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection



