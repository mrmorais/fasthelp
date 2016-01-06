<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Maradona Morais">

    <title>fastHelp</title>

    <!-- Bootstrap core CSS -->
    <link href="public/assets-dg/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="public/assets-dg/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="public/assets-dg/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="public/assets-dg/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="public/assets-dg/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="public/assets-dg/css/style.css" rel="stylesheet">
    <link href="public/assets-dg/css/style-responsive.css" rel="stylesheet">

    <script src="public/assets-dg/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
 <!--main content start-->
      <section id="main-content">
		  <section class="wrapper">
			  <div class="row">
                  <div class="col-lg-12">
					  <div class="panel">
						<div class="panel-body">
							<div class="col-md-4 text-center">
							<?php
								switch($tipo) {
									case "error":
										echo '<i style="font-size:190pt;" class="fa fa-exclamation-circle fa-5x"></i>';
										break;
									case "success":
										echo '<i style="font-size:190pt;" class="fa fa-check fa-5x"></i>';
										break;
								}
							?>
							
							</div>
							<div class="col-md-8">
								<?php
									switch($msg) {
										case "email_enviado":
											$titulo = "Sucesso ao enviar o(s) email(s)";
											$desc = "Garantimos que a maioria dos notificados serão atendidos!";
											$retorno = "?/Renub";
											break;
										case "sucesso_gerente_encerrar":
											$titulo = "Gerente excluído com sucesso!";
											$desc = "Você desativou a conta de um gerente!";
											$retorno = "?/Renub/orgaos";
											break;
										case "sucesso_orgao_encerrar":
											$titulo = "O órgão foi encerrado com sucesso!";
											$desc = "O órgão e todos os gerentes foram excluídos!";
											$retorno = "?/Renub/orgaos";
											break;
										case "qualquer_erro":
											$titulo = "Houve algum erro não esperado!";
											$desc = "Tente novamente mais tarde!";
											$retorno = "?/Renub";
											break;
									}
								?>
								
								<h2><?php echo $titulo; ?></h2>
								<p class="text-justify">
									<?php echo $desc; ?>
								</p>
								<a href="<?php echo $retorno; ?>"><button class="btn btn-info">Retornar</button></a>
							</div>
							
						</div>
					  </div>
 				  </div>
 			  </div>
          </section>
      </section>

  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="public/assets-dg/js/jquery.js"></script>
    <script src="public/assets-dg/js/jquery-1.8.3.min.js"></script>
    <script src="public/assets-dg/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="public/assets-dg/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="public/assets-dg/js/jquery.scrollTo.min.js"></script>
    <script src="public/assets-dg/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="public/assets-dg/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="public/assets-dg/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="public/assets-dg/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="public/assets-dg/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="public/assets-dg/js/sparkline-chart.js"></script>    
	<script src="public/assets-dg/js/zabuto_calendar.js"></script>	
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>
