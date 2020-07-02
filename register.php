<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname="newslobby";

 // Create connection
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 $user_detail = $conn->prepare("INSERT INTO user_info (username,email,password) VALUES (?, ?, ?)");// for user detail 
 $subscription = $conn->prepare("INSERT INTO user_to_channel (user_email,channel_name) VALUES (?, ?)");//for user subscription
 $get_email=$conn->prepare("SELECT email from user_info WHERE email=?");

 // Check connection
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }

//check for duplicate email
 if(isset($_POST["checkemail"]))
 {
 	$get_email->bind_param("s",$_POST["checkemail"]);
 	$get_email->execute();
 	$get_email->bind_result($email);
 	$get_email->fetch();
 	$get_email->close();
 	if(isset($email))
 		echo "already registered";
 	else
 		echo "not registered";

 	$_POST["checkemail"]="";
 }
if(isset($_POST["username"],$_POST["email"],$_POST["password"]))
{	
	$user_detail->bind_param("sss", $_POST["username"], $_POST["email"], $_POST["password"]);
	$user_detail->execute();
	$user_detail->close();
	
	//insert channel and user email into user_to_channel
	$selected_channels=json_decode($_POST["selected_channels"], true);
	foreach ($selected_channels as  $channel_name) {
	$subscription->bind_param("ss", $_POST["email"],$channel_name);
	$subscription->execute();
	}
	$subscription->close();
	mysqli_close($conn);
	echo "sucesss";
}
?>