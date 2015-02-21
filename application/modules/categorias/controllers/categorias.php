<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @autor BERNS SIMÃO, Alexandre Augusto <alexandre.b.simao@gmail.com>
 * @arquivo categorias
 * @modulo Categorias
 * @descrição controller onde possui todo processo de exibição, cadastro e alteração de categorias 
*/

class Categorias extends CI_Controller {

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

		$this->load->model('Categorias_model');
	}

	public function index(){
		$this->_data['view'] 	= 'index';
		$this->_data['titulo']	= 'Categorias';
		$this->_data['icon'] 	= 'list-alt';

		$this->_data['categorias'] = $this->Categorias_model->get_categorias();
		
		$this->load->view($this->_tpl,$this->_data);
	}

	public function novo(){
		$this->form_validation->set_rules('nome', 'Nome', 'required|xss_clean|trim');

		if ( $this->form_validation->run() ){
			$insert = array(
				'nome' => $_POST['nome']
				);

			if ( $this->Categorias_model->incluir( $insert ) ){
				$this->alert_library->set_alert('Cadastrado com sucesso!','success');
			}
			else{
				$this->alert_library->set_alert('Erro ao efetuar cadastro!','error');
			}
			redirect( base_url() . 'categorias' );

		}else{
			$this->_data['view']	= 'form';
			$this->_data['titulo']	= 'Nova Categoria';
			$this->_data['icon'] 	= 'list-alt';

			$this->_data['nome'] 		= array('name'=>'nome','type'=>'text','class'=>'form-control');
			$this->_data['salvar'] 		= array('name'=>'salvar','type'=>'submit','value'=>'Cadastrar','class'=>'btn btn-success');

			$this->load->view($this->_tpl, $this->_data);
		}

	}

	public function editar( $id ){
		$this->form_validation->set_rules('nome', 'Nome', 'required|xss_clean|trim');

		if ( $this->form_validation->run() ){
			$insert = array(
				'nome' => $_POST['nome']
				);

			if ( $this->Categorias_model->editar( $id, $insert ) ){
				$this->alert_library->set_alert('Atualizado com sucesso!','success');
			}
			else{
				$this->alert_library->set_alert('Erro ao efetuar atualização!','error');
			}
			redirect( base_url() . 'categorias' );

		}else{
			$this->_data['view']	= 'form';
			$this->_data['titulo']	= 'Editar Categoria';
			$this->_data['icon'] 	= 'list-alt';

			$categoria				= $this->Categorias_model->row_categoria( $id );

			$this->_data['nome'] 	= array('name'=>'nome','type'=>'text','class'=>'form-control', 'value' => $categoria->nome);
			$this->_data['salvar'] 	= array('name'=>'salvar','type'=>'submit','value'=>'Cadastrar','class'=>'btn btn-success');

			$this->load->view($this->_tpl, $this->_data);
		}

	}

}

/* End of file categorias.php */
/* Location: ./application/modules/categorias/controllers/categorias.php */