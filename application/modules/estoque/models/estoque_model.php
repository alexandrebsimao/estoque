<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @autor BERNS SIMÃO, Alexandre Augusto <alexandre.b.simao@gmail.com>
 * @arquivo Estoque_model
 * @modulo Estoque
 * @descrição Estoque_model é responsavel por toda operação com o banco de dados 
*/

class Estoque_model extends CI_Model {

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

	public function get_estoque(){
		return $this->db->select('e.*, p.nome')
						->join('produto p', 'p.id = e.produto_id')
						->get('estoque e')
						->result();
	}
	
	public function row_produto( $id ){
		return $this->db->where( 'id', $id )
						->get($this->_table)
						->row();
	}

	public function incluir_movimentacao( $insert ){
		$this->db->insert( 'movimentacao', $insert );
		return $this->db->affected_rows();
	}

	public function entrada_estoque( $produto, $quantidade ){
		if( $this->db->where( 'produto_id', $produto )->get( 'estoque' )->num_rows() )
			$this->db->query(" UPDATE estoque SET quantidade = (quantidade + {$quantidade})  WHERE produto_id = {$produto} ");
		else
			$this->db->query(" INSERT INTO estoque (quantidade, produto_id) VALUES ({$quantidade}, {$produto}) ");

		return $this->db->affected_rows();
	}	

	public function saida_estoque( $produto, $quantidade ){
		$this->db->query(" UPDATE estoque SET quantidade = (quantidade - {$quantidade})  WHERE produto_id = {$produto} ");

		return $this->db->affected_rows();
	}

	public function movimentacao(){
		return $this->db->join( 'produto p', 'p.id = m.produto_id' )
						->order_by('data_hora_movimentacao','DESC')
						->get( 'movimentacao m' )->result();
	}

	public function editar( $id, $update ){
		$this->db->where( 'id', $id )
				 ->update( $this->_table, $update );
		return $this->db->affected_rows();
	}

}