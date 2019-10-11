<?php 
	include "inc/header.php";
	include "lib/User.php";

	Session::checkLogin();

?>

<?php
	$user = new User();

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
		$userLog = $user->userLogin($_POST);
	}

?>

		<section class="main">
			<div class="container">
				<div class="card bg-light my-md-4">
					<div class="card-body pb-0">
						<div class="col-md-4 offset-md-4">

							<?php
								if (isset($userLog)) {
									echo $userLog;
								}
							?>
							<div class="text-center">
								<a href="login.php"><img src="image/logo.png" alt="LOGO"></a>
								<h2 class="mb-5">Sign in to Our Site</h2>
							</div>

							<form action="" method="POST">
								<div class="form-group">
									<label for="email">Enter Your Email Address</label>
									<input type="email" id="email" name="email" class="form-control" autocomplete="off">
								</div>
								<div class="form-group">
									<label for="password">Your Password</label>
									<a class="float-right" href="forgetpass/forget.php">Forgot password?</a>
									<input type="password" id="password" name="password" class="form-control" autocomplete="off">
								</div>
								<div class="form-group">
									<input type="submit" name="login" value="Sign In" class="btn btn-success btn-block">
								</div>
							</form>
						<div class="card bg-light my-md-4">
							<div class="card-body py-3">
								<span>New to Our Site? <a href="register.php">Create an account.</a></span>
							</div>
						</div>

						</div>
					</div>
				</div>
			</div>
		</section>
	

<?php 
	include "inc/footer.php";
?>