<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{	
    public function register(AdminRequest $request)
    {
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->phone = $request->phone;
    	$user->password = Hash::make($request->password);
    	$user->isVerified = true;
    	$user->save();
    	$user->assignRole('sub-admin');

    	return response([
            'success' => 'sub-admin created'
        ], Response::HTTP_CREATED);
    }

 
}
