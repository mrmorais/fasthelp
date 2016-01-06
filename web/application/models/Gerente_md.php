<?php

class Gerente_md extends CI_Model {
	public $id;
	public $orgao_id;
	public $nome;
	public $sobrenome;
	//public $tipo;
	public $email;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getGerente() {
		return array("id"=>$this->id, "orgao_id"=>$this->orgao_id, "nome"=>$this->nome, "sobrenome"=>$this->sobrenome, "email"=>$this->email, "conta_tipo"=>"main", "blocked"=>"no");
	}
	
	public function bloquear() {
		
	}
	
	public function setar($id) {
		$found = false;
		foreach ($this->getAll() as $gerente) {
			if ($gerente['id']==$id) {
				$this->id = $gerente['id'];
				$this->orgao_id = $gerente['orgao_id'];
				$this->nome = $gerente['nome'];
				$this->sobrenome = $gerente['sobrenome'];
				$this->email = $gerente['email'];
				
				$found = true;
				break;
			}
		}
		return $found;
	}
	
	//[block] Funções que funcionam somente após o Set
	
	public function getInArray() {
		return array("id"=>$this->id, "orgao_id"=>$this->orgao_id, "nome"=>$this->nome, "sobrenome"=>$this->sobrenome, "email"=>$this->email);
	}
	
	public function update($nome, $sobrenome, $email) {
		$this->load->database();
		$sql = "UPDATE gerente SET `nome` = ?, `sobrenome`= ?, `email`= ? WHERE `id`= ? and `orgao_id`= ?";
		if($this->db->query($sql, array($nome, $sobrenome, $email, $this->id, $this->orgao_id))) {
			return true;
		}
	}
	
	public function atualizaSenha($nova) {
		$this->load->database();
		$sql = "UPDATE gerente SET `senha` = ? WHERE `id`= ? and `orgao_id`= ?";
		if($this->db->query($sql, array($nova, $this->id, $this->orgao_id))) {
			return true;
		}
	}
	
	//[/block]
	
	public function getAllInArray($id=0) {
		$this->load->database();
		$sql = "SELECT * FROM gerente WHERE `orgao_id`= ?";
		$res = $this->db->query($sql, array($id));
		$gerentes = array();
		foreach($res->result() as $gerente) {
			$gerentes[] = array("id"=>$gerente->id, 
							  "orgao_id"=>$gerente->orgao_id, 
							  "nome"=>$gerente->nome, 
							  "sobrenome"=>$gerente->sobrenome, 
							  "email"=>$gerente->email);
		}
		return $gerentes;
	}
	
	public function delete($id, $orgao_id) {
		$this->load->database();
		$sql = "DELETE FROM gerente WHERE `id`=? and`orgao_id`=?";
		$query = $this->db->query($sql, array($id, $orgao_id));
		
		return $query;
	}
	
	public function getAll() {
		$this->load->database();
		$sql = "SELECT * FROM gerente";
		$res = $this->db->query($sql);
		$gerentes = array();
		foreach($res->result() as $row) {
			$gerentes[] = array("id"=>$row->id, 
							  "orgao_id"=>$row->orgao_id, 
							  "nome"=>$row->nome, 
							  "sobrenome"=>$row->sobrenome, 
							  "email"=>$row->email);
		}
		
		return $gerentes;
	}
	
	public function checkEmail($email) {
		$base = $this->getAll();
		foreach($base as $gerente) {
			if ($gerente['email']==$email) {
				return false;
			}
		}
		return true;
	}
	
	public function autenticar($email, $senha) {
		$this->load->database();
		$sql = "SELECT * FROM gerente WHERE email = ? AND senha = ? LIMIT 1";
		$query = $this->db->query($sql, array($email, $senha));
		if ($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$this->id = $row->id;
				$this->orgao_id = $row->orgao_id;
				$this->nome = $row->nome;
				$this->sobrenome = $row->sobrenome;
				$this->email = $row->email;
			}
			return true;
		} else {
			return false;
		}
	}
	
	public function criar($orgao_id, $nome, $sobrenome, $email) {
		$this->load->database();
		$sql = "INSERT INTO gerente(orgao_id, nome, sobrenome, email, senha) VALUES(?, ?, ?, ?, ?)";
		$senha = $this->generatePass();
		$this->db->query($sql, array($orgao_id, $nome, $sobrenome, $email, $senha));
		
		return $senha;
	}
	
	public function recuperar($id) {
		$this->load->model('mail_md');
		$this->setar($id);
		
		$novaSenha = $this->generatePass();
		
		$this->load->database();
		$query = $this->db->query("UPDATE gerente SET senha = ? WHERE id = ?", array($novaSenha, $id));
		
		$this->mail_md->sendDefaultMail("senha_redefinida", $this->email, array("nome"=>$this->nome, 
																				"sobrenome"=>$this->sobrenome,
																				"senha"=>$novaSenha));
		
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	private function generatePass() {
		$str = "ABCDEFGHIJKLMNOPQrSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; //62
		$tam = 5;
		$pass = "";
		for ($i=0; $i<$tam; $i++) {
			$pos = rand(0, 61);
			$pass = $pass.$str[$pos];
		}
		return $pass;
	}
}
?>
