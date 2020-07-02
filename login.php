<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="newslobby";

 // Create connection
if(!(isset($_POST["loginemail"],$_POST["loginpassword"])))
{
	header("Location:https:Location:http://localhost/oep/home.php");
	exit;
}
else
{
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$get_email=$conn->prepare("SELECT password from user_info WHERE email=?");
	$get_email->bind_param("s",$_POST["loginemail"]);
 	$get_email->execute();
 	$get_email->bind_result($password);
 	$get_email->fetch();
 	$get_email->close();
 	if($_POST["loginpassword"]==$password)
 	{
 		session_start();
 		$_SESSION["useremail"]=$_POST["loginemail"];
 		echo "success";
 	}
}
?>