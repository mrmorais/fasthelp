<?php
class Precadastro_md extends CI_Model {
	public $id;
	public $orgao_nome;
	public $orgao_razao;
	public $tipo;
	public $resp_nome;
	public $telefone;
	public $email;
	public $estado;
	public $cidade;
	public $endereco;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function setarFormulario($orgao_nome, $orgao_razao, $tipo, $resp_nome, $telefone, $email, $cidade, $estado, $endereco) {
		$this->orgao_nome = $orgao_nome;
		$this->orgao_razao = $orgao_razao;
		$this->tipo = $tipo;
		$this->resp_nome = $resp_nome;
		$this->telefone = $telefone;
		$this->email = $email;
		$this->estado = $estado;
		$this->cidade = $cidade;
		$this->endereco = $endereco;
	}
	
	public function insert() {
		$this->load->database();
		$sql = "INSERT INTO precadastro(orgao_nome, orgao_razao, tipo, resp_nome, telefone, email, cidade, estado, endereco) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$data = array($this->orgao_nome, $this->orgao_razao, $this->tipo, $this->resp_nome, $this->telefone, $this->email, $this->cidade, $this->estado, $this->endereco);
		if($this->db->query($sql, $data)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function numPrecadastros() {
		return count($this->getAll());
	}
	
	public function getAll() {
		$this->load->database();
		$sql = "SELECT * FROM precadastro";
		$res = $this->db->query($sql);
		$precadastros = array();
		foreach($res->result() as $row) {
			$precadastros[] = array("id"=>$row->id, "orgao_nome"=>$row->orgao_nome,
									"orgao_razao"=>$row->orgao_razao, "tipo"=>$row->tipo, 
									"resp_nome"=> $row->resp_nome, "telefone"=>$row->telefone,
									"email"=>$row->email, "cidade"=>$row->cidade, "estado"=>$row->estado, 
									"endereco"=>$row->endereco, "status"=>$row->status);
		}
		
		return $precadastros;
	}
	
	public function get($id) {
		$this->id = $id;
		$this->load->database();
		$sql = "SELECT * FROM precadastro WHERE id=?";
		$res = $this->db->query($sql, array($this->id));
		$precadastros = array();
		foreach($res->result() as $row) {
			$precadastros[] = array("id"=>$row->id, "orgao_nome"=>$row->orgao_nome,
									"orgao_razao"=>$row->orgao_razao, "tipo"=>$row->tipo, 
									"resp_nome"=> $row->resp_nome, "telefone"=>$row->telefone,
									"email"=>$row->email, "cidade"=>$row->cidade, "estado"=>$row->estado, 
									"endereco"=>$row->endereco, "status"=>$row->status);
		}
		return $precadastros;
	}
	
	public function delete() {
		$this->load->database();
		$sql = "DELETE FROM precadastro WHERE id=?";
		$this->db->query($sql, array($this->id));
	}
	
	public function recusar() {
		$precadastro = $this->get($this->id);
		
		$this->load->model('mail_md', 'mailer');
		$this->mailer->sendDefaultMail("conta_recusada", $precadastro[0]['email']);
		
		$this->delete();
	}
	
	public function criar() {
		$this->load->model('orgao_md', 'orgao');
		$this->load->model('gerente_md', 'gerente');
		$this->load->model('mail_md', 'mailer');
		
		$precadastro = $this->get($this->id);
		$orgao_id = $this->orgao->criar($precadastro[0]['orgao_nome'], $precadastro[0]['orgao_razao'], $precadastro[0]['tipo'], $precadastro[0]['telefone'], $precadastro[0]['estado'], $precadastro[0]['cidade'], $precadastro[0]['endereco']);
		
		$nomeSobre = explode(" ", $precadastro[0]['resp_nome']);
		$nome = $nomeSobre[0];
		$sobrenome = $nomeSobre[count($nomeSobre)-1];
		
		$senha = $this->gerente->criar($orgao_id, $nome, $sobrenome, $precadastro[0]['email']);
		
		$this->delete();
		
		$this->mailer->sendDefaultMail("conta_criada", $precadastro[0]['email'], array("nome"=>$precadastro[0]['resp_nome'], "email"=>$precadastro[0]['email'], "senha"=>$senha));
	}
	
	public function setStatus($status) {
		$this->load->database();
		$sql = "UPDATE precadastro SET status=? WHERE id = ?";
		$this->db->query($sql, array($status, $this->id));
	}
}
?>
