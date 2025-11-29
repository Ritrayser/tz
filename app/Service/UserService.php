<?php

namespace App\Service;

use App\DTO\UserLoginDto;
use App\DTO\UserRegisterDto;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function register(UserRegisterDto $dto): User
    {
        return DB::transaction(function () use ($dto) {
            $user = User::create([
                'name' => $dto->name,
                'email' => $dto->email,
                'password' => Hash::make($dto->password),
            ]);

            $profile = Profile::create([
                'first_name' => $dto->first_name,
                'last_name' => $dto->last_name,
                'gender' => $dto->gender,
                'user_id' => $user->id,
            ]);



            return $user;
        });
    }

    public function login(UserLoginDto $dto): User
    {
        $user = User::where('email', $dto->email)->first();

        if (!$user || !Hash::check($dto->password, $user->password)) {
            throw new AuthenticationException(['Неправильный логин или пароль']);
        }
        return $user;
    }

    public function getProgile(): Profile
    {
        $profile = Auth::user()->profile;

        return $profile;
    }
}
