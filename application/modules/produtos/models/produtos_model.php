<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @autor BERNS SIMÃO, Alexandre Augusto <alexandre.b.simao@gmail.com>
 * @arquivo produtos_model
 * @modulo Produtos
 * @descrição produtos_model é responsavel por toda operação com o banco de dados 
*/

class Produtos_model extends CI_Model {

	private $_table = 'produto';

	function __construct(){
		parent::__construct();

		$this->load->database();
	}

	public function get_produtos(){
		return $this->db->select( 'p.*, cp.nome as categoria' )
						->join( 'categoria_produto cp', 'cp.id = p.categoria_produto_id' )
						->get($this->_table . ' p')
						->result();
	}

	public function get_categorias(){
		return $this->db->get('categoria_produto')
						->result();
	}
	
	public function row_produto( $id ){
		return $this->db->where( 'id', $id )
						->get($this->_table)
						->row();
	}

	public function incluir( $insert ){
		$this->db->insert( $this->_table, $insert );
		return $this->db->affected_rows();
	}

	public function editar( $id, $update ){
		$this->db->where( 'id', $id )
				 ->update( $this->_table, $update );
		return $this->db->affected_rows();
	}

}