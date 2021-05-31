<!-- Modal -->
<div class="modal fade" id="trabalhoModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Compor trabalho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/admin_rh/cria-funcionario_cargo" method="POST" id="form_add_cargo_funcao_funcionario">
                    <?= csrf_field() ?>
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="trabalho_nome">Colaborador</label>
                            <select class="form-control select2FuncionarioCargos" name="funcionario_select" id="funcionario_select"></select>
                            <span id="funcionario_select_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Cargo</label>
                            <select class="form-control" name="select_cargo_e_funcoes" id="select_cargo_e_funcoes"></select>
                            <span id="select_cargo_e_funcoes_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputAddress">Departamento</label>
                            <select class="form-control" name="select_departamentos_all" id="select_departamentos_all"></select>
                            <span id="select_departamentos_all_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputAddress2">Atividade</label>
                            <select class="form-control" name="select_atividades_all" id="select_atividades_all"></select>
                            <span id="select_atividades_all_error" class="text-danger"></span>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="compositor_description">Descrição</label>
                        <textarea class="form-control" name="compositor_description" rows="3" placeholder="Digite aqui..."></textarea>
                        <span id="compositor_description_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="rh_cadastro" value="<?= session()->get('id') ?>">
                        <span id="rh_cadastro_error" class="text-danger"></span>
                    </div>

                    <button type="submit" class="cls_funcionario_cargo_add btn btn-info" id="id_funcionario_cargo_add">
                        <i class="fa fa-save"></i> Salvar
                    </button>

                </form>
<br>
<span id="message_cargo_funcionario"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>