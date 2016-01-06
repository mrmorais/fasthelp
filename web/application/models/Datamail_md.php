<?php

class Datamail_md extends CI_Model {
	public $email;
	public $nome;
	public $sobrenome;
	private $server;
	
	public function __construct() {
		parent::__construct();
		
		
	}
	
	public function test() {
		$this->load->library("MY_phpmailer");
		$email = new PHPMailer();
		$this->server->IsSMTP();
		$this->server->SMTPAuth = true;
		$this->server->SMTPSecure = "ssl";
		$this->server->Host = "smtp.gmail.com";
		$this->server->Port = 465;
		$this->server->Username = "neep.dev@gmail.com";
		$this->server->Password = "Facebook@42";
		$this->server->SetFrom("neep.dev@gmail.com", "FastHelp");
		
		$this->server->Subject = "Assunto";
		$this->server->Body = "corpo";
		$this->server->AddAddress("maradona.morais@hotmail.com", "Maradona Morais");
		
		if(!$this->server->Send()) {
			echo "Erro";
		} else {
			echo "success";
		}
	}
}
?>
