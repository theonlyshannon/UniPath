<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Menemukan pengguna berdasarkan UUID.
     *
     * @param string $id
     * @return User|null
     */
    public function find(string $id): ?User;

    /**
     * Menambahkan minat pengguna.
     *
     * @param string $userId
     * @param string $interest
     * @return void
     */
    public function addInterest(string $userId, string $interest): void;

    // Tambahkan metode lain sesuai kebutuhan
}
