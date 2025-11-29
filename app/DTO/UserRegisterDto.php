<?php

namespace App\DTO;

class UserRegisterDto
{
    public string $name;
    public string $email;
    public string $password;
    public string $first_name;
    public string $last_name;
    public string $gender;


    public function __construct(string $name, string $email, string $password, string $first_name, string $last_name, string $gender)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->gender = $gender;
    }
}
