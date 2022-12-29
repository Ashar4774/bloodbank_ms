<?php
//connection with DB
include "connection.php";


if (isset($_POST['save'])) {
	
$img = '';
$title = $_POST['title'];
$description = $_POST['description'];
$sku = $_POST['sku'];
$category = $_POST['category'];
//for img value
$img = $_FILES['image'];
$img_name = $img['name'];
$img_temp = $img['tmp_name'];
$folder = '../images/'.$img_name;
move_uploaded_file($img_temp,$folder);

//insert data into database
$sql = "INSERT INTO `product`(title,image,description,sku,category) VALUES ('".$title."','".$folder."','".$description."','".$sku."','".$category."')";
if($conn->query($sql) === TRUE){
	//echo "Data has been Inserted into the database!";	
	include('../insert.php?success=true');
	
}
else{
	echo "Error".$sql."<br>".$conn->error;
}
}