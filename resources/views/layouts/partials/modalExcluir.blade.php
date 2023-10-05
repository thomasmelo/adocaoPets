{{-- <button type="button" class="btn btn-danger mx-1"
data-bs-toggle="modal"
data-bs-target="#modalExcluir"
    data-identificacao="" data-url="">
    <i class="fas fa-trash"></i>
</button> --}}

{{-- MODAL DE EXCLUSÃO --}}
<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalExcluirLabel">Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="Excluir" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p class="font-weight-bold" id="identificacao"></p>
                    Tem certeza que deseja realizar esta ação?<br>
                    Não será possível desfazê-la posteriormente!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <input type="submit" class="btn btn-danger" value="Confirmar Exclusão">
                </div>
            </form>
        </div>
    </div>
</div>
{{-- /MODAL DE EXCLUSÃO --}}
{{-- SCRIPT MODAL DE EXCLUSÃO --}}
<script>
        ;
        $('#modalExcluir').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let identificacao = button.data('identificacao')
        let url = button.data('url')
        $('#identificacao').text(identificacao)
        $('#Excluir').attr('action', url)
    })
</script>
{{-- /SCRIPT MODAL DE EXCLUSÃO --}}
