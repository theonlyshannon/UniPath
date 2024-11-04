<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AIService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class AIController extends Controller
{
    protected AIService $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Menampilkan halaman chatbot.
     */
    public function showChatbot()
    {
        return view('pages.student.chatbot');
    }

    /**
     * Menangani permintaan chat dari frontend.
     */
    public function chat(Request $request)
    {
        if (!Auth::check()) {
            $loginUrl = URL::route('login');
            return response()->json([
                'response' => "Mohon Login terlebih dahulu sebelum menggunakan AI, Login klik disini: <a href='$loginUrl'>Login</a>"
            ], 401);
        }

        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $user = Auth::user();

        $user->chatLogs()->create([
            'sender' => 'user',
            'message' => $validated['message'],
        ]);

        $response = $this->aiService->getCombinedResponse($validated['message']);

        Log::info('User ID: ' . $user->id . ' sent message: ' . $validated['message']);
        Log::info('AI response: ' . $response);

        return response()->json([
            'response' => $response,
        ]);
    }
}
