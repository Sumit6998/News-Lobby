<?php
  session_start();
  if(!isset(($_SESSION["useremail"])))
  {
    header("Location:https://www.google.com/search?q=bunty+to+chutiya+hai&client=firefox-b-d&source=lnms&tbm=isch&sa=X&ved=0ahUKEwiinPSm2NPgAhXJs48KHcEGDYsQ_AUIDygC&biw=1366&bih=654#imgrc=Qx3jKTvj_ddnAM:");
    exit;
  }
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #ffffff">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">News Lobby</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	<li><a href="afterlogin.php">Home</a></li>
        <li><a href="#">Filter<span class="sr-only">(current)</span></a></li>
        <li class="active"><a href="#">Profile</a></li>
      </ul>
       <ul class="nav navbar-nav navbar-right">
        <li><a>Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="main-grid">
  <div class="sidenav">
    <ul>
    <li><a href="#Username">Username</a></li>
    <li><a href="#MyBookmarks">MyBookmarks</a></li>
    <li><a href="#MySubscription">MySubscription</a></li>
    <li><a href="#Add-Channels">Add Channels</a></li>
    </ul>
  </div>
  <div class="profile-content">
  <div class="news-channel-selection">   
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="newslobby";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
     }
    $get_subscription=$conn->prepare("SELECT channel_name from user_to_channel WHERE user_email=?");
    $get_subscription->bind_param("s",$_SESSION["useremail"]);
    $get_subscription->execute();
    $get_subscription->bind_result($subscription);     
    while($get_subscription->fetch())
    {
     print "<div id='".$subscription."'>";
     print "<img id='".$subscription."'src='images/".$subscription.".png'>";
     print "</div>";    
    }
    mysqli_close($conn);
        ?>

  </div>
  </div> 
</body>
</html>
<style>
.sidenav {
  background: grey;
  grid-row: 1/2;
  grid-column: 1/2;
  z-index: 1;
  width: 100%;
  height: 100vh;
  min-width: 150px;
  background-color:#ffffff; 
}
.sidenav >ul{
  margin-top: 80px;
  list-style-type: none;
  marker-left:20px;
}
.sidenav a {  
  margin-top: 26px;
  text-decoration: none;
  font-size: 15px;
  color: #4b4747;
  display: block;
}
.sidenav a:hover {
  color: #000000;
}
.main-grid{
display: grid;
grid-template-columns:15% 85%;
grid-auto-rows: minmax(132px,auto);
}
.profile-content{
  grid-row: 1/2;
  grid-column:2/3;
}
.news-channel-selection{
  display: grid;
  grid-template-columns: repeat(6,150px);
  grid-auto-rows: 200px;
  grid-gap: 2px 10px;
  padding-top: 40px;
  padding-left:20px;
  padding-right:20px;
  padding-bottom: 20px;
  grid-column: 2/4;
  margin-top: 40px;
  margin-left: 120px;
  overflow-y: scroll;
  height: 100vh;
}
.news-channel-selection  img{
  width: 100px;
  height:100px;
  transition: 0.1s; 
}
.news-channel-selection img:hover{
  transform: scale(1.1,1.1);
}
@media screen and (max-width: 600px) {
  .sidenav{
    min-width:100px; 
  }
  .sidenav >ul{
  margin-top: 50px;
}
.sidenav a {  
  margin-left:2px; 
  margin-top: 16px;
  font-size: 8px;
}
 .news-channel-selection{
  grid-template-columns: repeat(2,70px);
  grid-auto-rows: 80px;
  margin-left: 130px;
 }
 .main-grid{
grid-template-columns:5% 95%;
grid-auto-rows: minmax(80px,auto);
 }
 .news-channel-selection  img{
  width: 50px; 
  height:50px; 
}
}
body{
  padding-top: 10px;
  overflow-y: hidden;
  background: #f9f5f4;
}  
</style>

