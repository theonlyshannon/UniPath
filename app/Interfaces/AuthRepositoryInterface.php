<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function register(array $data);
    public function login(array $data);
    public function logout();
    public function user(array $data);
}
