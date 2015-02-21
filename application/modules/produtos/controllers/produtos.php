<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @autor BERNS SIMÃO, Alexandre Augusto <alexandre.b.simao@gmail.com>
 * @arquivo produtos
 * @modulo Produtos
 * @descrição controller onde possui todo processo de exibição, cadastro e alteração de produtos 
*/

class Produtos extends CI_Controller {

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

		$this->load->model('Produtos_model');
	}

	public function index(){
		$this->_data['view'] 	= 'index';
		$this->_data['titulo']	= 'Produtos';
		$this->_data['icon'] 	= 'th-large';

		$this->_data['produtos'] = $this->Produtos_model->get_produtos();
		
		$this->load->view($this->_tpl,$this->_data);
	}

	public function novo(){
		$this->form_validation->set_rules('nome', 'Nome', 'required|xss_clean|trim');
		$this->form_validation->set_rules('descricao', 'Descrição', 'required|xss_clean|trim');
		$this->form_validation->set_rules('categoria', 'Categoria', 'required|xss_clean|trim');

		if ( $this->form_validation->run() ){
			$insert = array(
				'nome' 					=> $_POST['nome'],
				'descricao' 			=> $_POST['descricao'],
				'categoria_produto_id' 	=> $_POST['categoria']
				);

			if ( $this->Produtos_model->incluir( $insert ) ){
				$this->alert_library->set_alert('Cadastrado com sucesso!','success');
			}
			else{
				$this->alert_library->set_alert('Erro ao efetuar cadastro!','error');
			}
			redirect( base_url() . 'produtos' );

		}else{
			$this->_data['view']	= 'form';
			$this->_data['titulo']	= 'Novo Produto';
			$this->_data['icon'] 	= 'th-large';

			$categorias				= $this->Produtos_model->get_categorias();

			$this->_data['categorias'][0] = 'Selecione';
			foreach ($categorias as $categoria) $this->_data['categorias'][$categoria->id] = $categoria->nome;

			$this->_data['set_categoria'] = 0;
			$this->_data['nome'] 		= array('name'=>'nome','type'=>'text','class'=>'form-control', 'value' => set_value('nome'));
			$this->_data['descricao'] 	= array('name'=>'descricao', 'class'=>'form-control', 'value' => set_value('descricao'));
			$this->_data['salvar'] 		= array('name'=>'salvar','type'=>'submit','value'=>'Cadastrar','class'=>'btn btn-success');

			$this->load->view($this->_tpl, $this->_data);
		}

	}

	public function editar( $id ){
		$this->form_validation->set_rules('nome', 'Nome', 'required|xss_clean|trim');
		$this->form_validation->set_rules('descricao', 'Descrição', 'required|xss_clean|trim');
		$this->form_validation->set_rules('categoria', 'Categoria', 'required|xss_clean|trim');

		if ( $this->form_validation->run() ){
			$insert = array(
				'nome' 					=> $_POST['nome'],
				'descricao' 			=> $_POST['descricao'],
				'categoria_produto_id' 	=> $_POST['categoria']
				);

			if ( $this->Produtos_model->editar( $id, $insert ) ){
				$this->alert_library->set_alert('Atualizado com sucesso!','success');
			}
			else{
				$this->alert_library->set_alert('Erro ao efetuar atualização!','error');
			}
			redirect( base_url() . 'produtos' );

		}else{
			$this->_data['view']	= 'form';
			$this->_data['titulo']	= 'Editar Produto';
			$this->_data['icon'] 	= 'th-large';

			$produto				= $this->Produtos_model->row_produto( $id );
			$categorias				= $this->Produtos_model->get_categorias();

			$this->_data['categorias'][0] = 'Selecione';
			foreach ($categorias as $categoria) $this->_data['categorias'][$categoria->id] = $categoria->nome;

			$this->_data['set_categoria'] = $produto->categoria_produto_id;

			$this->_data['nome'] 		= array('name'=>'nome','type'=>'text','class'=>'form-control', 'value' => set_value('nome',$produto->nome));
			$this->_data['descricao'] 	= array('name'=>'descricao', 'class'=>'form-control', 'value' => set_value('descricao',$produto->nome));
			$this->_data['salvar'] 		= array('name'=>'salvar','type'=>'submit','value'=>'Cadastrar','class'=>'btn btn-success');

			$this->load->view($this->_tpl, $this->_data);
		}

	}

}

/* End of file produtos.php */
/* Location: ./application/modules/produtos/controllers/produtos.php */