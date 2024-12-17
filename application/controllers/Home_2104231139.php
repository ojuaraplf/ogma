<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("home_model", 'hm');

	}


	public function index() {
		$this->load->view('Home');
	}

	


}
