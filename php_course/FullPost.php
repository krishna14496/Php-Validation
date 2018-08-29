<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php 
	if (isset($_POST["Submit"])) {
		$Name=$_POST["Name"];
		$Email=$_POST["Email"];
		$Comment=$_POST["Comment"]; 
		date_default_timezone_set("Asia/Kolkata");//select states of world
		$CurrentTime=time();      //current time
		//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);// describe month day year    hour mints and seconds.
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);// describe year month day    hour mints and seconds.
		$DateTime;
		$PostId=$_GET["id"];
		if(empty($Name)||empty($Email)||empty($Comment)) {
			$_SESSION["ErrorMessage"]="All Field Must Be Required.";
		//}elseif (strlen($Comment)<500){
		//	$_SESSION["ErrorMessage"]="Only 500 Characters Are allowed in Comments";
		//		Redirect_to("FullPost.php?id={$PostId}");
		}else{
			global $ConnectingDB;
				$PostIDFromURL=$_GET["id"];
				$Query="insert into comment(name,email,comment,datetime,status,admin_panel_id,approvedby) values('$Name','$Email','$Comment','$DateTime','Off','$PostIDFromURL','Pending')";
				$Execute=mysqli_query($Connection,$Query);
			if ($Execute) {
				$_SESSION["SuccessMessage"]="Comment Submitted Successfully ";
				Redirect_to("FullPost.php?id={$PostId}");
			}else{
				$_SESSION["ErrorMessage"]="Something went wrong Try Again !";
				Redirect_to("FullPost.php?id={$PostId}");
			}
			}
		}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Full Blog Post</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script scr="js/bootstrap.min.js"></script>
	<script scr="js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/publicstyles.css">

	<style>
		.FieldInfo{
			color: rgb(251,174,44);
			font-family: Bitter,Georgia,"Times New Roman",Times,serif;
			font-size: 1.2em;
		}
		.CommentBlock{
			background-color: #F6F7F9;
		}
		.Comment-Info{
			color: #356899;
			font-family: sans-serif;
			font-size: 1.1em;
			font-weight: bold;
			padding-top: 10px;
		}
		.comment{
			margin-top: -2px;
			padding-bottom: 10px;
			font-size: 1.1em;
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
		<a class="navbar-brand" href="FullPost.php">
			<img style="margin-top: -15px;" src="images/image1.jpg" width="200" height="50">
		</a>
		</div>
		<div class="collapsed navbar-collapse" id="collapse">
		<ul class="nav navbar-nav">
			<li class="nav-item"><a href="#">Home</a></li>
			<li class="nav-item" class="active"><a href="Blog.php">Blog</a></li>
			<li class="nav-item"><a href="#">About Us</a></li>
			<li class="nav-item"><a href="#">Services</a></li>
			<li class="nav-item"><a href="#">Contact Us</a></li>
			<li class="nav-item"><a href="#">Feature</a></li>
		</ul>
		<form action="Blog.php" class="navbar-form navbar-right">
			<div class="form-group">
				<input class="form-control" type="text" name="Search" placeholder="Search">
			</div>
			<button class="btn btn-default" name="SearchButton">Go</button>
		</form>
		</div>
	</div>
</nav>	
<div class="Line" style="height: 10px; background: #27aae1;"></div>
<div class="container"><!--Staring conatiner -->
	<div class="blog-header">
		<h1>This iS complet resposive blogssssss</h1>
		<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		</p>
	</div>
	<div class="row"><!-- row-->
		<div class="col-sm-8"><!-- Main blog area-->
			<?php echo Message(); 
			echo SuccessMessage();
			?>
				<?php 
				global $ConnectingDB;
				if (isset($_GET["SearchButton"])) {
					$Search=$_GET["Search"];
					$ViewQuery="select * from admin_panel
					where datetime like '%$Search%' or title like '%$Search%' or category like '%$Search%' or post like '%$Search%'";
				}
				//Query when category is active url web
				elseif (isset($_GET["Category"])) {
					$Category=$_GET["Category"];
					$ViewQuery="select * from admin_panel where category='$Category' order by datetime desc";
				}
				else{
					$PostIDFromURL=$_GET["id"];
				$ViewQuery="select * from admin_panel where id='$PostIDFromURL' order by datetime desc";}
				$Execute=mysqli_query($Connection, $ViewQuery);	
				while ($DataRows=mysqli_fetch_array($Execute)) {
					$PostId=$DataRows["id"];
					$DateTime=$DataRows["datetime"];
					$Title=$DataRows["title"];
					$Category=$DataRows["category"];
					$Admin=$DataRows["author"];
					$Image=$DataRows["image"];
					$Post=$DataRows["post"];
			 ?>
			 <div class="blogpost thumbnail">
			 	<img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?> ">
			 	<div class="caption">
			 		<h1 id="heading"><?php echo nl2br($Title); ?></h1>
			 		<p class="description">Category:<?php echo htmlentities($Category); ?> Published on <?php echo htmlentities($DateTime); ?>
			 		<?php 
						$ConnectingDB;
						$QueryApproved="select count(*) from comment where admin_panel_id='$PostId' and status='on' ";
						$ExecuteApproved=mysqli_query($Connection, $QueryApproved);
						$RowsApproved=mysqli_fetch_array($ExecuteApproved);
						$TotalApproved=array_shift($RowsApproved);	
						if ($TotalApproved>0) {
						?>
						<span class="badge pull-right">Comments: <?php echo $TotalApproved; ?></span>
						<?php } ?>	

			 		</p>
			 		<p class="post"><?php echo nl2br($Post); ?></p>
			 	</div>
			 </div>
			 <?php } ?>
			 <br><br>
			 <br><br>
			<br>
			 <span class="FieldInfo">Share Your Thoughts about this Post...</span>
			 <br>
			 <span class="FieldInfo">Comments</span>
				<?php 
				global $ConnectingDB;
					$PostIdForComments=$_GET["id"];
					$ExtractingCommentsQuery="select * from comment where admin_panel_id='$PostIdForComments' and status='On'";
					$Execute=mysqli_query($Connection, $ExtractingCommentsQuery);	
					while ($DataRows=mysqli_fetch_array($Execute)) {
						$CommentDate=$DataRows["datetime"];
						$CommenterName=$DataRows["name"];
						$CommentByUsers=$DataRows["comment"];
			 ?>
			 <div class="CommentBlock">
			 <img class="pull-left" src="images/comment.png" style="margin-left: 10px; margin-top: 10px; width: 70px;height: 70px;">
			 	<p style="margin-left: 90px;" class="Comment-Info"><?php echo $CommenterName; ?></p>
			 	<p style="margin-left: 90px;" class="description"><?php echo $CommentDate; ?></p>
			 	<p style="margin-left: 90px;" class="comment"><?php echo nl2br($CommentByUsers); ?></p>
			 </div>
			 <?php } ?>
			 <hr>
			 <div>
				<form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
							<label for="Name"><span class="FieldInfo">Name:</span></label>
	 						<input class="form-control" type="name" name="Name" id="name" placeholder="Enter Your Name...">
						</div>
						<div class="form-group">
							<label for="Email"><span class="FieldInfo">Email:</span></label>
	 						<input class="form-control" type="email" name="Email" id="email" placeholder="Enter Your Email...">
						</div>
						<div class="form-group">
							<label for="commentarea"><span class="FieldInfo">Comment:</span></label>
							<textarea class="form-control" name="Comment" id="commentarea"></textarea>
						</div>
						<input class="btn btn-primary" type="Submit" name="Submit" value="Submit">
						<br>
						<br>
					</fieldset>
				</form>
			</div>
		</div><!-- main blog area endig -->
		<div class="col-sm-offset-1 col-sm-3">
			<h2>About me</h2>
			<img class="img-responsive img-circle imageicon" src="images/book.png">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Categories</h2>
				</div>
				<div class="panel-body">
				<?php 
				 		global $ConnectingDB;
						$ViewQuery="select * from category order by datetime desc";
						$Execute=mysqli_query($Connection, $ViewQuery);
						while($DataRows=mysqli_fetch_array($Execute)){
						$Id=$DataRows['id'];	
						$Category=$DataRows['name'];		
				?>		
				<a href="Blog.php?Category=<?php echo $Category; ?>">
				<span id="heading"><?php echo $Category."<br>"; ?></span>
				</a>
				<?php } ?>
				</div>
				<div class="panel-footer"></div>
			</div>

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Recent Post</h2>
				</div>
				<div class="panel-body background">
					<?php 
				 		global $ConnectingDB;
						$ViewQuery="select * from admin_panel order by datetime desc limit 0,7";
						$Execute=mysqli_query($Connection, $ViewQuery);
						while($DataRows=mysqli_fetch_array($Execute)){
						$Id=$DataRows['id'];	
						$Title=$DataRows["title"];
						$DateTime=$DataRows["datetime"];
						$Image=$DataRows["image"];	
						if (strlen($DateTime)>11){$DateTime=substr($DateTime, 0,11);}	
				?>		
				<img class="pull-left" style="margin-top: 10px; margin-left: 10px;" src="Upload/<?php echo htmlentities($Image); ?>" width=70; hight=70;>
				<a href="FullPost.php?id=<?php echo $Id ?>">
				<p id="heading" style="margin-left: 90px;"><?php echo nl2br($Title); ?></p>
				</a>
				<p class="description" style="margin-left: 90px;"><?php echo htmlentities($DateTime) ?></p>
				<hr>

				<?php } ?>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div> <!-- Side area ending -->
	</div> <!-- Row ending -->
</div><!-- Conatainer ending -->


<div id="Footer">
	<hr><p>Theme By | Krishna Shankar | &copy;2016-2020 ---All Right Reserved.</p>
	<a style="color: white; text-decoration: none; cursor: pointer; font-weight: bold;" href="#" target="_blank">
		<p>This Side is only for a reference <br> And if you want download for a refernce than visit my &trade; github account.</hr></p>
	</a>
</div>
</body>
</html>