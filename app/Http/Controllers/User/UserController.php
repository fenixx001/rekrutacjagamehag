<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\ApiController;


class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = UserResource::collection(
            User::all()
        );

        return $collection;
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

}
