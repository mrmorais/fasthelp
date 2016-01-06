<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Maradona Morais">

    <title><?php echo $orgao['nome']; ?> - fastHelp</title>

    <!-- Bootstrap core CSS -->
    <link href="public/assets-dg/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="public/assets-dg/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="public/assets-dg/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="public/assets-dg/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="public/assets-dg/lineicons/style.css">
    <style>
	#talkie-cont {
		overflow-y: scroll;
		max-height: 500px;
	}
	.msg {
		font-size: 16px;
		color:#000048;
		margin-bottom:5px;
		margin-left:20px;
		margin-right:20px;
	}
	.msg div {
		padding:20px;
		border-radius:20px;
	}
	.user div{
		background: #F8F8F8;
	}
	.orgao div {
		background: #68DFF0;
	}
    </style> 
    
    <!-- Custom styles for this template -->
    <link href="public/assets-dg/css/style.css" rel="stylesheet">
    <link href="public/assets-dg/css/style-responsive.css" rel="stylesheet">
    
    <!--Sweet Alert-->
    <link href="public/sweet-alert/sweetalert.css" rel="stylesheet">

    <script src="public/assets-dg/js/chart-master/Chart.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4QfctSLm0DcYa_pygU0764RhqW__4V2A">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: { lat: <?php echo $chamado->lat; ?>, lng: <?php echo $chamado->lng; ?>},
          zoom: 16
        };
        var map = new google.maps.Map(document.getElementById('map'),
            mapOptions);
        var myLatlng = new google.maps.LatLng(<?php echo $chamado->lat; ?>, <?php echo $chamado->lng; ?>);
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: "Local do chamado",
			icon: "<?php echo $usuario->statusToImage($usuario->status, $usuario->alert); ?>"
		});
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>

  <body><div id="sound"></div>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Abrir/Fechar Menu"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b><img src="public/assets-dg/img/logo.png" width="200px"></b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-bell"></i>
                            <span class="badge bg-theme">+10</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">DashGum Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="public/assets-dg/img/ui-zac.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hi mate, how is everything?
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="public/assets-dg/img/ui-divya.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Divya Manian</span>
                                    <span class="time">40 mins.</span>
                                    </span>
                                    <span class="message">
                                     Hi, I need your help with this.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="public/assets-dg/img/ui-danro.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dan Rogers</span>
                                    <span class="time">2 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Love your new Dashboard.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="public/assets-dg/img/ui-sherman.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Dj Sherman</span>
                                    <span class="time">4 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Please, answer asap.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="?/Main/sair">Sair</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <?php include("sidebar.php"); ?>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
		  <section class="wrapper">
			  <div class="row">
                  <div class="col-lg-12">
					  <h3>Chamado - 42<?php echo $chamado->id; ?></h3>
					  <div class="panel">
						<div class="panel-body">
							<h4>Protocolo</h4>
							<div class="row">
								<div class="col-md-2">
									<img width="100%" src="<?php echo $chamado->codigoToImage($chamado->codigo); ?>">
								</div><!--/.col-->
								<div class="col-md-6">
									<h4><b><?php echo $chamado->titulo; ?></b></h4>
									<h4>Localização: <?php echo $chamado->endereco." - ".$chamado->cidade."/".$chamado->estado; ?></h4>
									<h4>Data e hora: <?php echo $chamado->data." às ".$chamado->hora; ?></h4>
									<hr><h4><b>Usuário</b></h4>
									<h4>Nome: <?php echo $usuario->nome." ".$usuario->sobrenome; ?></h4>
									<h4>Status: <img src="<?php echo $usuario->statusToImage($usuario->status, $usuario->alert); ?>"></h4>
									<?php
									if ($chamado->status < 4) {
										if ($chamado->hasOrgaoAtendimento($orgao['id'])) {
									?>
									<a href="?/Main/chamado/<?php echo $chamado->id; ?>/encerrar" class="btn btn-danger">Encerrar chamado</a>
									<?php
										} else {
									?>
									<a href="?/Main/chamado/<?php echo $chamado->id; ?>/atender" class="btn btn-success">Atender chamado</a>
									<a href="?/Main/chamado/<?php echo $chamado->id; ?>/recusar" class="btn btn-danger">Recusar chamado</a>
									<?php }
									}
									if ($chamado->status==4) {
										echo "<h4>Encerrado</h4>";
									}
									if ($chamado->status==5) {
										echo "<h4>Recusado</h4>";
									}
									?>
								</div><!--/.col-->
								<div class="col-md-4">
									<div id="map" style="height:300px;">
									</div>
								</div>
							</div><!--/.row-->
						</div>
					  </div>
					  <div class="panel col-md-6">
						<div class="panel-body">
							<h4>Comunicação</h4>
							<div id="talkie-cont">
								<i class="fa fa-spinner fa-pulse"></i> Aguarde. Carregando as mensagens...	
							</div><br>
							<div>
								<form class="form" id="msg-input">
									<div class="form-group">
										<input id="msg-value" type="text" class="form-control" placeholder="Escreva aqui (pressione [ENTER] para enviar)" autocomplete="off">
									</div>
								</form>
							</div>
						</div>
					  </div>
 				  </div>
 			  </div>
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              © 2015 Neep Development. Todos os direitos reservados. 
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
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
	
	<!--Notificador do sistema-->
	<script src="public/sweet-alert/sweetalert.min.js"></script>
	<script src="public/sys/notificador.js"></script>
	<script src="public/sys/messenger.js"></script>
	<script>
	$(function() {
		doMessenger(<?php echo $chamado->id; ?>);
	});
	</script>
  
	<script type="text/javascript">
	var _urq = _urq || [];
	_urq.push(['initSite', '359e9fc7-f574-4164-b9b9-008079b324b7']);
	(function() {
	var ur = document.createElement('script'); ur.type = 'text/javascript'; ur.async = true;
	ur.src = ('https:' == document.location.protocol ? 'https://cdn.userreport.com/userreport.js' : 'http://cdn.userreport.com/userreport.js');
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ur, s);
	})();
	</script>
  </body>
</html>
