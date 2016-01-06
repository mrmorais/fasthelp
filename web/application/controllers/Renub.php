<?php
class Renub extends CI_Controller {
	private function getLogged() {
		$this->load->library('session');
		if ($this->session->has_userdata('conta_tipo')) {
			if ($this->session->userdata('conta_tipo')=="renub") {
				return $this->session->userdata();
			}
		}
		header("Location: ?/Page/login");
	}
	public function index() {
		$user = $this->getLogged();
		$this->load->model('precadastro_md');
		$this->load->model('orgao_md');
		
		$this->load->database();
		$num_users = $this->db->query('SELECT count(id) as "users" FROM user');
		$num_acessos = $this->db->query('SELECT count(tipo) as "acessos" FROM acesso WHERE page = ?', array("index"));
		$panel = array("num_precadastros"=>$this->precadastro_md->numPrecadastros(),
					   "num_orgaos"=>$this->orgao_md->numOrgaos(),
					   "num_users"=>$num_users->result()[0]->users,
					   "num_acessos"=>$num_acessos->result()[0]->acessos);
		$data = array("actived"=>"home", "user"=>$user, "panel"=>$panel);
		$this->load->view('renub/home', $data);
	}
	public function testMail() {
		$this->load->model('datamail_md');
		$this->datamail_md->test();
	}
	public function precadastros() {
		$user = $this->getLogged();
		$this->load->model('precadastro_md', 'precad');
		$precadastros = $this->precad->getAll();
		
		$data = array("actived"=>"precadastros", "precadastros"=>$precadastros, "user"=>$user);
		$this->load->view('renub/precadastros', $data);
	}
	public function precadastro($id=0, $acao="show") {
		$user = $this->getLogged();
		$this->load->model('precadastro_md', 'precad');
		$precad = $this->precad->get($id);
		if($precad==null) {
			show_404();
		}
		switch($acao) {
			case "avaliacao":
				$this->precad->setStatus("avaliando");
				header("Location: ?/Renub/precadastro/".$id);
				break;
			case "navaliacao":
				$this->precad->setStatus("");
				header("Location: ?/Renub/precadastro/".$id);
				break;
			case "delete":
				$this->precad->recusar();
				header("Location: ?/Renub/precadastros");
				break;
			case "criar":
				$this->precad->criar();
				header("Location: ?/Renub/orgaos");
				break;
			default:
				$data = array("actived"=>"precadastros", "precadastro"=>$precad, "user"=>$user);
				$this->load->view('renub/precadastro', $data);
		}	
	}
	public function orgaos($cidade="all") {
		$user = $this->getLogged();
		
		$this->load->model('orgao_md', 'orgao');
		if ($cidade != "all") {
			$this->load->helper('inflector');
			$cidade = urldecode($cidade);
			$cidade = urldecode($cidade);
			$cidade = humanize($cidade);
			$orgaos = $this->orgao->getAll($cidade);
		} else {
			$orgaos = $this->orgao->getAll();
		}
		$cidades = $this->orgao->cidadesList();
		$data = array("actived"=>"orgaos", "user"=>$user, "orgaos"=>$orgaos, "cidade"=>$cidade, "listCidades"=>$cidades);
		$this->load->view('renub/orgaos', $data);
	}
	
	public function orgao($id=0, $acao="show") {
		$user = $this->getLogged();
		
		$this->load->model('orgao_md', 'orgao');
		$this->load->model('gerente_md', 'gerente');
		$this->load->model('mail_md');
		if ($id==0) {
			show_404();
		} else {
			if($this->orgao->setar($id)) {
				$gerentes = $this->gerente->getAllInArray($this->orgao->id);
				switch($acao) {
					case "show":
						$data = array("actived"=>"orgaos", "orgao"=>$this->orgao->getInArray(), "user"=>$user, "gerente"=>$gerentes);
						$this->load->view('renub/orgao', $data);
					break;
					case "send_email":
						$assunto = $this->input->post("assunto");
						$msg = $this->input->post("msg");
						foreach ($gerentes as $gerente) {
							$this->mail_md->sendMail($assunto.$gerente['id'], "maradona.morais@hotmail.com", $msg);
						}
						$data = array("msg"=>"email_enviado", "tipo"=>"success");
						$this->load->view('renub/message', $data);
					break;
				}
			} else {
				show_404();
			}
		}
	}
	
	public function administradores() {
		$user = $this->getLogged();
		$this->load->model('admin_md', 'admins');
		$this->load->model('gerente_md', 'gerentes');
		
		$admins = $this->admins->getAll();
		if ($admins==null) {
			show_404();
		}
		$data = array("actived"=>"admin", "admins"=>$admins, "user"=>$user);
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('sobrenome', 'Sobrenome', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Senha', 'required');
		$this->form_validation->set_rules('conf_pass', 'Confirmar senha', 'required|matches[pass]');
		
		if ($this->form_validation->run()==TRUE) {
			if($this->admins->checkEmail($this->input->post('email')) && $this->gerentes->checkEmail($this->input->post('email'))) {
				$this->admins->insert($this->input->post('nome'),
									  $this->input->post('sobrenome'),
									  $this->input->post('email'),
									  $this->input->post('pass'),
									  $this->input->post('tipo'));
				header("Location: ?/Renub/administradores");
			}
		}
		$this->load->view('renub/administradores', $data);
	}
	
	public function administrador($id=0, $acao="show") {
		$this->load->model('admin_md', 'admin');
		if ($acao=="delete") {
			if($this->admin->get($id)) {
				$this->admin->delete($id);
				header("Location: ?/Renub/administradores");
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}
	
	public function mail($acao="show", $id = 0) {
		$user = $this->getLogged();
		$this->load->model("mail_md");
		
		switch($acao) {
			case "show":
				$data = array("actived"=>"mail", "user"=>$user, "area"=>"grupos");
				$this->load->view('renub/mail', $data);
				break;
			case "send_group":
				$assunto = $this->input->post('assunto');
				$msg = $this->input->post('msg');
				$gerente = $this->input->post('cb_gerentes');
				$admins = $this->input->post('cb_admins');
				if ($gerente == "on") {
					$this->load->model("gerente_md");
					foreach($this->gerente_md->getAll() as $gerente) {
						$this->mail_md->sendMail($assunto.$gerente['id'], "maradona.morais@hotmail.com", $msg);
					}
				}
				if ($admins == "on") {
					$this->load->model("admin_md");
					foreach($this->admin_md->getAll() as $admin) {
						$this->mail_md->sendMail($assunto, "maradona.morais@hotmail.com", $msg);
					}
				}
				
				$data = array("msg"=>"email_enviado", "tipo"=>"success");
				$this->load->view('renub/message', $data);
				
				break;
			case "gerente":
				$this->load->model("gerente_md");
				$this->load->model("orgao_md");
				if ($this->gerente_md->setar($id)) {
					$this->orgao_md->setar($this->gerente_md->orgao_id);
					$data = array("actived"=>"mail", "user"=>$user, "area"=>"gerente", "gerente"=>$this->gerente_md->getInArray(), "orgao"=>$this->orgao_md->getInArray());
					$this->load->view('renub/mail', $data);
				} else {
					show_404();
				}
				break;
			case "send_gerente":
				$assunto = $this->input->post('assunto');
				$msg = $this->input->post('msg');
				$admins = $this->input->post('cb_admins');
				
				$this->load->model("gerente_md");
				$this->gerente_md->setar($id);
				$mail = $this->gerente_md->email;
				if($this->mail_md->sendMail($assunto, "maradona.morais@hotmail.com", $msg)) {				
					$data = array("msg"=>"email_enviado", "tipo"=>"success");
					$this->load->view('renub/message', $data);
				} else {
					$data = array("msg"=>"qualquer_erro", "tipo"=>"error");
					$this->load->view('renub/message', $data);
				}
				
				break;
		}
			
	}
	
	public function delete($tipo = null, $id = null) {
		if ($tipo == null || $id == null) {
			show_404();
		}
 		switch($tipo) {
			case "gerente":
				$this->load->model("gerente_md", "gerente");
				$this->load->model("orgao_md", "orgao");
				
				$this->gerente->setar($id);
				$this->orgao->setar($this->gerente->orgao_id);
				
				if (count($this->gerente->getAllInArray($this->gerente->orgao_id)) > 1) {
					if ($this->gerente->delete($this->gerente->id, $this->gerente->orgao_id)) {						
						$data = array("msg"=>"sucesso_gerente_encerrar", "tipo"=>"success");
						$this->load->view('renub/message', $data);
					} else {
						$data = array("msg"=>"qualquer_erro", "tipo"=>"error");
						$this->load->view('renub/message', $data);
					}
				} else {
					if ($this->orgao->delete()) {						
						$data = array("msg"=>"sucesso_orgao_encerrar", "tipo"=>"success");
						$this->load->view('renub/message', $data);
					} else {
						$data = array("msg"=>"qualquer_erro", "tipo"=>"error");
						$this->load->view('renub/message', $data);
					}
				}
				break;
		}
			
	}

	
	public function testemail() {
		$this->load->library('email');

		$this->email->from('neep.dev@gmail.com', 'Neep Dev');
		$this->email->to('maradona.morais.42@gmail.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		if($this->email->send()) {
			echo "sucesso";
		} else {
			echo "erro";
		}
		echo $this->email->print_debugger();
	}
	
	public function funcoes($acao = "show", $id = 0) {
		$user = $this->getLogged();
		$this->load->model("funcao_md");
		
		switch ($acao) {
			case "show":
				$funcoes = $this->funcao_md->getAll();
				$this->load->view("renub/funcoes", array("user"=>$user, "actived"=>"funcoes", "funcoes"=>$funcoes));
				break;
			case "new":
				$codigo = $this->input->post('codigo');
				$descricao = $this->input->post('descricao');
				$icone = $this->input->post('icone');
				
				$this->funcao_md->criar($codigo, $descricao, $icone);
				header("Location: ?/Renub/funcoes");
				break;
			case "deletar":
				if ($this->funcao_md->existe($id)) {
					$this->funcao_md->delete($id);
					header("Location: ?/Renub/funcoes");
				} else {
					show_404();
				}
				break;
		}
	}
	
	public function sair() {
		$this->load->library('session');
		$this->session->sess_destroy();
		header("Location: ?/Page/");	
	}
}
?>
