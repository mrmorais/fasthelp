<?php

class Mensagem_md extends CI_Model {
	public $id;
	public $chamado_id;
	public $usuario_id;
	public $orgao_id;
	
	
	public function __construct() {
		parent::__construct();
	}
	
	public function loadMsgByChamado($id) {
		$this->load->database();
		$query = $this->db->query("select mensagem.*, u.nome, u.sobrenome, o.nome as orgao_nome from user as u, mensagem, orgao as o where mensagem.user_id = u.id and mensagem.orgao_id = o.id and mensagem.chamado_id = ?;", array($id));
		$msg = [];
		foreach ($query->result() as $row) {
			$msg[] = array("id"=>$row->id,
								"chamado_id"=>$row->chamado_id,
								"user_id"=>$row->user_id,
								"user_nome"=>$row->nome,
								"user_sobrenome"=>$row->sobrenome,
								"orgao_id"=>$row->orgao_id,
								"orgao_nome"=>$row->orgao_nome,
								"autor"=>$row->autor,
								"type"=>$row->type,
								"texto"=>$row->texto);
		}
		return $msg;
	}
	
	public function enviar($chamado_id, $user_id, $orgao_id, $autor, $type, $msg) {
		$this->load->database();
		$this->db->insert("mensagem", array("chamado_id"=>$chamado_id,
											"user_id"=>$user_id,
											"orgao_id"=>$orgao_id,
											"autor"=>$autor,
											"type"=>$type,
											"texto"=>$msg));
	}
}
?>
