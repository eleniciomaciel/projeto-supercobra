<?= $this->extend('master/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->

<div class="col-md-12">
  <div class="card card-outline card-warning">
    <div class="card-header">
      <h3 class="card-title">Gestão de Atividades</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="display: block;">


      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Dados do Clinete</a>
          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Obras/Frente</a>
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Licenças</a>
          <a class="nav-item nav-link" id="nav-cento_custo-tab" data-toggle="tab" href="#nav-cento_custo" role="tab" aria-controls="nav-contact" aria-selected="false">Cento Custo</a>
          <a class="nav-item nav-link" id="nav-contratos-tab" data-toggle="tab" href="#nav-contratos" role="tab" aria-controls="nav-contratos" aria-selected="false">Contratos</a>
          <a class="nav-item nav-link" id="nav-usuarios-tab" data-toggle="tab" href="#nav-usuarios" role="tab" aria-controls="nav-usuarios" aria-selected="false">Usuários</a>
          <a class="nav-item nav-link" id="nav-atividades-tab" data-toggle="tab" href="#nav-atividades" role="tab" aria-controls="nav-atividades" aria-selected="false">Atividades</a>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <?= $this->include('master/layout/includes/tab-obras') ?>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <?= $this->include('master/layout/includes/tab-frentes') ?>
        </div>

        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
          <?= $this->include('master/layout/includes/tab-licencas') ?>
        </div>

        <div class="tab-pane fade" id="nav-cento_custo" role="tabpanel" aria-labelledby="nav-cento_custo-tab">
          <?= $this->include('master/layout/includes/tab-cento_custo') ?>
        </div>

        <div class="tab-pane fade" id="nav-contratos" role="tabpanel" aria-labelledby="nav-contratos-tab">
          <?= $this->include('master/layout/includes/tab-contratos') ?>
        </div>

        <div class="tab-pane fade" id="nav-usuarios" role="tabpanel" aria-labelledby="nav-usuarios-tab">
          <?= $this->include('master/layout/includes/tab-users') ?>
        </div>

        <div class="tab-pane fade" id="nav-atividades" role="tabpanel" aria-labelledby="nav-atividades-tab">
          <?= $this->include('master/layout/includes/tab-atividades') ?>
        </div>

      </div>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  <?= $this->include('master/layout/components/003_modal_atividadesfrente') ?>
</div>
<?= $this->endSection() ?>
<?= $this->section('adm-frota-js') ?>
<script>
  $(document).ready(function() {

    var datatale_clientes = $('#todos_clientes').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
      },
      "order": [0, "desc"],
      "serverSide": true,
      "ajax": {
        url: "<?php echo site_url("/clientes/lista_todos_clientes_mt"); ?>",
        type: "GET",
      }
    });

    $('#lista_atividades_frentes_f').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
      },
      "order": [0, "desc"],
      "serverSide": true,
      columnDefs: [{
        targets: 0,
        render: function(data) {
          return moment(data).format('L');
        }
      }],
      "ajax": {
        url: "<?php echo site_url("/atividades/getLista_atividades_frentes"); ?>",
        type: "GET",
      }
    });


    $('#add_new_active_admin').on('submit', function(event) {
      event.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        data: $(this).serialize(),
        dataType: "JSON",
        beforeSend: function() {
          $('#id_add_atividade_adm').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
          $('.cls_atividade_adm').attr('disabled', 'disabled');
        },
        success: function(data) {
          $('#id_add_atividade_adm').html('<i class="fa fa-save"></i> Salvar');
          $('.cls_atividade_adm').attr('disabled', false);

          if (data.error == 'yes') {
            $('#ativi_nome_error').text(data.ativi_nome_error);
            $('#ativ_descricao_error').text(data.ativ_descricao_error);
          } else {
            $('#ativi_nome_error').text('');
            $('#ativ_descricao_error').text('');

            $('#message_atividades').html(data.message);
            $('#add_new_active_admin')[0].reset();
            $('#lista_atividades_frentes_f').DataTable().ajax.reload();
            setTimeout(function() {
              $('#message_atividades').html('');
            }, 3000);
          }
        }
      })
    });


    /**altera atividades */
    $(document).on('click', '.visualizarAtividade', function() {
      var id = $(this).data('id');
      $.ajax({
        url: "<?php echo site_url('/atividades/one_atividades'); ?>",
        method: "GET",
        data: {
          id: id
        },
        dataType: 'JSON',
        success: function(data) {
          $('#atv_descricao').val(data.titulo_nome);
          $('#titulo_description').val(data.titulo_description);
          $('#modal_atividades_frentes').modal('show');
          $('#hidden_id_frente_active').val(id);
        }
      })
    });


    /**altera atividades */
    $('#update_new_active_admin').on('submit', function(event) {
      event.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        data: $(this).serialize(),
        dataType: "JSON",
        beforeSend: function() {
          $('#id_add_atividade_adm_up').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
          $('.cls_atividade_adm_up').attr('disabled', 'disabled');
        },
        success: function(data) {
          $('#id_add_atividade_adm_up').html('<i class="fa fa-save"></i> Alterar');
          $('.cls_atividade_adm_up').attr('disabled', false);

          if (data.error == 'yes') {
            $('#atv_descricao_error').text(data.atv_descricao_error);
            $('#titulo_description_error').text(data.titulo_description_error);
          } else {
            $('#atv_descricao_error').text('');
            $('#titulo_description_error').text('');
            $('#message_atividades_up').html(data.message);
            $('#lista_atividades_frentes_f').DataTable().ajax.reload();
            setTimeout(function() {
              $('#message_atividades_up').html('');
            }, 3000);
          }
        }
      })
    });

    /**deleta atividade trabalho */
    $(document).on('click', '.deleteAtividade', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Deletar?',
                text: "Deseja deletar essa atividade!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('/atividades/delete_atividade'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            )
                            $('#lista_atividades_frentes_f').DataTable().ajax.reload();
                          
                        }
                    })
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

    document.getElementById("ativi_nome").addEventListener("keypress", forceKeyPressUppercase, false);
    document.getElementById("atv_descricao").addEventListener("keypress", forceKeyPressUppercase, false);
    document.getElementById("ativ_descricao").addEventListener("keypress", forceKeyPressUppercase, false);

  });
</script>
<?= $this->endSection() ?>