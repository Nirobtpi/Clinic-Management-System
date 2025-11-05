import './bootstrap';

//  window.Laravel = { userId: userId };
//  alert(userId);
// const userId = document.head.querySelector('meta[name="user-id"]').content;
// window.Laravel = { userId: userId };
 let id = window.Laravel.userId


function handleIncomingMessage(e){
    const msg = e.message;
    const html = `
        <li class="media received">
            <div class="media-body">
                <div class="msg-box">
                    <div>
                        <p>${msg.message}</p>
                        <div class="chat-time"><span>${new Date(msg.created_at).toLocaleTimeString()}</span></div>
                    </div>
                </div>
            </div>
        </li>`;
    $('#messages').append(html);
    $('.chat-body').scrollTop($('#messages')[0].scrollHeight);
}

    window.Echo.private(`chat.${id}`)
        .listen('.MessageSent', handleIncomingMessage);


// Send message via AJAX
$(document).on('click', '#send-btn', function(){
    let message = $('#message-input').val();
    let receiver_id = $('#selected-user').val();

    if(!message.trim()) return;

    $.ajax({
        url: '/messages',
        type: 'POST',
        data: {
            message: message,
            receiver_id: receiver_id,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(res){
           const html = `
                <li class="media sent">
                    <div class="media-body">
                        <div class="msg-box">
                            <div>
                                <p>${res.message}</p>
                                <div class="chat-time"><span>${new Date(res.created_at).toLocaleTimeString()}</span></div>
                            </div>
                        </div>
                    </div>
                </li>`;
            $('#messages').append(html);
            $('#message-input').val('');
            $('.chat-body').scrollTop($('#messages')[0].scrollHeight);
        }
    });
});


