<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function find(string $id): ?User
    {
        return User::with('interests')->find($id);
    }

    public function addInterest(string $userId, string $interest): void
    {
        $user = $this->find($userId);
        if ($user) {
            $user->interests()->create([
                'interest' => $interest,
            ]);
        }
    }
}
