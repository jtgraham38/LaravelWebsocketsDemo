@extends('welcome')

@section('content')
    <div class="w-4/5 lg:w-2/3 my-6 bg-white rounded-lg p-4">
        <!-- Chat Messages Area -->
        <div class="h-[500px] overflow-y-auto mb-4 space-y-4" id="messages">
            <!-- Messages will be displayed here -->
        </div>

        <!-- Chat Input Form -->
        <form action="{{ route('chat.send') }}" onsubmit="sendMessage(event)" method="POST" id="chat-form" class="flex gap-2">
            @csrf
            <input 
                type="text" 
                name="message" 
                placeholder="Type your message..." 
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                required
            >
            <button 
                type="submit" 
                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors"
            >
                Send
            </button>
        </form>
    </div>

    <script>
        //submit the form via ajax
        function sendMessage(e) { 
            console.log('sendMessage');
            e.preventDefault();
            const formData = new FormData(e.target);
            fetch(event.target.action, {
                method: 'POST',
                body: formData
            }).then(response => response.json())
                .then(data => {
                    console.log(data);
                });

            //clear the input field
            e.target.reset();
        }

        // Listen for new messages
        window.addEventListener("DOMContentLoaded", function() {
            console.log('DOMContentLoaded');
            window.Echo.channel('chat-channel')
            .listen('ChatEvent', (e) => {
                const messagesDiv = document.getElementById('messages');
                const messageElement = document.createElement('div');
                messageElement.className = 'bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200';
                messageElement.textContent = e.message;
                messagesDiv.appendChild(messageElement);
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            });
        });
    </script>
@endsection
