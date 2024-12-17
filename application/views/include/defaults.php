<?php $this->load->view('include/spinner') ?>



<script type="text/javascript">
    if (localStorage.array_ogm_catalogoservicoitem == null || localStorage.array_ogm_catalogoservicoitem == []) {
        fetch_ogm_catalogoservicoitem();
    }
    if (localStorage.array_ogsv_CIL_ItemCatalogoLabel == null || localStorage.array_ogsv_CIL_ItemCatalogoLabel == []) {
        fetch_ogsv_CIL_ItemCatalogoLabel();
    }
    if (localStorage.arrayTipoMudancaCorrecao == null || localStorage.arrayTipoMudancaCorrecao == []) {
        fetchTipoMudancaCorrecao();
    }
    if (localStorage.arrayColaborador == null || localStorage.arrayColaborador == []) {
        fetchColaboradores();
    }
    if (localStorage.arrayFamiliaAtividade == null || localStorage.arrayFamiliaAtividade == []) {
        fetchFamiliaAtividade();
    }
    if (localStorage.arrayCargo == null || localStorage.arrayCargo == []) {
        fetchCargos();
    }
    if (localStorage.arrayContatoDetalhe == null || localStorage.arrayContatoDetalhe == []) {
        fetchContatoDetalhe();
    }
    if (localStorage.arrayClasseAtividade == [] || localStorage.arrayClasseAtividade == null) {
        fetchClasseAtividade();
    }

    if (localStorage.array_ogsv_TLG_Tecnologia == [] || localStorage.array_ogsv_TLG_Tecnologia == null) {
        fetch_ogsv_TLG_Tecnologia();
    }

    if (localStorage.arrayogma_PES_Selecao02 == [] || localStorage.arrayogma_PES_Selecao02 == null) {
        fetchogma_PES_Selecao02();
    }

    function fetch_ogsv_TLG_Tecnologia() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetch_ogsv_TLG_Tecnologia",
            dataType: 'text',
            success: function(data) {
                localStorage.array_ogsv_TLG_Tecnologia = data;
            }
        });
    }

    function fetch_ogm_catalogoservicoitem() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetch_ogm_catalogoservicoitem",
            dataType: 'text',
            success: function(data) {

                localStorage.array_ogm_catalogoservicoitem = data;
            }
        });
    }

    function fetch_ogsv_CIL_ItemCatalogoLabel() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetch_ogsv_CIL_ItemCatalogoLabel",
            dataType: 'text',
            success: function(data) {

                localStorage.array_ogsv_CIL_ItemCatalogoLabel = data;
            }
        });
    }

    function fetchTipoMudancaCorrecao() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetchTipoMudancaCorrecao",
            dataType: 'text',
            success: function(data) {
                localStorage.arrayTipoMudancaCorrecao = data;
            }
        });
    }

    function fetchClasseAtividade() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetchClasseAtividade",
            dataType: 'text',
            success: function(data) {
                localStorage.arrayClasseAtividade = data;
            }
        });
    }

    function fetchogma_PES_Selecao02() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetchogma_PES_Selecao02",
            dataType: 'text',
            success: function(data) {
                localStorage.arrayogma_PES_Selecao02 = data;
            }
        });
    }

    function fetchColaboradores() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetchColaboradores",
            dataType: 'text',
            success: function(data) {
                localStorage.arrayColaborador = data;
            }
        });
    }

    function fetchFamiliaAtividade() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetchFamiliaAtividade",
            dataType: 'text',
            success: function(data) {
                localStorage.arrayFamiliaAtividade = data;
            }
        });
    }

    function fetchCargos() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetchCargos",
            dataType: 'text',
            success: function(data) {
                localStorage.arrayCargo = data;
            }

        });
    }

    function fetchContatoDetalhe() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetchContatoDetalhe",
            dataType: 'text',
            success: function(data) {
                localStorage.arrayContatoDetalhe = data;
            }

        });
    }


    fetchRevisaoMonitoramentoUsuarioQtdade();

    function fetchRevisaoMonitoramentoUsuarioQtdade() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetchRevisaoMonitoramentoUsuarioQtdade",
            type: 'POST',
            dataType: 'text',
            data: {
                CBR_CODIGO: <?php if (!$this->session->has_userdata('userToken')) {
                                echo 0;
                            } else {
                                echo $this->session->userdata('userCodigo');
                            } ?>
            },
            success: function(data) {
                if (data > 0) {
                    $("#badgeQtdadeRevisaoMonitoramento").text(data);
                    $("#badgeQtdadeRevisaoMonitoramento").prop('hidden', false);
                }
            }
        });
    }
    fetchRevisaoChecklist();

    function fetchRevisaoChecklist() {
        $.ajax({
            url: "<?php echo base_url(); ?>defaults/defaults/fetchRevisaoChecklist",
            dataType: 'json',
            success: function(data) {

                var html = [];
                for (var i = data.length - 1; i >= 0; i--) {
                    var arrofwords = data[i].POP_ProcedDescricao.split(" ");

                    var middle = arrofwords.length / 2;
                    arrofwords.splice(middle, 0, "<br/>");
                    var output = data[i].POP_ProcedCodigo + ' -  ' + arrofwords.join(" ");
                    html.push('<li class="sidebar-item" id=""><a href="#" class="sidebar-link"><i class="mdi mdi-record"></i><span class="hide-menu"> ' + output + ' </span></a></li>');
                }
                $('#ulChecklist').append(html);
            }
        });
    }


    $(document).on('show.bs.modal', '.modal', function(event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    $('body').on('hidden.bs.modal', function() {
        if ($('.modal.show').length > 0) {
            $('body').addClass('modal-open');
        }
    });


    function getArrayIndexForKey(arr, key, val) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i][key] == val)
                return i;
        }
        return -1;
    }


    function loadSpinner() {
        $('html').css("visibility", "visible");
        $("#divSpinner").css("background-color", "rgba(255,255,255,1)");
        $('#divSpinner').show();
        $('body').addClass('stop-scrolling');

    }

    function loadBlurSpinner() {
        $("#divSpinner").css("background-color", "rgba(255,255,255,0.9)");
        $('#divSpinner').show();
        $('body').addClass('stop-scrolling');

    }

    function removeSpinner() {
        $('body').removeClass('stop-scrolling');
        $('html').css("visibility", "visible");
        $('#divSpinner').hide();
    }


    $('#buttonLogout').click(function() {

        $.ajax({
            url: "<?php echo base_url(); ?>login/logout",
            type: 'POST',
            success: function(data) {
                window.open('<?php echo base_url("login/") ?>', '_self');
            }
        });
    });

    Handlebars.registerHelper('dateUStoBR', function(date) {
        var splited = date.split(" ");
        return splited[0].split("-").reverse().join("/") + " " + splited[1];
    });


    function formatarReais(valor) {
		console.log("Entrou no formatarReais");
        return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    function formatarMilhar(valor) {
		console.log("Entrou no formatarMilhar");
		valor = parseFloat(valor);
		if (isNaN(valor)) {
			console.error("Valor não é um número válido:", valor);
			return ""; // Retorna uma string vazia ou um valor padrão
		}
		var valorComDuasDecimais = valor.toFixed(2);
		var partes = valorComDuasDecimais.split('.');
		partes[0] = partes[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');            
		return partes.join(',');
	}

</script> 
