<?php

class Tweet_md extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function send($ocorrido, $cidade, $estado, $endereco) {
		$this->load->library('twitteroauth');
		
		$consumer = 'LQrE2zWKosr1VVFBZTDa3fvvb';
		$consumer_secret = 'Uy9wqNdj6xqRnRPRlUZSIKQLjkR94unA5Sf1hYTmNrw6fDM9sV';
		$access_token = '4194622822-S56oP8WeOc1qKHrz274BSk9gFsG1g5Vj6MyTXUh';
		$access_token_secret = 'wbmY5fSTu1cAZIt277IwYEyc0cTDeq5s4mimGmQdIa1RV';
		
		$connection = $this->twitteroauth->create($consumer, $consumer_secret, $access_token, $access_token_secret);
		$content = $connection->get('account/verify_credentials');
		
		$msg = "ALERTA! Em ".$cidade."-".$estado.' um(a) "'.$ocorrido.'" em '.$endereco." #fastHelp #".$cidade;
		
		$data = array(
			'status' => $msg
		);
		$result = $connection->post('statuses/update', $data);
	}
}
?>
