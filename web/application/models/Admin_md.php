<?php
class Admin_md extends CI_Model {
	public $id;
	public $nome;
	public $sobrenome;
	public $email;
	public $tipo; //Master Slave
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getAdmin() {
		return array("id"=>$this->id, "nome"=>$this->nome, "sobrenome"=>$this->sobrenome, "email"=>$this->email, "tipo"=>$this->tipo, "conta_tipo"=>"renub");
	}
	
	public function setar($id) {
		if($usr = $this->get($id)) {
			$this->id = $usr['id'];
			$this->nome = $usr['nome'];
			$this->sobrenome = $usr['sobrenome'];
			$this->email = $usr['email'];
			$this->tipo = $usr['tipo'];
			
			return true;
		}
		return false;
	}
	
	public function autenticar($email, $senha) {
		$this->load->database();
		$sql = "SELECT * FROM admin WHERE email = ? AND senha = ? LIMIT 1";
		$query = $this->db->query($sql, array($email, $senha));
		if ($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$this->id = $row->id;
				$this->nome = $row->nome;
				$this->sobrenome = $row->sobrenome;
				$this->email = $row->email;
				$this->tipo = $row->tipo;
			}
			return true;
		} else {
			return false;
		}
	}
	
	public function getAll() {
		$this->load->database();
		$sql = "SELECT * FROM admin";
		$res = $this->db->query($sql);
		$admins = array();
		foreach($res->result() as $row) {
			$admins[] = array("id"=>$row->id, 
							  "nome"=>$row->nome, 
							  "sobrenome"=>$row->sobrenome, 
							  "email"=>$row->email,
							  "tipo"=>$row->tipo);
		}
		
		return $admins;
	}
	
	public function recuperar($id) {
		$this->load->model('mail_md');
		
		$this->setar($id);
		
		$novaSenha = $this->generatePass();
		
		$this->load->database();
		$query = $this->db->query("UPDATE admin SET senha = ? WHERE id = ?", array($novaSenha, $id));
		
		$this->mail_md->sendDefaultMail("senha_redefinida", $this->email, array("nome"=>$this->nome, 
																				"sobrenome"=>$this->sobrenome,
																				"senha"=>$novaSenha));
		
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function get($id) {
		$base = $this->getAll();
		foreach($base as $admin) {
			if($admin['id']==$id) {
				return $admin;
			}
		}
		return false;
	}
	
	public function delete($id) {
		$this->load->database();
		$sql = "DELETE FROM admin WHERE id=?";
		$this->db->query($sql, array($id));
	}
	
	public function insert($nome, $sobrenome, $email, $senha, $tipo) {
		$this->load->database();
		$sql = "INSERT INTO admin(nome, sobrenome, email, senha, tipo) VALUES(?, ?, ?, ?, ?)";
		if ($this->db->query($sql, array($nome, $sobrenome, $email, $senha, $tipo))) {
			return true;
		} else {
			return false;
		}
	}
	
	public function checkEmail($email) {
		$base = $this->getAll();
		foreach($base as $admin) {
			if ($admin['email']==$email) {
				return false;
			}
		}
		return true;
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
