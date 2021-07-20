<?= $this->extend('Views/kanban/layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Quadro de projetos</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Projetos</th>
                    <th>Data inicial</th>
                    <th>Data Final</th>
                    <th style="width: 40%;">Progresso</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listProjetos) && is_array($listProjetos)) : ?>
                    <?php foreach ($listProjetos as $pro_kan) : ?>
                        <tr>
                            <td><?= esc($pro_kan['kbp_nome_projeto']) ?></td>
                            <td><?= esc(date('d/m/Y', strtotime($pro_kan['kbp_data_inicial']))) ?></td>
                            <td><?= esc(date('d/m/Y', strtotime($pro_kan['kbp_data_final']))) ?></td>
                            <td>
                                <?php
                                $data_inicio = new DateTime($pro_kan['kbp_data_inicial']);
                                $data_fim = new DateTime($pro_kan['kbp_data_final']);
                                $dateInterval = $data_inicio->diff($data_fim);

                                $data_hoje = new DateTime(date('Y-m-d'));
                                $data_final_recebida = new DateTime($pro_kan['kbp_data_final']);
                                $dateDiasRestantes = $data_hoje->diff($data_final_recebida);
                                $x = $dateDiasRestantes->days;
                                $y = $dateInterval->days;

                                $percent = $x/$y * 100;

                                $percent_friendly = number_format($percent) . '%';
                                //echo $dateInterval->days .' | '.$dateDiasRestantes->days .' | '. $percent_friendly;
                                // echo  $percent_friendly.' - ';
                                // echo  $x.' - ';
                                // echo  $percent.' - ';
                                // echo  $y;
                                ?>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width:<?= $percent_friendly ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $percent_friendly ?></div>
                                </div>

                            </td>
                            <td><a href="/kanban/gerar-processo-kanban/<?= esc($pro_kan['kbp_id'], 'url') ?>" class="btn btn-block btn-primary btn-flat"><i class="fas fa-sign-in-alt"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Nenhum registro cadastrado</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->endSection() ?>