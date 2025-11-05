<div class="chat-header">
    <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
        <i class="material-icons">chevron_left</i>
    </a>
    <div class="media">
        <div class="media-img-wrap">
            <div class="avatar avatar-online">
                <img src="{{ asset($recipient->photo ?? 'frontend/assets/img/doctors/doctor-01.jpg') }}"
                    alt="User Image" class="avatar-img rounded-circle">
            </div>
        </div>
        <div class="media-body">
            <div class="user-name">{{ $recipient->name }}</div>
            <div class="user-status">online</div>
        </div>
    </div>
    <div class="chat-options">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#voice_call">
            <i class="material-icons">local_phone</i>
        </a>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#video_call">
            <i class="material-icons">videocam</i>
        </a>
        <a href="javascript:void(0)">
            <i class="material-icons">more_vert</i>
        </a>
    </div>
</div>
<div class="chat-body">
    <div class="chat-scroll">
        <ul class="list-unstyled" id="messages">
            @foreach($messages as $message)
                @if($message->sender_id == auth()->id())
                    <li class="media sent">
                        <div class="media-body">
                            <div class="msg-box">
                                <div>
                                    <p>{{ $message->message }}</p>
                                    <ul class="chat-msg-info">
                                        <li>
                                            <div class="chat-time">
                                                <span>{{ $message->created_at->format('h:i A') }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
                    <li class="media received">

                        <div class="media-body">
                            <div class="msg-box">
                                <div>
                                    <p>{{ $message->message }}</p>
                                    <ul class="chat-msg-info">
                                        <li>
                                            <div class="chat-time">
                                                <span>{{ $message->created_at->format('h:i A') }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif
            @endforeach

            {{-- <li class="chat-date">Today</li> --}}

        </ul>
    </div>
</div>
<div class="chat-footer">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="btn-file btn">
                <i class="fa fa-paperclip"></i>
                <input type="file">
            </div>
        </div>
        <input type="text" id="message-input" class="input-msg-send form-control" placeholder="Type something">
        <div class="input-group-append">
            <button type="button" id="send-btn" class="btn msg-send-btn"><i class="fab fa-telegram-plane"></i></button>
        </div>
    </div>
</div>
