<?php
//session start
session_start();
//connection with DB
include "connection.php";
//for User Registration
if (isset($_POST['register'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$gender = $_POST['gender'];
	$user_type = $_POST['user_type'];
	//for img value
	$img = $_FILES['image'];
	$img_name = $img['name'];
	$img_temp = $img['tmp_name'];
	$folder = '../images/users/' . $img_name;
	move_uploaded_file($img_temp, $folder);
	//password matched or not
	if ($password != $cpassword) {
		$_SESSION['password_warning'] = "Password do not match!";
		header('location:../registration.php');
	} else {
		//check duplication of email
		$duplicate = "SELECT * FROM registration WHERE `email`='$email'";
		$check = $conn->query($duplicate);
		if ($check->fetch_assoc() == TRUE) {
			$_SESSION['duplicate'] = "Email already exist!";
			header('location:../registration.php');
		} else {
			//query for inserting data in registration table
			$sql = "INSERT INTO `registration`(user_image,first_name,last_name,email,password,gender,user_type) VALUES ('" . $img_name . "','" . $fname . "','" . $lname . "','" . $email . "','" . $password . "','" . $gender . "','" . $user_type . "')";
			if ($conn->query($sql) == TRUE) {
				$_SESSION['signup'] = "User has been registered successfully!";
				header('location:../registration.php');
			} else {
				echo "Error" . $sql . "<br>" . $conn->error;
			}
		}
	}
}

//for login
if (isset($_POST['login'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];
	$user_type = $_POST['user_type'];

	if (empty($email) && empty($password) && empty($user_type)) {
		header('location:../login.php');
		exit;
	} else {
		$sql = "SELECT * FROM registration WHERE `email`='$email' AND `password`='$password' AND `user_type`='$user_type'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if ($row == TRUE && $user_type == 'admin') {
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_fname'] = $row['first_name'];
			$_SESSION['user_lname'] = $row['last_name'];
			$_SESSION['user_image'] = $row['user_image'];
			$_SESSION['user_email'] = $row['email'];
			$_SESSION['user_password'] = $row['password'];
			$_SESSION['user_gender'] = $row['gender'];
			$_SESSION['user_type'] = 'admin';
			$_SESSION['admin'] = 'admin';
			header('location:../admin/index.php');
		} elseif ($row == TRUE && $user_type == 'user') {
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_fname'] = $row['first_name'];
			$_SESSION['user_lname'] = $row['last_name'];
			$_SESSION['user_image'] = $row['user_image'];
			$_SESSION['user_email'] = $row['email'];
			$_SESSION['user_password'] = $row['password'];
			$_SESSION['user_gender'] = $row['gender'];
			$_SESSION['user_type'] = 'user';
			$_SESSION['user'] = 'user';
			header('location:../index.php');
		} else {
			$_SESSION['login_error'] = "Incorrect Username/Password!";

			header('location:../login.php');
		}
	}
}


//for organization
// Add
if (isset($_POST['add_org_btn'])) {
	$org_name = $_POST['org_name'];
	$org_address = $_POST['org_address'];
	$org_phone = $_POST['org_phone'];


	//insert data into database
	$sql = "INSERT INTO `organizations`(name,address,phone_no) VALUES ('" . $org_name . "','" . $org_address . "','" . $org_phone . "')";
	if ($conn->query($sql) === TRUE) {
		$_SESSION['org_success'] = "Organization has been added successfully!";
		header('location:../index_organization.php');
	} else {
		echo "Error" . $sql . "<br>" . $conn->error;
	}
}

// Delete
if (isset($_GET['dlt_org'])) {
	$dlt_org = $_GET['dlt_org'];
	$query = "SELECT * FROM `organizations` WHERE `id` = $dlt_org";
	$result = $conn->query($query);
	if ($result == true) {
		$row = $result->fetch_assoc();
		$id = $row['id'];
		//  query for blood detail info
		$query_blood = "SELECT * FROM `blood_types` WHERE `org_id` = $id";
		$result_blood = $conn->query($query_blood);
		if ($result_blood == true) {
			while ($row_blood = $result_blood->fetch_assoc()) {
				$blood_id = $row_blood['id'];
				$delete_blood = "DELETE FROM `blood_types` WHERE `id`= $blood_id";
				$conn->query($delete_blood);
			}
		}

		// query for donar if has any in this organization
		$query_donar = "SELECT * FROM `donars` WHERE `org_id` = $id";
		$result_donar = $conn->query($query_donar);
		if ($result_donar == true) {
			while ($row_donar = $result_donar->fetch_assoc()) {
				$donar_id = $row_donar['id'];
				$delete_donar = "DELETE FROM `donars` WHERE `id`= $donar_id";
				$conn->query($delete_donar);
			}
		}
		$org_delete = "DELETE FROM `organizations` WHERE `id`= $id";
		$conn->query($org_delete);
		$_SESSION['org_delete'] = "Organization and its associated record  has been deleted successfully!";
		header('location:../index_organization.php');
	}
}

//for blood detail
// Add
if (isset($_POST['add_blood_detail_btn'])) {
	$abo_type = $_POST['abo_type'];
	$rh_system = $_POST['rh_system'];
	$org_id = $_POST['org_id'];

	$existed_sql = "SELECT * FROM `blood_types` WHERE abo_type = '$abo_type' AND rh_system = '$rh_system'";
	$existed_result = $conn->query($existed_sql);
	$existed_row = mysqli_fetch_assoc($existed_result);
	$id = $existed_row['id'];
	$count = mysqli_num_rows($existed_result);
	if (mysqli_num_rows($existed_result) > 0) {
		// print_r($count);
		$count = $existed_row['count'] + 1;
		$update_sql = "UPDATE `blood_types` SET count = $count WHERE id = $id";
		// $update_result = $conn->query($update_sql);
		if ($conn->query($update_sql) === TRUE) {
			$_SESSION['blood_success'] = "Blood detail has been added successfully!";
			header('location:../index_blood_detail.php');
		} else {
			echo "Error" . $sql . "<br>" . $conn->error;
		}
	} else {
		//insert data into database
		$sql = "INSERT INTO `blood_types`(abo_type, rh_system, org_id, count) VALUES ('" . $abo_type . "','" . $rh_system . "','" . $org_id . "', 1)";
		if ($conn->query($sql) === TRUE) {
			$_SESSION['blood_success'] = "Blood detail has been added successfully!";
			header('location:../index_blood_detail.php');
		} else {
			echo "Error" . $sql . "<br>" . $conn->error;
		}
	}
}


// Update
if (isset($_POST['update_blood_detail_btn'])) {
	$blood_detail_id = $_POST['blood_detail_id'];
	$abo_type = $_POST['abo_type'];
	$rh_system = $_POST['rh_system'];
	$org_id = $_POST['org_id'];
	// get record from db, and match if updated record is same or not, if no update the record
	$query_exist = "SELECT * FROM `blood_types` WHERE `abo_type` = $abo_type AND `rh_system` = $rh_system AND `org_id` = $org_id";
	$result_exist = $conn->query($query);
	$row_exist = $result->fetch_row();
	print_r($row_exist);
	// if( ($update_abo_type == $row_exist['abo_type']) && ($update_rh_system == $row_exist['rh_system']) && ($update_org == ))
}

// Delete
if (isset($_GET['dlt_blood_detail'])) {
	$dlt_blood_detail = $_GET['dlt_blood_detail'];
	$query = "SELECT * FROM `blood_types` WHERE `id` = $dlt_blood_detail";
	$result = $conn->query($query);
	if ($result == TRUE) {
		$row = $result->fetch_assoc();
		$id = $row['id'];
		// print_r($row);
		if ($row['count'] > 1) {
			$count = $row['count'] - 1;
			$update_sql = "UPDATE `blood_types` SET `count` = $count WHERE id = $id";
			$update_result = $conn->query($update_sql);
		} elseif ($row['count'] == 1) {
			$dlt_sql = "DELETE FROM `blood_types` WHERE `id` = $id";
			$dlt_result = $conn->query($dlt_sql);
		}
		$_SESSION['blood_delete'] = "Blood detail has been deleted successfully!";
		header('location:../index_blood_detail.php');
	}
}

//for donar detail
// Add
if (isset($_POST['add_donar_detail_btn'])) {
	$donar_name = $_POST['donar_name'];
	$donar_phone_no = $_POST['donar_phone_no'];
	$donar_address = $_POST['donar_address'];
	$abo_type = $_POST['abo_type'];
	$rh_system = $_POST['rh_system'];
	$org_id = $_POST['org_id'];

	$sql = "INSERT INTO `donars`(org_id , name, address, phone_no, abo_type, rh_system) VALUES ('" . $org_id . "', '" . $donar_name . "','" . $donar_address . "','" . $donar_phone_no . "','" . $abo_type . "','" . $rh_system . "')";
	if ($conn->query($sql) === TRUE) {
		$existed_sql = "SELECT * FROM `blood_types` WHERE abo_type = '$abo_type' AND rh_system = '$rh_system'";
		$existed_result = $conn->query($existed_sql);
		$existed_row = mysqli_fetch_assoc($existed_result);
		$id = $existed_row['id'];
		$count = mysqli_num_rows($existed_result);
		if (mysqli_num_rows($existed_result) > 0) {
			// print_r($count);
			$count = $existed_row['count'] + 1;
			$update_sql = "UPDATE `blood_types` SET count = $count WHERE id = $id";
			// $update_result = $conn->query($update_sql);
			if ($conn->query($update_sql) === TRUE) {
				$_SESSION['blood_success'] = "Blood detail has been added successfully!";
				// header('location:../index_blood_detail.php');
			} else {
				echo "Error" . $sql . "<br>" . $conn->error;
			}
		} else {
			//insert data into database
			$sql_blood = "INSERT INTO `blood_types`(abo_type, rh_system, org_id, count) VALUES ('" . $abo_type . "','" . $rh_system . "','" . $org_id . "', 1)";
			if ($conn->query($sql_blood) === TRUE) {
				$_SESSION['blood_success'] = "Blood detail has been added successfully!";
				// header('location:../index_blood_detail.php');
			} else {
				echo "Error" . $sql . "<br>" . $conn->error;
			}
		}
		$_SESSION['donar_success'] = "User detail has been added successfully!";
		header('location:../index_donar.php');
	} else {
		echo "Error" . $sql . "<br>" . $conn->error;
	}
}

// Delete
if (isset($_GET['dlt_donar'])) {
	$dlt_donar = $_GET['dlt_donar'];
	$query = "SELECT * FROM `donars` WHERE `id` = $dlt_donar";
	$result = $conn->query($query);
	if ($result == TRUE) {
		$row = $result->fetch_assoc();
		$id = $row['id'];
		$abo_type = $row['abo_type'];
		$rh_system = $row['rh_system'];
		// print_r($row);
		
		$existed_sql = "SELECT * FROM `blood_types` WHERE abo_type = '$abo_type' AND rh_system = '$rh_system'";
		$existed_result = $conn->query($existed_sql);
		if ($existed_result == true) {
			$existed_row = $existed_result->fetch_assoc();
			if ($existed_row['count'] > 1) {
				$count = $row['count'] - 1;
				$update_sql = "UPDATE `blood_types` SET `count` = $count WHERE id = $id";
				$update_result = $conn->query($update_sql);
			} elseif ($existed_row['count'] == 1) {
				$dlt_sql = "DELETE FROM `blood_types` WHERE `id` = $id";
				$dlt_result = $conn->query($dlt_sql);
			}
			$dlt_sql = "DELETE FROM `donars` WHERE `id` = $dlt_donar";
			$dlt_result = $conn->query($dlt_sql);
			$_SESSION['blood_delete'] = "Blood detail has been deleted successfully!";
			header('location:../index_blood_detail.php');
		}
	}
}
