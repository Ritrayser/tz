<?php

namespace App\Service;

use App\DTO\UserRegisterDto;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function register(UserRegisterDto $dto): User
    {
        return DB::transaction(function ()use ($dto){
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
}
