<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @autor BERNS SIMÃO, Alexandre Augusto <alexandre.b.simao@gmail.com>
 * @arquivo estoque
 * @modulo Estoque
 * @descrição controller onde possui todo processo de movimentação e visualização de estoque 
*/

class Estoque extends CI_Controller {

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

		$this->load->model('Estoque_model');
	}

	public function index(){
		$this->_data['view'] 	= 'index';
		$this->_data['titulo']	= 'Estoque';
		$this->_data['icon'] 	= 'th-large';

		$this->_data['estoque'] = $this->Estoque_model->get_estoque();
		
		$this->load->view($this->_tpl,$this->_data);
	}

	public function entrada(){
		$this->form_validation->set_rules('quantidade','Quantidade','');
		$this->form_validation->set_rules('produto','Produto','');

		if($this->form_validation->run()){
			$quantidade = $_POST['quantidade'];
			$produto 	= $_POST['produto'];

			foreach ($quantidade as $key => $value) {
				$entrada = array(
					'data_hora_movimentacao'	=> date('Y-m-d H:i:s'),
					'quantidade'				=> $quantidade[$key],
					'tipo'						=> 'E',
					'produto_id'				=> $produto[$key]
					);
				$return += $this->Estoque_model->incluir_movimentacao( $entrada );

				$return += $this->Estoque_model->entrada_estoque( $produto[$key], $quantidade[$key] );
			}

			if( $return )
				$this->alert_library->set_alert('Estoque atualizado com sucesso!','success');
			else
				$this->alert_library->set_alert('Erro ao efetuar atualização!','error');

			redirect( base_url() . 'estoque' );

		}else{
			$this->_data['view'] 	= 'entrada';
			$this->_data['titulo']	= 'Entrada de Estoque';
			$this->_data['icon'] 	= 'arrow-up';

			$this->_data['produtos'][0] = '';
			$produtos = $this->Estoque_model->get_produtos();
			foreach ($produtos as $produto) $this->_data['produtos'][$produto->id] = $produto->nome;

			$this->_data['quantidade']  = array('name'=>'quantidade[]','type'=>'number','class'=>'form-control','required'=>'required');
			$this->_data['salvar'] 		= array('name'=>'salvar','type'=>'submit','value'=>'Cadastrar','class'=>'btn btn-success');

			$this->load->view($this->_tpl, $this->_data);
		}

	}

	public function saida(){
		$this->form_validation->set_rules('quantidade','Quantidade','');
		$this->form_validation->set_rules('produto','Produto','');

		if($this->form_validation->run()){
			$quantidade = $_POST['quantidade'];
			$produto 	= $_POST['produto'];

			foreach ($quantidade as $key => $value) {
				$entrada = array(
					'data_hora_movimentacao'	=> date('Y-m-d H:i:s'),
					'quantidade'				=> $quantidade[$key],
					'tipo'						=> 'S',
					'produto_id'				=> $produto[$key]
					);
				$return += $this->Estoque_model->incluir_movimentacao( $entrada );

				$return += $this->Estoque_model->saida_estoque( $produto[$key], $quantidade[$key] );
			}

			if( $return )
				$this->alert_library->set_alert('Estoque atualizado com sucesso!','success');
			else
				$this->alert_library->set_alert('Erro ao efetuar atualização!','error');

			redirect( base_url() . 'estoque' );

		}else{
			$this->_data['view'] 	= 'entrada';
			$this->_data['titulo']	= 'Saida de Estoque';
			$this->_data['icon'] 	= 'arrow-down';

			$this->_data['produtos'][0] = '';
			$produtos = $this->Estoque_model->get_produtos();
			foreach ($produtos as $produto) $this->_data['produtos'][$produto->id] = $produto->nome;

			$this->_data['quantidade']  = array('name'=>'quantidade[]','type'=>'number','class'=>'form-control','required'=>'required');
			$this->_data['salvar'] 		= array('name'=>'salvar','type'=>'submit','value'=>'Cadastrar','class'=>'btn btn-success');

			$this->load->view($this->_tpl, $this->_data);
		}

	}

	public function historico(){
		$this->_data['view'] 		= 'historico';
		$this->_data['titulo']		= 'Histórico de Estoque';
		$this->_data['icon'] 		= 'time';
		$this->_data['historico'] 	= $this->Estoque_model->movimentacao();

		$this->load->view($this->_tpl, $this->_data);
	}
}

/* End of file estoque.php */
/* Location: ./application/modules/estoque/controllers/estoque.php */