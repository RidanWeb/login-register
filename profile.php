<?php 
	include "lib/User.php";
	include "inc/header.php";
	Session::checkSession();
?>

<?php
	if (isset($_GET['id'])) {
		$userId = (int)$_GET['id'];
	}
	$user = new User();

	// For Update user data start==========================
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
		$updateUsr = $user->updateUserData($userId, $_POST);
	}
?>


<section class="main">
	<div class="container">
		<div class="card bg-light my-md-4">
			<div class="card-header">
				<h2>User Profile<span class="float-right"><a class="btn btn-primary" href="index.php">Home</a></span></h2>
			</div>
			<div class="card-body pb-0">
				<div class="col-md-6 offset-md-3">
				<!--=========== for print update message start ===========-->
				<?php
					if (isset($updateUsr)) {
						echo $updateUsr;
					}
				?>
				<!--=========== for print update message end ===========-->
				</div>
				<div class="col-md-6 offset-md-3">
					<!--======== for read user data ========-->
					<?php
						$userData = $user->getUserById($userId);
						if ($userData) {
						
					?>

					<form action="" method="POST">

						<div class="form-group">
							<label for="name">Your Name</label>
							<input type="text" id="name" name="name" class="form-control" value="<?php echo $userData->name; ?>" autocomplete="off">
						</div>

						<div class="form-group">
							<label for="username">Your Username</label>
							<input type="text" id="username" name="username" class="form-control" value="<?php echo $userData->username; ?>" autocomplete="off">
						</div>

						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="email" id="email" name="email" class="form-control" value="<?php echo $userData->email; ?>" autocomplete="off">
						</div>
						<!--============ for hide and show update button start ============-->
						<?php
							$sesid = Session::get("id");
							if ($userId == $sesid) {
						?>

						<div class="form-group">
							<input type="submit" name="update" value="Update" class="btn btn-success">
							<a class="btn btn-info" href="changepass.php?id=<?php echo $userId; ?>">Change password</a>
						</div>
						
						<?php } ?>	
						<!--============ for hide and show update button end ============-->
					</form>

				<?php }else{ ?>
					<h3 class="text-danger text-center">This Id Has No Data...!</h3>
				<?php
					}
				?>

				</div>
			</div>
		</div>
	</div>
</section>
	

<?php 
	include "inc/footer.php";
?>