<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface
{
    public function getAllTransaction(?int $perPage = null, ?string $search = null);

    public function getMonthlyTransaction();
}
