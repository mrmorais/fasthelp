<?php
class Comando extends CI_Controller {
	public function nextCall() {
		$this->load->database();
		$q = $this->db->query("SELECT * FROM chamado WHERE status = 1");
		echo json_encode($q->result());
		
		$this->showed();
	}
	
	private function showed() {
		$this->load->database();
		$q = $this->db->query("UPDATE chamado SET status = 2 WHERE status = 1");
	}
}
?>
