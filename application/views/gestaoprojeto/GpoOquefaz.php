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
    <title>O que faz na semana </title>

    <?php $this->load->view('include/headerTop') ?>

    <style>
        
        #tabOquefaz tbody tr {
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
                        <h4 class="page-title"> O que faz na semana </h4>
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
                                <div class="col-2">
                                    
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="buttonBack" style="font-size : 20px; width: 100%; height: 50px;"> <i class="mdi mdi-skip-backward"></i> Semana anterior </button>
                                </div>

                                <div class="col-2">
                                    <button class="btn btn-primary" id="buttonNow" style="font-size : 20px; width: 100%; height: 50px; background-color:green;"> Semana atual </button>
                                </div>

                                <div class="col-2">
                                    <button class="btn btn-primary" id="buttonFor" style="font-size : 20px; width: 100%; height: 50px; "> Semana seguinte <i class="mdi mdi-skip-forward" ></i> </button>
                                </div>
                                <div class="col-2">
                                </div>
                                <div class="col-2">                                
                                    <input type="checkbox"  id="checkboxFechaPlano" >
                                    <label class="text-left" for="checkboxFechaPlano" style="font-size : 20px;">Fechar em plano(s)</label>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
            <div class="row" id="divListaTrab">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="text-left control-label col-form-label" style="font-size : 20px;" > Semana do dia: </label>
                                        <input type="text" id="diadasemana" style="font-size : 20px;" disabled >
                                    </div>
                                </div>
                                <br />
                                <table id="tabOquefaz" class="cell-border table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th id='colConsult'> Consultor</th>
                                        <th id='colPlanoSe'> Plano de Serviço</th>
                                        <th id='colGerente'> Gerente </th>
                                        <th id='colDOMTrab'> DOMINGO </th>
                                        <th id='colSEGTrab'> SEGUNDA-FEIRA </th>
                                        <th id='colTERTrab'> TERÇA-FEIRA</th>
                                        <th id='colQUATrab'> QUARTA-FEIRA</th>
                                        <th id='colQUITrab'> QUINTA-FEIRA</th>
                                        <th id='colSEXTrab'> SEXTA-FEIRA</th>
                                        <th id='colSABTrab'> SÁBADO</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                </div>
                                    <b>...</b><br/>
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
        $('#liGpoOquefaz').addClass('active');
        $('#ulGpo').addClass('in');

        $('#divListaTrab').hide();
        
        var table = $('#tabOquefaz').DataTable();
        var DataRef_ = new Date();
        var DataRef = DataApenas(new Date());
        console.log(DataRef);
        var PJTFecha = null;
        console.log(PJTFecha);
        
        listaitens();
        setInputTextHints();

        function listaitens() {
            loadSpinner();

            PJTFecha = $('#checkboxFechaPlano').is(":checked") ? 1 : 0;
   
            document.getElementById("diadasemana").value = DataRef;
            

            $('#tabOquefaz').DataTable().clear().destroy();
            table = $('#tabOquefaz').DataTable({
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
                autoWidth: false,
                retrieve: true,
                paging: false,
                sAjaxDataProp: "",
                responsive: true,
                info: false,
                
                ajax: {
                    url: "<?php echo base_url(); ?>gestaoprojeto/GpoLista/fetchGpoOquefaz",
                    type: 'POST',
                    data: {
                        DataRef: DataRef,
                        PJTFecha: PJTFecha
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divListaTrab').show();
                        console.log(response);
                    }
                },
                
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [0, "asc"]
                ],
                rowId: 'CONSULTOR_ID',
                columns: [
                    {
                        "data": "CONSULTOR",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "PLANO",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "GERENTE_APELIDO",
                        "defaultContent": "",
                        className: "text-left"
                    },
                    {
                        "data": "DOM_TUDO",
                        "defaultContent": "",
                        className: "text-right",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#FFF5EE');
                        }
                    },
                    {
                        "data": "SEG_TUDO",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "TER_TUDO",
                        "defaultContent": "",
                        className: "text-right",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F8F8FF');
                        }
                    },
                    {
                        "data": "QUA_TUDO",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "QUI_TUDO",
                        "defaultContent": "",
                        className: "text-right",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F8F8FF');
                        }
                    },
                    {
                        "data": "SEX_TUDO",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "SAB_TUDO",
                        "defaultContent": "",
                        className: "text-right",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).css('background-color', '#F8F8FF');
                        }
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                },
                columnDefs: [
                    // {
                    //     "width": "2%",
                    //     "targets": [0]
                    // }

                ],

            });
        }

        
        $('#checkboxFechaPlano').click(function() {
            listaitens();
        });


        $('#buttonBack').click(function() {
            var res = DataRef_;
            res.setDate(res.getDate() - 7);
            console.log(res);
            DataRef = DataApenas(res);
            console.log(DataRef);
            listaitens();
            return DataRef
        });

        $('#buttonFor').click(function() {
            var res = DataRef_;
            res.setDate(res.getDate() + 7);
            console.log(res);
            DataRef = DataApenas(res);
            console.log(DataRef);
            listaitens();
            return DataRef
        });

        $('#buttonNow').click(function() {
            DataRef_ = new Date();
            DataRef = DataApenas(new Date());
            console.log("DataRef no buttonNow = "+DataRef);
            listaitens();
        });

        function DataApenas(pDataCompleta) {
            // Montando a data
            var dd = String(pDataCompleta.getDate()).padStart(2, '0');
            var mm = String(pDataCompleta.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = pDataCompleta.getFullYear();
            vDataApenas = yyyy + '-' + mm + '-' + dd;
            console.log(vDataApenas);
            return vDataApenas
        }

        function setInputTextHints() {

            $('#buttonBack').prop('title', 'Clique para mudar para semana anterior.' );
            $('#buttonFor').prop('title', 'Clique para mudar para próxima semana.' );
            
            $('#colConsult').prop('title', 'Apelido do Consultor/profissional.' );
            $('#colPlanoSe').prop('title', 'Apelido do Plano de Serviço (PPx):\nPPD: Plano de Projeto;\nPPS: Plano de Service Desk;\nPOS: Plano de Serviços On Site;\nPPT: Plano de Treinamento etc.' );
            $('#colGerente').prop('title', 'Apelido do Gerente da Operação/Projeto.' );
            $('#colDOMTrab').prop('title', 'DOMINGO:\nTrabalho em horas, realizado para o PPx.\nPrimeiro horário trabalhado no dia para o PPx.\nÚltimo horário trabalhado no dia para o PPx.' );
            $('#colSEGTrab').prop('title', 'SEGUNDA-FEIRA:\nTrabalho em horas, realizado para o PPx.\nPrimeiro horário trabalhado no dia para o PPx.\nÚltimo horário trabalhado no dia para o PPx.' );
            $('#colTERTrab').prop('title', 'TERÇA-FEIRA:\nTrabalho em horas, realizado para o PPx.\nPrimeiro horário trabalhado no dia para o PPx.\nÚltimo horário trabalhado no dia para o PPx.' );
            $('#colQUATrab').prop('title', 'QUARTA-FEIRA:\nTrabalho em horas, realizado para o PPx.\nPrimeiro horário trabalhado no dia para o PPx.\nÚltimo horário trabalhado no dia para o PPx.' );
            $('#colQUITrab').prop('title', 'QUINTA-FEIRA:\nTrabalho em horas, realizado para o PPx.\nPrimeiro horário trabalhado no dia para o PPx.\nÚltimo horário trabalhado no dia para o PPx.' );
            $('#colSEXTrab').prop('title', 'SEXTA-FEIRA:\nTrabalho em horas, realizado para o PPx.\nPrimeiro horário trabalhado no dia para o PPx.\nÚltimo horário trabalhado no dia para o PPx.' );
            $('#colSABTrab').prop('title', 'SÁBADO-FEIRA:\nTrabalho em horas, realizado para o PPx.\nPrimeiro horário trabalhado no dia para o PPx.\nÚltimo horário trabalhado no dia para o PPx.' );
            
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
