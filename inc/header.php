<?php 

	$filePath = realpath(dirname(__FILE__));
	include_once $filePath.'/../lib/Session.php';
	Session::init();

	ob_start();
?>	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DYNAMIC LOGIN-REGISTER WITH PHP OOP & PDO</title>

	<!--============ bootstrap-supported-CSS-file ==============-->
	<link rel="stylesheet" href="lib/css/bootstrap.min.css">
	<!--============ bootstrap-supported-CSS-file ==============-->
	<!-- search bar and pagenation files -->
	<link rel="stylesheet" href="lib/css/datatable.min.css">

	<style>
		.page-navigation a {
		  margin: 0 2px;
		  display: inline-block;
		  padding: 3px 5px;
		  color: #ffffff;
		  background-color: #70b7ec;
		  border-radius: 5px;
		  text-decoration: none;
		  font-weight: bold;
		}

		.page-navigation a[data-selected] {
		  background-color: #3d9be0;
		}
	</style>

</head>

	<?php

		if (isset($_GET['action']) && $_GET['action'] == "logout") {
			Session::destroy();
		}

	?>

	<body>

		<header>
			<div class="container">
				<div class="card">
					<nav class="navbar navbar-expand-lg navbar-light ">
					  <a class="navbar-brand text-dark" href="index.php"><h2>Login Register System PHP & PDO</h2></a>
					  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					    <span class="navbar-toggler-icon"></span>
					  </button>

					  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					    <ul class="navbar-nav ml-auto">

						<?php
							$id = Session::get("id");
							$userLogin = Session::get("login");

						if ($userLogin == true) { ?>

					      <li class="nav-item active">
					        <a class="nav-link text-dark" href="profile.php?id=<?php echo $id; ?>">Profile <span class="sr-only">(current)</span></a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link text-dark" href="?action=logout">Logout</a>
					      </li>

						<?php }else{ ?>

					     <h2>User Login</h2>
					      
						<?php } ?>

					    </ul>
					  </div>
					</nav>
				</div>
			</div>
		</header>