<?php
class Page extends CI_Controller {
	public function index() {
		if (!empty($this->input->get('busca'))) {
			$this->load->model('search_md', 'search');
			$query = $this->input->get('busca');
			if ($this->search->doSearch($query)!==FALSE) {
				$this->load->view('search', array("orgao"=>$this->search->result));
				$this->load->view('footer');
			} else {
				$this->load->view('message', 
				array("title"=>'Dought! Não estamos em "'.htmlspecialchars($query).'"', 
					"desc"=>"Quem sabe um dia, né? Até lá!", 
					"bt_text"=>"Voltar",
					"bt_url"=>"?/Page/"));
				$this->load->view('footer');
			}
		} else {
			$this->load->view('home');
			$this->load->view('footer');
			$this->logAcesso();
		}
	}
	private function logAcesso() {
		$this->load->database();
		$this->db->insert("acesso", array("tipo"=>"site", "page"=>"index"));
	}
	public function cadastro($tipo="orgao") {
		switch ($tipo) {
			case "orgao":
				$this->load->library('form_validation');
				
				$this->form_validation->set_rules('nome', 'Nome do órgão', 'required');
				$this->form_validation->set_rules('razao', 'Razão social', 'required');
				$this->form_validation->set_rules('responsavel', 'Responsável', 'required');
				$this->form_validation->set_rules('cidade', 'Cidade', 'required');
				$this->form_validation->set_rules('estado', 'Estado', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
				$this->form_validation->set_rules('telefone', 'Telefone', 'required');
				
				if ($this->form_validation->run()==FALSE) {
					$this->load->view('cadastro_orgao');
					$this->load->view('footer');
				} else {
					$this->load->model('precadastro_md', 'precadastro');
					$this->load->model('admin_md', 'admin');
					$this->load->model('gerente_md', 'gerente');
					$email = $this->input->post('email');
					if (!$this->gerente->checkEmail($email) || !$this->admin->checkEmail($email)) {
						$this->load->view('message', 
						array("title"=>"<i class='fa fa-exclamation-triangle'></i> Ops! Verifique seu email", 
							"desc"=>"O email inserido já está cadastrado no nosso banco de dados!", 
							"bt_text"=>"Tentar novamente",
							"bt_url"=>"?/Page/cadastro/orgao"));
						$this->load->view('footer');
					} else {
						$this->precadastro->setarFormulario($this->input->post('nome'),
															$this->input->post('razao'),
															$this->input->post('tipo'),
															$this->input->post('responsavel'),
															$this->input->post('telefone'),
															$this->input->post('email'),
															$this->input->post('cidade'),
															$this->input->post('estado'),
															$this->input->post('endereco'));
						if($this->precadastro->insert()) {
							$this->load->view('message', 
							array("title"=>"<i class='fa fa-flag-checkered'></i> Os seus dados foram arquivados com sucesso", 
								"desc"=>"Para o processo de validação você receberá um email, ou telefonema, de nossa equipe.", 
								"bt_text"=>"voltar para o Início",
								"bt_url"=>"?/Page"));
							$this->load->view('footer');
							$this->load->model("mail_md", "mailer");
							$this->mailer->sendDefaultMail("precadastro", $this->input->post('email'), array("nome"=>$this->input->post('responsavel')));
						} else {
							$this->load->view('message', 
							array("title"=>"<i class='fa fa-rocket'></i> Houston, we have a problem!", 
								"desc"=>"Algum erro impediu o sucesso do procedimento, tente novamente mais tarde", 
								"bt_text"=>"voltar para o Início",
								"bt_url"=>"?/Page"));
							$this->load->view('footer');
						}
					}
					
				}
				break;
			default:
				show_404();
		}
	}
	public function login() {
		$this->load->library('session');
		if($this->session->has_userdata('id')) {
			if ($this->session->userdata('conta_tipo')=="main") {
				if ($this->session->userdata('blocked')=="yes") {
					header("Location: ?/Main/lock");
				} else {
					header("Location: ?/Main");
				}
			} elseif($this->session->userdata('conta_tipo')=="renub") {
				header("Location: ?/Renub");
			}
		}
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('mail', 'E-mail', 'required|valid_email', array('required'=>'O campo %s deve ser preenchido', 'valid_email'=>'O E-mail deve ser válido'));
		$this->form_validation->set_rules('password', 'Senha', 'required', array('required'=>'O campo %s deve ser preenchido'));
		
		if ($this->form_validation->run()==FALSE) {
			$this->load->view('login');
		} else {
			$this->load->model('admin_md', 'admin');
			$this->load->model('gerente_md', 'gerente');
			$this->load->library('session');
			
			if ($this->admin->autenticar($this->input->post('mail'), $this->input->post('password'))) {
				$this->session->set_userdata($this->admin->getAdmin());
				header("Location: ?/Renub/");
			} elseif($this->gerente->autenticar($this->input->post('mail'), $this->input->post('password'))) {
				$this->session->set_userdata($this->gerente->getGerente());
				header("Location: ?/Main/");
			} else {
				$this->load->view('login');
			}
		}
	}
	
	public function recuperar_senha() {
		$this->load->model('gerente_md', 'gerente');
		$this->load->model('admin_md', 'admin');
		
		$email = $this->input->post('email_recu');
		
		$gerentes = $this->gerente->getAll();
		$found = false;
		foreach ($gerentes as $gerente) {
			if ($gerente['email']==$email) {
				if ($this->gerente->recuperar($gerente['id'])) {
					$this->load->view('message', 
							array("title"=>"Nova senha foi definida!", 
								"desc"=>"Verifique seu e-mail e entre com a nova senha de acesso!", 
								"bt_text"=>"voltar para Login",
								"bt_url"=>"?/Page/login"));
					$this->load->view('footer');
				} else {
					$this->load->view('message', 
							array("title"=>"Nova senha foi definida!", 
								"desc"=>"Verifique seu e-mail e entre com a nova senha de acesso!", 
								"bt_text"=>"voltar para Login",
								"bt_url"=>"?/Page/login"));
					$this->load->view('footer');
				}
				$found = true;
			}
		}
		if (!$found) {
			$admins = $this->admin->getAll();
			foreach($admins as $admin) {
				if ($admin['email']==$email) {
					if ($this->admin->recuperar($admin['id'])) {
						$this->load->view('message', 
								array("title"=>"Nova senha foi definida!", 
									"desc"=>"Verifique seu e-mail e entre com a nova senha de acesso!", 
									"bt_text"=>"voltar para Login",
									"bt_url"=>"?/Page/login"));
						$this->load->view('footer');
					} else {
						$this->load->view('message', 
								array("title"=>"Nova senha foi definida!", 
									"desc"=>"Verifique seu e-mail e entre com a nova senha de acesso!", 
									"bt_text"=>"voltar para Login",
									"bt_url"=>"?/Page/login"));
						$this->load->view('footer');
					}
					$found = true;
				}
			}
			
			if (!$found) {
				$this->load->view('message', 
							array("title"=>"E-mail não existe!", 
								"desc"=>"Verifique seu e-mail!", 
								"bt_text"=>"voltar para o Login",
								"bt_url"=>"?/Page/login"));
				$this->load->view('footer');
			}
		}
	}
	
	public function termos() {
		$this->load->view('termos');
		$this->load->view('footer');
	}
	public function search() {
		$this->load->model('search_md', 'search');
		$query = $this->input->get('q');
		if ($query == null) {
			header("Location: ?/Page/");
		} else {
			$this->search->doSearch($query);
		}
	}
	public function sendmail() {
		$this->load->model("mail_md");
		$this->mail_md->testMail();
	}
}
?>
