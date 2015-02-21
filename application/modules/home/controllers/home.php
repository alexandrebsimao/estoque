<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	private $_tpl = 'template';
	private $_data;

	function __construct(){
		parent::__construct();

		$this->load->library('user_library');
		$this->load->library('alert_library');

		if(!$this->user_library->verifica_logado()){
			redirect(base_url().'user/login');
		}

		$this->_data['session_user'] = $this->session->userdata('usuario');

	}

	public function index(){
		redirect(base_url().'estoque/index');
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */