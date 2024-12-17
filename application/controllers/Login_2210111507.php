<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model("login_model", 'lm');
    }

    public function index()
    {
        $this->load->view('Login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
    }


    function performLogin()
    {
        $login = $this->input->post("login");
        $pwd = $this->input->post("pwd");

        $user = $this->lm->performLogin($login, $pwd);
    
        if (empty($user)) {
            echo json_encode(array('statusCode' => 404, 'message' => 'Login ou senha inválido(s)!'));
        } else {

            if (password_verify($pwd, $user->USU_Senha)) {

                $data = array(
                    'USU_Login' => $login,
                    'USU_Senha' => $pwd,
                    'device_name' => 'ogma'
                );
        
                $data_string = json_encode($data);
                
                $curl = curl_init(apiURL . 'externalLogin');
        
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
                );
        
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
                $result = curl_exec($curl);
                curl_close($curl);
                $token = json_decode($result)->data->token;


                $newdata = array(
                    'userToken'  => $login,
                    'userCodigo'  => $user->USU_PESCodigo,
                    'userName'  => $user->PES_Nome,
                    'USU_FlgPodeEditarColaborador' => $user->USU_FlgPodeEditarColaborador,
                    'USU_FlgPodePreFaturar' => $user->USU_FlgPodePreFaturar,
                    'USU_FlgPodeAcessarGestaoPlanos' => $user->USU_FlgPodeAcessarGestaoPlanos,
                    'USU_FlgPodeSigilo01' => $user->USU_FlgPodeSigilo01,
                    'USU_FlgPodeEditarPessoa' => $user->USU_FlgPodeEditarPessoa,
                    'USU_FlgPodeEditarUsuario' => $user->USU_FlgPodeEditarUsuario,
                    'userLogin'  => $login,
                    'token' => $token
                );
                $this->session->set_userdata($newdata);
                echo json_encode(array('statusCode' => 200, 'message' => 'Login feito com sucesso.!'));

            } else {
                echo json_encode(array('statusCode' => 404, 'message' => 'Senha inválido!'));
            }
        }
    }
}
