<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Find a user by their ID, including their interests.
     *
     * @param string $id
     * @return User|null
     */
    public function find(string $id): ?User
    {
        return User::with('interests')->find($id);
    }

    /**
     * Add an interest to a user.
     *
     * @param string $userId
     * @param string $interest
     * @return void
     */
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
