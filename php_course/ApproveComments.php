<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<?php 
	if (isset($_GET["id"])) {
	$IDFromURL=$_GET["id"];
	$ConnectingDB;
	$Admin=$_SESSION["Username"];
	$Query="update comment set status='on', approvedby='$Admin' where id='$IDFromURL' ";
	$Execute=mysqli_query($Connection, $Query);	
	if ($Execute) {
		$_SESSION["SuccessMessage"]="Comment Approved Successfully ";
				Redirect_to("Comments.php");
			}else{
				$_SESSION["ErrorMessage"]="Something went wrong Try Again !";
				Redirect_to("Comments.php");
			}
	}
						
 ?>