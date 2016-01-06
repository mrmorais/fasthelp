<?php

class Profile extends CI_Controller {
	public function o($nick=null) {
		$this->load->model("profile_md", "profile");
		$this->load->model("orgao_md", "orgao");
		if(!$this->profile->existeNick($nick)) {
			show_404();
		}
		$profile = $this->profile->setByNick($nick);
		$this->orgao->setar($profile->orgao_id);
		$orgao = $this->orgao->getInArray();
		
		$this->logAcesso($orgao['id']);
		$this->load->view('profile/home', array("profile"=>$profile, "orgao"=>$orgao));
		$this->load->view('profile/footer');
	}
	
	private function logAcesso($o_id) {
		$this->load->database();
		$this->db->insert("acesso", array("tipo"=>"profile", "page"=>$o_id));
	}
}
?>
