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
				<a class="navbar-brand" href="?/">
					<img src="public/res/img/hp.png" width="200px">
				</a>
			</div>
		</div>
    </nav>
    <div class="jumbotron" id="header_panel">
		<div class="container">
			<div class="col-md-12">
				<h1><?php echo $title;?></h1>
				<p><?php echo $desc;?></p>
				<p><a class="btn btn-success" href="<?php echo $bt_url; ?>"><?php echo $bt_text; ?></a></p>
			</div>
		</div>
    </div>
    
