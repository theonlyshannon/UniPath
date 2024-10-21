<?php

namespace App\Interfaces;

interface AIRepositoryInterface
{
    /**
     * Mendapatkan respons AI berdasarkan data yang diberikan.
     *
     * @param array $data
     * @return string
     */
    public function getResponse(array $data): string;
}
