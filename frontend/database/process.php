<?php
//session start
session_start();
//connection with DB
include "connection.php";

// Request for blood donation
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
        $_SESSION['receiver_request'] = "Your request has been submitted, We will contact you soon.";
        $to = "email@gmail.com";
        $from = "Receiver";
        $title = "Mail";
        foreach ($_POST as $key => $value) {
            $message_body .= "$key: $value\n";
        }
        $headers = "From: $from" . "\r\n" . 'Reply-To: ' . $to . "\r\n";
        mail($to, $subject, $message_body, $headers);
        header('location:../request.php');
    } else {
        echo "Error" . $sql . "<br>" . $conn->error;
    }
}
