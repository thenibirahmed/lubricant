<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = User::all();
        return view( 'users.all-users', [
            'users' => $data,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $roles = Role::pluck( 'name', 'id' )->toArray();

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
        // dd( $request->all() );
        $data = $request->validate( [
            'name'            => 'required',
            'fathers_name'    => 'required',
            'email'           => 'required|unique:App\Models\User,email',
            'cell_no'         => 'required|string',
            'role_id'         => 'required|gt:0',
            'nid'             => 'required',
            'division'        => 'required',
            'district'        => 'required',
            'subdistrict'     => 'required',
            'shop_name'       => 'nullable',
            'password'        => 'required|confirmed|min:8',
            
        ], [
            'role_id.required'      => 'The Role field is required',
        ] );

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

        $data['password'] = Hash::make( $data['password'] );

        

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

    public function profile() {
        return view( 'users.user-profile', [
            'user' => Auth::user(),
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


        return view( 'users.edit-users', [
            'user' => $user,
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
            'name'            => 'required',
            'fathers_name'    => 'required',
            'email'           => 'required|unique:App\Models\User,email,'.$user->id,
            'cell_no'         => 'required|string',
            'role_id'         => 'required|gt:0',
            'nid'             => 'required',
            'division'        => 'required',
            'district'        => 'required',
            'subdistrict'     => 'required',
            'shop_name'       => 'nullable',
            'password'        => 'nullable|confirmed|min:8',
            
        ], [
            'role_id.required'      => 'The Role field is required',
        ] );

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

        $data['password'] = Hash::make( $data['password'] );

        $user->update( $data );
        return redirect()->back()->with( 'update', 1 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        $user = User::find( $id );

        if($user->lisence){

            $unlinkAddress = str_replace( asset( '' ), '', $user->lisence->path );
    
            //return $unlinkAddress . $user->media->id;
            //return asset('') . $oldimage->path;
            unlink( $unlinkAddress );
            Media::destroy( $user->lisence->id );
        }

        if($user->shop_img){

            $unlinkAddress = str_replace( asset( '' ), '', $user->shop_img->path );
    
            //return $unlinkAddress . $user->media->id;
            //return asset('') . $oldimage->path;
            unlink( $unlinkAddress );
            Media::destroy( $user->shop_img->id );
        }


        $user->delete();
        return redirect()->route( 'users.index' )->with( 'delete', 1 );
    }
}