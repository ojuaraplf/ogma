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
    <title>wD Fechamento Mensal </title>

    <?php $this->load->view('include/headerTop') ?>

    <style>
        #tableCbr tbody tr {
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
                        <h3 class="page-title"><i class="mdi mdi-library"></i> Fechamento Mensal </h3>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Fechamento Mensal</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card" style="background-color: #eeeeee;">
                    <div class="col-12">
                        <button class="btn float-right" style="font-size: 25px; color: #00FF00; background-color: #000000;" id="btnAtoa" disabled> "" </button>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="eOptionMes" class="text-left control-label col-form-label"> Mês de referência </label>
                                        <input type="text" id="eOptionMes" value=<?php echo date('m/Y', strtotime('-1 months', strtotime(date('Y-m-d')))); ?> class="form-control" />
                                    </div>
                                    <div class="col-9">
                                        <label for="eSelectCbr" class="text-left control-label col-form-label"> Colaborador </label>                                        
                                        <select class="form-control" id="eSelectCbr">                                            
                                            <option value="0"> Todos os colaboradores ... </option>
                                            <?php foreach ($Cbres as $item): ?>
                                                <option value="<?= $item['CODIGO'] ?>">
                                                    <?= $item['COLABORADOR'] ?>
                                                </option>
                                            <?php endforeach; ?>                                            
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="checkbox" id="checkboxpAbreProjeto" checked>
                                        <label class="text-left" for="checkboxpAbreProjeto">Abre projeto</label>
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

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="inputTextFiltro" class="text-left control-label col-form-label"> Pesquisar </label>
                                        <input type="text" class="form-control" id="inputTextFiltro"/>
                                    </div>
                                </div>

                                <div class="table-responsive">         
                                    <table id="tableCbr" class="table table-hover table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th id="thColaborador"> Colaborador</th>
                                                <th id="thVhsysCodigo"> Chave VhSys</br>Código</th>
                                                <th id="thVhsysEmpres"> Chave VhSys</br>Empresa</th>
                                                <th id="thPlanoServiço" >Ultimo dia apontado</th>
                                                <th id="thUnidRemunera"> UD</th>
                                                <th id="thTrabalhoHora"> <i class="mdi mdi-rowing"></i> (h)<br/><span id="spanSomaTrabalho" style="font-weight: bold; color: darkblue;">-</span></td>
                                                <th id="thTrabalhoPerc"> <i class="mdi mdi-rowing"></i> (%)</th>
                                                <th id="thReaisUnitari"> Unit. (R$)</th>
                                                <th id="thReaisTotalGe"> Total (R$)<br/><span id="spanSomaReais" style="font-weight: bold; color: darkblue;">-</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                    <b>Versão: 1.00 - 11/09/2024</b><br/>
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

        $('#ulFinanceiro').addClass('selected');
		$('#liFechaMes').addClass('active');
		$('#ulFinanceiro').addClass('in');

        $('#divLista').hide();

        function pesquisa_Tabela(){
		// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("inputTextFiltro");
			filter = input.value.toUpperCase();
			table = document.getElementById("tableCbr");
			tr = table.getElementsByTagName("tr");

			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td") ; 
				for(j=0 ; j<td.length ; j++)
				{
				let tdata = td[j] ;
				if (tdata) {
					if (tdata.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
					break ; 
					} else {
					tr[i].style.display = "none";
					}
				} 
				}
			}
		}

        var $rows = $('#tableCbr tbody tr');
		$('#inputTextFiltro').keyup(function() {
			pesquisa_Tabela();
		});

        var arrayLista = [];
        var table = $('#tableCbr').DataTable();

        setInputTextHints();        
        listarCbr();

        function listarCbr() {

            var pAbreProjeto = $('#checkboxpAbreProjeto').is(":checked") ? 1 : 0;
            $('#thPlanoServiço').text(pAbreProjeto ? "Plano de Serviço" : "Ultimo dia apontado");

            pCBRCodigo = $('#eSelectCbr').val();
            var date = "01/" + $('#eOptionMes').val();
            pMes = date.split("/").reverse().join("-");
            console.log('console.log(date)');
            console.log($('#eOptionMes').val());
            console.log(date);
            console.log(pMes);
            pAbreProjeto = $('#checkboxpAbreProjeto').is(":checked") ? 1 : 0;

            loadSpinner();
            $('#tableCbr').DataTable().clear().destroy();
            table = $('#tableCbr').DataTable({
                // dom: 'Bfrtip',
                dom: '<"html5buttons"B>Tfgitp',
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
                fixedHeader: true,

                ajax: {
                    url: "<?php echo base_url(); ?>administrativo/CbrLista/FechaMesFech",
                    type: 'POST',
                    data: {                    
                        PCBRCodigo: pCBRCodigo,
                        PMes: pMes,
                        PAbreProjeto: pAbreProjeto
                    },
                    complete: function(response) {
                        arrayLista = JSON.parse(response.responseText);
                        $('#divLista').show();
                        // console.log(response);
                    }
                },
                // responsive: true,
                // "scrollY": 600,
                // "scrollX": true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                order: [
                    [0, "asc"]
                ],
                columns: [
                    {
                        "data": "COLABORADOR",
                        "defaultContent": ""
                    },
                    {
                        "data": "CODI_VHSYS",
                        "defaultContent": ""
                    },
                    {
                        "data": "EMRE_VHSYS",
                        "defaultContent": ""
                    },
                    {
                        "data": "PROJETO",
                        "defaultContent": ""
                    },
                    {
                        "data": "UD",
                        "defaultContent": ""
                    },
                    {
                        "data": "TRAB_H",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "PERCENTUAL_TRAB_H",
                        "defaultContent": "",
                        className: "text-right"
                    },                    
                    {
                        "data": "VRUN_RS",
                        "defaultContent": "",
                        className: "text-right"
                    },
                    {
                        "data": "VRTO_RS",
                        "defaultContent": "",
                        className: "text-right"
                    }
                ],
                'initComplete': function(settings, json) {
                    removeSpinner();
                    SomaLinhas();
                },
                columnDefs: [
                    
               ]

            });
        };

        $('#eOptionMes').change(function() {
            listarCbr()
        })

        $('#eSelectCbr').change(function() {
            listarCbr()
        })

        $('#checkboxpAbreProjeto').change(function() {
            listarCbr()
        })

        $('#eSelectCbr').select2();

        $('#eOptionMes').datepicker({
            autoclose: true,
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months",
            orientation: 'bottom'
        });

        function SomaLinhas() {
            var vSomaTrabalho = 0;
            var vSomaReais = 0;            
            $('#tableCbr').find('tr').slice(1).each(function(i, el) {
                var $tds = $(this).find('td');
                vSomaTrabalho += parseFloat($tds.eq(5).text());                
                vSomaReais += parseFloat($tds.eq(8).text().replace(/\./g, '').replace(',', '.'));
                //vSomaReais += parseFloat($tds.eq(8).text());
                console.log(parseFloat($tds.eq(8).text().replace(/\./g, '').replace(',', '.')));
            });
            console.log(vSomaTrabalho);
            console.log(vSomaReais);            
            $('#spanSomaTrabalho').text(formatarMilhar(vSomaTrabalho));
            $('#spanSomaReais').text(formatarReais(vSomaReais));
        }

        // /***************************************************************************************/
        function setInputTextHints() {

            $('#thColaborador').prop('title', 'Nome do Colaborador.' );
            $('#thVhsysCodigo').prop('title', 'Chave para o sistema VhSys: Código.' );
            $('#thVhsysEmpres').prop('title', 'Chave para o sistema VhSys: Nome da Empresa.' );
            $('#thPlanoServiço').prop('title', 'Se fechado em projetos: Apelido do Plano de Serviço;\nSe aberto: Último dia do mês com apontamento do colaborador.' );
            $('#thUnidRemunera').prop('title', 'Unidade de remuneração do Colaborador.' );
            $('#thTrabalhoHora').prop('title', 'Número de horas trabalhado pelo Colaborador.' );
            $('#thTrabalhoPerc').prop('title', 'Percentual de trabalho do Colaborador no Plano de Serviço (Projeto).' );
            $('#thReaisUnitari').prop('title', 'Valor unitário da remuneração.' );
            $('#thReaisTotalGe').prop('title', 'Valor total da remuneração.' );

            $('[data-toggle="tooltip"]').tooltip({
                placement: "bottom",
                boundary: 'window',
                animation: true,
                trigger: "hover"
            });
        }
        /*
        var selectedCbr = "";
        $(document).on('click', '#tableCbr > tbody > tr ', function() {
          selectedCbr = arrayLista[table.row(this).index()];
          window.open('<!?php echo base_url('CbrEdita/') ?>' + selectedCbr.CODIGO, '_self');
        });
        */

    </script>
</body>

</html> 