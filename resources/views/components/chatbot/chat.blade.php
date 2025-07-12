
<section class="bg-white rounded-xl border-4 border-[#f58a66]/20 shadow-lg p-6">
    <!-- Header dengan tombol reset -->
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Chatbot Asisten</h3>
        <div class="flex items-center gap-2">
            <!-- Indicator untuk pesan baru -->
            <button id="scroll-to-bottom"
                class="hidden px-2 py-1 text-xs bg-[#f58a66] text-white rounded-full hover:bg-[#f58a66]/90 transition-colors">
                <i class="fas fa-arrow-down mr-1"></i> Pesan baru
            </button>
            <button id="reset-chat" 
                class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                <i class="fas fa-redo-alt mr-1"></i> Percakapan Baru
            </button>
        </div>
    </div>
    
    <!-- Chat History -->
    <div id="chat-history" class="space-y-4 mb-6 h-[60vh] overflow-y-auto scroll-smooth"></div>

    <!-- Chat Input -->
    <form id="chat-form" class="relative">
        @csrf
        <textarea
            id="user-input"
            class="w-full py-4 pl-4 pr-20 border-2 border-gray-200 rounded-xl resize-none focus:border-[#f58a66] focus:ring-2 focus:ring-[#f58a66]/20 transition-colors lg:pr-24"
            placeholder="Ketik pesanmu di sini..."
            rows="2"
        ></textarea>
        <button
            type="submit"
            class="absolute right-4 bottom-6 bg-[#f58a66] text-white px-5 py-3 rounded-lg hover:bg-[#f58a66]/90 transition-colors disabled:bg-gray-300"
            id="send-button"
        >
            <i class="fa-solid fa-paper-plane" id="send-icon"></i>
            <i class="fa-solid fa-spinner fa-spin hidden" id="loading-icon"></i>
        </button>
    </form>
</section>

<script>
    const chatHistory = document.getElementById('chat-history');
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');
    const sendButton = document.getElementById('send-button');
    const sendIcon = document.getElementById('send-icon');
    const loadingIcon = document.getElementById('loading-icon');
    const resetChatBtn = document.getElementById('reset-chat');
    const scrollToBottomBtn = document.getElementById('scroll-to-bottom');

    // Variable untuk menyimpan conversation ID
    window.conversationId = null;

    // Load history saat halaman dimuat
    document.addEventListener('DOMContentLoaded', async () => {
        // Ambil conversation_id dari meta tag jika ada
        const metaConversationId = document.querySelector('meta[name="chat-conversation-id"]');
        if (metaConversationId && metaConversationId.content) {
            window.conversationId = metaConversationId.content;
        }
        
        // Load history saat halaman dimuat (tanpa scroll otomatis)
        await loadChatHistory();
        
        // Hanya scroll ke bawah jika tidak ada history atau history kosong
        if (chatHistory.children.length <= 1) {
            scrollToBottom();
        }
    });

    // Function untuk memuat chat history
    async function loadChatHistory() {
        try {
            setLoading(true);
            
            const response = await fetch('/chat/history', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            
            if (!response.ok) {
                throw new Error('Failed to load chat history');
            }
            
            const data = await response.json();
            
            // Set conversation ID
            if (data.conversation_id) {
                window.conversationId = data.conversation_id;
            }
            
            // Clear existing messages
            chatHistory.innerHTML = '';
            
            // Tampilkan pesan selamat datang jika tidak ada history
            if (!data.messages || data.messages.length === 0) {
                const welcomeMessages = [
                    "Hai! Saya asisten Elkaris. Ada yang bisa saya bantu terkait materi pembelajaran atau karir IT?",
                    "Kamu bisa bertanya tentang:",
                    "1. Materi pembelajaran",
                    "2. Profesi di bidang IT", 
                    "3. Rekomendasi belajar",
                    "4. Bantuan penggunaan platform"
                ];
                
                addMessage(welcomeMessages.join("\n"), false);
                return;
            }
            
            // Tampilkan pesan yang tersimpan
            data.messages.forEach(message => {
                addMessage(message.content, message.role === 'user', false, false); // No animation for existing messages
            });
            
        } catch (error) {
            console.error('Error loading chat history:', error);
            // Tampilkan pesan selamat datang default jika error
            const welcomeMessages = [
                "Hai! Saya asisten Elkaris. Ada yang bisa saya bantu terkait materi pembelajaran atau karir IT?",
                "Kamu bisa bertanya tentang:",
                "1. Materi pembelajaran", 
                "2. Profesi di bidang IT",
                "3. Rekomendasi belajar",
                "4. Bantuan penggunaan platform"
            ];
            
            addMessage(welcomeMessages.join("\n"), false, false, false); // No animation for welcome message
        } finally {
            setLoading(false);
        }
    }

    let conversationHistory = [];

    function setLoading(isLoading) {
        userInput.disabled = isLoading;
        sendButton.disabled = isLoading;
        sendIcon.classList.toggle('hidden', isLoading);
        loadingIcon.classList.toggle('hidden', !isLoading);
    }

    function addMessage(content, isUser = false, isError = false, retryMessage = null, withAnimation = true) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `flex ${isUser ? 'justify-end' : 'justify-start'}`;

        const messageContent = `
            <div class="max-w-[80%] ${isUser ? 'bg-[#f58a66]/10' : isError ? 'bg-red-50' : 'bg-gray-100'} rounded-xl p-4">
                <div class="flex items-center gap-3 mb-2">
                    <span class="font-semibold ${isError ? 'text-red-600' : 'text-gray-800'}">
                        ${isUser ? 'kamu' : 'Elkaris Assistant'}
                    </span>
                </div>
                <p class="${isError ? 'text-red-600' : 'text-gray-700'} whitespace-pre-wrap typing-text"></p>
                ${isError && retryMessage ? `
                    <button
                        onclick="retryMessage('${retryMessage}')"
                        class="mt-2 flex items-center gap-2 text-red-600 hover:text-red-700">
                        <i class="fas fa-redo-alt"></i>
                        Coba Lagi
                    </button>
                ` : ''}
            </div>
        `;

        messageDiv.innerHTML = messageContent;
        chatHistory.appendChild(messageDiv);

        // Only animate for new bot messages, not for loaded history
        if (!isUser && !isError && withAnimation) {
            const textElement = messageDiv.querySelector('.typing-text');
            animateTyping(textElement, content, 30);
        } else {
            messageDiv.querySelector('.typing-text').textContent = content;
        }

        // Only auto-scroll if user is near bottom or it's a new message
        if (withAnimation || isScrollNearBottom()) {
            scrollToBottom();
        } else if (withAnimation) {
            // Show scroll to bottom button for new messages when user is not at bottom
            scrollToBottomBtn.classList.remove('hidden');
        }
    }

    // Function to check if user is near bottom of chat
    function isScrollNearBottom() {
        return chatHistory.scrollTop + chatHistory.clientHeight >= chatHistory.scrollHeight - 100;
    }

    function animateTyping(element, text, delay = 30, onComplete = null) {
        let index = 0;
        element.textContent = '';

        const typeNextChar = () => {
            if (index < text.length) {
                element.textContent = text.slice(0, index + 1) + '▋';
                index++;
                if (isScrollNearBottom()) {
                    scrollToBottom();
                }
                setTimeout(typeNextChar, delay);
            } else {
                element.textContent = text;
                if (isScrollNearBottom()) {
                    scrollToBottom();
                }
                if (onComplete) onComplete();
            }
        };

        typeNextChar();
    }

    function scrollToBottom() {
        chatHistory.scrollTop = chatHistory.scrollHeight;
        // Hide scroll to bottom button when scrolled to bottom
        scrollToBottomBtn.classList.add('hidden');
    }

    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = userInput.value.trim();
        if (!message) return;

        const lastMessage = message;
        
        // Simpan posisi scroll sebelum menambah pesan
        const wasNearBottom = isScrollNearBottom();

        try {
            setLoading(true);
            addMessage(message, true, false, null, false); // User messages don't need animation

            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 30000);

            const response = await fetch('/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    message,
                    conversation_id: window.conversationId
                }),
                signal: controller.signal
            });

            clearTimeout(timeoutId);
            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Terjadi kesalahan saat menghubungi AI. Silakan coba lagi.');
            }

            window.conversationId = data.conversation_id;
            addMessage(data.response, false, false, null, true); // With animation for new messages

        } catch (error) {
            console.error('Chat Error:', error);

            let errorMessage;
            if (error.name === 'AbortError') {
                errorMessage = 'Waktu permintaan habis. Silakan coba lagi.';
            } else if (error.message.includes('Silakan login terlebih dahulu')) {
                errorMessage = 'Anda harus login untuk menggunakan chatbot. Silakan login dan coba lagi.';
            } else {
                errorMessage = error.message.includes('API')
                    ? 'Maaf, layanan AI sedang tidak tersedia. Tim kami sedang menangani masalah ini.'
                    : error.message;
            }

            addMessage(errorMessage, false, true, lastMessage, false); // No animation for error messages

        } finally {
            userInput.value = '';
            setLoading(false);
            userInput.focus();
        }
    });

    async function retryMessage(message) {
        userInput.value = message;
        await chatForm.dispatchEvent(new Event('submit'));
    }

    userInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });
    
    // Reset chat functionality
    resetChatBtn.addEventListener('click', async () => {
        if (confirm('Mulai percakapan baru? Riwayat percakapan sebelumnya akan disimpan di database.')) {
            try {
                const response = await fetch('/chat/reset', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Clear conversation ID
                    window.conversationId = null;
                    
                    // Clear chat history
                    chatHistory.innerHTML = '';
                    
                    // Tampilkan pesan selamat datang
                    const welcomeMessages = [
                        "Hai! Saya asisten Elkaris. Ada yang bisa saya bantu terkait materi pembelajaran atau karir IT?",
                        "Kamu bisa bertanya tentang:",
                        "1. Materi pembelajaran",
                        "2. Profesi di bidang IT",
                        "3. Rekomendasi belajar",
                        "4. Bantuan penggunaan platform"
                    ];
                    
                    addMessage(welcomeMessages.join("\n"), false, false, null, false); // No animation for welcome message
                } else {
                    throw new Error(data.error || 'Gagal memulai percakapan baru');
                }
                
            } catch (error) {
                console.error('Error resetting conversation:', error);
                alert('Gagal memulai percakapan baru. Silakan coba lagi.');
            }
        }
    });
    
    // Scroll to bottom button functionality
    scrollToBottomBtn.addEventListener('click', () => {
        scrollToBottom();
    });
    
    // Monitor scroll position to show/hide scroll to bottom button
    chatHistory.addEventListener('scroll', () => {
        if (isScrollNearBottom()) {
            scrollToBottomBtn.classList.add('hidden');
        }
    });
</script>