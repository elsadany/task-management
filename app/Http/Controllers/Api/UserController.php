<?php

namespace App\Http\Controllers\Api;

use App\services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function __construct(protected readonly UserService $userService)
    {
        
    }
    function index(Request $request){
        $data = $this->userService->index(['role'=>'user']);
        return $this->successResponse(data:$data);
    }
}
