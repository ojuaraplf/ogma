<?php

class Relatorio_model extends CI_Model
{
    public function fetchRelatorioFechaMes($selectedColaborador, $selectedMes, $pAbreProjeto)
    {
        $query = $this->db->query("CALL ogrh_FMC_ListaFechaMes(?, ?, ?)", array($selectedColaborador == "" ? null : $selectedColaborador, $selectedMes, $pAbreProjeto));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function saveRelatorioFechaMes($arrayRowFechar)
    {
        foreach ($arrayRowFechar as $key => $value) {
            $this->db->query("CALL ogrh_FMC_SalvaFechaMes(?, ?, ?, ?, ?, ?, ?, ?, now(), ?)", array($value["pCBRCodigo"], $value["PMes"], $value["pPJTCodigo"], $value["pQtHora"], $value["pVrHora"], $value["pVrTotal"], $value["pFlgQuebrado"], $value["pCBUCodigo"], $value["pUSULogin"]));
        }
    }

    public function fetchColaborador()
    {
        $query = $this->db->query("CALL ogrh_CBR_Selecao01()");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}
