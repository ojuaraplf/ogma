<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notificacao extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("configuracao/Notificacao_model", 'model');
	}

	public function lista()
	{
		$data['notifications'] = json_encode($this->model->fetch());
		$this->load->view('notificacao/lista', $data);
	}

	public function adicionar()
	{
		$this->load->view('notificacao/adicionar');
	}

	public function save()
	{
		date_default_timezone_set('America/Sao_Paulo');
		$this->load->helper('string');

		$title = $this->input->post("inputTitle");
		$description = $this->input->post("textareaDescription");
		$isEnabled = $this->input->post("isEnabled") ? 1 : 0;
		$userLogin = $this->session->userdata("userLogin");
		$createdTime = date_create()->format('Y-m-d H:i:s');

		try {
			if (isset($_FILES["inputUploadFile"]["name"])) {
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('inputUploadFile')) {
					throw new \Exception("Tamanho máximo do arquivo permitido é 2MB. O arquivo deve ser .jpg, .jpeg ou .png.");
				} else {
					$data = $this->upload->data();

					$extension = pathinfo($data["file_name"])['extension'];

					$filename = $data["file_name"];
					$source = 'uploads/' . $filename;

					$this->load->library('ftp');
					$config['hostname'] = '162.240.209.46';
					$config['username'] = 'somoswd';
					$config['password'] = 'Ja@UUc34O4Jo';
					$config['debug']    = TRUE;

					$this->ftp->connect($config);

					$randomFilenameString = random_string('alnum', 32) . '.' . $extension;

					$destination = 'public_html/ogma_notification_files/' . $randomFilenameString;

					$this->ftp->upload($source, $destination);
					$this->ftp->close();
					@unlink($source);

					$data = [
						"NOT_Titulo" => $title,
						"NOT_Descricao" => $description,
						"NOT_Habilitada" => $isEnabled,
						"NOT_USULogin" => $userLogin,
						"NOT_MomCriacao" => $createdTime,
						"NOT_NomeImagem" => $randomFilenameString
					];

					$this->model->insert($data);

					$return = array(
						'status' => 200,
						'message' => "Sucesso!"
					);
					echo json_encode($return);
				}
			}
		} catch (Exception $e) {
			$return = array(
				'status' => 404,
				'message' => $e->getMessage()
			);
			echo json_encode($return);
		}
	}

	function changeEnabledDisabled()
	{
		$data['NOT_Codigo'] = $this->input->post("NOT_Codigo");
		$data['NOT_Habilitada'] = $this->input->post("NOT_Habilitada") ? 1 : 0;
		$this->model->updateEnabled($data);
		$return = array(
			'status' => 200,
			'message' => "Sucesso!"
		);
		echo json_encode($return);
	}
}
