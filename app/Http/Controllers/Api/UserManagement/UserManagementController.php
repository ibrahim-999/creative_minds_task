<?php

namespace App\Http\Controllers\Api\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\Api\UsersResource;
use App\Http\Resources\ProfilesResource;
use App\Libraries\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['index', 'store', 'destroy', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->guard('admin'))
        {
            return ApiResponse::fail('invalid credentials');
        }
        return ApiResponse::success([
            'Users' => UsersResource::collection(User::paginate())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        if (!auth()->guard('admin'))
        {
            return ApiResponse::fail('Unauthorized');
        }
        $user = User::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);
        return ApiResponse::success([
            $user
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        if (!auth()->guard('admin'))
        {
            return ApiResponse::forbidden('Unauthorized');
        }
        Log::info($request->all());
        $user = User::find($id);
        if (!$user)
        {
            return ApiResponse::fail('User Not Found');
        }
        $user->update($request->all());
        return ApiResponse::success([$user], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->guard('admin'))
        {
            return ApiResponse::fail('Unauthorized');
        }
        $user = User::find($id);
        if(!$user){
            return ApiResponse::fail('User Not Found');
        }
        $user->delete();
        return ApiResponse::success(['User Deleted Successfully'], 201);
    }
}
