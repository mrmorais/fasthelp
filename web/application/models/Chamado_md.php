<?php

class Chamado_md extends CI_Model {
	public $id;
	public $user_id;
	public $codigo;
	public $titulo;
	public $image;
	public $status;
	public $lat;
	public $lng;
	public $cidade;
	public $estado;
	public $endereco;
	public $atendimentos;
	public $data;
	public $hora;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function setar($id) {
		$this->load->database();
		$this->db->where("id", $id);
		$q = $this->db->get("chamado");
		foreach($q->result() as $row) {
			$this->id = $row->id;
			$this->user_id = $row->user_id;
			$this->codigo = $row->codigo;
			$this->titulo = $this->codigoToTitle($row->codigo);
			$this->image = $this->codigoToImage($row->codigo);
			$this->status = $row->status;
			$this->lat = $row->lat;
			$this->lng = $row->lng;
			$this->cidade = $row->cidade;
			$this->estado = $row->estado;
			$this->endereco = $row->endereco;
			$this->data = $this->formatData($row->create_time, "data");
			$this->hora = $this->formatData($row->create_time, "hora");
			$this->setAtendimentos();
			
			return $this;
		}
		return false;
	}
	
	public function criar($user_id, $codigo, $lat, $lng, $cidade, $estado, $endereco) {
		$this->load->database();
		$this->load->model('tweet_md', 'tweet');
		$this->db->insert("chamado", array("user_id"=>$user_id, 
										   "codigo"=>$codigo,
										   "lat"=>$lat,
										   "lng"=>$lng,
										   "cidade"=>$cidade,
										   "estado"=>$estado,
										   "endereco"=>$endereco));
		$this->tweet->send($this->codigoToTitle($codigo), $cidade, $estado, $endereco);
	}
	
	//[block] Seted
	public function hasOrgaoAtendimento($orgao_id) {
		foreach($this->atendimentos as $a) {
			if ($a['orgao_id']==$orgao_id) {
				return true;
			}
		}
		return false;
	}
	public function setAtendimentos() {
		$this->load->model("atendimento_md");
		$this->atendimentos = $this->atendimento_md->getInArray($this->id);
	}
	public function atender($orgao_id) {
		$this->load->model("atendimento_md");
		$this->atendimento_md->criar($this->id, $orgao_id);
		$this->updateStatus(3);
	}
	
	private function updateStatus($status) {
		$this->load->database();
		$this->db->query("UPDATE chamado SET status=? WHERE id = ?", array($status, $this->id));
	}
	public function encerrar() {
		$this->load->database();
		foreach ($this->atendimentos as $a) {
			$this->db->query("UPDATE atendimento SET status=2 WHERE id = ?", array($a['id']));
		}
		$this->updateStatus(4);
	}
	public function recusar() {
		$this->load->database();
		$this->updateStatus(5);
	}
	
	public function getInArray() {
		return array("id"=>$this->id, 
					 "codigo"=>$this->codigo, 
					 "titulo"=>$this->titulo,
					 "status"=>$this->status,
					 "cidade"=>$this->cidade,
					 "estado"=>$this->estado,
					 "endereco"=>$this->endereco);
	}
	//./[block] Seted
	
	public function getChamados($cidade, $estado, $status, $funcoes) {
		$this->load->database();
		if (count($funcoes)>0) {
			$in = "";
			for ($n=0; $n<count($funcoes); $n++) {
				if ($n == count($funcoes)-1) {
					$in.="'".$funcoes[$n]['codigo']."'";
				} else {
					$in.="'".$funcoes[$n]['codigo']."', ";
				}
			}
			$q = $this->db->query("SELECT * FROM chamado WHERE codigo in (".$in.") and cidade = ? and estado = ? and status = ?", array($cidade, $estado, $status));
			$chamados = [];
			foreach($q->result() as $row) {
				$chamados[] = array("id"=>$row->id,
									"user_id"=>$row->user_id, 
									"codigo"=>$row->codigo,
									"titulo"=>$this->codigoToTitle($row->codigo), 
									"image"=>$this->codigoToImage($row->codigo), 
									"status"=>$row->status, 
									"lat"=>$row->lat,
									"lng"=>$row->lng,
									"cidade"=>$row->cidade,
									"estado"=>$row->estado,
									"endereco"=>$row->endereco);
			}
			return $chamados;
		} else {
			return false;
		}
	}
	
	public function setViewed($chamados) {
		$this->load->database();
		foreach ($chamados as $chamado) {
			$this->db->query("UPDATE chamado SET status = 2 WHERE id = ?", array($chamado['id']));
		}
	}
	
	public function getChamadosByUser($user_id) {
		$this->load->database();
		$sql = "select * from chamado where user_id=? and (`status`=1 or `status`=2 or `status`=3)";
		$r = $this->db->query($sql, array($user_id));
		$chamados = [];
		if ($r->num_rows() > 0) {
			foreach($r->result() as $row) {
				$chamados[] = array("id"=>$row->id,
										"user_id"=>$row->user_id, 
										"codigo"=>$row->codigo,
										"titulo"=>$this->codigoToTitle($row->codigo), 
										"image"=>$this->codigoToImage($row->codigo), 
										"status"=>$row->status, 
										"lat"=>$row->lat,
										"lng"=>$row->lng,
										"cidade"=>$row->cidade,
										"estado"=>$row->estado,
										"endereco"=>$row->endereco);
			}
			return $chamados;
		} else {
			return false;
		}
	}
	
	public function codigoToTitle($codigo) {
		switch($codigo) {
			case "atl":
				return "Acidente de Trânsito (com lesões)";
				break;
			case "ats":
				return "Acidente de Trânsito (sem lesões)";
				break;
			case "ama":
				return "Assalto a Mão Armada";
				break;
			case "agr":
				return "Agressão";
				break;
			case "asa":
				return "Ataque de Saúde";
				break;
			case "inc":
				return "Incêndio";
				break;
			case "atp":
				return "Acidente Pessoal";
				break;
			case "mul":
				return "Violência Contra a Mulher";
				break;
		}
	}
	
	public function codigoToImage($codigo) {
		switch($codigo) {
			case "atl":
				return "public/img/fuc-1.png";
				break;
			case "ats":
				return "public/img/fuc-2.png";
				break;
			case "ama":
				return "public/img/fuc-3.png";
				break;
			case "agr":
				return "public/img/fuc-4.png";
				break;
			case "asa":
				return "public/img/fuc-5.png";
				break;
			case "inc":
				return "public/img/fuc-6.png";
				break;
			case "atp":
				return "public/img/fuc-7.png";
				break;
			case "mul":
				return "public/img/fuc-8.png";
				break;
		}
	}
	
	private function formatData($data, $get) {
		switch($get) {
			case "hora":
				return date("H:i:s", strtotime($data));
				break;
			case "data":
				return date("d/m/Y", strtotime($data));
				break;
		}
	}
}
?>
