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
  <title>wDiscovery</title>

  <?php $this->load->view('include/headerTop') ?>
</head>
<style type="text/css">
.default {
  cursor: default;
}
.wait {
  cursor: wait;
}
</style>

<body style="background: #eeeeee;">
  <div id="main-wrapper">
    <?php $this->load->view('include/navbarHome') ?>
    <?php $this->load->view('include/asidebar') ?>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title"> PARCEIROS </h4>
            <?php
//echo "teste > " . $this->session->userdata('userLogin');
?>

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
      <br />
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Parceiros VHSYS</h4>
                <div class="border-top"></div>
                <br />

                <div class="row mb-3">


                  <div class="col-2">
                    <label for="idParceiro" class="text-left control-label col-form-label">Código VHSYS</label>
                    <input type="text" placeholder="Informe código VHSYS" id="idParceiro" class="form-control" />
                  </div>

                  <input type="text" id="idtxt" class="form-control " style="display:none;" />

                  <div class="col-2">
                    <label for="" class="text-left control-label col-form-label">&nbsp;</label>
                    <button class="btn btn-primary btn-block" id="buttonConsultar" name="buttonConsultar">Consultar</button>
                    <button class="btn btn-primary btn-block" style="display:none;" id="btnx" >x</button>
                  </div>

                  <div class="col12" id="div_teste" style="display:none;" >
                  <input type="text" id="txtPES_Codigo" class="form-control "/>
                  <input type="text" id="txtVhSysClienteIdx" class="form-control "/>
                  <input type="text" id="CBR_PESCodigox" class="form-control "/>
                  <input type="text" id="txtPES_Nome" class="form-control "/>
                  <input type="text" id="txtPES_CnpjCpf" class="form-control "/>
                  <input type="text" id="txtPES_Apelido" class="form-control "/>
                  <input type="text" id="txtPES_EndLogradouro" class="form-control "/>
                  <input type="text" id="txtPES_EndNumero" class="form-control "/>
                  <input type="text" id="txtPES_EndBairro" class="form-control "/>
                  <input type="text" id="txtPES_EndCEP" class="form-control "/>
                  <input type="text" id="txtcidade_cliente" class="form-control "/>  
                  <input type="text" id="txtuf_cliente" class="form-control "/>
                  <input type="text" id="txtuf_cliente" class="form-control "/>
                  <input type="text" id="txtVhSysClienteId" class="form-control "/>
                  <input type="text" id="CBR_PESCodigo" class="form-control "/>
                  </div> 


                </div>


                <div id="div_dialogo" >
                </div>


                <div class="col-lg-12" style="text-align: center;" id="div_btn" style="display:none;">
                  <button class="btn btn-primary" name="btnInsertParceiro" id="btnInsertParceiro">Sim</button>
                  <button class="  btn btn-primary" name="btnNao" id="btnNao">Não</button>              
                </div>

                <br /><br />

                <div class="border-top"></div>
                <label for="" class="text-left control-label col-form-label"> Parceiros </label>
                <div class="table-responsive">
                <table id="tableParceiros" style="text-align: center;" class="table table-hover table-sm table-bordered" >
                  <thead>
                    <tr style="text-align: center;" scope="col">
                      <th style="width: 10%;" scope="col"> Idparceiro</th>
                      <th style="width: 15%;" scope="col"> CPF/CNPJ</th>
                      <th style="width: 60%;" scope="col"> Nome Parceiro</th>
                      <th style="width: 15%;" scope="col"> Tipo de vínculo</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                </div>

              </div>
            </div>
          </div>


        </div>
      </div>



    </div>
    <?php $this->load->view('include/headerBottom') ?>
    <?php $this->load->view('include/defaults') ?>



  </div>

  <script type="text/javascript">
   
    $("#div_dialogo").addClass('hide');
    $("#div_btn").addClass('hide');
    var status_ws;
    var CBR_USULogin = "<?= $this->session->userdata('userLogin'); ?>";

    var idparceiro;
    var PES_Codigo;
    var PARCEIRO;
    var CBR_VhSysClienteId;

    var PES_Nome;
    var PES_CnpjCpf;
    var PES_Apelido;
    var PES_EndLogradouro;
    var PES_EndNumero;
    var PES_EndBairro;
    var PES_EndCEP;
    var cidade_cliente;
    var uf_cliente;


    $('#idParceiro').keyup(function() {
      $(this).val(this.value.replace(/\D/g, ''));
    });


    function checarPESCnpjCpf(PES_CnpjCpf) {
      $.ajax({
        url: "<?php echo base_url(); ?>administrativo/parceiro/checarPESCnpjCpf",
        type: 'POST',
        dataType: 'json',
        data: {
          PES_CnpjCpf: PES_CnpjCpf
        },

        success: function(data) {
          //data = JSON.parse(data).data;
          console.log(data);
          $('#txtPES_Codigo').val(data[0].PES_Codigo);
          $('#CBR_PESCodigo').val(data[0].CBR_PESCodigo);
          $('#txtVhSysClienteId').val(data[0].CBR_VhSysClienteId);
          return data[0].PES_Codigo;
        },

        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    }


    function cadastraPesPessoa() {

      var cnpjcpf = $('#txtPES_CnpjCpf').val();
      var CnpjCpf = cnpjcpf.replace(/[^\d]+/g,"");

      $.ajax({
        url: "<?php echo base_url(); ?>administrativo/parceiro/cadastraPesPessoa",
        type: 'POST',
        datatype: 'text',
        data: {
          PES_Nome: $('#txtPES_Nome').val(),
          PES_CnpjCpf: CnpjCpf,
          PES_Apelido: $('#txtPES_Apelido').val(),
          PES_EndLogradouro: $('#txtPES_EndLogradouro').val(),
          PES_EndNumero: $('#txtPES_EndNumero').val(),
          PES_EndBairro: $('#txtPES_EndBairro').val(),
          PES_EndCEP: $('#txtPES_EndCEP').val()
        },

        error: function(e, ts, et) {
          console.log(e)
        },

        success: function(data) {
          console.log(data);
          $('#txtPES_Codigo').val(data);
          return data;
        },
      })

    }


    function atualizaFuncionario() {

      $.ajax({
        url: "<?php echo base_url(); ?>administrativo/parceiro/atualizaFuncionario",
        type: 'POST',
        datatype: 'text',
        data: {
          CBR_PESCodigo: $('#txtPES_Codigo').val(),
          CBR_VhSysClienteId: $('#idParceiro').val()
        },

        error: function(e, ts, et) {
          console.log(e)
        },

        success: function(data) {
          console.log(data);
          return data;
        },
      })

    }


    function cadastraFuncionario() {

    $.ajax({
      url: "<?php echo base_url(); ?>administrativo/parceiro/cadastraFuncionario",
      type: 'POST',
      datatype: 'text',
      data: {
        CBR_PESCodigo: $('#txtPES_Codigo').val(),
        CBR_VhSysClienteId: $('#idParceiro').val()
      },

      error: function(e, ts, et) {
        console.log(e)
      },

      success: function(data) {
        console.log(data);
        return data;
      },
    })

    }


    function listaparceiros() {
      //alert('opa');
      $("#tableParceiros > tbody").html("");

			$.ajax({
				url: "<?php echo base_url(); ?>administrativo/parceiro/listaparceiros",
        type: 'POST',
        dataType: 'json',  

				success: function (data) {
          
					//data = JSON.parse(data).data;
          console.log(data);
          var html = [];
          var v_vhsysIdCli = "";
          for (var i = data.length - 1; i >= 0; i--) {
            v_vhsysIdCli = "";
            if (data[i].PAR_Vhsys_Id_Cliente > 0) {
              v_vhsysIdCli = data[i].PAR_Vhsys_Id_Cliente;
            }

            html.push('<tr scope="row">');
            html.push('<td>' + v_vhsysIdCli + '</td>');
            html.push('<td>' + data[i].PES_CnpjCpf + '</td>');
            html.push('<td style="text-align: left;">' + data[i].PES_NOME + '</td>');
            html.push('<td>Padrão</td>');
            html.push('</tr>');

					}

          $('#tableParceiros').append(html);
				}
			});
    }

    listaparceiros();

    function redifinirAmbiente(){

      $("#div_dialogo").addClass('hide');
      $("#div_btn").addClass('hide');

      PES_Codigo = "";
      PARCEIRO = "";
      CBR_VhSysClienteId = "";
      PES_Nome = "";
      PES_CnpjCpf = "";
      PES_Apelido = "";
      PES_EndLogradouro = "";
      PES_EndNumero = "";
      PES_EndBairro = "";
      PES_EndCEP = "";
      cidade_cliente = "";
      uf_cliente = "";
      
      $('#txtPES_Codigo').val("");
      $('#txtVhSysClienteId').val("");
      $('#txtPES_Nome').val("");
      $('#txtPES_CnpjCpf').val("");
      $('#txtPES_Apelido').val("");
      $('#txtPES_EndLogradouro').val("");
      $('#txtPES_EndNumero').val("");
      $('#txtPES_EndBairro').val("");
      $('#txtPES_EndCEP').val("");
      $('#txtcidade_cliente').val("");
      $('#txtuf_cliente').val("");
      $('#CBR_PESCodigo').val("");
      
    }


    function validaEndereco() {
      return true;
      if (($('#txtPES_EndLogradouro').val() == "") ||
         ($('#txtPES_EndBairro').val() == "") ||
         ($('#txtPES_EndCEP').val() == "") ||
         ($('#txtcidade_cliente').val() == "") || 
         ($('#txtuf_cliente').val() == "")) {
          return false;
         }
    }



    function verificaidparceiro(idparceiro)
    {
      status_ws = "";
      $.ajax({
        url: "<?php echo base_url(); ?>administrativo/parceiro/consultaws_status",
        type: 'POST',
        data: {
          idparceiro:  idparceiro
        },

        error: function(e, ts, et) {
              console.log(e)
            },

        success: function(data) {
          console.log(data);
          status_ws = data;
          return data;
        },
      })
    
    }

    function validaidparceiro(idparceiro) {

      $.when(verificaidparceiro(idparceiro)).done(function(x0) {
        //alert(status_ws);
        var timerId = setInterval( function() {

          if (status_ws == "error") {
            clearInterval(timerId);
            return false;
          } else if ( status_ws == "success") {
            clearInterval(timerId);
            return true;
          }
        }, 100 );

      })

    }

    $('#btnx').click(function() {

      teste_verificacao($('#idParceiro').val());

    });

    //function buscaParceiro(idparceiro, callback)
    function buscaParceiro(idparceiro)
    {

      $.ajax({
        url: "<?php echo base_url(); ?>administrativo/parceiro/consultaws",
        type: 'POST',
        datatype: 'html',
        data: {
          idparceiro:  idparceiro
        },

        error: function(e, ts, et) {
              console.log(e)
            },

        success: function(data) {
          data = JSON.parse(data).data;
          PES_CnpjCpf = data.cnpj_cliente;
          var _PES_CnpjCpf = PES_CnpjCpf.replace(/[^\d]+/g,"");
          $('#txtPES_Nome').val(data.razao_cliente);
          $('#txtPES_CnpjCpf').val(PES_CnpjCpf);
          $('#txtPES_Apelido').val(data.fantasia_cliente);
          $('#txtPES_EndLogradouro').val(data.endereco_cliente);
          $('#txtPES_EndNumero').val(data.numero_cliente);
          $('#txtPES_EndBairro').val(data.bairro_cliente);
          $('#txtPES_EndCEP').val(data.cep_cliente);
          $('#txtcidade_cliente').val(data.cidade_cliente);
          $('#txtuf_cliente').val(data.uf_cliente);          
          PES_Nome = data.razao_cliente;
          PES_Apelido = data.fantasia_cliente;
          PES_EndLogradouro = data.endereco_cliente;
          PES_EndNumero = data.numero_cliente;
          PES_EndBairro = data.bairro_cliente;
          PES_EndCEP = data.cep_cliente;
          cidade_cliente = data.cidade_cliente;
          uf_cliente = data.uf_cliente;
          PES_Codigo = checarPESCnpjCpf(_PES_CnpjCpf);

          return data.id_cliente;
        },
      })
    
     // return callback(PES_Codigo);
    }


    $('#buttonConsultar').click(function() {

      var idparceiro = $('#idParceiro').val();
      var flag_erro = false;

      document.body.style.cursor = "wait";
      //$("body").addClass("wait");  
      //$("body").css("cursor", "wait");    

      if (idparceiro == null || idparceiro == "") {
        $('#idParceiro').addClass('is-invalid');
        redifinirAmbiente();
        return;
      } else {

        var html = "";
        var html2 = "";
        var btnstatus = 0;
        redifinirAmbiente();

        $('#buttonConsultar').html('buscando...');
        $('#buttonConsultar').addClass('disabled');

        $.when(validaidparceiro(idparceiro)).done(function(x0) {
        //alert(status_ws);
        var setvalidacao = setInterval( function() {

          if (status_ws == "error") {

            html += '<div class="alert alert-danger" role="alert">';
            html += 'Nenhum registro cadastrado com ID ' + idparceiro + ' na base VHSYS!';
            html += '</div>';
            $("#div_btn").addClass('hide');
            $('#btnInsertParceiro').html('Sim');        
            $('#div_dialogo').html(html);
            $("#div_dialogo").removeClass('hide'); 
            $('#idParceiro').val('');
            $('#idParceiro').focus();
            $('#buttonConsultar').html('Consultar');
            $('#buttonConsultar').removeClass('disabled'); 

            document.body.style.cursor = "default";      

            clearInterval(setvalidacao);

          } else if ( status_ws == "success") {
            
            $('#idParceiro').removeClass('is-invalid');

            $.when(buscaParceiro(idparceiro)).done(function(x) {
            
              var timerId = setInterval( function() {
                
                if ($('#txtPES_Codigo').val() != "" && $('#txtPES_Codigo').val() != null && $('#txtPES_Codigo').val() != "0") { 
                  html += '<div class="alert alert-success" role="alert">';
                  html += '<h4><small class="text-muted">Código: </small>' + idparceiro + '</h4>';
                  html += '<h6><small class="text-muted">CNPJ :</small>' + PES_CnpjCpf + '<small class="text-muted"> | Razão Social: </small>' + $('#txtPES_Nome').val() + '<small class="text-muted"> | ';
                  html += 'Nome fantasia: </small>' + $('#txtPES_Apelido').val() + '</h6>';
                  html += '<h6><small class="text-muted">Bairro: </small>' + $('#txtPES_EndBairro').val() + '<small class="text-muted"> | Cidade: </small>' + $('#txtcidade_cliente').val() + '<small class="text-muted"> | ';
                  html += 'UF: </small>' + $('#txtuf_cliente').val() + '<small class="text-muted"> | Cep: </small>' + $('#txtPES_EndCEP').val() + '</h6>';
                  html += '<hr>';   
                  html += '<div class="alert alert-warning" role="alert">';
                  //if (parseInt($('#txtVhSysClienteId').val()) > 0) {
                  if (parseInt($('#CBR_PESCodigo').val()) > 0 && $('#txtVhSysClienteId').val() == "" ) {
                    html += 'Cadastro ' + $('#txtPES_CnpjCpf').val() + ' | Atualizar vínculação como colaborador?';
                    btnstatus = 1;
                  } else if ($('#CBR_PESCodigo').val() == "" && $('#txtVhSysClienteId').val() == "" ) {
                    html += 'Cadastro ' + $('#txtPES_CnpjCpf').val() + ' consta no base OGMA. Deseja víncular como parceiro colaborador?';
                    btnstatus = 1;
                  } else {
                    html += 'Cadastro ' + $('#txtPES_CnpjCpf').val() + ' consta como integrado.';
                  }
                  html += '</div>';
                  html += '<h4></h4>';
                  html += '</div>';

                  if (btnstatus == 1) {
                    $('#btnNao').html('Não');
                    $("#btnInsertParceiro").removeClass('hide');
                  } else if (btnstatus == 0) {
                    $('#btnNao').html('Voltar');
                    $("#btnInsertParceiro").addClass('hide');
                  }

                  $('#div_dialogo').html(html);
                  $("#div_dialogo").removeClass('hide');

                  $("#div_btn").removeClass('hide');

                  $('#buttonConsultar').html('Consultar');
                  $('#buttonConsultar').removeClass('disabled');

                  document.body.style.cursor = "default";            

                  clearInterval(timerId);

                } else if ($('#txtPES_Codigo').val() == "0") {
                  html += '<div class="alert alert-success" role="alert">';
                  html += '<h4><small class="text-muted">Código: </small>' + idparceiro + '</h4>';
                  html += '<h6><small class="text-muted">CNPJ :</small>' + PES_CnpjCpf + '<small class="text-muted"> | Razão Social: </small>' + $('#txtPES_Nome').val() + '<small class="text-muted"> | ';
                  html += 'Nome fantasia: </small>' + $('#txtPES_Apelido').val() + '</h6>';
                  html += '<h6><small class="text-muted">Bairro: </small>' + $('#txtPES_EndBairro').val() + '<small class="text-muted"> | Cidade: </small>' + $('#txtcidade_cliente').val() + '<small class="text-muted"> | ';
                  html += 'UF: </small>' + $('#txtuf_cliente').val() + '<small class="text-muted"> | Cep: </small>' + $('#txtPES_EndCEP').val() + '</h6>';
                  html += '<hr>';   
                  html += '<div class="alert alert-warning" role="alert">';
                  if (validaEndereco()) {
                    html += 'Opa! Dados novos. Deseja víncular agora?';
                    btnstatus = 1;
                  } else {
                    html += 'Opa! Dados de endereço incompleto?';
                  }
                  html += '</div>';
                  html += '<h4></h4>';
                  html += '</div>';

                  if (btnstatus == 1) {
                    $('#btnNao').html('Não');
                    $("#btnInsertParceiro").removeClass('hide');
                  } else if (btnstatus == 0) {
                    $('#btnNao').html('Voltar');
                    $("#btnInsertParceiro").addClass('hide');
                  }

                  //$('#btnNao').html('Não');
                 // $("#btnInsertParceiro").removeClass('hide');

                  $('#div_dialogo').html(html);
                  $("#div_dialogo").removeClass('hide');
                  
                  $("#div_btn").removeClass('hide');

                  $('#buttonConsultar').html('Consultar');
                  $('#buttonConsultar').removeClass('disabled');

                  document.body.style.cursor = "default";

                  clearInterval(timerId);
                }

              }, 100 );


              });
              
              clearInterval(setvalidacao);

          }

        }, 100 );

        })

       // if (flag_erro == true) {alert('oi');}


      }

      //document.body.style.cursor = "default";
      //$("body").removeClass("wait");
      //$("body").css("cursor", "default");
      

    })
  

    $('#btnInsertParceiro').click(function() {
      
      //var PAR_TipoParceria = 32898;
      var html;
      var CheckCadPessoa = 0;

      $('#btnInsertParceiro').html('vinculando...');

      if($('#txtPES_Codigo').val() == "0") {
        
        $.when(cadastraPesPessoa()).done(function(x) {

          var timerId = setInterval( function() {
            
            CheckCadPessoa = x;
            
            if (parseInt(CheckCadPessoa) > 0) {
              $('#txtPES_Codigo').val(CheckCadPessoa);
              clearInterval(timerId);
            }

          }, 100 );

        })
        
      }


      var timerId2 = setInterval( function() {

        if (parseInt($('#txtPES_Codigo').val()) > 0) {
          
          if (parseInt($('#CBR_PESCodigo').val()) > 0 && $('#txtVhSysClienteId').val() == "" ) {
            // atualiza ogrh_CBR_Funcionario
            $.when(atualizaFuncionario()).done(function(x2) {

              html += '<div class="alert alert-success" role="alert">';
              html += 'Registro atualizado!';
              html += '</div>';
              $('#div_dialogo').html(html);

              setTimeout(function () { 
                $('#div_dialogo').html('');
                $("#div_dialogo").addClass('hide'), 
                listaparceiros(),
                redifinirAmbiente()
                $('#idParceiro').val('');
                $('#idParceiro').focus(); 
              }, 3000);
              $("#div_btn").addClass('hide');
              $('#btnInsertParceiro').html('Sim');
              clearInterval(timerId2);

            })


          } else if ($('#CBR_PESCodigo').val() == "" && $('#txtVhSysClienteId').val() == "" ) {
            // cadastra em ogrh_CBR_Funcionario
            $.when(cadastraFuncionario()).done(function(x2) {

              html += '<div class="alert alert-success" role="alert">';
              html += 'Registro cadastrado!';
              html += '</div>';
              $('#div_dialogo').html(html);

              setTimeout(function () { 
                $('#div_dialogo').html('');
                $("#div_dialogo").addClass('hide'), 
                listaparceiros(),
                redifinirAmbiente()
                $('#idParceiro').val('');
                $('#idParceiro').focus(); 
              }, 3000);
              $("#div_btn").addClass('hide');
              $('#btnInsertParceiro').html('Sim');
              clearInterval(timerId2);

            })

          } 

        }

      }, 100 );


    })




    $('#btnNao').click(function() {


      redifinirAmbiente();
      $('#div_dialogo').html('');
      $("#div_dialogo").addClass('hide');
      $("#div_btn").addClass('hide');
      $('#idParceiro').val('');
      $('#idParceiro').focus();


    })



    removeSpinner();
  
  </script>
 

</body>

</html>