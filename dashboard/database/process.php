<?php
//session start
session_start();
//connection with DB
include "connection.php";
//for User Registration
if (isset($_POST['register'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$cnic = $_POST['cnic'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$gender = $_POST['gender'];
	$role = $_POST['role'];
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
			$sql = "INSERT INTO `registration`(name,email,cnic,password,role) VALUES ('" . $name . "','" . $email . "','" . $cnic . "','" . $password . "','" . $role . "')";
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
	$role = 0;

	if (empty($email) && empty($password)) {
		header('location:../login.php');
		exit;
	} else {
		$sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password' AND `role`=$role";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if ($row == TRUE) {
			$_SESSION['user'] = $row;
			header('location:../index.php');
		} else {
			$_SESSION['login_error'] = "Incorrect Username/Password!";

			header('location:../login.php');
		}
	}
}

// for logout
if (isset($_GET['logout'])) {
	session_destroy();
	header('location: ../login.php');
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

// Update
if (isset($_POST['edit_org_btn'])) {
	$org_id = $_POST['org_id'];
	$org_name = $_POST['org_name'];
	$org_address = $_POST['org_address'];
	$org_phone = $_POST['org_phone'];

	// get record from db, and match if updated record is same or not, if no update the record
	$update_sql = "UPDATE `organizations` SET `id` = '$org_id', `name` = '$org_name', `address` = $org_address, `phone_no` = '$org_phone' WHERE id = $org_id";
	// $update_result = $conn->query($update_sql);
	if ($conn->query($update_sql) === TRUE) {
		$_SESSION['org_update'] = "Organization has been updated successfully!";
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

	//insert data into database
	$sql = "INSERT INTO `blood_types`(abo_type, rh_system, org_id) VALUES ('" . $abo_type . "','" . $rh_system . "','" . $org_id . "')";
	if ($conn->query($sql) === TRUE) {
		$_SESSION['blood_success'] = "Blood detail has been added successfully!";
		header('location:../index_blood_detail.php');
	} else {
		echo "Error" . $sql . "<br>" . $conn->error;
	}
}


// Update
if (isset($_POST['update_blood_detail_btn'])) {
	$blood_detail_id = $_POST['blood_detail_id'];
	$abo_type = $_POST['abo_type'];
	$rh_system = $_POST['rh_system'];
	$org_id = $_POST['org_id'];

	// get record from db, and match if updated record is same or not, if no update the record
	$update_sql = "UPDATE `blood_types` SET `abo_type` = '$abo_type', `rh_system` = '$rh_system', `org_id` = $org_id WHERE id = $blood_detail_id";
	// $update_result = $conn->query($update_sql);
	if ($conn->query($update_sql) === TRUE) {
		$_SESSION['blood_update'] = "Blood detail has been updated successfully!";
		header('location:../index_blood_detail.php');
	} else {
		echo "Error" . $sql . "<br>" . $conn->error;
	}
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
		$dlt_sql = "DELETE FROM `blood_types` WHERE `id` = $id";
		$dlt_result = $conn->query($dlt_sql);
		$_SESSION['blood_delete'] = "Blood detail has been deleted successfully!";
		header('location:../index_blood_detail.php');
	} else {
		echo "Error" . $sql . "<br>" . $conn->error;
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
	$donar_status = "Approved";

	$sql = "INSERT INTO `donars`(org_id , name, address, phone_no, abo_type, rh_system, status) VALUES ('" . $org_id . "', '" . $donar_name . "','" . $donar_address . "','" . $donar_phone_no . "','" . $abo_type . "','" . $rh_system . "', '" . $donar_status . "')";
	if ($conn->query($sql) === TRUE) {
		$_SESSION['donar_success'] = "User detail has been added successfully!";
		header('location:../index_donar.php');
	} else {
		echo "Error" . $sql . "<br>" . $conn->error;
	}
}

// Update
if (isset($_POST['edit_donar_submit'])) {
	$donar_id = $_POST['donar_id'];
	$donar_name = $_POST['donar_name'];
	$donar_phone_no = $_POST['donar_phone_no'];
	$donar_address = $_POST['donar_address'];
	$abo_type = $_POST['abo_type'];
	$rh_system = $_POST['rh_system'];
	$org_id = $_POST['org_id'];

	$sql = "UPDATE `donars` SET `name` = '$donar_name', `phone_no` = '$donar_phone_no', `address` = '$donar_address', `abo_type` = '$abo_type', `rh_system` = '$rh_system', `org_id` = $org_id WHERE id = $donar_id";
	if ($conn->query($sql) === TRUE) {
		$_SESSION['donar_update'] = "Donar detail has been updated successfully!";
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
		$dlt_sql = "DELETE FROM `donars` WHERE `id` = $dlt_donar";
		$dlt_result = $conn->query($dlt_sql);
		$_SESSION['donar_delete'] = "Donar detail has been deleted successfully!";
		header('location:../index_donar.php');
	}
}

// update receiver's status
if (isset($_POST['status_change'])) {
	$receiver_id = $_POST['receiver_id'];
	$status_change = $_POST['status_change'];
	$query = "SELECT * FROM `receivers` WHERE `id` = $receiver_id";
	$result = $conn->query($query);
	$rows = mysqli_fetch_assoc($result);
	if ($rows) {
		$status = $rows['status'];
		$update_query = "UPDATE `receivers` SET `status` = '$status_change' WHERE `id` = $receiver_id";
		$update_result = $conn->query($update_query);

		$query = "SELECT `status` FROM `receivers` WHERE `id` = $receiver_id";
		$result = $conn->query($query);
		$rows = mysqli_fetch_assoc($result);
		print_r(json_encode($rows));
	} else {
		echo "Data not found";
	}
}

// Update donar's status
if (isset($_POST['donar_status_change'])) {
	$donar_id = $_POST['donar_id'];
	$donar_status_change = $_POST['donar_status_change'];
	$query = "SELECT * FROM `donars` WHERE `id` = $donar_id";
	$result = $conn->query($query);
	$rows = mysqli_fetch_assoc($result);
	if ($rows) {
		$status = $rows['status'];
		$update_query = "UPDATE `donars` SET `status` = '$donar_status_change' WHERE `id` = $donar_id";
		$update_result = $conn->query($update_query);
		print_r($update_result);
	} else {
		echo "Data not found";
	}
}