<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>

<?php 
	function Redirect_to($New_Location){
		header("Location:".$New_Location);
			exit;
	}

	function Login_Attemp($Username,$Password){
			global $Connection;
			$Query="select * from registration where username='$Username' and password='$Password' ";
			$Execute=mysqli_query($Connection, $Query);
			if($admin=mysqli_fetch_assoc($Execute)){ 
			 	return $admin;
			}else{
				return null;	
			}
	}

	function Login(){
		if (isset($_SESSION["User_Id"])) {
			return true;
		}
	}
	function Confirm_Login(){
		if (!Login()) {
			$_SESSION["ErrorMessage"]="Login required ! .";
			Redirect_to("Login.php");
		}
	}
 ?>

