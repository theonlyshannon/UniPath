<?php

namespace App\Repositories;

use App\Interfaces\AIRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Tectalic\OpenAi\Manager as OpenAIManager;
use Tectalic\OpenAi\Authentication;
use Tectalic\OpenAi\Models\ChatCompletions\CreateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatLog;

class AIRepository implements AIRepositoryInterface
{
    protected $openAIClient;

    public function __construct()
    {
        // Inisialisasi OpenAI Client menggunakan Tectalic
        $this->openAIClient = OpenAIManager::build(
            new \GuzzleHttp\Client(),
            new Authentication(env('OPENAI_API_KEY'))
        );
    }

    public function getResponse(array $data): string
    {
        try {
            // Mengambil data minat dari student
            $user = Auth::user();
            $student = $user->student;

            $interests = [];
            if ($student) {
                // Ambil minat universitas utama dan sekunder
                if ($student->mainUniversity) {
                    $interests[] = 'Main University: ' . $student->mainUniversity->name;
                }
                if ($student->secondUniversity) {
                    $interests[] = 'Secondary University: ' . $student->secondUniversity->name;
                }

                // Ambil minat fakultas utama dan sekunder
                if ($student->mainFaculty) {
                    $interests[] = 'Main Faculty: ' . $student->mainFaculty->name;
                }
                if ($student->secondFaculty) {
                    $interests[] = 'Secondary Faculty: ' . $student->secondFaculty->name;
                }

                if ($student->gender) {
                    $interests[] = 'Gender: ' . ucfirst($student->gender);
                }
                if ($student->city) {
                    $interests[] = 'City: ' . $student->city;
                }
            }

            // Mengambil chat logs terbaru, misalnya 5 terakhir
            $chatLogs = $user->chatLogs()->latest()->take(5)->get();

            $chatHistory = [];
            foreach ($chatLogs as $log) {
                $chatHistory[] = [
                    'role' => $log->sender === 'user' ? 'user' : 'assistant',
                    'content' => $log->message,
                ];
            }

            // Membuat prompt yang mencakup minat dan chat history
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'You are an AI assistant acting as a university admissions consultant. Your responses should be informative, friendly, and tailored to help students navigate university-related queries effectively. Use the user\'s interests and past chat history to provide personalized and human-like advice. When answering, ensure your responses are clear, concise, and helpful, similar to how a university lecturer would provide guidance.',
                ],
            ];

            if (!empty($interests)) {
                $messages[] = [
                    'role' => 'system',
                    'content' => 'User Interests: ' . implode(', ', $interests),
                ];
            }

            if (!empty($chatHistory)) {
                $messages = array_merge($messages, $chatHistory);
            }

            // Tambahkan pesan terbaru dari user
            $messages[] = [
                'role' => 'user',
                'content' => $data['message'],
            ];

            // Panggilan ke OpenAI GPT-4
            $openAIResponse = $this->openAIClient->chatCompletions()->create(
                new CreateRequest([
                    'model' => 'gpt-4-turbo',
                    'messages' => $messages,
                ])
            )->toModel();

            if (isset($openAIResponse->choices[0]->message->content)) {
                $responseContent = $openAIResponse->choices[0]->message->content;

                // Simpan respons AI ke chat logs
                $user->chatLogs()->create([
                    'sender' => 'ai',
                    'message' => $responseContent,
                ]);

                return $responseContent;
            }

            return "OpenAI tidak memberikan respons yang valid.";
        } catch (\Exception $e) {
            Log::error('Error fetching OpenAI response: ' . $e->getMessage());
            return "Mohon maaf, kami mengalami kendala dalam memproses permintaan Anda.";
        }
    }
}
