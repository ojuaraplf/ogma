<?php

if (!($this->session->has_userdata('userToken'))) {
    redirect('login');
}
?>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>wD Ogma Previsão de Disponibilidade </title>

    <?php $this->load->view('include/headerTop') ?>


    <style>

        #tableApontamentoHoras tbody tr {
      cursor: pointer;
    }

    html {
      visibility: hidden;
    }
  </style>


</head>

<body style="background: #eeeeee;">
    <div id="main-wrapper">
        <?php $this->load->view('include/navbarHome') ?>
        <?php $this->load->view('include/asidebar') ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Previsão de Disponibilidade </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page"> Home</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="text-left control-label col-form-label"> Consultor </label>
                                        <select class="form-control" id="optionselectedCbr">
                                            <option value="0"> Todos os consultores ... </option>

                                            <?php foreach ($listaCbr as $item): ?>
                                            <option value="<?= $item['CODIGO']?>" <?= $this->session->userdata('userCodigo') == $item['CODIGO'] ? "selected" : "" ?>>
                                                <?= $item['COLABORADOR'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="text-left control-label col-form-label"> Gestor </label>
                                        <select class="form-control" id="optionselectedGco">
                                            <option value="0"> Todos os gestores ... </option>

                                            <?php foreach ($listaGco as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['NOME'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <label for="" class="text-left control-label col-form-label"> Ano / mês </label>
                                        <select class="form-control" id="comboboxMes">
                                            <option value="0">  Selecione o ano / mês. </option>

                                            <?php foreach ($listaMes as $item): ?>
                                            <option value="<?= $item['MES'] ?>">
                                                <?= $item['MES'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-10">
                                        <label for="" class="text-left control-label col-form-label"> Plano de Serviço (PPx) </label>
                                        <select class="form-control" id="comboboxPPx">
                                            <option value="0"> Todos os planos de serviço ... </option>

                                            <?php foreach ($listaPjt as $item): ?>
                                            <option value="<?= $item['CODIGO'] ?>">
                                                <?= $item['APELIDO'] ?>
                                            </option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                        
                                <br />

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="buttonListar"> Listar </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="divLista">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="card-title">Previsões </h4>
                                        </div>
                                    </div>
                                    <br />
                                    <table class="table table-sm table-bordered" id="tableLista">
                                        <thead>
                                            <tr>
                                                <th id='col01cons'> Consultor</th>
                                                <th id='col02plan'> Plano</th>

                                                <th id='col03sem1'> Semana<br/>01</th>
                                                <th id='col04pre1'> Prev<br/>01</th>
                                                <th id='col05rea1'> Real<br/>01</th>
                                                
                                                <th id='col06sem2'> Semana<br/>02</th>
                                                <th id='col07pre2'> Prev<br/>02</th>
                                                <th id='col08rea2'> Real<br/>02</th>
                                                
                                                <th id='col09sem3'> Semana<br/>03</th>
                                                <th id='col10pre3'> Prev<br/>03</th>
                                                <th id='col11rea3'> Real<br/>03</th>
                                                
                                                <th id='col12sem4'> Semana<br/>04</th>
                                                <th id='col13pre4'> Prev<br/>04</th>
                                                <th id='col14rea4'> Real<br/>04</th>
                                                
                                                <th id='col15sem5'> Semana<br/>05</th>
                                                <th id='col16pre5'> Prev<br/>05</th>
                                                <th id='col17rea5'> Real<br/>05</th>
                                                
                                                <th id='col18sem6'> Semana<br/>06</th>
                                                <th id='col19pre6'> Prev<br/>06</th>
                                                <th id='col20rea6'> Real<br/>06</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                    <b>Versão Beta: 00.60 - 23/05/2021</b><br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>

    <script type="text/javascript">
        removeSpinner();
       
        $('#liGpo').addClass('selected');
        $('#liDicLista').addClass('active');
        $('#ulGpo').addClass('in');

        $('#divLista').hide();

        var arrayLista = [];
        var table = $('#tableLista').DataTable();
        var selectedCbr = null;
        var selectedGco = null;
        var selectedMes = null;
        var selectedPjt = null;


        // textos para validação/orientação do preenchimento de alguns principais campos:
        var vAlertaCbr = 'Selecione o colaborador/consultor.';
        var vAlertaGco = 'Selecione o gestor do plano de serviço.';
        var vAlertaMes = 'Selecione o mês e ano.';
        var vAlertaPjt = 'Selecione o plano de serviço.';

        setInputTextHints();

        $('#buttonListar').click(function() {

            if( $('#comboboxMes').val() == '0' )
                {
                document.getElementById('comboboxMes').focus();
                Swal.fire(
                    'Ops!',
                    vAlertaMes,
                    'warning'
                )
                return;
            }

            selectedCbr = ($('#optionselectedCbr')[0].selectedIndex == 0) ? 0 : $('#optionselectedCbr').val();
            selectedGco = ($('#optionselectedGco')[0].selectedIndex == 0) ? 0 : $('#optionselectedGco').val();
            selectedMes = ($('#comboboxMes')[0].selectedIndex == 0) ? null : $('#comboboxMes').val();
            selectedPjt = ($('#comboboxPPx')[0].selectedIndex == 0) ? 0 : $('#comboboxPPx').val();
            
            console.log(selectedMes);
            // var pAbreAtividade = $('#checkboxpAbreProjeto').is(":checked") ? 1 : 0;
            

            loadSpinner();
            $('#tableLista').DataTable().clear().destroy();
            table = $('#tableLista').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'pdf',
                        className: 'btn-primary',
                        exportOptions: {
                        columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-primary'
                    },
                    {
                        extend: 'excel',
                        className: 'btn-primary'
                    }
                ],
                destroy: true,
                searching: false,
                // autoWidth: false,
                retrieve: true,
                paging: false,
                sAjaxDataProp: "",
                responsive: true,
                info: false,

                ajax: {
                    url: "<?php echo base_url(); ?>gestaoprojeto/DicLista/fetchDicLista",
                    type: 'POST',
                    data: {
                        selectedCbr: selectedCbr,
                        selectedGco: selectedGco,
                        selectedMes: selectedMes,
                        selectedPjt: selectedPjt
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divLista').show();
                        console.log(response);
                    }
                },
                // responsive: true,
                // "scrollY": 600,
                // "scrollX": true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [1, "asc"]
                ],
                rowId: 'ID1',
                columns: [
                    {
                        "data": "CONSULTOR",
                        "defaultContent": ""
                    },
                    {
                        "data": "PLANO",
                        "defaultContent": ""
                    },


                    {
                        "data": "SEM01",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM01P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM01E",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    
                    
                    {
                        "data": "SEM02",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM02P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM02E",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    
                    
                    {
                        "data": "SEM03",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM03P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM03E",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    
                    
                    {
                        "data": "SEM04",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM04P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM04E",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    
                    
                    {
                        "data": "SEM05",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM05P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM05E",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    
                    
                    {
                        "data": "SEM06",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM06P",
                        "defaultContent": "",
                        className: "text-center"
                    },
                    {
                        "data": "SEM06E",
                        "defaultContent": "",
                        className: "text-center"
                    }
                    
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
               
                // columnDefs: [
                //     {
                //         'orderable': false
                  
                  
                //     }
                    
                // ]
            });
        });

        // $(function () {
        //     $("td").dblclick(function () {
        //         var conteudoOriginal = $(this).text();

        //         $(this).addClass("tableLista");
        //         $(this).html("<input type='text' value='" + conteudoOriginal + "' />");
        //         $(this).children().first().focus();

        //         $(this).children().first().keypress(function (e) {
        //             if (e.which == 13) {
        //                 var novoConteudo = $(this).val();
        //                 $(this).parent().text(novoConteudo);
        //                 $(this).parent().removeClass("tableLista");
        //             }
        //         });

        //     $(this).children().first().blur(function(){
        //         $(this).parent().text(conteudoOriginal);
        //         $(this).parent().removeClass("tableLista");
        //     });
        //     });
        // });

        function setInputTextHints() {
            $('#optionselectedCbr').prop('title', vAlertaCbr );
            $('#optionselectedGco').prop('title', vAlertaGco );
            $('#comboboxMes').prop('title', vAlertaMes );
            $('#comboboxPPx').prop('title', vAlertaPjt );

            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }


    </script>
</body>

</html> 