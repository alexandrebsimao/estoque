<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @autor BERNS SIMÃO, Alexandre Augusto <alexandre.b.simao@gmail.com>
 * @arquivo categorias_model
 * @modulo Categorias
 * @descrição categorias_model é responsavel por toda operação com o banco de dados 
*/

class Categorias_model extends CI_Model {

	private $_table = 'categoria_produto';

	function __construct(){
		parent::__construct();

		$this->load->database();
	}

	public function get_categorias(){
		return $this->db->get($this->_table)
						->result();
	}
	
	public function row_categoria( $id ){
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