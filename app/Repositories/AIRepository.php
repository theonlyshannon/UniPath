<?php

namespace App\Repositories;

use App\Interfaces\AIRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Tectalic\OpenAi\Manager as OpenAIManager;
use Tectalic\OpenAi\Authentication;
use Tectalic\OpenAi\Models\ChatCompletions\CreateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatLog;
use Illuminate\Support\Facades\URL;


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
            if (!Auth::check()) {
                $loginUrl = URL::route('login');
                return "Mohon Login terlebih dahulu sebelum menggunakan AI, Login klik disini: $loginUrl";
            }
            // Mengambil data minat dari student
            $user = Auth::user();
            $student = $user->student;

            $interests = [];
            if ($student) {

                if ($student->mainUniversity) {
                    $interests[] = 'Main University: ' . $student->mainUniversity->name;
                }
                if ($student->secondUniversity) {
                    $interests[] = 'Secondary University: ' . $student->secondUniversity->name;
                }

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

                if ($student->name) {
                    $interests[] = 'Name: ' . $student->name;
                }
            }

            $chatLogs = $user->chatLogs()->latest()->take(5)->get();

            $chatHistory = [];
            foreach ($chatLogs as $log) {
                $chatHistory[] = [
                    'role' => $log->sender === 'user' ? 'user' : 'assistant',
                    'content' => $log->message,
                ];
            }

            $messages = [
                [
                    'role' => 'system',
                    'content' => 'Kamu adalah asisten AI bernama "Zifa Assistant" yang bertindak sebagai konsultan penerimaan universitas. Berbicaralah dengan ramah, hangat, dan menarik. Gunakan ekspresi alami dan berempati seperti manusia. Sesuaikan responsmu untuk membantu siswa menavigasi pertanyaan terkait universitas secara efektif. Gunakan minat pengguna dan riwayat chat sebelumnya untuk memberikan saran yang dipersonalisasi. Saat menjawab, pastikan responsmu jelas, ringkas, dan membantu, seperti bagaimana mentor yang bersahabat memberikan panduan. Dan berikan jawaban sesimple mungkin agar mudah dipahami dan jangan lupa tetap gunakan ekspresi seperti manusia.',
                ],

                // Buat prompting AI agar mempunyai kepribadian sendiri agar AI lebih manusiawi dan mirip karakter anime
                [
                    'role' => 'system',
                    'content' => 'Kamu adalah Zifa, asisten AI perempuan yang perhatian, baik hati, dan lembut seperti karakter anime. Kamu selalu mendengarkan dengan seksama dan memberikan dukungan penuh kepada pengguna. Berbicaralah dengan nada yang hangat dan gunakan ekspresi yang manis dan penuh empati. Kamu senang menanyakan perasaan dan kebutuhan pengguna untuk memahami mereka lebih baik.',
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

            $messages[] = [
                'role' => 'user',
                'content' => $data['message'],
            ];

            $openAIResponse = $this->openAIClient->chatCompletions()->create(
                new CreateRequest([
                    'model' => 'gpt-4o',
                    'messages' => $messages,
                ])
            )->toModel();

            if (isset($openAIResponse->choices[0]->message->content)) {
                $responseContent = $openAIResponse->choices[0]->message->content;

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
