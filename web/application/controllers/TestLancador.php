<?php
class TestLancador extends CI_Controller {
	
	public function abrirCall() {
		$this->load->database();
		$dados = array("endereco"=>"Reis magos", "create_time"=>"NOW()");
		$this->db->insert("chamado", $dados);
	}
}
?>
