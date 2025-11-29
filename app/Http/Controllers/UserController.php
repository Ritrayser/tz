<?php

namespace App\Http\Controllers;

use App\DTO\UserLoginDto;
use App\DTO\UserRegisterDto;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\Profile;
use App\Models\User;
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

    public function login(UserService $userService, UserLoginRequest $request)
    {  
        $dto = new UserLoginDto(email: $request->email, password: $request->password);

        $user = $userService->login($dto);

        $token = $user->createToken('default');

        return response()->json(['token' => $token->plainTextToken], Response::HTTP_OK);
    }

    public function getProfile(UserService $userService)
    {
        return $userService->getProgile();
    }
}
