<!-- Modal-->
<div class="modal fade" id="{{ $idComponent }}" data-backdrop="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $classModal }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $titleModal }}</h5>
                <button type="button" class="close p-4" data-dismiss="modal" aria-label="Close">
                    <span class="text-secondary" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-0">
                {{ $modalBody }}
            </div>
        </div>
    </div>
</div>
