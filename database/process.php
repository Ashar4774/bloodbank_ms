<?php
//session start
session_start();
//connection with DB
include "connection.php";

// Register user
if (isset($_POST['register'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$cnic = $_POST['cnic'];
	$phone_no = $_POST['phone_no'];
	$password = $_POST['password'];
	$cpassword = $_POST['c_password'];
	$role = $_POST['role'];
	//password matched or not
	if ($password != $cpassword) {
		$_SESSION['password_warning'] = "Password do not match!";
		header('location:../register.php');
	} else {
		//check duplication of email
		$duplicate = "SELECT * FROM `users` WHERE `email`='$email'";
		$check = $conn->query($duplicate);
		if ($check->fetch_assoc() == TRUE) {
			$_SESSION['duplicate'] = "Email already exist!";
			header('location:../register.php');
		} else {
			//query for inserting data in registration table
			$sql = "INSERT INTO `users`(`name`,`email`,`cnic`,`phone_no`,`password`,`role`) VALUES ('" . $name . "','" . $email . "','" . $cnic . "','" . $phone_no . "','" . $password . "'," . $role . ")";
			if ($conn->query($sql) == TRUE) {
				$_SESSION['user_success'] = "User has been registered successfully!";
				header('location:../register.php');
			} else {
				echo "Error" . $sql . "<br>" . $conn->error;
			}
		}
	}
}

// Login user
//for login
if (isset($_POST['login'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];
	$role = $_POST['role'];

	if (empty($email) && empty($password)) {
		header('location:../login.php');
		exit;
	} else {
		$sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password' AND `role`=$role";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if ($row == TRUE) {
			$_SESSION['user'] = $row;
			// $_SESSION['user_name'] = $row['name'];
			// $_SESSION['user_email'] = $row['email'];
			// $_SESSION['role'] = $row['role'];
			header('location:../dashboard/index.php');
		} else {
			$_SESSION['login_error'] = "Incorrect Username/Password!";

			header('location:../login.php');
		}
	}
}

// Request for blood receiving
if (isset($_POST['request_submit'])) {
    $receiver_cnic = $_POST['receiver_cnic'];
    $receiver_name = $_POST['receiver_name'];
    $receiver_phone_no = $_POST['receiver_phone_no'];
    $receiver_abo_type = $_POST['receiver_abo_type'];
    $receiver_rh_system = $_POST['receiver_rh_system'];
    $receiver_address = $_POST['receiver_address'];
    $receiver_bottle_qty = $_POST['receiver_bottle_qty'];
    $receiver_status = "pending";

    $sql = "INSERT INTO `receivers` (`cnic`, `name`, `phone_no`, `abo_type`, `rh_system`, `address`, `bottle_qty`, `status`) VALUES ('$receiver_cnic', '$receiver_name', '$receiver_phone_no', '$receiver_abo_type', '$receiver_rh_system', '$receiver_address', '$receiver_bottle_qty', '$receiver_status' )";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['receiver_request'] = "Your request has been submitted, We will contact you soon once admin approve your request.";
        $to = "email@gmail.com";
        $from = "Receiver";
        $subject = "Need blood";
        $title = "Mail";
        foreach ($_POST as $key => $value) {
            $message_body .= "$key: $value\n";
        }
        $headers = "From: $from" . "\r\n" . 'Reply-To: ' . $to . "\r\n";
        mail($to, $subject, $message_body, $headers);
        header('location:../request.php');
    } else {
        $_SESSION['redceiver_error'] = "There is an error while sending your request, please check your form again";
        header('location:../request.php');
        // echo "Error" . $sql . "<br>" . $conn->error;
    }
}

// Request for blood donation
if (isset($_POST['donar_submit'])) {
    $donar_cnic = $_POST['donar_cnic'];
    $donar_name = $_POST['donar_name'];
    $donar_phone_no = $_POST['donar_phone_no'];
    $donar_abo_type = $_POST['donar_abo_type'];
    $donar_rh_system = $_POST['donar_rh_system'];
    $donar_address = $_POST['donar_address'];
    $donar_bottle_qty = $_POST['donar_bottle_qty'];
    $donar_status = "pending";


    $sql = "INSERT INTO `donars`(`cnic` , `name`, `address`, `phone_no`, `abo_type`, `rh_system`, `status`) VALUES ('" . $donar_cnic . "', '" . $donar_name . "','" . $donar_address . "','" . $donar_phone_no . "','" . $donar_abo_type . "','" . $donar_rh_system . "', '" . $donar_status . "')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['donar_request'] = "Your donation request has been submitted, We will contact you soon once admin approve your request.";
        $to = "email@gmail.com";
        $from = "Donar";
        $subject = "Become a donar";
        $title = "Mail";
        foreach ($_POST as $key => $value) {
            $message_body .= "$key: $value\n";
        }
        $headers = "From: $from" . "\r\n" . 'Reply-To: ' . $to . "\r\n";
        mail($to, $subject, $message_body, $headers);
        header('location:../request.php');
    } else {
        $_SESSION['donar_error'] = "There is an error while sending your request, please check your form again";
        header('location:../request.php');
        // echo "Error" . $sql . "<br>" . $conn->error;
    }
}