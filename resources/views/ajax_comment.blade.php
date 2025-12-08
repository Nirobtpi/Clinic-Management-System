@forelse($comments as $comment)
    <li class="mb-4">
        <div class="d-flex">
            <img src="{{ asset('frontend/assets/img/patients/patient1.jpg') }}" alt="User Avatar"
                class="rounded-circle me-3" width="50" height="50">
            <div class="flex-grow-1 ml-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-1 fw-bold">Nirob</h6>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>

                <p class="mb-3">{{ $comment->comment }}</p>
                <div>
                    <button class="btn btn-sm btn-outline-primary me-2">
                        <i class="fas fa-thumbs-up"></i> Like
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-reply"></i> Reply
                    </button>
                </div>
            </div>
        </div>
    </li>
    <hr class="my-3">
@empty
    <li class="text-center text-muted py-4">
        <p>No comments yet. Be the first to comment!</p>
    </li>
@endforelse
