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
            <form class="formsub" action="{{ $routeName }}" method="{{ $method }}"> @csrf
                @if ($secondaryMethod == 'true')
                    @method('PUT')
                @endif
                <div class="modal-body">
                    {{ $modalBody }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">Cancelar</button>
                    @if ($buttonDelete == 'true')
                        <button id="btnDelete" type="button" class="btn btn-danger font-weight-bold">Eliminar</button>
                    @endif
                    <button type="submit" class="btn btn-primary btnsub font-weight-bold">{{ $buttonSubmit }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
