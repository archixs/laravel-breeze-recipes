<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat with AI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="font-semibold text-lg text-gray-800">AI Chat</h2>
                
                <div class="border rounded-lg p-4 h-96 overflow-y-auto" id="chat-box">
                    <div class="text-gray-600">Start chatting with AI!</div>
                </div>

                <form id="chat-form" class="mt-4 flex">
                    @csrf
                    <input type="text" id="message" name="message" placeholder="Enter message..." class="flex-grow border-gray-300 rounded-lg p-2" autocomplete="off">
                    <button type="submit" class="ml-2 text-white px-4 py-2 rounded-lg bg-blue-500">Send</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('chat-form').addEventListener('submit', function (event) {
        event.preventDefault();
        let messageInput = document.getElementById('message');
        let chatBox = document.getElementById('chat-box');
        let message = messageInput.value.trim();

        if (message === '') return;

        chatBox.innerHTML += `<div class='text-right text-blue-600 mt-2'>${message}</div>`;
        messageInput.value = '';

        fetch("{{ route('ai-page') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ content: message })
        })
        .then(response => response.json())
        .then(data => {
            chatBox.innerHTML += `<div class='text-left text-gray-600 mt-2'>${data.response}</div>`;
            chatBox.scrollTop = chatBox.scrollHeight;
        })
        .catch(error => console.error('Error:', error));
    });
</script>