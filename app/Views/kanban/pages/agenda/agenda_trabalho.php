<?= $this->extend('Views/kanban/layout/Base_layout') ?>

<?= $this->section('content') ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <button type="button" class="btn btn-app bg-success" data-toggle="modal" data-target="#agendaModalLong">
                <i class="fas fa-edit"></i> Agendar tarefa
            </button>
            <div class="col-md-12">
                <h3 style="text-align: center">Atividades de trabalho</h3>
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div id="calendar"></div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<!-- Modal -->
<div class="modal fade" id="agendaModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Criar Tarefa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <span id="message_agenda"></span>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Dados da Tarefa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?=base_url('Kanban/AgendaController/novaAgenda')?>" method="POST" id="form_agenda">
                    <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Descrição</label>
                                <input type="text" class="form-control"  name="title" placeholder="Ex.: Fazer..." maxlength="50">
                                <span id="title_error" class="text-danger"></span>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Data de início</label>
                                        <input type="date" class="form-control" name="start">
                                        <span id="start_error" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Data de final</label>
                                        <input type="date" class="form-control" name="end">
                                        <span id="end_error" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="cls_btn_add_agenda btn btn-primary" id="id_btn_add_agenda">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- /.content -->
<?= $this->endSection() ?>
<?= $this->section('script_geral') ?>
<script>
    $(document).ready(function() {

        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        var site_url = "<?= site_url('kanban-agenda') ?>";
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
                center: 'title',
                initialView: 'listWeek',
                initialView: 'listDay',
                initialView: 'listMonth',
            },
            themeSystem: 'bootstrap4',
            eventColor: '#4B0082',
            eventOrder: "title",
            slotEventOverlap: true,
            weekNumbers: true,
            dayMaxEvents: true, // allow "more" link when too many events
            locale: 'pt-br',
            editable: true,
            events: site_url + "/event",
            displayEventTime: false,
            editable: true,
            eventRender: function(event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {

                var title = prompt('Título do evento:');

                if (title) {
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD");

                    $.ajax({
                        url: site_url + "/eventAjax",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            type: 'add',
                            [csrfName]: csrfHash
                        },
                        type: "POST",
                        success: function(data) {
                            displayMessage("Evento criado com sucesso");

                            calendar.fullCalendar('renderEvent', {
                                id: data.id,
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay,
                                [csrfName]: csrfHash,
                            }, true);

                            calendar.fullCalendar('unselect');
                        }
                    });
                }
            },

            eventDrop: function(event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                $.ajax({
                    url: site_url + '/eventAjax',
                    data: {
                        title: event.title,
                        start: start,
                        end: end,
                        id: event.id,
                        type: 'update',
                        [csrfName]: csrfHash,
                    },
                    type: "POST",
                    success: function(response) {

                        displayMessage("Evento atualizado com sucesso");
                    }
                });
            },
            eventClick: function(event) {
                var deleteMsg = confirm("Você realmente deseja excluir?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: site_url + '/eventAjax',
                        data: {
                            id: event.id,
                            type: 'delete',
                            [csrfName]: csrfHash,
                        },
                        success: function(response) {

                            calendar.fullCalendar('removeEvents', event.id);
                            displayMessage("Evento deletado com sucesso!");
                        }
                    });
                }
            }

        });

    });

    function displayMessage(message) {
        toastr.success(message, 'Evento');
    }
</script>
<script>
    $('#form_agenda').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: "JSON",
            beforeSend: function() {
                $('#id_btn_add_agenda').val('Aguarde, salvando...');
                $('.cls_btn_add_agenda').attr('disabled', 'disabled');
            },
            success: function(data) {
                $('#id_btn_add_agenda').html('<i class="fa fa-save"></i> Salvar');
                $('.cls_btn_add_agenda').attr('disabled', false);
                if (data.error == 'yes') {
                    $('#title_error').text(data.title_error);
                    $('#start_error').text(data.start_error);
                    $('#end_error').text(data.end_error);
                } else {
                    $('#title_error').text('');
                    $('#start_error').text('');
                    $('#end_error').text('');

                    $('#message_agenda').html(data.message);
                    setTimeout(function() {
                        $('#message_agenda').html('');
                        window.location.reload(1);
                    }, 2000);
                }
            }
        })
    });
</script>
<?= $this->endSection() ?>