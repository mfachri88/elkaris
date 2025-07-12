@component("layouts.main-layout", [
    "judul" => "Chatbot | Elkaris",
    "deskripsi" => "Asisten pembelajaran pintar Elkaris",
    "halaman_khusus" => false
])
<main class="min-h-screen px-6 bg-white">
    @include("components.chatbot.chat")
</main>
@endcomponent