<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require("PHPMailer/PHPMailerAutoload.php");
class Mailer extends PHPMailer {
	public function __construct() {
		parent::__construct();
	}
}

?>
