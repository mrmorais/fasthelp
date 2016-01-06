<?php
class Mail_md extends CI_Model {
	//Central de e-mails
	//Powed by Maradona Morais
	public $mail;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->library("mailer");
		
		$this->mail = new Mailer();
		$this->mail->IsSMTP();
		$this->mail->Host = "smtp.gmail.com";
		$this->mail->SMTPAuth = true;
		$this->mail->isHTML(true);
		$this->mail->CharSet = "UTF-8";
		$this->mail->Username = "neep.dev@gmail.com";
		$this->mail->Password = "Facebook@42";
		$this->mail->SMTPSecure = "tls";
		$this->mail->Port = 587;
		
		$this->mail->From = "neep.dev@gmail.com";
		$this->mail->FromName = "fastHelp";
	}
	
	public function sendMail($assunto, $email, $msg) {
		$this->mail->Subject = $assunto;
		$this->mail->addAddress($email);
		$this->mail->Body = $this->templateIt($msg);
		if($this->mail->send()) {
			return true;
		} else {
			return false;
		}
	}
	
	public function sendDefaultMail($tipo, $email, $dados = null) {
		switch($tipo) {
			case "precadastro":
				$assunto = "Recebemos seu cadastro";
				$msg = "<p>Olá, <b>".$dados["nome"]."</b>.</p>
				<p>O cadastro do órgão que você representa foi recebido com sucesso! A sua etapa é <i>pré-cadastro</i>,
				isto significa que nossa equipe está avaliando os dados que você submeteu.</p>
				<p>No limite de 72 horas, sua conta estará pronta para acesso. Até lá você poderá receber ligações
				ou contato através de e-mail. Esta avaliação é importante para que tenhamos órgãos reais atuando na
				plataforma, evitando fraudes.</p>
				<p>Quando sua conta for aprovada você receberá um email explicando a forma de acesso ao sistema.</p>
				<p>Agradecemos por sua colaboração, seja bem-vindo ao <b>fastHelp</b>!</p>";
				break;
			case "conta_criada":
				$assunto = "Sua conta foi aprovada";
				$msg = "<p>Olá, <b>".$dados["nome"]."</b>.</p>
				<p>Sua inscrição no <b>fastHelp</b> obteve o estado de <i>APROVADA</i>. Você já pode ter acesso
				à plataforma!</p>
				<p>Para logar, você precisa entrar com seu e-mail (".$dados["email"].") e a senha gerada aleatoriamente, que é:</p>
				<table>
					<tr>
						<td class='padding'>
							<p class='btn-primary'>".$dados["senha"]."</p>
						</td>
					</tr>
				</table>
				<p>Esta senha é provisória, você poderá alterá-la no primeiro acesso</p>
				<p>Muito obrigado por escolher o <b>fastHelp</b>. Seja bem-vindo!</p>";
				break;
			case "conta_recusada":
				$assunto = "Seu cadastro foi recusado";
				$msg = "<p>Olá!</p>
				<p>A validação do seu registo no <b>fastHelp</b> foi finalizada e obteve reprovação pelo avaliador. 
				Foi contastado que você não representa um órgão público, ou o órgão não existe. Portanto, você não 
				poderá ter acesso ao nosso serviço.</p>
				<p>Caso considere que a avaliação não condiz com a realidade, ou seja, se o órgão realmente existe e
				você é um representante dele, entre em contato com nossa equipe para que a avaliação possa ser
				realizada novamente. Antes, você deve refazer o cadastro do órgão.</p>
				<p>O contato pode ser feito pelo e-mail: neep.dev@gmail.com</p>
				<p>Muito obrigado!</p>";
				break;
			case "novo_gerenciador":
				$assunto = "Bem vindo ao fastHelp";
				$msg = "<p>Olá, ".$dados['nome']." ".$dados['sobrenome']."!</p>
				<p>Você agora é gerenciador do <b>".$dados['orgao']."</b> na plataforma <b>fastHelp</b>. Você pode acessar
				sua área entrando no nosso site (clique na logomarca) e clicando em 'Acessar área restrita'. Deve
				informar seu email e sua senha provisória, que foi gerada automaticamente pelo nosso sistema.</p>
				<p>Sua senha provisória é:</p>
				<table>
					<tr>
						<td class='padding'>
							<p class='btn-primary'>".$dados["senha"]."</p>
						</td>
					</tr>
				</table>
				<p>Para conhecer um pouco mais sobre o que é o <b>fastHelp</b> acesse nosso site, lá tem uma área
				específica que explica detalhadamente o que a gente faz para ajudar no seu serviço.</p>
				<p>Muito obrigado. Seja bem vindo!</p>";
				break;
			case "senha_redefinida":
				$assunto = "Você redefiniu a senha";
				$msg = "<p>Olá, ".$dados['nome']." ".$dados['sobrenome']."!</p>
				<p>Recebemos um pedido de redefinição de senha, já que você esqueceu sua senha de acesso. Por favor, 
				se acha que não foi você quem solicitou esta alteração de senhas entre em contato com o fastHelp, 
				através do email neep.dev@gmail.com. Sua nova senha é:</p>
				<table>
					<tr>
						<td class='padding'>
							<p class='btn-primary'>".$dados["senha"]."</p>
						</td>
					</tr>
				</table>
				<p>Muito obrigado, faça um proveito do nosso sistema!</p>";
				break;
		}
		
		$this->sendMail($assunto, "maradona.morais@hotmail.com", $msg);
	}
	
	public function templateIt($mensagem) {
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Really Simple HTML Email Template</title>
<style>
/* -------------------------------------
		GLOBAL
------------------------------------- */
* {
	margin: 0;
	padding: 0;
	font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
	font-size: 100%;
	line-height: 1.6;
}
img {
	max-width: 100%;
}
body {
	-webkit-font-smoothing: antialiased;
	-webkit-text-size-adjust: none;
	width: 100%!important;
	height: 100%;
}
/* -------------------------------------
		ELEMENTS
------------------------------------- */
a {
	color: #348eda;
}
.btn-primary {
	text-decoration: none;
	color: #FFF;
	background-color: #348eda;
	border: solid #348eda;
	border-width: 10px 20px;
	line-height: 2;
	font-weight: bold;
	margin-right: 10px;
	text-align: center;
	cursor: pointer;
	display: inline-block;
	border-radius: 25px;
}
.btn-secondary {
	text-decoration: none;
	color: #FFF;
	background-color: #aaa;
	border: solid #aaa;
	border-width: 10px 20px;
	line-height: 2;
	font-weight: bold;
	margin-right: 10px;
	text-align: center;
	cursor: pointer;
	display: inline-block;
	border-radius: 25px;
}
.last {
	margin-bottom: 0;
}
.first {
	margin-top: 0;
}
.padding {
	padding: 10px 0;
}
/* -------------------------------------
		BODY
------------------------------------- */
table.body-wrap {
	width: 100%;
	padding: 20px;
}
table.body-wrap .container {
	border: 1px solid #f0f0f0;
}
/* -------------------------------------
		FOOTER
------------------------------------- */
table.footer-wrap {
	width: 100%;	
	clear: both!important;
}
.footer-wrap .container p {
	font-size: 12px;
	color: #666;
	
}
table.footer-wrap a {
	color: #999;
}
/* -------------------------------------
		TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
	font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	color: #000;
	margin: 40px 0 10px;
	line-height: 1.2;
	font-weight: 200;
}
h1 {
	font-size: 36px;
}
h2 {
	font-size: 28px;
}
h3 {
	font-size: 22px;
}
p, ul, ol {
	margin-bottom: 10px;
	font-weight: normal;
	font-size: 14px;
}
ul li, ol li {
	margin-left: 5px;
	list-style-position: inside;
}
/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display: block!important;
	max-width: 600px!important;
	margin: 0 auto!important; /* makes it centered */
	clear: both!important;
}
/* Set the padding on the td rather than the div for Outlook compatibility */
.body-wrap .container {
	padding: 20px;
}
/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	max-width: 600px;
	margin: 0 auto;
	display: block;
}
.content table {
	width: 100%;
}
</style>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap" bgcolor="#f6f6f6">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">

			<!-- content -->
			<div class="content">
			<table>
				<tr>
					<td>
						<a href="http://localhost/fH"><img src="http://s14.postimg.org/bwwy375b5/logo.png" width="110px"></a><br><br>
						'.$mensagem.'
						<!--COMO FAZER UM BOTÃO!!!
						<table>
							<tr>
								<td class="padding">
									<p><a href="https://github.com/leemunroe/html-email-template" class="btn-primary">View the source and instructions on GitHub</a></p>
								</td>
							</tr>
						</table>
						-->
					</td>
				</tr>
			</table>
			</div>
			<!-- /content -->
			
		</td>
		<td></td>
	</tr>
</table>
<!-- /body -->

<!-- footer -->
<table class="footer-wrap">
	<tr>
		<td></td>
		<td class="container">
			
			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td align="center">
							<p>&copy; 2015 Neep Development. Todos os direitos reservados.</p>
						</td>
					</tr>
				</table>
			</div>
			<!-- /content -->
			
		</td>
		<td></td>
	</tr>
</table>
<!-- /footer -->

</body>
</html>';
	return $body;
	}
}
?>
