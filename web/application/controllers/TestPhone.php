<?php
class TestPhone extends CI_Controller {
	public function index(){
		$this->load->view("phone/home");
	}
	
	public function mudarStatus($status) {
		$this->load->database();
		$this->db->query("UPDATE user SET status = ? WHERE id = ?", array($status, 1));
		
		header("Location: ?/TestPhone");
	}
	
	public function mudarConexao($con) {
		$this->load->database();
		$this->db->query("UPDATE user SET connected = ? WHERE id = ?", array($con, 1));
		
		header("Location: ?/TestPhone");
	}
	
}
?>
