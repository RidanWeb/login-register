<?php 
	include "inc/header.php";
	include "lib/User.php";

?>

<?php
	$user = new User();

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
		$userReg = $user->userRegistration($_POST);
	}

?>


		<section class="main">
			<div class="container">
				<div class="card bg-light my-md-4">
					<div class="card-header">
						<span style="    font-size: 30px;font-weight: 700;font-family: arial;">User Registration</span>
						<span style="    font-size: 30px;font-weight: 700;font-family: arial;"><a class="float-right" href="login.php">Login</a></span>
					</div>
					<div class="card-body pb-0">
						<div class="col-md-6 offset-md-3">

							<?php
								if (isset($userReg)) {
									echo $userReg;
								}
							?>


							<form action="" method="POST">

								<div class="form-group">
									<label for="name">Your Name</label>
									<input type="text" id="name" name="name" class="form-control" autocomplete="off">
								</div>

								<div class="form-group">
									<label for="username">Your Username</label>
									<input type="text" id="username" name="username" class="form-control" autocomplete="off">
								</div>

								<div class="form-group">
									<label for="email">Email Address</label>
									<input type="email" id="email" name="email" class="form-control" autocomplete="off">
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" id="password" name="password" class="form-control" autocomplete="off">
								</div>

								<div class="form-group">
									<input type="submit" name="register" value="Registration" class="btn btn-success">
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	

<?php 
	include "inc/footer.php";
?>