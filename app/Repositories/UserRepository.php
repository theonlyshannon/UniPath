<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Menemukan pengguna berdasarkan UUID.
     *
     * @param string $id
     * @return User|null
     */
    public function find(string $id): ?User
    {
        return User::with('interests')->find($id);
    }

    /**
     * Menambahkan minat pengguna.
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

    // Implementasi metode lain sesuai kebutuhan
}
