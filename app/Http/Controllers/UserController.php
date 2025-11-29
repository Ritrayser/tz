<?php

namespace App\Http\Controllers;

use App\DTO\UserRegisterDto;
use App\Http\Requests\UserRegistrationRequest;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function register(UserService $userService, UserRegistrationRequest $request)
    {
        $dto = new UserRegisterDto(name: $request->name, email: $request->email, password: $request->password, first_name: $request->first_name, last_name: $request->last_name, gender: $request->gender);

        $user = $userService->register($dto);

        $token = $user->createToken('auth_token');

        return response()->json(['token' => $token->plainTextToken], Response::HTTP_CREATED);
    }

    
}
