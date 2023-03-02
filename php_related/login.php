<?php 
session_start();
if (!isset($_SESSION['user']['id'])) {
	header('location:index.php');
	exit;
}
include "includes/html_head.php";
?>

<body class="body-index">
	<!--including header navbar portion -->
	<?php include "includes/header.php"; ?>
	<section class="container">

	<div class="card mx-auto w-25 mt-5">
		<?php
		if(isset($_SESSION['login_error'])){
			echo '<div class="alert alert-danger mb-0" role="alert">';
	  		echo $_SESSION['login_error'];
			echo '</div>';
			unset($_SESSION['login_error']);
		}
		if(isset($_SESSION['unauth'])){
			echo '<div class="alert alert-danger mb-0" role="alert">';
	  		echo $_SESSION['unauth'];
			echo '</div>';
			unset($_SESSION['unauth']);
		}
		?>
		<form method="POST" autocomplete="off" action="database/process.php" enctype="multipart/form-data" class="align-middle">
			<div class="card-header"><h4 class="font-weight-bold text-center">Login</h4></div>
		<div class="card-body">
			<div class="form-group">
				<label for="mail">Email</label>
				<input type="email" name="email" placeholder="example@abc.com" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="password">password</label>
				<input type="password" name="password" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="user_type">User type :</label>
				<input type="radio" name="user_type" value="admin" class="custom-radio" required>&nbsp;Admin |
				<input type="radio" name="user_type" value="user" class="custom-radio" required>&nbsp;User
			</div>
			<div class="form-group text-center">
				<button type="submit" name="login" class="btn btn-primary ">Login</button>
			</div>
			<div class="form-group text-center">
				<p>Not a member <a href="registration.php">Register</a> yourself!</p>
			</div>
		</div>
		</form>
		</div>
	</section>
</body>
</html>