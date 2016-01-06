<?php

class Search_md extends CI_Model {
	public $query;
	public $result;
	
	public function __construct() {
		parent::__construct();
		
		$this->result = array();
	}
	
	public function doSearch($query) {
		$this->query = $query;
		$terms = $this->defineTerms($query);
		$where = 'cidade like ';
		if (count($terms)==1) {
			$where.= '"%'.trim($terms[0]).'%"';
		} else {
			$where.= '"%'.trim($terms[0]).'%" and estado like "%'.trim($terms[1]).'%"';
		}
		$sql = "select * from orgao where ".$where." order by cidade";
		$this->load->database();
		$results = $this->db->query($sql);
		if ($results->num_rows() == 0) {
			return false;
		} else {
			foreach($results->result() as $row) {
				$this->result[] = array("id"=>$row->id, "cidade"=>$row->cidade, "estado"=>$row->estado, "nome"=>$row->nome, "endereco"=>$row->endereco, "telefone"=>$row->telefone, "nick"=>$this->getNickById($row->id));
			}
		}
	}
	
	private function defineTerms($q) {
		// separa cidade de estado por ',' ou '-'
		$q = explode(',', $q);
		if(count($q)==1) {
			$q = explode('-', $q[0]);
		}
		
		return $q;
	}
	
	private function getNickById($id) {
		$this->load->database();
		$result = $this->db->query("SELECT `nick` FROM profile WHERE orgao_id = ? LIMIT 1", array($id));
		if ($result->num_rows() == 0) {
			return null;
		} else {
			foreach($result->result() as $row) {
				return $row->nick;
			}
		}
	}
	
}
?>
