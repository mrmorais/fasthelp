<?php

class Profile_md extends CI_Model {
	public $id;
	public $orgao_id;
	public $nick;
	public $descricao;
	public $img;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function criar($orgao_id, $nick) {
		$this->load->database();
		$dados = array("orgao_id"=>$orgao_id, "nick"=>$nick);
		if (!$this->existeNick($nick)) {
			if($this->db->insert('profile', $dados)) {
				$this->setar($orgao_id);
				return $this->getInArray();
			}
		}
		return false;
	}
	
	public function setDescricao($descricao, $orgao_id) {
		$this->load->database();
		$query = $this->db->query("UPDATE profile SET descricao = ? WHERE orgao_id = ?", array($descricao, $orgao_id));
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function existeNick($nick) {
		$this->load->database();
		$query = $this->db->query("SELECT * FROM profile WHERE nick = ?", array($nick));
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	
	public function setar($orgao_id) {
		$this->load->database();
		$sql = "SELECT * FROM profile WHERE orgao_id = ? LIMIT 1";
		$query = $this->db->query($sql, array($orgao_id));
		foreach($query->result() as $row) {
			$this->id = $row->id;
			$this->orgao_id = $row->orgao_id;
			$this->nick = $row->nick;
			$this->descricao = $row->descricao;
		}
	}
	
	public function setByNick($nick) {
		$this->load->database();
		$sql = "SELECT * FROM profile WHERE nick = ? LIMIT 1";
		$query = $this->db->query($sql, array($nick));
		foreach($query->result() as $row) {
			$this->id = $row->id;
			$this->orgao_id = $row->orgao_id;
			$this->nick = $row->nick;
			$this->descricao = $row->descricao;
			$this->img = $row->img;
			return $this;
		}
	}
	
	//[block] Funções que funcionam somente após o Set
	
	public function getInArray() {
		return array("id"=>$this->id, "orgao_id"=>$this->orgao_id, "nick"=>$this->nick, "descricao"=>$this->descricao);
	}
	
	//[/block]
	
	public function numOrgaos() {
		return count($this->getAll());
	}
	
	public function getAll() {
		$this->load->database();
		$sql = 'SELECT * FROM profile';
		$res = $this->db->query($sql);
		$profiles = array();
		foreach($res->result() as $row) {
			$orgaos[] = array("id"=>$row->id, "nome"=>$row->nome,
									"razao"=>$row->razao, "tipo"=>$row->tipo, "telefone"=>$row->telefone,
									"cidade"=>$row->cidade, "estado"=>$row->estado, 
									"endereco"=>$row->endereco);
		}
		
		return $orgaos;
	}
	public function cidadesList() {
		$this->load->database();
		$sql = 'SELECT * FROM orgao GROUP BY cidade;';
		$res = $this->db->query($sql);
		$cidades = array();
		foreach($res->result() as $row) {
			$cidades[] = array("value"=>$row->cidade, "cidade"=>$row->cidade." - ".$row->estado);
		}
		return $cidades;
	}
	
	public function setarAvatar($img, $orgao_id) {
		$this->load->database();
		$query = $this->db->query("UPDATE profile SET img = ? WHERE orgao_id = ?", array($img, $orgao_id));
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function gerarNomeAvatar() {
		return md5(time());
	}
}
?>
