<?php

class Funcao_md extends CI_Model {
	public $id;
	public $codigo;
	public $descricao;
	public $icone;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function criar($codigo, $descricao, $icone) {
		$this->load->database();
		
		$dados = array("codigo"=>$codigo, "descricao"=>$descricao, "img"=>$icone);
		$this->db->insert("funcao", $dados);
	}
	
	public function getAll() {
		$this->load->database();
		
		$query = $this->db->get("funcao");
		$funcoes = [];
		foreach($query->result() as $row) {
			$funcoes[] = array("id"=>$row->id, "codigo"=>$row->codigo, "descricao"=>$row->descricao, "icone"=>$row->img);
		}
		
		return $funcoes;
	}
	
	public function getByOrgao($id) {
		$this->load->database();
		
		$query = $this->db->get("funcao");
		$funcoes = [];
		foreach($query->result() as $row) {
			$funcoes[] = array("id"=>$row->id, "codigo"=>$row->codigo, "descricao"=>$row->descricao, "icone"=>$row->img, "checked"=>$this->isInOrgao($row->id, $id));
		}
		
		return $funcoes;
	}
	
	public function existe($id) {
		$all = $this->getAll();
		foreach ($all as $one) {
			if ($id == $one['id']) {
				return true;
			}
		}
		return false;
	}
	
	public function isInOrgao($id, $orgao_id) {
		$this->load->database();
		$query = $this->db->query("SELECT * FROM funcao WHERE id in (SELECT funcao_id FROM orgao_has_funcao WHERE orgao_id = ?) and id = ?", array($orgao_id, $id));
		if ($query->num_rows() > 0) {
			return "checked";
		} else {
			return "";
		}
	}
	
	public function delete($id) {
		$this->load->database();
		$query = $this->db->query("DELETE FROM funcao WHERE id = ?", array($id));
	}
	
}
?>
