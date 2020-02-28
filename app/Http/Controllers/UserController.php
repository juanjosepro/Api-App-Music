<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $cat = [];
        foreach ($users as $user) {
            $cat[] = $user->rol;
            $cat[] = $user->image;
        }
        return $users;
    }

    public function listStatus()
    {
        $status = User::select('status')->groupBy('status')->get();
        return $status;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->rol_id = $request['rol_id'];
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->country = $request['country'];
        $user->sex = $request['sex'];
        $user->date_of_birth = $request['date_of_birth'];
        $user->status = $request['status'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();

        $image = new Image();
        $image->url = 'https://lorempixel.com/90/90/';
        $image->imageable_type = 'App\User'; 
        $image->imageable_id = $user->id; 
        $image->save();

        return response()->json([
            'success' => true,
            'msg'     => 'Author created successfully',
            'user'    => $user    
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->rol_id = $request['rol_id'];
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];
        $user->country = $request['country'];
        $user->sex = $request['sex'];
        $user->date_of_birth = $request['date_of_birth'];
        $user->status = $request['status'];
        $user->email = $request['email'];
        $user->save();

        return response()->json([
            'success' => true,
            'msg'     => 'Author Updated successfully',
            'user'    => $user    
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 'DISABLED';
        $user->save();
        
        return response()->json([
            'success' => true,
            'msg'     => 'Author disabled successfully',
            'user'    => $user   
        ], 200);
    }
}
