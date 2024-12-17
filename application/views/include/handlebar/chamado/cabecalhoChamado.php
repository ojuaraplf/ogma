<script id="cabecalhoChamado" type="text/x-handlebars-template">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <h4 class="card-title"> {{ chamado.CHD_Descricao }} </h4>
                </div>
            </div>
            <div class="border-top"></div>
            <br />
            <div class="row">
                <div class="col-8">
                    <strong> Projeto/Fase: </strong> <br /> {{chamado.PJT_CODIGO}} / {{chamado.PJF_ORDEMFASE}} - {{chamado.PJF_IDENTIFICACAOFASE}} 
                </div>
                <div class="col-4">
                    <strong> Data Abertura: </strong><br />{{ dateUStoBR chamado.CHD_MomAbertura }}

                </div>
            </div>
            <br />
            <div class="border-top"></div>
            <br />
            <div class="row">
                <div class="col-4">
                    <strong> Prioridade: </strong> <br />{{ chamado.CHP_Descricao }}
                </div>
                <div class="col-4">
                    <strong> Categoria: </strong><br />{{ chamado.CHC_Descricao }}
                </div>
                <div class="col-4">
                    <strong> Status Chamado: </strong><br />{{ chamado.STC_Descricao }}
                </div>
            </div>
            <br />
            <div class="border-top"></div>
            <br />
            <div class="row">
                <div class="col-4">
                    <strong> Responsável: </strong> <br />{{ chamado.COLABORADOR }}
                </div>
                <div class="col-3">
                    <strong> Esforço previsto/orçamento: </strong><br />{{ chamado.CHD_QtHora }}
                </div>
                <div class="col-5">
                    <strong> Solicitante: </strong> <br />{{ chamado.CHD_Solicitante }}
                </div>
            </div>
            <br />
            <div class="border-top"></div>
            <br />
            <div class="row">
                <div class="col-12">
                    <strong> Descrição: </strong> <br />{{ chamado.CHD_TextoSolicitacao }}
                </div>
            </div>


            <br />



            <div class="border-top"></div>
            <br />

            <div class="row">
                <div class="col-12">
                    <strong> Anexos: </strong> <br />
                    <?php foreach ($ogsv_CHA_AnexoChamado as $item): ?>
                        <a href="<?= base_url('detalheChamado/downloadFile/'); ?><?= $item["CHA_Codigo"] ?>"> <?= explode('/', $item["CHA_DocumLink"])[2] ?> </a>
                        <br />
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</script> 