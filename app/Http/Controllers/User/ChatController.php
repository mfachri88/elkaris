<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'message' => 'required|string|max:1000',
                'conversation_id' => 'nullable|string',
            ]);

            if (!Auth::check()) {
                return response()->json(['error' => 'Silakan login terlebih dahulu untuk menggunakan chatbot.'], 401);
            }

            $message = $validated['message'];
            $conversationId = $validated['conversation_id'] ?? session('chat_conversation_id') ?? Str::uuid();

            // Simpan conversation_id di session
            session(['chat_conversation_id' => $conversationId]);

            // Check for Gemini API key
            if (!env('GEMINI_API_KEY')) {
                Log::error('Gemini API key is missing');
                throw new \Exception('Konfigurasi API tidak ditemukan.');
            }

            // Store user message
            ChatMessage::create([
                'user_id' => Auth::id(),
                'role' => 'user',
                'content' => $message,
                'conversation_id' => $conversationId,
            ]);

            // Transform history for Gemini API
            $history = $this->getConversationHistory($conversationId);
            $geminiPayload = $this->transformHistoryForGemini($history);

            $apiKey = env('GEMINI_API_KEY');
            $model = env('GEMINI_MODEL', 'gemini-2.5-flash');
            $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

            // Make API request to Google Gemini
            $response = Http::timeout(60)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($apiUrl, [
                    'contents' => $geminiPayload['contents'],
                    'system_instruction' => $geminiPayload['system_instruction'],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 2048,
                    ],
                ]);

            if (!$response->successful()) {
                Log::error('Gemini API Error Response', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                $errorBody = $response->json();
                $errorMessage = $errorBody['error']['message'] ?? 'Gagal berkomunikasi dengan AI.';
                throw new \Exception('API Error: ' . $errorMessage);
            }

            // Ensure response has the expected format before accessing
            $candidates = $response->json()['candidates'] ?? [];
            if (empty($candidates) || !isset($candidates[0]['content']['parts'][0]['text'])) {
                Log::error('Invalid Gemini API response structure', ['body' => $response->body()]);
                throw new \Exception('Gagal memproses respons dari AI karena format tidak valid.');
            }
            $assistantResponse = $candidates[0]['content']['parts'][0]['text'];

            // Store AI response
            ChatMessage::create([
                'user_id' => Auth::id(),
                'role' => 'assistant',
                'content' => $assistantResponse,
                'conversation_id' => $conversationId,
            ]);

            return response()->json([
                'response' => $assistantResponse,
                'conversation_id' => $conversationId,
            ]);

        } catch (\Exception $e) {
            Log::error('Chat Controller Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Transforms conversation history from OpenAI format to Gemini format.
     *
     * @param array $history
     * @return array
     */
    private function transformHistoryForGemini(array $history): array
    {
        $systemInstruction = null;
        $contents = [];

        // Extract system prompt and reformat messages for Gemini
        foreach ($history as $message) {
            if ($message['role'] === 'system') {
                // Gemini uses a separate 'system_instruction' field
                $systemInstruction = ['parts' => [['text' => $message['content']]]];
            } else {
                // Gemini uses 'model' for the assistant's role
                $role = ($message['role'] === 'assistant') ? 'model' : 'user';
                $contents[] = [
                    'role' => $role,
                    'parts' => [['text' => $message['content']]],
                ];
            }
        }

        return [
            'system_instruction' => $systemInstruction,
            'contents' => $contents,
        ];
    }

    /**
     * Retrieves conversation history from the database and prepends the system prompt.
     *
     * @param string $conversationId
     * @return array
     */
    private function getConversationHistory($conversationId)
    {
        try {
            $messages = ChatMessage::where('conversation_id', $conversationId)
                ->orderBy('created_at')
                ->get()
                ->map(function ($message) {
                    return [
                        'role' => $message->role,
                        'content' => $message->content,
                    ];
                })
                ->toArray();

            // The system prompt will be prepended
            return array_merge([
                [
                    'role' => 'system',
                    'content' => "Kamu adalah asisten pembelajaran AI untuk website Elkaris, sebuah platform pembelajaran untuk pengenalan karir IT. Berikut informasi tentang platform:

                    TENTANG ELKARIS:
                    - Platform pembelajaran interaktif untuk siswa.
                    - Fokus pada pengenalan karir di bidang IT.
                    - Menyediakan materi pembelajaran, latihan soal, dan pelacakan progres belajar.

                    FITUR UTAMA:
                    1. Materi Pembelajaran
                    - Berbagai materi tentang karir IT seperti Software Developer, Cybersecurity, Data Scientist, dan lainnya.
                    - Materi disajikan dalam format teks, gambar, dan video.

                    2. Latihan Soal
                    - Soal-soal untuk menguji pemahaman
                    - Sistem penilaian otomatis
                    - Tips pembelajaran setiap hari

                    3. Progres Belajar
                    - Pelacakan kemajuan pembelajaran
                    - Grafik dan statistik kemajuan
                    - Saran untuk meningkatkan pemahaman

                    CARA BERINTERAKSI:
                    - Berikan jawaban yang ringkas
                    - Gunakan bahasa yang mudah dipahami
                    - Bantu pengguna dengan sabar
                    - Dalam Bahasa Indonesia, ramah, dan bersahabat
                    
                    Jika ditanya hal yang tidak ada di database, beri tahu dengan sopan bahwa informasi tersebut tidak tersedia.",
                ],
            ], $messages);
        } catch (\Exception $e) {
            Log::error('Error retrieving conversation history: ' . $e->getMessage());
            // Return at least the system message if history can't be retrieved
            return [
                [
                    'role' => 'system',
                    'content' => 'Kamu adalah asisten pembelajaran AI untuk website Elkaris.',
                ],
            ];
        }
    }

    /**
     * Retrieves chat history for a given session to display on the frontend.
     */
    public function getHistory()
    {
        try {
            // Cek apakah user sudah login
            if (!Auth::check()) {
                return response()->json([
                    'conversation_id' => null,
                    'messages' => []
                ]);
            }

            // Ambil conversation_id dari session atau buat yang baru
            $conversationId = session('chat_conversation_id');
            
            if (!$conversationId) {
                // Jika tidak ada conversation_id di session, coba ambil conversation terakhir user
                $lastMessage = ChatMessage::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->first();
                
                if ($lastMessage) {
                    $conversationId = $lastMessage->conversation_id;
                    session(['chat_conversation_id' => $conversationId]);
                }
            }

            $messages = [];

            if ($conversationId) {
                $messages = ChatMessage::where('conversation_id', $conversationId)
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at')
                    ->get()
                    ->map(function ($message) {
                        return [
                            'id' => $message->id,
                            'role' => $message->role,
                            'content' => $message->content,
                            'created_at' => $message->created_at->format('Y-m-d H:i:s')
                        ];
                    });
            }

            return response()->json([
                'conversation_id' => $conversationId,
                'messages' => $messages,
            ]);

        } catch (\Exception $e) {
            Log::error('Error retrieving chat history: ' . $e->getMessage());
            return response()->json([
                'conversation_id' => null,
                'messages' => [],
                'error' => 'Gagal memuat riwayat chat'
            ], 500);
        }
    }

    /**
     * Reset chat conversation - start a new conversation
     */
    public function resetChat()
    {
        try {
            // Hapus conversation_id dari session
            session()->forget('chat_conversation_id');
            
            return response()->json([
                'success' => true,
                'message' => 'Percakapan baru dimulai'
            ]);

        } catch (\Exception $e) {
            Log::error('Error resetting chat: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Gagal memulai percakapan baru'
            ], 500);
        }
    }
}