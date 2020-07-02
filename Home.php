<!--Commit Test-->
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


</head>
<body>
  <!---------------------------------------------------------navbar------------------------------------->

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
      	<li class="active"><a href="#">Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<li><a id="loginbtn-navbar" href="#" data-toggle="modal" data-target="#loginModal">Sign in</a></li>
        <li><a id="registerbtn-navbar" href="#" data-toggle="modal" data-target="#registerModal">Register</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
	</nav>
   <!---------------------------------------------------------navbar------------------------------------->

     <!---------------------------------------------------------GRID------------------------------------->
	<div class="grid">
	<?php
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,"https://newsapi.org/v2/top-headlines?country=in&apiKey=f28db8ec72a149c8a276bd2a2424839b");
	$result=curl_exec($ch);
	$obj = json_decode($result);
	function display_news($channel_name,$link_to_article,$thumbnail,$description)
	{
		$html_div='<div class="news-container">'.	
			'<div class="thumbnail">'.
				'<div class="caption" style="border-bottom-style: solid;border-bottom-width:thick;margin-top: 0px"></div>'.
				'<div class="caption channel-name">'.$channel_name.'</div>'.
				'<object class="headline-image" data="'.$thumbnail.'">'.
				'<img class="headline-image" src="http://www.sclance.com/pngs/news-paper-png/news_paper_png_929170.png">'.
				'</object>'.
			'<div class="caption">'.
				$description. 
			'</div>'.	
		'</div>'.
		'</div>';
		print $html_div;
	}
	//print $obj->{'articles'}[0]->{'content'};
	foreach($obj->{'articles'} as & $value){
    	display_news($value->source->{"name"},$value->{"url"},$value->{"urlToImage"},$value->{"content"});
	}
	curl_close($ch);
	?>
	</div>
<!---------------------------------------------------------GRID------------------------------------->

 <!---------------------------------------------------------registerform------------------------------------->

 <div class="modal fade" tabindex="-1" role="dialog" id="registerModal" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('.carousel').carousel(0);clearmodel()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
      
 
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
       <form>
        <div class="form-group">
            <label for="exampleInputPassword1" required>Username</label>
            <input type="text" class="form-control" id="username" placeholder="Username" required="">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
          </div>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('.carousel').carousel(0);clearmodel()">Close</button>
        <button  id="nextbtn" type="button" class="btn btn-primary">Next</button>
      </form>
    </div>
    <div class="item">
      <div  class="profile-channel-select">
        <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname="newslobby";
          // Create connection
         $conn = mysqli_connect($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          $sql="SELECT channel_name from `news_channel`";

          $result = $conn->query($sql); 
            while($row = mysqli_fetch_assoc($result)) {
            print "<div id='".$row["channel_name"]."'>";
            print "<img id='".$row["channel_name"]."'src='images/".$row["channel_name"].".png'>";
            print "</div>";    
            }
        mysqli_close($conn);  

        ?>
         
  </div>
  <div style="margin-top: 20px;">
  <button id="backbtn" type="button" class="btn btn-default" onclick="$('.carousel').carousel('prev');">Back</button>
  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('.carousel').carousel(0);clearmodel()">Close</button>
  <button id="registerbtn" type="button" class="btn btn-primary">Register</button>
  </div>
     
    </div>
  </div>
</div>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 <!---------------------------------------------------------registerform------------------------------------->

 <!--------------------------------------------------------loginform----------------------------------------->
 <div class="modal fade" tabindex="-1" role="dialog" id="loginModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="loginemail" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="loginpassword" placeholder="Password">
          </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button  id="loginbtn" type="button" class="btn btn-primary">login</button>
      </form>
       </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>  
 





 <!------------------------------------------------------- login--------------------------------------------->
</body>
</html>
<style>
.grid{
	display: grid;
	grid-template-columns: repeat(3,400px);
 	grid-auto-rows:380px;
  grid-gap:80px 30px;
  margin-left: 37px;
  margin-top:50px;
}
.news-container{
	transition: 0.5s;
}
.news-container:hover{
	transform: scale(1.1,1.1);
}
.channel-name{
	text-align: center;
}
.headline-image{
	width: 360px !important;
	height: 250px !important;
}
.news-desc{
	top:264px;
	width:100%;
	height:112px;
	background-color:white;
	position: absolute;
  text-align:justify;   
}
.profile-channel-select
{
  display: grid;
  grid-template-columns: repeat(5,80px);
  grid-auto-rows:80px;
  grid-gap:30px 30px;
  margin-left: 17px;
  margin-top:10px;
  overflow-y: scroll;
  max-height: 200px;
}
.profile-channel-select img{
  height: 80px;
  width: 80px;
  padding:2px;
}
.profile-channel-select img:hover{
  animation-name: drawborder;
  animation-duration: 2s;
  animation-iteration-count:1;
  animation-direction: normal;
  animation-fill-mode: forwards;
}
@keyframes drawborder{
  0%  {border-top: 1px solid black;}
  40% {border-top: 1px solid black;border-right: 1px solid black;}
  60% {border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;}
  100% {border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-left: 1px solid black;} 
}
.invalid-data{
  animation-name:vibrate;
  animation-duration: 0.2s;
  animation-iteration-count:1;
  animation-direction: normal;
  animation-fill-mode: forwards;
}
@keyframes vibrate{
  0% {transform: translate(10px);}
  50% {transform: translate(-10px);}
  100% {transform: translate(0px);}
}
@media screen and (max-width: 992px) {
    .grid{
    	grid-template-columns: repeat(3,400px);
    }
}
@media screen and (max-width: 600px) {
  .grid{
  	grid-template-columns: repeat(1,250px);
  	grid-gap: 70px;
  	margin-left: 50px;
  }
  .headline-image{
  	width:270px important;
  	height:100px important; 
  }
  .profile-channel-select
  {
    grid-template-columns: repeat(3,40px);
    grid-auto-rows: 30px;
    grid-gap: 30px;
    margin-left:40px;
  }
  .profile-channel-select img{
    height: 40px;
    width: 40px;
  }

}
html{
    display: flex;
    flex-flow: row nowrap;  
    justify-content: center;
    align-content: center;
    align-items: center;
    height:100%;
}
body 
{
    margin: 0;
    flex: 0 1 auto;
    align-self: auto;
    width: 100%
    max-width: 900px;
    height: 100%;
    max-height: 600px;
    background-color: #f9f5f4
}
</style>
<!-----------------------------------------------------------register request ot server------------------------------->
<script>
  var listOfchannels=["abc-news","bbc-news","bbc-sports","bloomberg","business-insider","cnn","espn","financial-post","focus",
                      "fox-news","google-news-in","hacker-news","ign","national-geographic","tech-crunch","techradar",
                      "the-hindu","the-economist","the-next-web","the-verge","the-times-of-india","the-wall-street-journal","wired"];
  var selected_channels=[]; 
  var username="";
  var email="";
  var password=""; 
  var emailvalidater="/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
  var xhttp = new XMLHttpRequest();
  $("#registerbtn-navbar").click(function(){
    document.getElementsByClassName("profile-channel-select")[0].addEventListener('click',function(event){
    for(let i=0;i<listOfchannels.length;i++)
    {
    if(event.target.id==listOfchannels[i])
      {
        if(!selected_channels.includes(listOfchannels[i]))
        {
        selected_channels.push(event.target.id);
        document.getElementById(listOfchannels[i]).style.outline="2px solid black";
        }
        else
        {
          document.getElementById(listOfchannels[i]).style.outline="none";
          selected_channels.splice(selected_channels.indexOf(listOfchannels[i]),1);
        } 
      }
    }
  });
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText=="already registered")
      {
        document.getElementById("email").value="";
        $(".modal").addClass("invalid-data");
        $("#email").addClass("alert alert-danger");
        document.getElementById("email").placeholder="already registered";
      }
      else
      {
        $('.carousel').carousel('next');
      }
    }
  };
  $("#nextbtn").click(function(){
  ifvalidated(function(){
  email=document.getElementById("email").value;
  xhttp.open("POST", "register.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("checkemail="+email);
  });
  
  });
});  

 $("#registerbtn").click(function(){
  email=document.getElementById("email").value;
  username=document.getElementById("username").value;
  password=document.getElementById("password").value;
  sel_chan=JSON.stringify(selected_channels);
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText=="sucesss")
          $('#registerModal').modal('hide');
    }
  };
  console.log(sel_chan);
  xhttp.open("POST", "register.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("username="+username+"&password="+password+"&email="+email+"&selected_channels="+sel_chan);
 });

 function clearmodel()
 {
  for(let i=0;i<listOfchannels.length;i++)
  {
        document.getElementById(listOfchannels[i]).style.outline="none";
  }
   $(".modal").removeClass("invalid-data");
   $("#username").removeClass("alert alert-info");
   $("#email").removeClass("alert alert-info");
   $("#password").removeClass("alert alert-info");
   $("#email").removeClass("alert alert-danger");
   document.getElementById("email").placeholder="email";
   document.getElementById("password").value="";
   document.getElementById("password").placeholder="password";
   document.getElementById("username").placeholder="username";
   selected_channels=[];
 }
 function ifvalidated(nextstep)
 {
  email=document.getElementById("email").value.trim();
  username=document.getElementById("username").value.trim();
  password=document.getElementById("password").value.trim();
  if(username=="")
  {
    $("#username").addClass("alert alert-info"); 
    document.getElementById("username").placeholder="please enter some data";
    document.getElementById("username").value="";
  } 
  if(email=="")
  {
    $("#email").addClass("alert alert-info"); 
    document.getElementById("email").placeholder="please enter some data";
    document.getElementById("email").value="";
  } 
  if(!(/^\w+@([a-zA-Z_])+(\.[a-zA-Z]+)+$/.test(email)))
  {
    $("#email").addClass("alert alert-info"); 
    document.getElementById("email").placeholder="enter valid email";
    document.getElementById("email").value="";
  }
  if(password=="")
  {
    $("#password").addClass("alert alert-info");
    document.getElementById("password").placeholder="please enter some data";
    document.getElementById("password").value="";
  }
  if(email!="" && username!="" && password!="")
  {
    $("#username").removeClass("alert alert-info"); 
    document.getElementById("username").placeholder="username";
    $("#email").removeClass("alert alert-info"); 
    document.getElementById("email").placeholder="email";
    $("#password").removeClass("alert alert-info"); 
    document.getElementById("password").placeholder="password";
    nextstep();
  }
  else
  {
    $(".carousel").carousel(0);
  }
}
</script>
<!-----------------------------------------------------------register request to server-------------------------------->

<!-----------------------------------------------------------login request to server-------------------------------->
<script>
  var loginemail;
  var loginpassword;
  $("#loginbtn").click(function(){
  loginvalidate(function(){
  loginemail=document.getElementById("loginemail").value;
  loginpassword=document.getElementById("loginpassword").value;  
  xhttp.open("POST", "login.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("loginemail="+loginemail+"&loginpassword="+loginpassword);
  });  
});

   xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText=="success")
      {
        window.location.assign("http://localhost/oep/afterlogin.php");
      }
      else
      {
        $(".modal").addClass("invalid-data");
        $("#loginemail").addClass("alert alert-danger");
        document.getElementById("loginemail").value="";
        document.getElementById("loginemail").placeholder="invalid data";
        $("#loginpassword").addClass("alert alert-danger");
        document.getElementById("loginpassword").placeholder="invalid data";
        document.getElementById("loginpassword").value="";
      }
    }
  };
  function loginvalidate(login)
  {
    loginemail=document.getElementById("loginemail").value.trim();
    loginpassword=document.getElementById("loginpassword").value.trim();
    if(loginemail=="")
    {
      $("#loginemail").addClass("alert alert-info"); 
      document.getElementById("loginemail").placeholder="please enter some data";
      document.getElementById("loginemail").value="";
    }
    if(loginpassword=="")
    {
      $("#loginpassword").addClass("alert alert-info");
      document.getElementById("loginpassword").placeholder="please enter some data";
      document.getElementById("loginpassword").value="";
    }
    if(loginemail!="" && loginpassword!="")
    {
      $("#loginemail").removeClass("alert alert-info"); 
      document.getElementById("loginemail").placeholder="email";
      $("#loginpassword").removeClass("alert alert-info"); 
      document.getElementById("loginpassword").placeholder="password";
      login();
    }
  }
</script>

<!-----------------------------------------------------------login request to server-------------------------------->
