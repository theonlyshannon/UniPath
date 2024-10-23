<?php

namespace App\Services;

use App\Interfaces\AIRepositoryInterface;
use Illuminate\Support\Facades\Log;

class AIService
{
    protected AIRepositoryInterface $aiRepository;

    public function __construct(AIRepositoryInterface $aiRepository)
    {
        $this->aiRepository = $aiRepository;
    }

    /**
     * Mendapatkan respons dari AI.
     *
     * @param string $message
     * @return string
     */
    public function getCombinedResponse(string $message): string
    {
        return $this->aiRepository->getResponse(['message' => $message]);
    }
}
