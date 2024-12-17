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

  <style type="text/css">
    .spanDetalheProjetoTitulo {
      font-size: 14px;
      font-weight: bold;
    }

    .spanDetalhePessoa {
      font-size: 14px;
    }

    .rowProjeto {
      cursor: pointer;
    }

    html {
      visibility: hidden;
    }
  </style>
</head>

<body style="background: #eeeeee;">
  <div id="main-wrapper">


    <?php $this->load->view('include/navbarProjeto') ?>
    <?php $this->load->view('include/asidebar') ?>


    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Pessoa <span id="spanPES_Codigo"> - </span></h4>
            <div class="ml-auto text-right">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url('home/'); ?>">Home</a></li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url('listaPessoa/'); ?>">Cadastro de Pessoa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Cadastro de Pessoa</li>
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


                <div class="row mb-3">

                  <div class="col-10">
                    <h4 class="card-title" id="spaPES_CnpjCpf"> - </h4>
                  </div>
                  <div class="col-2 text-right">
                    <!-- <button class="btn btn-primary" id="btnImprimirProjeto">Imprimir</button> -->
                    <button class="btn btn-primary" id="btnEditarPessoa">Editar</button>
                  </div>

                </div>

                <!-- <br /> -->
            <div class="border-top"></div>
            <br />

                <div class="row">
                  <div class="col-2">
                    <span class="spanDetalheProjetoTitulo"> Tipo: </span> <br /><span class="spanDetalhePessoa" id="spanPES_TIPODESC"> - </span>
                  </div>                
                  <div class="col-5">
                    <span class="spanDetalheProjetoTitulo"> Nome: </span> <br /><span class="spanDetalhePessoa" id="spanPES_Nome"> - </span>
                  </div>
                  <div class="col-5">
                    <span class="spanDetalheProjetoTitulo"> Apelido: </span> <br /><span class="spanDetalhePessoa" id="spanPES_Apelido"> - </span>
                  </div>
               </div>
                <br />
            <div class="border-top"></div>
                <br />
                <div class="row">
                  <div class="col-6">
                    <span class="spanDetalheProjetoTitulo"> E-mail: </span> <br /><span class="spanDetalhePessoa" id="spanPES_ContEmail"> - </span>
                  </div>
                  <div class="col-6">
                    <span class="spanDetalheProjetoTitulo"> Telefone: </span> <br /><span class="spanDetalhePessoa" id="spanPES_ContTelefone"> - </span>
                  </div>                  
                </div>
                <br />
            <div class="border-top"></div>
            <br />

                <div class="row">
                  <div class="col-3">
                    <span class="spanDetalheProjetoTitulo"> CEP:</span><br /> <span class="spanDetalhePessoa" id="spanPES_EndCEP"> - </span>
                  </div>

                  <div class="col-6">
                    <span class="spanDetalheProjetoTitulo"> Logradouro:</span><br /> <span class="spanDetalhePessoa" id="spanPES_EndLogradouro"> - </span>
                  </div>

                  <div class="col-3">
                    <span class="spanDetalheProjetoTitulo"> Numero:</span><br /> <span class="spanDetalhePessoa" id="spanPES_EndNumero"> - </span>
                  </div>

                  <div class="col-4">
                    <span class="spanDetalheProjetoTitulo"> Complemento:</span><br /> <span class="spanDetalhePessoa" id="spanPES_EndComplemento"> - </span>
                  </div>         

                  <div class="col-4>
                    <span class="spanDetalheProjetoTitulo"> Bairro:</span><br /> <span class="spanDetalhePessoa" id="spanPES_EndBairro"> - </span>
                  </div> 

                  <div class="col-4">
                    <span class="spanDetalheProjetoTitulo"> Cidade:</span><br /> <span class="spanDetalhePessoa" id="spana902_nm_cidade"> - </span>
                  </div>                                                                

                </div>


            </div>
          </div>

        </div>
      </div>
      <footer class="footer text-center">
        © 2019 wDiscovery Ltda.
      </footer>
    </div>


  </div>


  <?php $this->load->view('include/headerBottom') ?>
  <?php $this->load->view('include/defaults') ?>


  <script type="text/javascript">
    
    loadSpinner();



    function fetchTotalHorasApontadas() {
      return $.ajax({
        url: "<?php echo base_url(); ?>detalheProjeto/fetchTotalHorasApontadas",
        type: 'POST',
        dataType: 'text',
        data: {
          PJT_CODIGO: <?php echo $this->uri->segment(2); ?>
        }

      });
    }



  </script>
</body>
</html>