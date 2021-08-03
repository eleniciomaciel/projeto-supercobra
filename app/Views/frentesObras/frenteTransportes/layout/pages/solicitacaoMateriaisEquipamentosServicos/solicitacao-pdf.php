<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document-solicitation</title>
</head>

<body>


    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 1px 0px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 1px 0px;
            word-break: normal;
        }

        .tg .tg-91w8 {
            border-color: inherit;
            font-size: 10px;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-2h92 {
            border-color: inherit;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-l6li {
            border-color: inherit;
            font-size: 10px;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-77x5 {
            border-color: inherit;
            font-size: 12px;
            font-weight: bold;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-watk {
            border-color: inherit;
            font-size: 11px;
            font-weight: bold;
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-0pky {
            border-color: inherit;
            text-align: left;
            vertical-align: top,
        }

        .tg .tg-whm0 {
            border-color: inherit;
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif !important;
            ;
            font-size: xx-small;
            font-weight: bold;
            text-align: center;
            vertical-align: middle
        }
    </style>
    <table class="tg">
        <thead>
            <tr>
                <th class="tg-0pky" colspan="2" cellspacing="0" style="border-right: none;" ><img src="<?=base_url()?>/logo-doc.png"></th>
                <th class="tg-2h92" colspan="3">SOLICITAÇÃO DE <br>MATERIAIS / EQUIPAMENTOS / SERVIÇOS</th>
                <th class="tg-watk" colspan=3>
                <?= esc($solicitacao['smes_sequencia_numerica']) ?><br>
                    DATA <?= date('d/m/Y', strtotime($solicitacao['datetime'])) ?><br>
                    REV.: 04<br>
                    LOCAL DE ENTREGA: <?= esc($solicitacao['smes_local_entrega']) ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-77x5" colspan="8">PLICAÇÃO: LOCAÇÃO DE BENS MÓVEIS SEM MÃO DE OBRA PARA EQUIPE DE LANÇAMENTO DE CABOS E CONDUTORES</td>
            </tr>
            <tr>
                <td class="tg-77x5" colspan="4"><?= esc($solicitacao['obras_local']) ?></td>
                <td class="tg-77x5" colspan="4">SOLICITANTE: SETOR DE <?= esc($solicitacao['dep_name']) ?></td>
            </tr>
            <tr>
                <td class="tg-whm0">ITE</td>
                <td class="tg-whm0">UNI</td>
                <td class="tg-whm0">QUANT</td>
                <td class="tg-whm0">DESCRÇÃO DO MATERIAL / EQUIPAMENTO</td>
                <td class="tg-whm0">REQUISITO SEGURANÇA DO MEIO AMBIENTE</td>
                <td class="tg-whm0">CENTO DE CUSTO</td>
                <td class="tg-whm0">DATA <br>DA <br>NECESSIDADE</td>
                <td class="tg-whm0">OBSERVAÇÕES</td>
            </tr>

            <?php if (!empty($list_itens) && is_array($list_itens)) : ?>

                <?php
                $soma = 1;
                foreach ($list_itens as $lst_doc) : ?>

                    <tr>
                        <td class="tg-91w8"><?= $soma++ ?></td>
                        <td class="tg-91w8"><?= esc($lst_doc['isc_unidade']) ?></td>
                        <td class="tg-91w8"><?= esc($lst_doc['isc_quantidade']) ?></td>
                        <td class="tg-l6li"><?= esc($lst_doc['isc_descricao_da_requisicao'] == NULL ? 'N/A':$lst_doc['isc_descricao_da_requisicao'] ) ?></td>
                        <td class="tg-l6li"><?= esc(strip_tags($lst_doc['isc_requisito_meio_ambiente'] == NULL ? 'N/A': $lst_doc['isc_requisito_meio_ambiente'])) ?></td>
                        <td class="tg-l6li"><?= esc($lst_doc['isc_cento_custo']) ?></td>
                        <td class="tg-91w8"><?= date('d/m/Y', strtotime($lst_doc['isc_data_necessidade'])) ?></td>
                        <td class="tg-91w8"><?= esc($lst_doc['isc_observacoes']) ?></td>
                    </tr>

                <?php endforeach; ?>

            <?php else : ?>
                <tr>
                    <td colspan="8" class="tg-77x5" style="text-align: center;">Não ha itens para essa solicitação</td>
                </tr>
            <?php endif ?>
            <tr>
                <td class="tg-77x5" colspan="4">SOLICITADO POR: <?= esc($user_dd['f_nome']) ?></td>
                <td class="tg-77x5" colspan="4">APROVADO POR: ISMAEL ANTONIO CARVALHO</td>
            </tr>
            <tr>
                <td class="tg-0pky" colspan="4"></td>
                <td class="tg-0pky" colspan="4"></td>
            </tr>
        </tbody>
    </table>

</body>

</html>