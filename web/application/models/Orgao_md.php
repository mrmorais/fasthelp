<?php

class Orgao_md extends CI_Model {
	public $id;
	public $nome;
	public $razao;
	public $tipo;
	public $telefone;
	public $estado;
	public $cidade;
	public $endereco;
	public $funcoes;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function criar($nome, $razao, $tipo, $telefone, $estado, $cidade, $endereco) {
		$this->load->database();
		$sql = "INSERT INTO orgao(nome, razao, cidade, estado, endereco, tipo, telefone) VALUES(?, ?, ?, ?, ?, ?, ?)";
		$query = $this->db->query($sql, array($nome, $razao, $cidade, $estado, $endereco, $tipo, $telefone));
		return $this->db->insert_id();
	}
	
	public function setar($id) {
		$found = false;
		foreach ($this->getAll() as $orgao) {
			if ($orgao['id']==$id) {
				$this->id = $orgao['id'];
				$this->nome = $orgao['nome'];
				$this->razao = $orgao['razao'];
				$this->tipo = $orgao['tipo'];
				$this->telefone = $orgao['telefone'];
				$this->cidade = $orgao['cidade'];
				$this->estado = $orgao['estado'];
				$this->endereco = $orgao['endereco'];
				$this->setFuncoes($id);
				$found = true;
				break;
			}
		}
		return $found;
	}
	
	private function setFuncoes($id) {
		$this->load->database();
		$query = $this->db->query("SELECT * FROM funcao WHERE id in (SELECT funcao_id FROM orgao_has_funcao WHERE orgao_id = ?)", array($id));
		$funcoes = [];
		foreach ($query->result() as $funcao) {
			$funcoes[] = array("id"=>$funcao->id, "codigo"=>$funcao->codigo, "descricao"=>$funcao->descricao);
		}
		$this->funcoes = $funcoes;
	}
	
	//[block] Funções que funcionam somente após o Set
	
	public function getInArray() {
		return array("id"=>$this->id, "nome"=>$this->nome, "razao"=>$this->razao, "tipo"=>$this->tipo, 
					 "telefone"=>$this->telefone, "cidade"=>$this->cidade, "estado"=>$this->estado,
					 "endereco"=>$this->endereco, "funcoes"=>$this->funcoes);
	}
	
	public function delete() {
		//Exterminar os gerentes
		$this->load->model('gerente_md', 'gerente');
		$todosGerentes = $this->gerente->getAllInArray($this->id);
		foreach($todosGerentes as $gerente) {
			$this->gerente->delete($gerente['id'], $this->id);
		}
		
		//suicidar o órgão
		$this->load->database();
		$sql = "DELETE FROM orgao WHERE `id`=?";
		$query = $this->db->query($sql, array($this->id));
		
		return $query;	
	}
	
	public function getOrgaoHasFuncao() {
		$this->load->database();
		$this->db->where("orgao_id", $this->id);
		$query = $this->db->get("orgao_has_funcao");
		$orgao_has_funcao = [];
		foreach($query->result() as $row) {
			$orgao_has_funcao[] = array("id"=>$row->id, "funcao_id"=>$row->funcao_id);
		}
		return $orgao_has_funcao;
	}
	
	public function limparOrgaoHasFuncao() {
		$this->load->database();
		foreach ($this->getOrgaoHasFuncao() as $relacao) {
			$this->db->delete("orgao_has_funcao", array("id"=>$relacao['id']));
		}
	}
	
	public function setarFuncoes($funcoes) {
		$this->limparOrgaoHasFuncao();
		$this->load->database();
		foreach ($funcoes as $funcao) {
			$this->db->query('INSERT INTO orgao_has_funcao VALUES(null, ?, (SELECT id FROM funcao WHERE codigo=? LIMIT 1));', array($this->id, $funcao));
		}
	}
	
	//[/block]
	
	public function numOrgaos() {
		return count($this->getAll());
	}
	
	public function getAll($cidade = "all") {
		$this->load->database();
		$sql = 'SELECT * FROM orgao';
		if ($cidade != "all") {
			$sql .= ' where cidade="'.$cidade.'"';
		}
		$res = $this->db->query($sql);
		$orgaos = array();
		foreach($res->result() as $row) {
			$orgaos[] = array("id"=>$row->id, "nome"=>$row->nome,
									"razao"=>$row->razao, "tipo"=>$row->tipo, "telefone"=>$row->telefone,
									"cidade"=>$row->cidade, "estado"=>$row->estado, 
									"endereco"=>$row->endereco);
		}
		
		return $orgaos;
	}
	
	public function getAllIn($cidade, $estado) {
		$all = $this->getAll($cidade);
		$filtered = [];
		foreach($all as $one) {
			if ($one['estado']==$estado) {
				$filtered[] = $one;
			}
		}
		return $filtered;
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
}
?>
