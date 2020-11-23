<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function __construct() {
        $this->middleware(['auth','role:1,2'])->except(['index','create','store','profile','user_account_data_update','user_basic_data_update']);
        $this->middleware(['auth','role:1,2,5,8'])->only(['index','create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if( Auth::user()->role && Auth::user()->role->priority == 5 ){
            $data = Auth::user()->by;
            
            return view( 'users.all-users', [
                'users' => $data,
            ] );
        }elseif(Auth::user()->role && Auth::user()->role->priority == 8){
            $data = Auth::user()->by;
            return view( 'users.all-users', [
                'users' => $data,
            ] );
        }
        else{
            $data = User::all();
            return view( 'users.all-users', [
                'users' => $data,
            ] );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        if( Auth::user()->role && (Auth::user()->role->priority == 1 || Auth::user()->role->priority == 2) ){
            $roles = Role::pluck( 'name', 'id' )->toArray();
        }elseif (Auth::user()->role && (Auth::user()->role->priority == 8 )){
            $roles = Role::whereNotIn('priority',[1,2,8])->pluck( 'name', 'id' )->toArray();
        }else{
            $roles = Role::whereIn('priority',[10,11,12])->pluck( 'name', 'id' )->toArray();
        }
        // dd($roles);
        return view( 'users.create-users', [
            'roles' => $roles,
        ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        // dd( $request->role_id );

        $data = $request->validate( [
            'name'         => 'required',
            'fathers_name' => 'nullable',
            'email'        => 'nullable|unique:App\Models\User,email',
            'cell_no'      => 'required|string',
            'role_id'      => 'required|gt:0',
            'nid'          => 'nullable',
            'division'     => 'required',
            'district'     => 'required',
            'subdistrict'  => 'required',
            'shop_name'    => 'nullable',
            'password'     => 'nullable|confirmed|min:8',
            'is_active'    => 'required',
            'dob'          => 'nullable',
            'address'      => 'required',
        ], [
            'role_id.required' => 'The Role field is required',
        ] );

        if ( Auth::user()->role && (Auth::user()->role->priority == 5 || Auth::user()->role->priority == 8 ) ) {
            $data['added_by'] = Auth::user()->id;
        }
        
// dd( $data );
        if($data['password'] == null){
            $data['password'] = Hash::make("password");
        }else{
            $data['password'] = Hash::make( $data['password'] );
        }

        //dd("validation successful");

        if ( $file = $request->file( 'trade_lisence' ) ) {

            $name = time() . $file->getClientOriginalName();
            $file->move( 'media/userimages/', $name );

            $path = asset( 'media/userimages/' . $name );

            $image = Media::create( ['path' => $path, 'name' => $name] );
            //$image = Media::create( ['path' => asset( 'media/userimages/' ) . $name, 'name' => $request->username] );
            $data['trade_lisence'] = $image->id;

        }

        if ( $file = $request->file( 'shop_image' ) ) {

            $name = time() . $file->getClientOriginalName();
            $file->move( 'media/userimages/', $name );

            $path = asset( 'media/userimages/' . $name );

            $image = Media::create( ['path' => $path, 'name' => $name] );
            //$image = Media::create( ['path' => asset( 'media/userimages/' ) . $name, 'name' => $request->username] );
            $data['shop_image'] = $image->id;

        }

        $lastInput = User::create( $data );
        return redirect()->route( 'users.index' )->with( 'success', 1 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
    }

    public function search( Request $request ) {
        if ( empty( $request->all() ) ) {

            return view( 'users.search-user', [
                'users' => User::all(),
                'roles' => Role::all(),
            ] );
        } else {
            
            $data = $request->validate( [
                'division'    => 'required',
                'district'    => 'nullable',
                'subdistrict' => 'nullable',
            ] );

            $user = User::where( 'division', $data['division'] );

            $user = isset( $data['district'] ) ? $user->where( 'district', $data['district'] ) : $user;
            $user = isset( $data['subdistrict'] ) ? $user->where( 'subdistrict', $data['subdistrict'] ) : $user;

            $roles = Role::all();

            return view( 'users.search-user', [
                'users' => $user->get(),
                'roles' => $roles,
            ] );
        }
    }

    public function profile() {
        // dd(Auth::user());
        $roles = Role::pluck( 'name', 'id' )->toArray();
        return view( 'users.user-profile', [
            'user'  => Auth::user(),
            'roles' => $roles,
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user ) {

        $roles = Role::pluck( 'name', 'id' )->toArray();
        // dd($user);
        return view( 'users.edit-users', [
            'user'  => $user,
            'roles' => $roles,
        ] );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, User $user ) {
        $data = $request->validate( [
            'name'         => 'required',
            'fathers_name' => 'nullable',
            'email'        => 'nullable|unique:App\Models\User,email,' . $user->id,
            'cell_no'      => 'required|string',
            'role_id'      => 'required|gt:0',
            'nid'          => 'nullable',
            'division'     => 'required',
            'district'     => 'required',
            'subdistrict'  => 'required',
            'shop_name'    => 'nullable',
            'password'     => 'nullable|confirmed|min:8',
            'is_active'    => 'required',
            'dob'          => 'nullable',
            'address'      => 'required',
        ], [
            'role_id.required' => 'The Role field is required',
        ] );

        if ( $data['password'] == null ) {
            unset( $data['password'] );
        }

        if ( $file = $request->file( 'trade_lisence' ) ) {

            if ( $user->lisence ) {

                $unlinkAddress = str_replace( asset( '' ), '', $user->lisence->path );

                //return $unlinkAddress . $user->media->id;
                //return asset('') . $oldimage->path;
                if( file_exists($unlinkAddress) ){
                    unlink( $unlinkAddress );
                }
                Media::destroy( $user->lisence->id );
            }

            $name = time() . $file->getClientOriginalName();
            $file->move( 'media/userimages/', $name );

            $path = asset( 'media/userimages/' . $name );

            $image = Media::create( ['path' => $path, 'name' => $name] );
            //$image = Media::create( ['path' => asset( 'media/userimages/' ) . $name, 'name' => $request->username] );
            $data['trade_lisence'] = $image->id;

        }

        if ( $file = $request->file( 'shop_image' ) ) {

            if ( $user->shop_img ) {

                $unlinkAddress = str_replace( asset( '' ), '', $user->shop_img->path );

                //return $unlinkAddress . $user->media->id;
                //return asset('') . $oldimage->path;
                if( file_exists($unlinkAddress) ){
                    unlink( $unlinkAddress );
                }
                Media::destroy( $user->shop_img->id );
            }

            $name = time() . $file->getClientOriginalName();
            $file->move( 'media/userimages/', $name );

            $path = asset( 'media/userimages/' . $name );

            $image = Media::create( ['path' => $path, 'name' => $name] );
            //$image = Media::create( ['path' => asset( 'media/userimages/' ) . $name, 'name' => $request->username] );
            $data['shop_image'] = $image->id;

        }
        if ( isset( $data['password'] ) ) {
            $data['password'] = Hash::make( $data['password'] );
        }

        $user->update( $data );
        return redirect()->back()->with( 'update', 1 );
    }

    public function user_account_data_update( Request $request ) {

        $data = $request->validate( [
            'email'            => 'required',
            'cell_no'          => 'required',
            'current_password' => 'required_with:password|nullable',
            'password'         => 'nullable|min:8|string|confirmed',
        ] );

        if ( $data['current_password'] != null && $data['password'] != null ) {
            if ( Hash::check( $data['current_password'], Auth::user()->password ) ) {
                $data['password'] = Hash::make( $data['password'] );
            } else {
                return redirect()->back()->with( 'confirm_error', 1 );
            }
        } else if ( $data['password'] == null ) {
            $data['password'] = Auth::user()->password;
        }

        User::findOrFail( Auth::user()->id )->update( $data );
        return redirect()->back()->with( 'account_update', 1 );
    }

    public function front_reg( Request $request ) {

        $data = $request->validate( [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'fathers_name'  => ['required', 'string', 'max:255'],
            'cell_no'       => ['required', 'string', 'max:255'],
            'nid'           => ['required', 'string', 'max:255'],
            'role_id'       => ['required', 'integer', 'max:255'],
            'division'      => ['required', 'string', 'max:255'],
            'district'      => ['required', 'string', 'max:255'],
            'subdistrict'   => ['required', 'string', 'max:255'],
            'trade_lisence' => ['nullable', 'image'],
            'shop_image'    => ['nullable', 'image'],
            'shop_name'     => ['nullable', 'string'],
            'is_active'     => ['required'],
        ] );

        if ( $file = $request->file( 'trade_lisence' ) ) {
            // dd("File to ase");
            $name = time() . $file->getClientOriginalName();
            $file->move( 'media/userimages/', $name );

            $path = asset( 'media/userimages/' . $name );

            $image = Media::create( ['path' => $path, 'name' => $name] );
            //$image = Media::create( ['path' => asset( 'media/userimages/' ) . $name, 'name' => $request->username] );
            $data['trade_lisence'] = $image->id;
            // dd("File gese");
        }

        if ( $file = $request->file( 'shop_image' ) ) {

            $name = time() . $file->getClientOriginalName();
            $file->move( 'media/userimages/', $name );

            $path = asset( 'media/userimages/' . $name );

            $image = Media::create( ['path' => $path, 'name' => $name] );
            //$image = Media::create( ['path' => asset( 'media/userimages/' ) . $name, 'name' => $request->username] );
            $data['shop_image'] = $image->id;

        }

        User::create( [
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => Hash::make( $data['password'] ),
            'fathers_name'  => $data['fathers_name'],
            'cell_no'       => $data['cell_no'],
            'nid'           => $data['nid'],
            'role_id'       => $data['role_id'],
            'division'      => $data['division'],
            'district'      => $data['district'],
            'subdistrict'   => $data['subdistrict'],
            'trade_lisence' => $data['trade_lisence'] ?? null,
            'shop_image'    => $data['shop_image'] ?? null,
            'shop_name'     => $data['shop_name'] ?? null,
        ] );

        return redirect( '/login' );
    }

    public function user_basic_data_update( Request $request ) {

        $data = $request->validate( [
            'name'         => 'required',
            'fathers_name' => 'required',
            'role_id'      => 'required',
            'shop_name'    => 'nullable',
            'nid'          => 'required',
            'division'     => 'required',
            'district'     => 'required',
            'subdistrict'  => 'required',
        ] );
        // dd($data);

        User::findOrFail( Auth::user()->id )->update( $data );

        return redirect()->back()->with( 'basic_update', 1 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        $user = User::find( $id );

        if ( $user->lisence ) {

            $unlinkAddress = str_replace( asset( '' ), '', $user->lisence->path );

            //return $unlinkAddress . $user->media->id;
            //return asset('') . $oldimage->path;
            if( file_exists($unlinkAddress) ){
                unlink( $unlinkAddress );
            }
            Media::destroy( $user->lisence->id );
        }

        if ( $user->shop_img ) {

            $unlinkAddress = str_replace( asset( '' ), '', $user->shop_img->path );

            //return $unlinkAddress . $user->media->id;
            //return asset('') . $oldimage->path;
            if( file_exists($unlinkAddress) ){
                unlink( $unlinkAddress );
            }
            Media::destroy( $user->shop_img->id );
        }

        $user->delete();
        return redirect()->route( 'users.index' )->with( 'delete', 1 );
    }
}
