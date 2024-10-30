<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function find(string $id): ?User;

    public function addInterest(string $userId, string $interest): void;
}
