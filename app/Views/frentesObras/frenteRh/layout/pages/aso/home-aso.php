<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>

<section class="content col-md-12">
    <div class="container-fluid">
        <h5 class="mb-2"><?= esc($title) ?></h5>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cargo: <?= esc($list_cargo['cargo_nome']) ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Exames</th>
                            <th>Tipos:&nbsp;
                                <?php
                                foreach ($list_tipos as $tipos) {
                                ?>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="inlineCheckbox1"><?= $tipos['ect_nome'] ?></label>
                                    </div>
                                <?php
                                }
                                ?>

                            </th>
                            <th>1º P/D</th>
                            <th>2º P/D</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($list_dd) && is_array($list_dd)) : ?>

                            <?php foreach ($list_dd as $news_item) : ?>
                                <tr>
                                    <td><?= esc($news_item['ex_tipo_exame']) ?></td>
                                    <td>
                                        <?php
                                        foreach ($list_tipos as $tipos) {
                                        ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="<?= $tipos['id'] ?>" <?php if($tipos['id'] == $news_item['ex_fk_tipo_contato']){echo 'checked';}?>>
                                                <label class="form-check-label" for="inlineCheckbox1"><?= $tipos['ect_nome'] ?></label>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        ?>
                                    </td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger">55%</span></td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>
                                <td colspan="4" class="text-center">Sem registro</td>
                            </tr>

                        <?php endif ?>




                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row -->

        <!-- =========================================================== -->

    </div><!-- /.container-fluid -->
</section>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>

<script>
    $(document).ready(function() {

    });
</script>
<?= $this->endSection() ?>