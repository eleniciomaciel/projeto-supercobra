<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12">
    <!-- TO DO List -->


    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-five-overlay-tab" data-toggle="pill" href="#custom-tabs-five-overlay" role="tab" aria-controls="custom-tabs-five-overlay" aria-selected="true"><i class="fas fa-heartbeat"></i> Médicos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-five-overlay-dark-tab" data-toggle="pill" href="#custom-tabs-five-overlay-dark" role="tab" aria-controls="custom-tabs-five-overlay-dark" aria-selected="false"><i class="fas fa-id-card-alt"></i> Cadastrar Médico</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-five-normal-tab" data-toggle="pill" href="#custom-tabs-five-normal" role="tab" aria-controls="custom-tabs-five-normal" aria-selected="false"><i class="fas fa-user-md"></i> Médicos Inativos</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-five-tabContent">
                <div class="tab-pane fade active show" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
                    <div class="overlay-wrapper">
                        <!-- <div class="overlay">
                            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Carregando...</div>
                        </div> -->
                        <?= $this->include('frentesObras/frenteRh/layout/pages/medicos-pcmso/includes/table-lista-medicos') ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-five-overlay-dark" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-dark-tab">
                    <div class="overlay-wrapper">

                        <div class="id_loader_spiner overlay dark" style="display: none;">
                            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Salvando, aguarde...</div>
                        </div>

                        <?= $this->include('frentesObras/frenteRh/layout/pages/medicos-pcmso/includes/form-cadastra-medicos') ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-five-normal" role="tabpanel" aria-labelledby="custom-tabs-five-normal-tab">
                    <?= $this->include('frentesObras/frenteRh/layout/pages/medicos-pcmso/includes/table-lista-medicos-desativos') ?>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

    <?= $this->include('frentesObras/frenteRh/layout/pages/medicos-pcmso/component/001_cadastro') ?>
</section>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Jquery Validate -->

<script>
    $(document).ready(function() {
        meusMedicos();
        meusMedicosInativos();
        /**
         * cadastra medico pcmso
         */
        $("#quickFormPcmso_form").submit(function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(".id_loader_spiner").css('display', 'flex');
                    $(form).find('span.error-text').text('');
                    $('#btn_id_new_medical').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_new_medical').attr('disabled', 'disabled');

                },
                success: function(data) {
                    $('#btn_id_new_medical').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_new_medical').attr('disabled', false);
                    $(".id_loader_spiner").css('display', 'none');
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'success'
                            );
                            meusMedicos();
                        } else {
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'error'
                            );
                        }
                    } else {
                        $.each(data.error, function(prefix, val) {
                            Swal.fire(
                                'Ops!',
                                'Existem alguns erros, corrija por favor.',
                                'error'
                            );
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });


        function meusMedicos() {
            $.ajax({
                url: "<?php echo base_url('Rh/Medicos/PcmsoController/getListaMedicos'); ?>",
                type: "GET",
                cache: false,
                success: function(dataResult) {
                    $("#table_lista_mdicos_rh").html(dataResult);
                }
            });
        };


        /**
         * lista medicos inativos
         */

        function meusMedicosInativos() {
            $.ajax({
                url: "<?php echo base_url('Rh/Medicos/PcmsoController/getListaMedicosInativados'); ?>",
                type: "GET",
                cache: false,
                success: function(dataResult) {
                    $("#table_lista_mdicos_rh_inativos").html(dataResult);
                }
            });
        };

        $(document).on('click', '.verMedicoEaltera', function() {
            var id_medic = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('Rh/Medicos/PcmsoController/getMedico'); ?>",
                method: "GET",
                data: {
                    id_medic: id_medic
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#medic_pcmso_nome').val(data.medic_pcmso_nome);
                    $('#medic_pcmso_email').val(data.medic_pcmso_email);
                    $('#medic_pcmso_crm').val(data.medic_pcmso_crm);
                    $('#medic_pcmso_description').val(data.medic_pcmso_description);
                    $('#dadosMedicoOneModalLong').modal('show');
                    $('#hidden_id_medic').val(id_medic);
                }
            })
        });


        /**
         * altera cadastro de médico
         */
        $("#quickFormPcmso_form_altera").submit(function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                    $('#btn_id_new_medical_up').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_new_medical_up').attr('disabled', 'disabled');

                },
                success: function(data) {
                    $('#btn_id_new_medical_up').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_new_medical_up').attr('disabled', false);
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            //$(form)[0].reset();
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'success'
                            );
                            meusMedicos();
                        } else {
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'error'
                            );
                        }
                    } else {
                        $.each(data.error, function(prefix, val) {
                            Swal.fire(
                                'Ops!',
                                'Existem alguns erros, corrija por favor.',
                                'error'
                            );
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });

        /**
         * status do médico
         */

        $(document).on('click', '.statusMedico', function() {
            var id_medic = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('Rh/Medicos/PcmsoController/getMedico'); ?>",
                method: "GET",
                data: {
                    id_medic: id_medic
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#x_pcmso_nome').val(data.medic_pcmso_nome);
                    $('#medic_pcmso_status').val(data.medic_pcmso_status);
                    $('#statusMedicoOneModalLong').modal('show');
                    $('#hidden_id_medic_state').val(id_medic);
                }
            })
        });

        /**
         * altera status
         */

        $("#formAddStatusMedico").submit(function(e) {
            e.preventDefault();

            var data = $("#formAddStatusMedico").serialize();
            var form = this;

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: data,
                beforeSend: function() {
                    $('#btn_id_new_medical_st_up').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_new_medical_st_up').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_id_new_medical_st_up').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_new_medical_st_up').attr('disabled', false);
                    $('.alert-success').show();
                    $("#success_status").text(data);
                    meusMedicos();
                    meusMedicosInativos();
                }
            });
        });

        /**
         * delete medico
         */
        $(document).on('click', '.deleteMedicalOne', function() {
            var id_medic_del = $(this).data('id');

            Swal.fire({
                title: 'Deseja deletar?',
                text: "Ao confirmar essa ação será permanente!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('Rh/Medicos/PcmsoController/delMedicalOne'); ?>",
                        method: "GET",
                        data: {
                            id_medic_del: id_medic_del
                        },
                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                            meusMedicos();
                            meusMedicosInativos();
                        }
                    });
                }
            });
        });

        function forceKeyPressUppercase(e) {
            var charInput = e.keyCode;
            if ((charInput >= 97) && (charInput <= 122)) { // lowercase
                if (!e.ctrlKey && !e.metaKey && !e.altKey) { // no modifier key
                    var newChar = charInput - 32;
                    var start = e.target.selectionStart;
                    var end = e.target.selectionEnd;
                    e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
                    e.target.setSelectionRange(start + 1, start + 1);
                    e.preventDefault();
                }
            }
        }

        document.getElementById("med_name").addEventListener("keypress", forceKeyPressUppercase, false);

    });
</script>
<?= $this->endSection() ?>