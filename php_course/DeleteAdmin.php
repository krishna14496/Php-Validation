<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<?php 
	if (isset($_GET["id"])) {
	$IDFromURL=$_GET["id"];
	$ConnectingDB;
	$Query="delete from registration where id='$IDFromURL' ";
	$Execute=mysqli_query($Connection, $Query);	
	if ($Execute) {
		$_SESSION["SuccessMessage"]="Admin Deleted Successfully ";
				Redirect_to("Admins.php");
			}else{
				$_SESSION["ErrorMessage"]="Something went wrong Try Again !";
				Redirect_to("Admins.php");
			}
	}
						
 ?>