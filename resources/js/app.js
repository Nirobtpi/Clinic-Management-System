import './bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Make Pusher available globally
window.Pusher = Pusher;

// Laravel Echo instance
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Optional: Listen to messages in console for debugging
window.Echo.channel('chat')
    .listen('MessageSent', (e) => {
        console.log('New message:', e.message);
        const messagesEl = document.getElementById('messages');
        const li = document.createElement('li');
        li.textContent = e.message.user.name + ': ' + e.message.message;
        messagesEl.appendChild(li);
        messagesEl.scrollTop = messagesEl.scrollHeight;
    });

window.Echo.channel('chat')
    .listen('MessageSent', (e) => {
        console.log('New message:', e.message);
        const messagesEl = document.getElementById('messages');
        const li = document.createElement('li');
        li.textContent = e.message.user.name + ': ' + e.message.message;
        messagesEl.appendChild(li);
        messagesEl.scrollTop = messagesEl.scrollHeight;
    });
