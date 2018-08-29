<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php 
	if (isset($_POST["Submit"])) {
		$Username=mysqli_real_escape_string($Connection,$_POST["Username"]);
		$Password=mysqli_real_escape_string($Connection,$_POST["Password"]);

		if(empty($Username)||empty($Password)) {
			$_SESSION["ErrorMessage"]="All Fields must be filled out";
			Redirect_to("Login.php");

		}
		else{
			$Found_Account=Login_Attemp($Username,$Password);
			$_SESSION["User_Id"]=$Found_Account["id"];
			$_SESSION["Username"]=$Found_Account["username"];
			if($Found_Account){
				$_SESSION["SuccessMessage"]="Welcome {$_SESSION["Username"]} .";
				Redirect_to("dashboard.php");
			}
			else{
				$_SESSION["ErrorMessage"]="Invalid Usrename & Password .";
				Redirect_to("Login.php");
			}
			}
		}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Admin</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script scr="js/bootstrap.min.js"></script>
	<script scr="js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">
	<style>
		.FieldInfo{
			color:rgb(251, 174, 44);
			font-family: Bitter,Geogia,"Times New Roman",Times,serif;
			font-size: 1.2em;
		}
		body{
			background-color: #ffffff;
		}
	</style>
</head>
<body>
<div style="height: 10px; background: #27aae1;"></div>
<nav class="navbar navbar-expand-md navbar-inverse fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="Blog.php">
			<img style="margin-top: -15px;" src="images/image1.jpg" width="200" height="50">
		</a>
		</div>
		<div class="collapse navbar-collapse" id="collapse">
		</div>
	</div>
</nav>	
<div class="Line" style="height: 10px; background: #27aae1;"></div>

<br><br>
<br>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-offset-4 col-sm-4">
			<div><?php echo Message(); 
			echo SuccessMessage(); ?></div>
			<h2>Welcome Back</h2>
			<div>
				<form action="Login.php" method="post" >
					<fieldset>
						<div class="form-group">
							<label for="Username"><span class="FieldInfo">User Name:</span></label>
							<div class="input-group input-group-lg">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-envelope text-info"></span>
							</span>
	 						<input class="form-control" type="text" name="Username" id="Username" placeholder=" User Name...">
							</div>
						</div>
						<div class="form-group">
							<label for="Password"><span class="FieldInfo">Password:</span></label>
	 						<div class="input-group input-group-lg">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-lock text-info"></span>
							</span>
	 						<input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
						</div>
						</div>
						<br>
						<input class="btn btn-info btn-block btn-lg" type="Submit" name="Submit" value="Login">
						<br>
					</fieldset>
				</form>
			</div>
		</div><!-- Ending of a main area. -->
	</div><!-- Ending of row -->
</div><!-- ending of container fluid -->
<br><br>
<br>

<div id="Footer">
	<hr><p>Theme By | Krishna Shankar | &copy;2016-2020 ---All Right Reserved.</p>
	<a style="color: white; text-decoration: none; cursor: pointer; font-weight: bold;" href="#" target="_blank">
		<p>This Side is only for a reference <br> And if you want download for a refernce than visit my &trade; github account.</hr></p>
	</a>
</div>
</body>
</html>