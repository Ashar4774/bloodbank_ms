<?php
session_start();
include "includes/html_head.php";
?>

<body class="body-index">
	<!--Navbar-->
	<?php include "includes/header.php"; ?>
	<!--Form -->
	<section class="container my-5">
	<h1 class="h1-index my-5 text-center">Register yourself it's Easy!!</h1>
	<!-- Registration Form -->
	<div class="row">
		<div class="card mx-auto w-25">
		<?php
		if(isset($_SESSION['password_warning'])){
		echo '<div class="alert alert-danger mb-0" role="alert">';
  		echo	$_SESSION['password_warning'];
		echo '</div>';
		unset($_SESSION['password_warning']);
		}
		
		if(isset($_SESSION['signup'])){
		echo '<div class="alert alert-success mb-0" role="alert">';
  		echo	$_SESSION['signup'];
		echo '</div>';
		unset($_SESSION['signup']);
		}
		
		if(isset($_SESSION['duplicate'])){
		echo '<div class="alert alert-danger mb-0" role="alert">';
  		echo	$_SESSION['duplicate'];
		echo '</div>';
		unset($_SESSION['duplicate']);
		}
		?>
		<form method="POST" autocomplete="off" action="database/process.php" enctype="multipart/form-data" class="align-middle">
			<div class="card-header"><h4 class="font-weight-bold text-center">Registration Form</h4></div>
			<div class="card-body">
			<div class="form-group">
				<label for="fname">first Name</label>
				<input type="text" name="fname" placeholder="Enter your first name" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="lname">last Name</label>
				<input type="text" name="lname" placeholder="Enter your last name" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Image</label>
				<input type="file" name="image" class="img" >
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" placeholder="example@abc.com" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="password">password</label>
				<input type="password" name="password" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="cpassword">Confirm password</label>
				<input type="password" name="cpassword" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="gender">Gender</label>
				<select name="gender" class="form-control" required>
					<option value=""></option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
			</div>
			<div class="form-group">
				<label for="user_type">User type :</label>
				<input type="radio" name="user_type" value="admin" class="custom-radio" required>&nbsp;Admin |
				<input type="radio" name="user_type" value="user" class="custom-radio" required>&nbsp;User
			</div>
			<div class="form-group text-center">
				<button type="submit" name="register" class="btn btn-primary ">Register</button>
			</div>
			<div class="form-group text-center">
				<p>Already a member <a href="login.php">Login</a>!</p>
			</div>
			</div>
		</div>
		</form>
	</div>
	</section>
	<!-- ------------------------ -->

</body>
</html>