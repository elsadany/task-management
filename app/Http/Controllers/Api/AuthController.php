<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function __construct(readonly UserService $userService)
    {
        
    }
    
    function login(LoginRequest $request){
        $data = $this->userService->login($request->validated());
        if(!$data){
            return $this->errorResponse('invalid credentials');
        }
        return $this->successResponse(data:$data);
    }

    function logout(Request $request){
        $this->userService->logout($request->user());
        return $this->successResponse('logged out');
    }
}
