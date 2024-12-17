<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapeamento extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("mapeamento/Mapeamento_model", 'mm');
    }


    public function index()
    {
        $this->load->view('mapeamento/Mapeamento');
    }

    function fetchPJT_CODIGO()
    {
        $PJF_CODIGO = $this->input->post("PJF_CODIGO");
        $data = $this->mm->fetchPJT_CODIGO($PJF_CODIGO);
        echo json_encode($data);
    }





    public function fetchogm_projeto()
    {
        $data = $this->mm->fetchogm_projeto();
        echo json_encode($data);
    }



    function fetchogm_projetofase()
    {
        $PJT_CODIGO = $this->input->post("PJT_CODIGO");
        $data = $this->mm->fetchogm_projetofase($PJT_CODIGO);
        echo json_encode($data);
    }



    function updateIMPLANTACAO()
    {
        $CHV_IMPLANTACAO = $this->input->post("CHV_IMPLANTACAO");
        $CHV_FASE = $this->input->post("CHV_FASE");
        $DSC_NOMEIMPLANTACAO = $this->input->post("DSC_NOMEIMPLANTACAO");
        $DAT_IMPLANTACAO = $this->input->post("DAT_IMPLANTACAO");
        $DSC_IMPLANTACAO = $this->input->post("DSC_IMPLANTACAO");
        $data = array(
            "CHV_IMPLANTACAO" => $CHV_IMPLANTACAO,
            "CHV_FASE" => $CHV_FASE,
            "DSC_NOMEIMPLANTACAO" => $DSC_NOMEIMPLANTACAO,
            "DAT_IMPLANTACAO" => $DAT_IMPLANTACAO,
            "DSC_IMPLANTACAO" => $DSC_IMPLANTACAO

        );
        echo $this->mm->updateIMPLANTACAO($data);
    }



    public function fetchLOCAL_BD()
    {
        $data = $this->mm->fetchLOCAL_BD();
        echo json_encode($data);
    }





    public function fetchTIPO_OBJETO()
    {
        $data = $this->mm->fetchTIPO_OBJETO();
        echo json_encode($data);
    }
    public function fetchIMPLANTACAO()
    {
        $data = $this->mm->fetchIMPLANTACAO();
        echo json_encode($data);
    }


    function updateOBJETO()
    {
        $CHV_OBJETO = $this->input->post("CHV_OBJETO");
        $COD_OBJETO = $this->input->post("COD_OBJETO");
        $CHV_IMPLANTACAO = $this->input->post("CHV_IMPLANTACAO");
        $CHV_LOCAL_BD = $this->input->post("CHV_LOCAL_BD");
        $CHV_TIPO_OBJETO = $this->input->post("CHV_TIPO_OBJETO");
        $DSC_OBJETO = $this->input->post("DSC_OBJETO");
        $DSC_DEFINICAO = $this->input->post("DSC_DEFINICAO");
        $IND_VERSIONAMENTO = $this->input->post("IND_VERSIONAMENTO");
        $DSC_REGRA_VERSIONAMENTO = $this->input->post("DSC_REGRA_VERSIONAMENTO");
        $DSC_PERIODO_AFERICAO = $this->input->post("DSC_PERIODO_AFERICAO");
        $DSC_RETENCAO = $this->input->post("DSC_RETENCAO");
        $DSC_OBSERVACAO = $this->input->post("DSC_OBSERVACAO");
        $data = array(
            "CHV_OBJETO" => $CHV_OBJETO,
            "COD_OBJETO" => $COD_OBJETO,
            "CHV_IMPLANTACAO" => $CHV_IMPLANTACAO,
            "CHV_LOCAL_BD" => $CHV_LOCAL_BD,
            "CHV_TIPO_OBJETO" => $CHV_TIPO_OBJETO,
            "DSC_OBJETO" => $DSC_OBJETO,
            "DSC_DEFINICAO" => $DSC_DEFINICAO,
            "IND_VERSIONAMENTO" => $IND_VERSIONAMENTO,
            "DSC_REGRA_VERSIONAMENTO" => $DSC_REGRA_VERSIONAMENTO,
            "DSC_PERIODO_AFERICAO" => $DSC_PERIODO_AFERICAO,
            "DSC_RETENCAO" => $DSC_RETENCAO,
            "IND_VERSIONAMENTO" => $IND_VERSIONAMENTO,
            "DSC_OBSERVACAO" => $DSC_OBSERVACAO
        );
        echo $this->mm->updateOBJETO($data);
    }


    public function fetchOBJETO()
    {
        $data = $this->mm->fetchOBJETO();
        echo json_encode($data);
    }

    public function fetchOBJETO_RELACIONAMENTO()
    {
        $CHV_OBJETO_ORIGEM = $this->input->post("CHV_OBJETO_ORIGEM");
        $data = $this->mm->fetchOBJETO_RELACIONAMENTO($CHV_OBJETO_ORIGEM);
        echo json_encode($data);
    }










    function updateOBJETO_RELACIONAMENTO()
    {
        $arrayCHV_OBJETO_DESTINO = $this->input->post("arrayCHV_OBJETO_DESTINO");
        $CHV_OBJETO_ORIGEM = $this->input->post("CHV_OBJETO_ORIGEM");

        echo $this->mm->updateOBJETO_RELACIONAMENTO($arrayCHV_OBJETO_DESTINO, $CHV_OBJETO_ORIGEM);
    }

    // public function fetchObjeto()
    // {
    //     $CHV_OBJETO = $this->input->post("CHV_OBJETO");
    //     $data = $this->smm->fetchObjeto($CHV_OBJETO);
    //     echo json_encode($data);
    // }
    //
    // public function fetchMAP_INDICADOR()
    // {
    //     $data = $this->smm->fetchMAP_INDICADOR();
    //     echo json_encode($data);
    // }



}
