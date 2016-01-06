<?php
class Main extends CI_Controller {
	private function getLogged() {
		$this->load->library('session');
		if ($this->session->has_userdata('id')) {
			if ($this->session->userdata('conta_tipo')=="main") {
				if ($this->session->userdata('blocked')=="no") {
					return $this->session->userdata();
				} else {
					header("Location: ?/Main/lock");
				}
			} else {
				header("Location: ?/Page/login");
			}
		} else {
			header("Location: ?/Page/login");
		}
	}
	public function index() {
		$user = $this->getLogged();
		
		$this->load->model('orgao_md', 'orgao');
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		$this->load->model('user_md', 'user');
		$num = count($this->user->getConnectedUsers($orgao['cidade'], $orgao['estado']));
		$acessos = $this->db->query('SELECT count(page) as "acessos" FROM acesso WHERE page = ?', array($orgao['id']));
		
		$esseMes = mktime(0, 0, 0, date("n"), 1, date("Y"));
		$dtMes = date("Y-m-d H:i:s", $esseMes);
		$atendimentos_mes = $this->db->query('
		select count(a.id) as n_atendimentos from 
		atendimento as a, 
		chamado as c 
		where a.chamado_id=c.id 
		and a.orgao_id='.$orgao['id'].' 
		and c.create_time > "'.$dtMes.'"');
		
		$infos = array("connected_users"=>$num, "page_access"=>$acessos->result()[0]->acessos, "atendimentos_mes"=>$atendimentos_mes->result()[0]->n_atendimentos);
		
		$data = array("actived"=>"dashboard", "user"=>$user, "orgao"=>$orgao, "infos"=>$infos);
		$this->load->view('main/home', $data);
	}
	
	public function chart_chamados() {
		$user = $this->getLogged();
		$this->load->model('orgao_md', 'orgao');
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		$this->load->database();
		$dados = $this->db->query("select create_time from chamado where cidade=? and estado=? order by create_time asc", array($orgao['cidade'], $orgao['estado']));
		$dia = [];
		for ($i=14; $i>=0; $i--) {
			$count = 0;
			$dia_x = mktime(0,0,0,date("n"),date("j")-$i, date("Y"));
			foreach($dados->result() as $row) {
				$time_temp = strtotime($row->create_time);
				$dt_temp = date("Y-m-d", $time_temp);
				if($dt_temp == date("Y-m-d", $dia_x)) {
					$count++;
				}
			}
			$dia[] = array("date"=>date("d/m", $dia_x), "count"=>$count);
		}
		print json_encode($dia);
	}
	
	public function notify() {
		$this->load->view('main/notify');
	}
	
	public function mapa() {
		$user = $this->getLogged();
		
		$this->load->model('orgao_md', 'orgao');
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		$data = array("actived"=>"mapa", "user"=>$user, "orgao"=>$orgao);
		$this->load->view('main/mapa', $data);
	}
	
	public function terminal() {
		$user = $this->getLogged();
		
		$this->load->model('chamado_md', 'chamado');
		$this->load->model('orgao_md', 'orgao');
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		$atendimentos = $this->chamado->getChamados($orgao['cidade'], $orgao['estado'], 3, $orgao['funcoes']);
		if ($atendimentos==false) {
			$atendimentos = [];
		}
		
		$chamados = $this->chamado->getChamados($orgao['cidade'], $orgao['estado'], 2, $orgao['funcoes']);
		if ($chamados==false) {
			$chamados = [];
		}
		
		$data = array("actived"=>"terminal", "user"=>$user, "orgao"=>$orgao, "chamados"=>$chamados, "atendimentos"=>$atendimentos);
		$this->load->view('main/terminal', $data);
	}
	
	public function nextCall() {
		$user = $this->getLogged();
		
		$this->load->model('chamado_md', 'chamado');
		$this->load->model('orgao_md', 'orgao');
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		$chamados = $this->chamado->getChamados($orgao['cidade'], $orgao['estado'], 1, $orgao['funcoes']);
		if ($chamados==false) {
			$chamados = [];
		}
		
		echo json_encode($chamados);
		
		$this->chamado->setViewed($chamados);
	}
	
	public function chamado($id = 0, $acao = "show") {
		$gerente = $this->getLogged();
		
		$this->load->model('orgao_md', 'orgao');
		$this->orgao->setar($gerente['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		if($id == 0) {
			show_404();
		} else {
			$this->load->model("chamado_md", "chamado");
			$this->load->model("user_md", "user");
			$chamado = $this->chamado->setar($id);
			$usuario = $this->user->setar($chamado->user_id);
			if ($chamado) {
				if ($acao == "show") {
					$data = array("actived"=>"terminal", "user"=>$gerente, "usuario"=>$usuario, "orgao"=>$orgao, "chamado"=>$chamado);
					$this->load->view('main/chamado', $data);
				} elseif($acao == "atender") {
					$chamado->atender($orgao['id']);
					header("Location: ?/Main/terminal");
				} elseif($acao == "encerrar") {
					$chamado->encerrar();
					header("Location: ?/Main/terminal");
				} elseif($acao == "recusar") {
					$chamado->recusar();
					header("Location: ?/Main/terminal");
				}
			} else {
				show_404();
			}
			
		}
	}
	
	public function messenger($quantidade = "todas") {
		$user = $this->getLogged();
		
		$this->load->model('orgao_md', 'orgao');
		$this->load->model('mensagem_md', 'msg');
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		$msgs = $this->msg->loadMsgByChamado($this->input->post("id"));
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
	
	function sendMsg() {
		$user = $this->getLogged();
		
		$id = $this->input->post("id");
		$type = $this->input->post("type");
		$msg = $this->input->post("msg");
		$msg = htmlspecialchars($msg);
		
		$this->load->model("chamado_md", "chamado");
		$this->chamado->setar($id);
		$u_id = $this->chamado->user_id;
		
		$this->load->model("mensagem_md", "mensagem");
		$this->mensagem->enviar($id, $u_id, $user['orgao_id'], "orgao", $type, $msg);
	}
	
	public function gerentes($acao = "show", $id=0) {
		$user = $this->getLogged();
		
		$this->load->model('orgao_md', 'orgao');
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		$this->load->model('gerente_md', 'gerente');
		$this->load->model('admin_md', 'admin');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('sobrenome', 'Sobrenome', 'required');
		$this->form_validation->set_rules('mail', 'Email', 'required|valid_email');
		
		switch ($acao) {
			case "show":
				$gerentes = $this->gerente->getAllInArray($user['orgao_id']);
				
				$data = array("actived"=>"gerentes", "user"=>$user, "gerentes"=>$gerentes, "orgao"=>$orgao);
				$this->load->view('main/gerentes', $data);
			break;
			case "cadastrar":
				if ($this->form_validation->run()==TRUE) {
					if($this->admin->checkEmail($this->input->post('mail')) && $this->gerente->checkEmail($this->input->post('mail'))) {
						$senha = $this->gerente->criar($user['orgao_id'],
													   $this->input->post('nome'),
													   $this->input->post('sobrenome'),
													   $this->input->post('mail'));
						$data = array("msg"=>"sucesso_cadastro_gerente", "tipo"=>"success");
						$this->load->view('main/message', $data);
						
						$this->load->model("mail_md", "mailer");
						$this->mailer->sendDefaultMail("novo_gerenciador", $this->input->post('mail'), array("nome"=>$this->input->post('nome'), 
																											 "sobrenome"=>$this->input->post('sobrenome'), 
																											 "orgao"=>$orgao['nome'], 
																											 "senha"=>$senha));
					} else {
						$data = array("msg"=>"email_ja_existe", "tipo"=>"error");
						$this->load->view('main/message', $data);
					}
				}
			break;
			case "delete":
				if($id!=0) {
					$this->load->model("gerente_md", "gerente_del");
					
					if ($this->gerente_del->setar($id)) {
						$gerente_del = $this->gerente_del->getInArray();
						
						if ($this->gerente_del->delete($gerente_del['id'], $orgao['id'])) {
							$data = array("msg"=>"sucesso_deletar_gerente", "tipo"=>"success");
							$this->load->view('main/message', $data);
						} else {
							$data = array("msg"=>"erro_deletar_gerente", "tipo"=>"error");
							$this->load->view('main/message', $data);
						}
					} else {
						$data = array("msg"=>"gerente_n_existe", "tipo"=>"error");
						$this->load->view('main/message', $data);
					}
				} else {
					header("Location: ?/Main/gerentes");
				}
			break;
		}
		
	}
	
	public function configura_gerente($area, $acao="show") {
		$user = $this->getLogged();
		
		$this->load->model('gerente_md', 'gerente');
		$this->load->model('admin_md', 'admin');
		$this->load->model('orgao_md', 'orgao');
		
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('sobrenome', 'Sobrenome', 'required');
		$this->form_validation->set_rules('mail', 'Email', 'required|valid_email');
		
		switch($area) {
			case "dados":
				if($acao == "show") {
					$data = array("actived"=>"c_gerente", "user"=>$user, "orgao"=>$orgao, "area"=>"dados");
					$this->load->view('main/c_gerente', $data);
				} elseif($acao == "confirmar") {
					if ($this->form_validation->run()==TRUE) {
						if ($this->input->post('mail') == $user['email']) {
							$passMail = true;
						} else {
							if($this->admin->checkEmail($this->input->post('mail')) && $this->gerente->checkEmail($this->input->post('mail'))) {
								$passMail = true;	
							} else {
								$passMail = false;
							}
						}
						
						if ($passMail) {
							$this->gerente->setar($user['id']);
							if($this->gerente->update($this->input->post('nome'), $this->input->post('sobrenome'), $this->input->post('mail'))) {
								$this->atualizarSession();
								$data = array("msg"=>"sucesso_alterar_dados", "tipo"=>"success");
								$this->load->view('main/message', $data);
							} else {
								$data = array("msg"=>"mysql_erro", "tipo"=>"error");
								$this->load->view('main/message', $data);
							}						
						} else {
							$data = array("msg"=>"email_ja_existe_dados", "tipo"=>"error");
							$this->load->view('main/message', $data);
						}
					}
				}
				break;
			case "senha":
				if($acao == "show") {
					$data = array("actived"=>"c_gerente", "user"=>$user, "orgao"=>$orgao, "area"=>"senha");
					$this->load->view('main/c_gerente', $data);
				} elseif($acao == "confirmar") {
					$senha = $this->input->post("senha_atual");
					$nova = $this->input->post("senha_nova");
					$nova_r = $this->input->post("senha_nova_r");
					if ($nova == $nova_r) {
						if($this->gerente->autenticar($user['email'], $senha)) {
							$this->gerente->setar($user['id']);
							$this->gerente->atualizaSenha($nova);
							
							$data = array("msg"=>"sucesso_alterar_senha", "tipo"=>"success");
							$this->load->view('main/message', $data);
						} else {
							$data = array("msg"=>"senha_incorreta_alt_senha", "tipo"=>"error");
							$this->load->view('main/message', $data);
						}
					} else {
						$data = array("msg"=>"senhas_nao_sao_iguais", "tipo"=>"error");
						$this->load->view('main/message', $data);
					}
				}
				break;
			case "encerrar":
				if($acao == "show") {
					$data = array("actived"=>"c_gerente", "user"=>$user, "orgao"=>$orgao, "area"=>"encerrar");
					$this->load->view('main/c_gerente', $data);
				} elseif($acao == "confirmar") {
					$senha = $this->input->post('senha');
					
					if ($this->gerente->autenticar($user['email'], $senha)) {
						if (count($this->gerente->getAllInArray($user['orgao_id'])) > 1) {
							if ($this->gerente->delete($user['id'], $user['orgao_id'])) {
								$this->load->library('session');
								$this->session->sess_destroy();
								
								$data = array("msg"=>"sucesso_gerente_encerrar", "tipo"=>"success");
								$this->load->view('main/message', $data);
							} else {
								$data = array("msg"=>"mysql_erro", "tipo"=>"error");
								$this->load->view('main/message', $data);
							}
						} else {
							if ($this->orgao->delete()) {
								$this->load->library('session');
								$this->session->sess_destroy();
								
								$data = array("msg"=>"sucesso_orgao_encerrar", "tipo"=>"success");
								$this->load->view('main/message', $data);
							} else {
								$data = array("msg"=>"mysql_erro", "tipo"=>"error");
								$this->load->view('main/message', $data);
							}
						}
					} else {
						$data = array("msg"=>"gerente_encerrar_senha_errada", "tipo"=>"error");
						$this->load->view('main/message', $data);
					}
				}
				break;
		}
		
		
	}
	
	public function configura_orgao($area, $acao="show") {
		$user = $this->getLogged();
		
		$this->load->model('gerente_md', 'gerente');
		$this->load->model('admin_md', 'admin');
		$this->load->model('orgao_md', 'orgao');
		
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		switch($area) {
			case "dados":
				if ($acao == "show") {
					$data = array("actived"=>"c_orgao", "user"=>$user, "orgao"=>$orgao, "area"=>"dados");
					$this->load->view('main/c_orgao', $data);
				}
				break;
			case "funcoes":
				$this->load->model("funcao_md");
				$funcoes = $this->funcao_md->getByOrgao($orgao['id']);
				if ($acao == "show") {
					$data = array("actived"=>"c_orgao", "user"=>$user, "orgao"=>$orgao, "area"=>"funcoes", "funcoes"=>$funcoes);
					$this->load->view('main/c_orgao', $data);
				} elseif($acao == "confirmar") {
					$funcoes = $this->input->post('funcao');
					$this->orgao->setarFuncoes($funcoes);
					header("Location: ?/Main/");
				}
				break;
			case "encerrar":
			
				break;
		}
		
		
	}
	
	public function pagina_orgao($acao=null) {
		$etapa = 0;
		
		$user = $this->getLogged();
		
		$this->load->model('orgao_md', 'orgao');
		$this->load->model('profile_md', 'profile');
		$this->load->helper('url');
		
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		if ($acao == "criar") {
			$nick = $this->input->post("nick");
			
			$profile = $this->profile->criar($this->orgao->id, $nick);
			if ($profile) {
				header("Location: ?/Main/pagina_orgao/etapa_2");
			}
		} else {
			
			if ($acao=="etapa_2") {
				$etapa = 2;
			} elseif($acao=="etapa_2_send") {
				$descricao = $this->input->post('descricao');
				if ($this->profile->setDescricao($descricao, $this->orgao->id)) {
					header("Location: ?/Main/pagina_orgao/etapa_3");
				} else {
					header("Location: ?/Main/pagina_orgao/etapa_2");
				}
			} elseif($acao=="etapa_3") {
				$etapa = 3;
			} elseif($acao=="etapa_3_send") {
				$config['upload_path'] = 'public/img/avatar';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name']= $this->profile->gerarNomeAvatar();
				$config['max_size']	= '300';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';
				
				$this->load->library('upload', $config);
				
				if($this->upload->do_upload()) {
					$this->profile->setarAvatar($this->upload->data()['file_name'], $this->orgao->id); ;
				}
			}
			
			$this->profile->setar($this->orgao->id);
			$profile = $this->profile->getInArray();
		}
		$data = array("actived"=>"pagina_orgao", "user"=>$user, "orgao"=>$orgao, "profile"=>$profile, "etapa"=>$etapa);
		$this->load->view('main/pagina_orgao', $data);
		
	}
	
	public function lock() {
		$this->load->library('session');
		if(!$this->session->has_userdata('id')) {
			header("Location: ?/Page/login");
		}
		$this->session->set_userdata('blocked', 'yes');
		$this->load->view('main/lock_screen', array("mail"=>$this->session->userdata('email')));
	}
	
	public function atualizarSession() {
		$user = $this->getLogged();
		$this->load->library('session');
		$this->load->model('gerente_md');
		$this->gerente_md->setar($user['id']);
		$this->session->set_userdata($this->gerente_md->getGerente());
	}
	
	public function getMarkers() {
		$user = $this->getLogged();
		
		$this->load->model('gerente_md', 'gerente');
		$this->load->model('orgao_md', 'orgao');
		$this->load->model('user_md', 'user');
		
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		$markers = $this->user->getConnectedUsers($orgao['cidade'], $orgao['estado']);
		echo json_encode($markers);
	}
	
	public function ideia($page) {
		$user = $this->getLogged();
		
		$this->load->model('orgao_md', 'orgao');
		$this->orgao->setar($user['orgao_id']);
		$orgao = $this->orgao->getInArray();
		
		switch($page) {
			case "central_dados":
				$ideia = array("titulo"=>"Central de Dados", "descricao"=>"Uma central de estatísticas que permita analisar os dados de ocorrências filtradas por regiões; com descriminação visual (através de gráficos e mapas inteligentes) na finalidade de facilitar os processos estratégicos de atendimento de ocorrências.");
				break;
			case "pagina_orgao":
				$ideia = array("titulo"=>"Página do órgão", "descricao"=>"Uma área do site em que seja possível inserir informações que viabilizem a integração do órgão com a sociedade, tal como uma fan page em uma rede social. Nesta área será possível inserir postagens, relatar atendimento à determinadas ocorrências e receber mensagens da população.");
				break;
		}
		
		$data = array("user"=>$user, "orgao"=>$orgao, "ideia"=>$ideia, "actived"=>"ideia");
		$this->load->view('main/ideia', $data);
	}
	
	public function sair() {
		$user = $this->getLogged();
		
		$this->load->library('session');
		$this->session->sess_destroy();
		header("Location: ?/Page/");	
	}
}
?>
