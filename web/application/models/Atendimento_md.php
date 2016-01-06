<?php

class Atendimento_md extends CI_Model {
	public $id;
	public $orgao_id;
	public $chamado_id;
	public $status;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function criar($chamado_id, $orgao_id) {
		$this->load->database();
		$this->db->insert("atendimento", array("orgao_id"=>$orgao_id, "chamado_id"=>$chamado_id));
	}
	
	public function setar($id) {
		$this->load->database();
		$this->db->where("id", $id);
		$q = $this->db->get("atendimento");
		foreach($q->result() as $row) {
			$this->id = $row->id;
			$this->orgao_id = $row->orgao_id;
			$this->chamado_id = $row->chamado_id;
			$this->status = $row->status;
			
			return $this;
		}
		return false;
	}
	
	public function getInArray($chamado_id) {
		$this->load->database();
		$this->db->where("chamado_id", $chamado_id);
		$q = $this->db->get("atendimento");
		$atendimentos = [];
		foreach($q->result() as $row) {
			$atendimentos[] = array("id"=>$row->id, "orgao_id"=>$row->orgao_id, "chamado_id"=>$row->chamado_id, "status"=>$row->status);
		}
		if(count($atendimentos)==0) {
			return $atendimentos = [];
		} else {
			return $atendimentos;
		}
	}
		
}
?>
