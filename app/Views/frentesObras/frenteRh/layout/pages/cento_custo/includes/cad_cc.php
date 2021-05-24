<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Cadastrar Cento de Custo</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/admin_rh/adiciona_rh_cc" method="POST" id="form_add_rh_new_cc">
    <?= csrf_field() ?>
        <div class="card-body">
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="cc_name">Número CC</label>
                    <input type="text" class="form-control" name="cc_name" id="cc_name" placeholder="Ex.: 1234567">
                    <span id="cc_name_error" class="text-danger"></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="dep_cc">Departamento CC</label>
                    <select class="form-control select2DepartamentosCC" name="dep_cc" id="dep_cc">
                        <option selected disabled>Selecione aqui..</option>
                        <?php if (!empty($departamentos) && is_array($departamentos)) : ?>
                            <?php foreach ($departamentos as $news_dep) : ?>
                                <option value="<?= esc($news_dep['id']) ?>"><?= esc($news_dep['dep_name']) ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option selected disabled>Sem cadastros</option>
                        <?php endif ?>
                    </select>
                    <span id="dep_cc_error" class="text-danger"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="cc_dec">Descrição:</label>
                    <textarea class="form-control" name="cc_dec" id="cc_dec" rows="3" placeholder="Digite aqui..."></textarea>
                    <span id="cc_dec_error" class="text-danger"></span>
                </div>
                <div class="col-md-12"><span id="message_new_cc"></span></div>
            </div>
            <input type="hidden" name="id_fk_cargo"     value="<?= session()->get('log_cargo') ?>">
            <input type="hidden" name="id_fk_obrar"     value="<?= session()->get('log_obra') ?>">
            <input type="hidden" name="id_fk_frent"     value="<?= session()->get('log_frente') ?>">
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="cls_add_cc btn btn-primary" id="id_add_cc">
                <i class="fa fa-save"></i> Salvar
            </button>
        </div>
    </form>
</div>