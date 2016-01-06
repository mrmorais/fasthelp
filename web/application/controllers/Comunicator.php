<?php
class Comunicator extends CI_Controller {
	public $user;
	
	public function userInfos() {
		$token = $this->input->post("token");
		$this->load->model("user_md");
		
		if($tmp_user = $this->user_md->getByToken($token)) {
			$infos = array("user_id"=>$tmp_user->id, 
						   "nome"=>$tmp_user->nome, 
						   "sobrenome"=>$tmp_user->sobrenome, 
						   "email"=>$tmp_user->email, 
						   "status"=>$tmp_user->status, 
						   "alert"=>$tmp_user->alert);
			echo json_encode($infos);
		} else {
			echo json_encode(array("error"=>"(x02) Erro ao carregar infos"));
		}
	}
	
	public function getUser($token) {
		$this->load->model("user_md");
		
		return $this->user_md->getByToken($token);
	}
	
	public function cadastrar() {
		$nome = $this->input->post("nome");
		$sobrenome = $this->input->post("sobrenome");
		$email = $this->input->post("email");
		$senha = $this->input->post("senha");
		$senha_r = $this->input->post("senha_r");
		
		$this->load->model("user_md");
		
		if (!empty($nome) && !empty($sobrenome) && !empty($email) && !empty($senha) && !empty($senha_r)) {
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				if ($this->user_md->checkEmail($email)) {
					if ($senha==$senha_r) {
						if ($this->user_md->insert($nome, $sobrenome, $email, $senha)) {
							echo json_encode(array("msg"=>"success"));
						} else {
							echo json_encode(array("error"=>"(x04.04) Erro desconhecido"));
						}
					} else {
						echo json_encode(array("error"=>"(x04.03) Senhas não corresponde"));
					}
				} else {
					echo json_encode(array("error"=>"(x04.02) E-mail já existe"));
				}
			} else {
				echo json_encode(array("error"=>"(x04.01) E-mail inválido"));
			}
		}
	}
	
	public function orgaosNaArea() {
		$this->load->model('orgao_md');
		$cidade = $this->input->post("cidade");
		$estado = $this->input->post("estado");
		$orgaos = $this->orgao_md->getAllIn($cidade, $estado);
		if (count($orgaos) > 0) {
			echo json_encode($orgaos);
		} else {
			echo json_encode(array("error"=>"(x06) Nenhum órgão na área"));
		}
	}
	
	public function auth() {
		$email = $this->input->post("usr");
		$senha = $this->input->post("pss");
		$this->load->model("user_md");
		$token = $this->user_md->autenticar($email, $senha);
		if ($token != false) {
			echo json_encode(array("token"=>$token));
		} else {
			echo json_encode(array("error"=>"(x01) Conta inexistente"));
		}
	}
	
	public function logout() {
		$token = $this->input->post("token");
		$this->user = $this->getUser($token);
		
		if ($this->user->logout()) {
			echo json_encode(array("msg"=>"success"));
		} else {
			echo json_encode(array("error"=>"(x03) Token não existe"));
		}
	}
	
	public function status() {
		$token = $this->input->post("token");
		$status = $this->input->post("status");
		$this->user = $this->getUser($token);
		$this->user->mudarStatus($status);
	}
	
	public function track() {
		$token = $this->input->post("token");
		$lat = $this->input->post("lat");
		$lng = $this->input->post("lng");
		$cidade = $this->input->post("cidade");
		$estado = $this->input->post("estado");
		
		$this->user = $this->getUser($token);
		$this->user->track($lat, $lng, $cidade, $estado);
	}
	
	public function call() {
		$token = $this->input->post("token");
		$codigo = $this->input->post("codigo");
		$endereco = $this->input->post("endereco");
		
		$this->user = $this->getUser($token);
		$this->user->abrirChamado($codigo, $endereco);
	}
	
	public function getCalls() {
		$this->load->model("chamado_md");
		$token = $this->input->post("token");
		$this->user = $this->getUser($token);
		
		$chamados = $this->chamado_md->getChamadosByUser($this->user->id);
		if($chamados) {
			echo json_encode($chamados);
		} else {
			echo json_encode(array("error"=>"(x05) Não existem chamados"));
		}
	}
	
	public function getCall() {
		$this->load->model("chamado_md");
		$token = $this->input->post("token");
		$cid = $this->input->post("cid");
		
		if ($this->chamado_md->setar($cid)) {
			$chamadoInArray = $this->chamado_md->getInArray();
			echo json_encode($chamadoInArray);
		} else {
			echo json_encode(array("error"=>"(x07) Este chamado não existe"));
		}
	}
	
	public function messenger($quantidade = "all") {
		$token = $this->input->post("token");
		$this->user = $this->getUser($token);
		
		$this->load->model('mensagem_md', 'msg');
		
		$msgs = $this->msg->loadMsgByChamado($this->input->post("cid"));
		if ($quantidade == "news") {
			$qnt = $this->input->post("qnt");
			$novas = [];
			if(count($msgs) > $qnt) {
				//novas mensagens --> count - qnt = qnt de novas
				$diff = count($msgs) - $qnt;
				
				for ($n = $qnt; $n < count($msgs); $n++) {
					$novas[] = $msgs[$n];
				}
			}
			echo json_encode($novas);
		} else {
			echo json_encode($msgs);
		}
	}
	
	public function sendmsg() {
		$token = $this->input->post("token");
		$this->user = $this->getUser($token);
		
		$idc = $this->input->post("idc");
		$msg = $this->input->post("msg");
		$type = $this->input->post("type");
		
		$this->load->model("mensagem_md", "msg");
		$this->msg->enviar($idc, $this->user->id, 4, "user", $type, $msg);
		
	}
}
?>
