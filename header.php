<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Agenda de Contatos</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.mask.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/override.css">
	<script type="text/javascript" src="js/override.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-sm">
		<a href="#" class="navbar-brand">Agenda</a>
		<ul class="navbar-nav">
			<li class="nav-item dropdown bg-dark btnDrop text-center">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Cadastro</a>
				<div class="dropdown-menu" style="border-radius: 10px;">
					<ul class="nav nav-tabs menu-dropdown">
						<li>
							<a href="#contact" data-toggle="tab" class="dropdown-item">Contato</a>
						</li>
						<li>
							<a href="#address" data-toggle="tab" class="dropdown-item">Endereço</a>	
						</li>
						<li>
							<a href="#phone" data-toggle="tab" class="dropdown-item">Telefone</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item divSearch">
				<form class="form-inline" action="#">
					<input class="form-control" autocomplete="off" id="searchInput" type="text" name="searchInput" onkeydown="getScreenContactsSearch(this.value)">
					<i class="fa fa-search" aria-hidden="true"></i>
				</form>
			</li>
		</ul>
	</nav>