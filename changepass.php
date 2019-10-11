<?php 
	include "lib/User.php";
	include "inc/header.php";
	Session::checkSession();
?>

<?php
	if (isset($_GET['id'])) {
		$userId = (int)$_GET['id'];

		$sesid = Session::get("id");
		if ($userId != $sesid) {
			header("Location: index.php");
		}
	}


	$user = new User();

	// For Update user data start==========================
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatePass'])) {
		$updatepass = $user->updatepassword($userId, $_POST);
	}
?>


<section class="main">
	<div class="container">
		<div class="card bg-light my-md-4">
			<div class="card-header">
				<h2>Change Password<span class="float-right"><a class="btn btn-primary" href="profile.php?id=<?php echo $userId;  ?>">Profile</a></span></h2>
			</div>
			<div class="card-body pb-0">
				<div class="col-md-6 offset-md-3">
				<!--=========== for print update message start ===========-->
				<?php
					if (isset($updatepass)) {
						echo $updatepass;
					}
				?>
				<!--=========== for print update message end ===========-->
				</div>
				<div class="col-md-6 offset-md-3">

					<form action="" method="POST">

						<div class="form-group">
							<label for="old_pass">Old Password</label>
							<input type="password" id="old_pass" name="old_pass" class="form-control" autocomplete="off">
						</div>

						<div class="form-group">
							<label for="new_pass">New Password</label>
							<input type="password" id="new_pass" name="new_pass" class="form-control" autocomplete="off">
						</div>
						
						<div class="form-group">
							<input type="submit" name="updatePass" value="Update Password" class="btn btn-success">
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