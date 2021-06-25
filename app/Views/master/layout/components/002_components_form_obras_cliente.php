<form action="/clientes/cadastrar" method="POST" id="form_cadastro_cliente">
<?= csrf_field() ?>
    <div class="form-row">

        <div class="form-group col-md-8">
            <label for="cli_o_nome_obra">Nome da obra</label>
            <input type="text" class="form-control" name="cli_o_nome_obra" id="cli_o_nome_obra" placeholder="Ex.: Mantiqueira">
            <span id="cli_o_nome_obra_error" class="text-danger"></span>
        </div>

        <div class="form-group col-md-4">
            <label for="cli_o_cnpj">CNPJ:</label>
            <input type="text" class="form-control" name="cli_o_cnpj" id="cli_o_cnpj" placeholder="Ex.: 20.730.618/0001-14">
            <span id="cli_o_cnpj_error" class="text-danger"></span>
        </div>

        <div class="form-group col-md-6">
            <label for="cli_o_datainicial">Data Inicial</label>
            <input type="date" class="form-control" name="cli_o_datainicial" id="cli_o_datainicial"> 
            <span id="cli_o_datainicial_error" class="text-danger"></span>
        </div>

        <div class="form-group col-md-6">
            <label for="cli_o_datafinal">Data Final</label>
            <input type="date" class="form-control" name="cli_o_datafinal" id="cli_o_datafinal">
            <span id="cli_o_datafinal_error" class="text-danger"></span>
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="cli_o_cep">Cep:</label>
            <input type="text" class="form-control" name="cli_o_cep" id="cli_o_cep">
            <span id="cli_o_cep_error" class="text-danger"></span>
        </div>

        <div class="form-group col-md-3">
            <label for="cli_o_uf">Estado:</label>
            <input type="text" class="form-control" name="cli_o_uf" id="cli_o_uf">
            <span id="cli_o_uf_error" class="text-danger"></span>
        </div>

        <div class="form-group col-md-6">
            <label for="cli_o_city">Cidade:</label>
            <input type="text" class="form-control" name="cli_o_city" id="cli_o_city">
            <span id="cli_o_city_error" class="text-danger"></span>
        </div>
    </div>

    <div class="form-row">

        <div class="form-group col-md-8">
            <label for="cli_o_address">Endereço</label>
            <input type="text" class="form-control" name="cli_o_address" id="cli_o_address" placeholder="Ex.: Rua Pedro Dias">
            <span id="cli_o_address_error" class="text-danger"></span>
        </div>

        <div class="form-group col-md-4">
            <label for="cli_o_number">Número</label>
            <input type="number" class="form-control" name="cli_o_number" id="cli_o_number" placeholder="Ex.: 01">
            <span id="cli_o_number_error" class="text-danger"></span>
        </div>

        <div class="form-group col-md-12">
            <label for="cli_o_neighborhood">Bairro:</label>
            <input type="text" class="form-control" name="cli_o_neighborhood" id="cli_o_neighborhood" placeholder="Ex.: Centro">
            <span id="cli_o_neighborhood_error" class="text-danger"></span>
        </div>

        <div class="form-group col-md-12">
            <label for="objeto_ob">Objeto:</label>
            <textarea class="form-control" name="objeto_ob" id="objeto_ob" rows="3" placeholder="Digite aqui..."></textarea>
            <span id="objeto_ob_error" class="text-danger"></span>
        </div>
    </div>

    <button type="submit" class="submit_cli_add_cls btn btn-primary" id="submit_id_cli_add">
        <i class="fa fa-save"></i> Salvar
    </button>
    <br><br>
</form>