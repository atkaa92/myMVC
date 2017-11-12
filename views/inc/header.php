<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="/">Ka3en</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="/pages/about">About Us</a></li>
					<li><a href="/posts">Posts</a></li>
					<li><a href="/users">Users</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php if(isset($_SESSION['id'])): ?>
						<li><a><input type="text" class="form-control" placeholder="Search" id="searchedText"></a></li>
					    <li><a><button type="submit" class="btn btn-default" id="search">Search</button></a></li>
					    <li><a href="/users/user"><i class="fa fa-address-card-o" style="color:#9d9d9d"></i> My Page</a></li>
						<li><a href="/users/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	 				<?php else: ?>
						<li><a href="/users/register"><span class="glyphicon glyphicon-user"></span> Register</a></li>
						<li><a href="/users/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	 				<?php endif; ?>
				</ul>

			</div>
		</nav>
		<br>
		<div class="container">
 			<div class="row">


 				
 					
