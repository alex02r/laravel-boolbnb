@if (isset($message))
    <div class="modal fade" id="modal_message_delete-{{ $message->id }}" tabindex="-1" aria-labelledby="modal_message_delete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="modal_message_delete_label">Conferma cancellazione messaggio inviato da {{ $message->user_mail }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 id="custom-message">Sei sicuro di voler cancellare il messaggio inviato da {{ $message->user_mail }}?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Chiudi</button>
                    <form action="{{ route('user.message.destroy', ['message' => $message->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="fas fa-trash"></i> Cancella</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif