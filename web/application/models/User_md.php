<?php

class User_md extends CI_Model {
	public $id;
	public $nome;
	public $sobrenome;
	public $email;
	public $cidade;
	public $estado;
	public $lat;
	public $lng;
	public $status;
	public $alert;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function setar($id) {
		$this->load->database();
		$this->db->where("id", $id);
		$q = $this->db->get("user");
		foreach($q->result() as $row) {
			$this->id = $row->id;
			$this->nome = $row->nome;
			$this->sobrenome = $row->sobrenome;
			$this->email = $row->email;
			$this->cidade = $row->cidade;
			$this->estado = $row->estado;
			$this->lat = $row->lat;
			$this->lng = $row->lng;
			$this->status = $row->status;
			$this->alert = $row->alert;
			
			return $this;
		}
		return false;
	}
	
	public function autenticar($email, $senha) {
		$this->load->database();
		$this->db->where("email", $email);
		$this->db->where("senha", $senha);
		$query = $this->db->get("user");
		foreach($query->result() as $row) {
			$this->setar($row->id)->setConnected(true);
			return $this->registrarLogin($row->id);
		}
		return false;
	}
	
	private function registrarLogin($id) {
		$this->load->database();
		$token = md5(time().$id);
		$query = $this->db->insert("token", array("user_id"=>$id, "token"=>$token));
		return $token;
	}
	
	public function getByToken($token) {
		$this->load->database();
		$q = $this->db->query("SELECT * FROM token WHERE token = ?", array($token));
		foreach($q->result() as $row) {
			return $this->setar($row->user_id);
		}
		return false;
	}
	
	public function getConnectedUsers($cidade, $estado) {
		$this->load->database();
		$limit = mktime(date("H"), date("i")-2, date("s"));
		$timestamp = date("Y-m-d H:i:s", $limit);
		$query = $this->db->query("SELECT id, nome, sobrenome, lat, lng, status, alert FROM user WHERE cidade = ? and estado = ? and connected = 1 and last_update > ?", array($cidade, $estado, $timestamp));
		$users = [];
		foreach ($query->result() as $user) {
			$users[] = $user;
		}
		return $users;
	}
	//block-Seted
	public function logout() {
		$this->load->database();
		$query = $this->db->query("DELETE FROM token WHERE user_id = ?", array($this->id));
		$this->setConnected(false);
		return $query;
	}
	
	public function setConnected($connected) {
		$this->load->database();
		if($connected) {
			$this->db->query("UPDATE user SET connected = 1 WHERE id = ?", array($this->id));
		} else {
			$this->db->query("UPDATE user SET connected = 0 WHERE id = ?", array($this->id));
		}
	}
	
	public function setAlert($alert) {
		$this->load->database();
		if($alert) {
			$this->db->query("UPDATE user SET alert = 1 WHERE id = ?", array($this->id));
		} else {
			$this->db->query("UPDATE user SET alert = 0 WHERE id = ?", array($this->id));
		}
	}
	
	public function mudarStatus($status) {
		$this->load->database();
		$this->db->query("UPDATE user SET status = ? WHERE id = ?", array($status, $this->id));
	}
	
	public function track($lat, $lng, $cidade, $estado) {
		$this->load->database();
		$this->db->query("UPDATE user SET lat = ?, lng = ?, cidade = ?, estado = ? WHERE id = ?", array($lat, $lng, $cidade, $estado, $this->id));
	}
	
	public function abrirChamado($codigo, $endereco) {
		$this->load->model("chamado_md");
		$this->chamado_md->criar($this->id, $codigo, $this->lat, $this->lng, $this->cidade, $this->estado, $endereco);
		$this->setAlert(true);
	}
	
	//.block-Seted
	public function insert($nome, $sobrenome, $email, $senha) {
		$this->load->database();
		$data = array("nome"=>$nome, "sobrenome"=>$sobrenome, "email"=>$email, "senha"=>$senha);
		if ($this->db->insert("user", $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function getAll() {
		$this->load->database();
		$sql = "SELECT * FROM user";
		$res = $this->db->query($sql);
		$usrs = array();
		foreach($res->result() as $row) {
			$usrs[] = array("id"=>$row->id, 
							  "nome"=>$row->nome, 
							  "sobrenome"=>$row->sobrenome, 
							  "email"=>$row->email,
							  "cidade"=>$row->cidade, 
							  "estado"=>$row->estado, 
							  "lat"=>$row->lat, 
							  "lng"=>$row->lng, 
							  "connected"=>$row->connected, 
							  "status"=>$row->status, 
							  "alert"=>$row->alert);
		}
		
		return $usrs;
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
	
	public function statusToImage($status, $alert) {
		if ($alert == 1) {
			switch($status) {
				case 1:
					return "public/img/sts_c-1.png";
					break;
				case 2:
					return "public/img/sts_c-2.png";
					break;
				case 3:
					return "public/img/sts_c-3.png";
					break;
				case 4:
					return "public/img/sts_c-4.png";
					break;
				case 5:
					return "public/img/sts_c-5.png";
					break;
			}
		} else {
			switch($status) {
				case 1:
					return "public/img/sts-1.png";
					break;
				case 2:
					return "public/img/sts-2.png";
					break;
				case 3:
					return "public/img/sts-3.png";
					break;
				case 4:
					return "public/img/sts-4.png";
					break;
				case 5:
					return "public/img/sts-5.png";
					break;
			}
		}
	}
}
?>
