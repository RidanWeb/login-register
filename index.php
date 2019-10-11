<?php 
	include "lib/User.php";
	include "inc/header.php";
	Session::checkSession();
?>

		<section class="main">
			<div class="container">
				<div class="mt-md-4">
					<?php 

						$loginMsg = Session::get("loginMsg");

						if (isset($loginMsg)) {
							echo $loginMsg;
						}
						Session::set("loginMsg", NULL);

					?>
				</div>
				<div class="card bg-light my-md-4">
					<div class="card-header">
						<h2>User List<span class="float-right">Welcome!<strong>
						<?php 

							$name = Session::get("username");

							if (isset($name)) {
								echo $name;
							}

						?>
						</strong></span></h2>
					</div>
					<div class="card-body pb-0">
						<table id="myTable" class="table">
						  <thead>
						    <tr>
						      <th scope="col">Serial</th>
						      <th scope="col">Name</th>
						      <th scope="col">User Name</th>
						      <th scope="col">Email</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <?php
						  	$user = new User();
						  	$userData = $user->getUserData();
						  	if ($userData) {
						  		$i = 0;
						  		foreach ($userData as $sdata) {
						  			$i++;
						  	?>
						  <tbody>
						    <tr>
						      <th><?php echo $i; ?></th>
						      <td><?php echo $sdata['name']; ?></td>
						      <td><?php echo $sdata['username']; ?></td>
						      <td><?php echo $sdata['email']; ?></td>
						      <td>
						      	<a class="btn btn-primary" href="profile.php?id=<?php echo $sdata['id']; ?>">View</a>
						      </td>
						    </tr>
						  </tbody>

						<?php } }else{ ?> 
							<tr>
								<td colspan="5"><h3 class="text-center text-danger">No User Data Found!</h3></td>
							</tr>
						<?php } ?>	

						</table>
					</div>
				</div>
			</div>
		</section>
	


<?php 

	include "inc/footer.php";
?>