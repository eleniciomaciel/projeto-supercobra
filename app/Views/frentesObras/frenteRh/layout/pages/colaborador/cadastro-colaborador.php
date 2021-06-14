<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <a href="/admin_rh/cadastrar-dados" class="btn btn-success btn-flat">
        <i class="fa fa-plus"></i> Cadastrar
    </a>
    <br><br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Funcionarios cadastrados</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table table-responsive col-12">
                <table class="table table-sm" id="lista_funcioanrios_frente" style="width: 100%;">
                    <br>
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Código</th>
                            <th>Matrícula</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>

<?= $this->endSection() ?>
<?= $this->section('script_toast') ?>
<script>
$(document).ready(function(){
    // load_toast_frente();
    // load_toast_habilitacao_vencida();

    // function load_toast_frente() {
    //     $.ajax({

    //         url: "<?php echo site_url('/banco/get_toast_vence_conta'); ?>",
    //         method: "GET",
    //         headers: {
    //             'X-Requested-With': 'XMLHttpRequest'
    //         },
    //         dataType: 'JSON',

    //         success: function(response) {

    //             $.each(response, function(index, data) {
    //                 $(document).Toasts('create', {
    //                     class: 'bg-maroon',
    //                     title: 'Aviso:',
    //                     subtitle: data['f_nome'],
    //                     body: 'Esses funcionários com cartões vencidos <a href="/banco/page-banco/' + data['f_id'] + '">Visualizar<a/>.'
    //                 })
    //             });
    //         }
    //     })
    // }

    // function load_toast_habilitacao_vencida() {
    //     $.ajax({
    //         url: "<?php echo site_url('/banco/get_toast_habilitacao_vencida'); ?>",
    //         method: "GET",
    //         headers: {
    //             'X-Requested-With': 'XMLHttpRequest'
    //         },
    //         dataType: 'JSON',

    //         success: function(response) {

    //             $.each(response, function(index, data) {
    //                 $(document).Toasts('create', {
    //                     class: 'bg-warning',
    //                     title: 'Aviso:',
    //                     subtitle: 'Habilitação vencida',
    //                     body: 'Habilitação do(a) mototista <a href="/banco/visualiza_minha_cnh/' + data['f_id'] + '">'+ data['f_nome']+'<a/> Vencida.'
    //                 })
    //             });
    //         }
    //     })
    // }
});
</script>
<?= $this->endSection() ?>