<!DOCTYPE html>
<html>
<head>
    <title>AI Chatbot</title>
    <!-- Link SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset some basic elements */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 1.5em;
            position: relative;
        }

        .chat-header .icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2em;
        }

        .chat-box {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-image: url('https://www.transparenttextures.com/patterns/black-hole.png');
            background-repeat: repeat;
        }

        .chat-message {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-end;
        }

        .chat-message.user {
            justify-content: flex-end;
        }

        .chat-message.ai {
            justify-content: flex-start;
        }

        .chat-message .message {
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 20px;
            position: relative;
            line-height: 1.4;
            font-size: 1em;
        }

        .chat-message.user .message {
            background-color: #4CAF50;
            color: white;
            border-bottom-right-radius: 0;
        }

        .chat-message.ai .message {
            background-color: #f1f0f0;
            color: #333;
            border-bottom-left-radius: 0;
        }

        .chat-message.ai .message::after {
            content: "";
            position: absolute;
            top: 10px;
            left: -10px;
            border-width: 10px 10px 10px 0;
            border-style: solid;
            border-color: transparent #f1f0f0 transparent transparent;
        }

        .chat-message.user .message::after {
            content: "";
            position: absolute;
            top: 10px;
            right: -10px;
            border-width: 10px 0 10px 10px;
            border-style: solid;
            border-color: transparent transparent transparent #4CAF50;
        }

        .input-group {
            display: flex;
            padding: 15px;
            border-top: 1px solid #ddd;
            background-color: #fafafa;
        }

        .input-group input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 1em;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-group input:focus {
            border-color: #4CAF50;
        }

        .input-group button {
            margin-left: 10px;
            padding: 10px 20px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 1.2em;
        }

        .input-group button:hover {
            background-color: #45a049;
        }

        /* Typing Indicator */
        .typing-indicator {
            display: none;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .typing-indicator .dot {
            height: 10px;
            width: 10px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            animation: blink 1.4s infinite both;
        }

        .typing-indicator .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-indicator .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes blink {
            0%, 80%, 100% {
                opacity: 0;
            }
            40% {
                opacity: 1;
            }
        }

        /* Scrollbar Styling */
        .chat-box::-webkit-scrollbar {
            width: 8px;
        }

        .chat-box::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .chat-box::-webkit-scrollbar-thumb {
            background: #4CAF50;
            border-radius: 4px;
        }

        .chat-box::-webkit-scrollbar-thumb:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <i class="fas fa-comments icon"></i>
            AI Chatbot
        </div>
        <div class="chat-box" id="chat-box">
            <!-- Chat messages akan ditampilkan di sini -->
            <div class="typing-indicator" id="typing-indicator">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
        <div class="input-group">
            <input type="text" id="message-input" placeholder="Type your message here..." autocomplete="off">
            <button id="send-button"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery for simplicity -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk mengirim pesan
            $('#send-button').click(function() {
                sendMessage();
            });

            // Kirim pesan saat menekan Enter
            $('#message-input').keypress(function(e) {
                if (e.which == 13) { // Enter key pressed
                    sendMessage();
                    return false;
                }
            });

            function sendMessage() {
                var message = $('#message-input').val().trim();
                if (message === '') {
                    return;
                }

                appendMessage('user', message);
                $('#message-input').val('');

                // Tampilkan typing indicator
                $('#typing-indicator').show();

                $.ajax({
                    url: '{{ route("student.chat") }}', // Menggunakan route POST web biasa
                    method: 'POST',
                    data: {
                        message: message
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        // Sembunyikan typing indicator
                        $('#typing-indicator').hide();
                        appendMessage('ai', response.response);
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        // Sembunyikan typing indicator
                        $('#typing-indicator').hide();
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = '';
                            $.each(errors, function(key, value) {
                                errorMessages += value.join('<br>') + '<br>';
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: errorMessages
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error processing your request.'
                            });
                        }
                    }
                });
            }

            function appendMessage(sender, message) {
                var messageHtml = '<div class="chat-message ' + sender + '"><div class="message">' + escapeHtml(message) + '</div></div>';
                $('#chat-box').append(messageHtml);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }

            // Fungsi untuk menghindari XSS
            function escapeHtml(text) {
                return text
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }
        });
    </script>
</body>
</html>
