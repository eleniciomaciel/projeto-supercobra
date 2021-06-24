<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>

<section class="content col-md-12">
    <div class="card">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Tabs</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Exames</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Configurações</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Tab 3</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                        Dropdown <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" tabindex="-1" href="#">Action</a>
                        <a class="dropdown-item" tabindex="-1" href="#">Another action</a>
                        <a class="dropdown-item" tabindex="-1" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" tabindex="-1" href="#">Separated link</a>
                    </div>
                </li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">



                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Quick Example</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationDefaultUsername">Cod.:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                            </div>
                                            <select class="form-control"  name="new_select_cargos" id="new_select_cargos"></select>
                                        </div>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <label for="validationDefault02">Funcao:</label>
                                        <input type="text" class="form-control" id="validationDefault02" placeholder="Last name" value="Otto" required>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="exampleFormControlTextarea1">Descricao:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>

                                </div>

                                <br>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Exames do Cargo</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Exames</th>
                                                    <th>Tpos</th>
                                                    <th>1º P/D</th>
                                                    <th>2º P/D</th>
                                                    <th>L</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" name="new_exames_select" id="new_exames_select">
                                                                <option selected disabled>Selecione aqui</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>

                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" id="a">
                                                            <label for="a" class="custom-control-label">A</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" id="b">
                                                            <label for="b" class="custom-control-label">D</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" id="c">
                                                            <label for="c" class="custom-control-label">P</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" id="d">
                                                            <label for="d" class="custom-control-label">M</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" id="e">
                                                            <label for="e" class="custom-control-label">R</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline">
                                                            <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" id="f">
                                                            <label for="f" class="custom-control-label">I/S</label>
                                                        </div>

                                                    </td>

                                                    <td>
                                                        <input type="number" class="form-control" id="inputZip">

                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" id="inputZip">

                                                    </td>
                                                    <td>
                                                    <button type="button" class="btn btn-danger btn-flat"><i class="fa fa-plus"></i> Adicionar</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>


                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>



                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                    new common language would be desirable: one could refuse to pay expensive translators. To
                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                    words. If several languages coalesce, the grammar of the resulting language is more simple
                    and regular than that of the individual languages.
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                    sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                    like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>

<script>
    $(document).ready(function() {
        seleciona_exames_ajax();
        seleciona_cargos_empresa();

        function seleciona_exames_ajax() {
            $.ajax({
                url: '<?= site_url('/riscosexames/lista_exames') ?>',
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $.each(response, function(index, data) {
                        $('#new_exames_select').append('<option value="' + data['id_ex'] + '">' + data['ex_tipo_exame'] + '</option>');
                    });
                }
            });
        }

        function seleciona_cargos_empresa() {
            $.ajax({
                url: '<?= site_url('/riscosexames/cargos_all') ?>',
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $.each(response, function(index, data) {
                        $('#new_select_cargos').append('<option value="' + data['id_cargo'] + '">' + data['cargo_nome'] + '</option>');
                    });
                }
            });
        }


        $(".add-row").click(function() {
            var name = $("#name").val();
            var email = $("#email").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name + "</td><td>" + email + "</td></tr>";
            $("table tbody").append(markup);
        });

        // Find and remove selected table rows
        $(".delete-row").click(function() {
            $("table tbody").find('input[name="record"]').each(function() {
                if ($(this).is(":checked")) {
                    $(this).parents("tr").remove();
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>