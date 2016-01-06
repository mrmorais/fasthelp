<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>fastHelp</title>

    <link href="public/res/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/res/css/maradona.css" rel="stylesheet">
    <link href="public/assets-dg/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="public/assets-dg/css/AdminLTE.css" rel="stylesheet" />
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4QfctSLm0DcYa_pygU0764RhqW__4V2A">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: { lat: -5.6578847, lng: -37.7954813},
          zoom: 14
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			<div class="navbar-header">
				<a class="navbar-brand" href="?/Page">
					<img src="public/res/img/hp.png" width="200px">
				</a>
			</div>
			
		</div>
    </nav>
    <div class="jumbotron" id="header_panel">
		<div class="container">
			<div class="col-md-2">
				<img src="public/img/avatar/<?php echo $profile->img; ?>" width="100%">
			</div>
			<div class="col-md-10">
				<h1><?php echo $orgao['nome']." -  ".$orgao['cidade'].", ".$orgao['estado']; ?></h1><hr>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star-o"></i>
				<i class="fa fa-star-o"></i>
				(120 avaliações)
			</div>
		</div>
    </div>
    <div class="container">
		<div class="col-md-4">
			<div class="row col-md-12">
				<!--GOOGLEMAPS-->
				<div class="row panel panel-default">
					<div class="panel-heading"><strong>Localização</strong></div>
					<div class="panel-body" id="map-canvas" style="height:200px;"></div>
				</div>
				<!--/GOOGLEMAPS-->
				<!--DESCRIÇÃO-->
				<div class="row panel panel-default">
					<div class="panel-heading"><strong>Descrição</strong></div>
					<div class="panel-body">
						<p class="text-justify">
							<?php echo $profile->descricao; ?>
						</p>
					</div>
				</div>
				<!--/DESCRIÇÃO-->
				<!--INFORMAÇÕES-->
				<div class="row panel panel-default">
					<div class="panel-heading"><strong>Informações</strong></div>
					<div class="panel-body">
						<p class="text-justify">
							<strong>Cidade: </strong><?php echo $orgao['cidade'].", ".$orgao['estado']; ?><br>
							<strong>Endereço: </strong><?php echo $orgao['endereco']; ?><br>
							<strong>Telefone: </strong><?php echo $orgao['telefone']; ?>
						</p>
					</div>
				</div>
				<!--/INFORMAÇÕES-->
			</div>
		</div>
		<div class="col-md-8">
			<div class="row col-md-12">
					<!-- The time line -->
				  <ul class="timeline">
					<!-- timeline time label -->
					<li class="time-label">
					  <span class="bg-red">
						10 Feb. 2014
					  </span>
					</li>
					<!-- /.timeline-label -->
					<!-- timeline item -->
					<li>
					  <i class="fa fa-envelope bg-blue"></i>
					  <div class="timeline-item">
						<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
						<h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
						<div class="timeline-body">
						  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
						  weebly ning heekya handango imeem plugg dopplr jibjab, movity
						  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
						  quora plaxo ideeli hulu weebly balihoo...
						</div>
						<div class="timeline-footer">
						  <a class="btn btn-primary btn-xs">Read more</a>
						  <a class="btn btn-danger btn-xs">Delete</a>
						</div>
					  </div>
					</li>
					<!-- END timeline item -->
					<!-- timeline item -->
					<li>
					  <i class="fa fa-user bg-aqua"></i>
					  <div class="timeline-item">
						<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
						<h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
					  </div>
					</li>
					<!-- END timeline item -->
					<!-- timeline item -->
					<li>
					  <i class="fa fa-comments bg-yellow"></i>
					  <div class="timeline-item">
						<span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
						<h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
						<div class="timeline-body">
						  Take me to your leader!
						  Switzerland is small and neutral!
						  We are more like Germany, ambitious and misunderstood!
						</div>
						<div class="timeline-footer">
						  <a class="btn btn-warning btn-flat btn-xs">View comment</a>
						</div>
					  </div>
					</li>
					<!-- END timeline item -->
					<!-- timeline time label -->
					<li class="time-label">
					  <span class="bg-green">
						3 Jan. 2014
					  </span>
					</li>
					<!-- /.timeline-label -->
					<!-- timeline item -->
					<li>
					  <i class="fa fa-camera bg-purple"></i>
					  <div class="timeline-item">
						<span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
						<h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
						<div class="timeline-body">
						  <img src="http://placehold.it/150x100" alt="..." class="margin" />
						  <img src="http://placehold.it/150x100" alt="..." class="margin" />
						  <img src="http://placehold.it/150x100" alt="..." class="margin" />
						  <img src="http://placehold.it/150x100" alt="..." class="margin" />
						</div>
					  </div>
					</li>
					<!-- END timeline item -->
					<!-- timeline item -->
					<li>
					  <i class="fa fa-video-camera bg-maroon"></i>
					  <div class="timeline-item">
						<span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>
						<h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
						<div class="timeline-body">
						  <div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" frameborder="0" allowfullscreen></iframe>
						  </div>
						</div>
						<div class="timeline-footer">
						  <a href="#" class="btn btn-xs bg-maroon">See comments</a>
						</div>
					  </div>
					</li>
					<!-- END timeline item -->
					<li>
					  <i class="fa fa-clock-o bg-gray"></i>
					</li>
				  </ul>
				  <!--END all timeline--><br>
			</div>
		</div>
    </div>
