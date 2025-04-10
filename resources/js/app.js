import Echo from 'laravel-echo';
import './bootstrap';

window.Echo.channel('chat-channel')
    .listen('ChatEvent', (e) => {
        console.log('ChatEvent', e);
        //window.alert(e.message); // Should log "Hello, Soketi!"
    });