<?php
//session start
session_start();
//connection with DB
include "connection.php";
include "phpMailer.php";
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
    $receiver_email = $_POST['receiver_email'];
    $receiver_cnic = $_POST['receiver_cnic'];
    $receiver_name = $_POST['receiver_name'];
    $receiver_phone_no = $_POST['receiver_phone_no'];
    $receiver_abo_type = $_POST['receiver_abo_type'];
    $receiver_rh_system = $_POST['receiver_rh_system'];
    $receiver_address = $_POST['receiver_address'];
    $receiver_bottle_qty = $_POST['receiver_bottle_qty'];
    $avail_user = ($_POST['avail_user'] != '') ? $_POST['avail_user'] : '';
    $receiver_status = "pending";

    $sql = "INSERT INTO `receivers` (`cnic`, `name`, `phone_no`, `abo_type`, `rh_system`, `address`, `bottle_qty`, `status`) VALUES ('$receiver_cnic', '$receiver_name', '$receiver_phone_no', '$receiver_abo_type', '$receiver_rh_system', '$receiver_address', '$receiver_bottle_qty', '$receiver_status' )";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['receiver_request'] = "Your request has been submitted, We will contact you soon once admin approve your request.";
        // $to = "email@gmail.com";
        // $from = "Receiver";
        // $subject = "Need blood";
        // $title = "Mail";
        // foreach ($_POST as $key => $value) {
        //     $message_body .= "$key: $value\n";
        // }
        // $headers = "From: $from" . "\r\n" . 'Reply-To: ' . $to . "\r\n";
        // mail($to, $subject, $message_body, $headers);
        $mail->setFrom('ashar.muhammad74@gmail.com', 'AsharMuhammad');
        $mail->addReplyTo('ashar.muhammad74@gmail.com', 'AsharMuhammad');

        // Add a recipient 
        $mail->addAddress($receiver_email);

        //$mail->addCC('cc@example.com'); 
        //$mail->addBCC('bcc@example.com'); 

        // Set email format to HTML 
        $mail->isHTML(true);

        // Mail subject 
        $mail->Subject = 'Need blood';

        // Mail body content
        $bodyContent = '<h1>I need blood, here i have entered the information</h1>';
        foreach ($_POST as $key => $value) {
            $bodyContent .= "$key: $value\n";
        }
        $mail->Body    = $bodyContent;

        // Send email 
        if (!$mail->send()) {
            $_SESSION['receiver_error'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $_SESSION['receiver_request'] = 'Message has been sent.';
            header('location:../request.php');
        }
        
    } else {
        $_SESSION['receiver_error'] = "There is an error while sending your request, please check your form again";
        header('location:../request.php');
        // echo "Error" . $sql . "<br>" . $conn->error;
    }
}

// Request for blood donation
if (isset($_POST['donar_submit'])) {
    $donar_email = $_POST['donar_email'];
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
        // $to = "email@gmail.com";
        // $from = "Donar";
        // $subject = "Become a donar";
        // $title = "Mail";
        // foreach ($_POST as $key => $value) {
        //     $message_body .= "$key: $value\n";
        // }
        // $headers = "From: $from" . "\r\n" . 'Reply-To: ' . $to . "\r\n";
        // mail($to, $subject, $message_body, $headers);
        $mail->setFrom('ashar.muhammad74@gmail.com', 'AsharMuhammad');
        $mail->addReplyTo('ashar.muhammad74@gmail.com', 'AsharMuhammad');

        // Add a recipient 
        $mail->addAddress($donar_email);

        //$mail->addCC('cc@example.com'); 
        //$mail->addBCC('bcc@example.com'); 

        // Set email format to HTML 
        $mail->isHTML(true);

        // Mail subject 
        $mail->Subject = 'Need blood';

        // Mail body content
        $bodyContent = '<h1>I want to donate blood, here i have entered the information</h1>';
        foreach ($_POST as $key => $value) {
            $bodyContent .= "$key: $value\n";
        }
        $mail->Body    = $bodyContent;

        // Send email 
        if (!$mail->send()) {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
            header('location:../request.php');
        }
    } else {
        $_SESSION['donar_error'] = "There is an error while sending your request, please check your form again";
        header('location:../request.php');
        // echo "Error" . $sql . "<br>" . $conn->error;
    }
}

// check blood availbility
if (isset($_POST['check_avail'])) {
    $donars = [];
    $org = [];
    $org_detail = [];
    $data = [];
    $name;
    $receiver_rh_system = $_POST['receiver_rh_system'];
    $receiver_abo_type = $_POST['receiver_abo_type'];
    $query = "SELECT * FROM `donars` WHERE `rh_system` = '$receiver_rh_system' AND `abo_type` = '$receiver_abo_type' AND `status` = 'Approved'";
    $result = $conn->query($query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $donars[] = $row;
        }
        $data['donars'] = $donars;
    }
    $query_org = "SELECT *, count(`org_id`) AS `count` FROM `blood_types` WHERE `rh_system` = '$receiver_rh_system' AND `abo_type` = '$receiver_abo_type' GROUP BY `org_id`";
    $result_org = $conn->query($query_org);
    while ($row = $result_org->fetch_assoc()) {
        $row_id =  $row['org_id'];
        $count =  $row['count'];
        $query_detail = "SELECT `name` FROM `organizations` WHERE `id` = $row_id";
        $result_detail = $conn->query($query_detail);
        $org_detail = $result_detail->fetch_assoc();
        $name = $org_detail['name'];
        $org[] = array('org' => $row, 'name' => $name);
    }
    $data['org'] = $org;

    if ($data) {
        print_r(json_encode($data));
    } else {
        echo "Error" . $sql . "<br>" . $conn->error;
    }
}
