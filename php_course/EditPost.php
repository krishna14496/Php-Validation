<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>

<?php 
	if (isset($_POST["Submit"])) {
		$Title=$_POST["Title"];
		$Category=$_POST["Category"];
		$Post=$_POST["Post"];
		date_default_timezone_set("Asia/Kolkata");//select states of world
		$CurrentTime=time();      //current time
		//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);// describe month day year    hour mints and seconds.
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);// describe year month day    hour mints and seconds.
		$DateTime;
		$Admin="krishna";
		$Image=$_FILES["Image"]["name"];
		$Target="Upload/".basename($_FILES["Image"]["name"]);
		if(empty($Title)) {
			$_SESSION["ErrorMessage"]="Title Can't be empty";
			Redirect_to("AddNewPost.php");

		}
		elseif (strlen($Title)<2) {
			$_SESSION["ErrorMessage"]="Title should be at least two characters";
			Redirect_to("AddNewPost.php");
		}
		else{

			global $ConnectingDB;
			$EditFromURL=$_GET['Edit'];
			$Query="update admin_panel set  datetime='$DateTime',title='$Title',category='$Category', author='$Admin',image='$Image'
			,post='$Post' where id='$EditFromURL'";
			$Execute=mysqli_query($Connection,$Query);
			if ($Execute) {
				move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
				$_SESSION["SuccessMessage"]="Post Updated Successfully ";
				Redirect_to("dashboard.php");
			}else{
				$_SESSION["ErrorMessage"]="Something went wrong Try Again !";
				Redirect_to("dashboard.php");
			}
			}
		}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Post</title>
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
		<a href="Blog.php" class="navbar-brand">
			<img style="margin-top: -15px;" src="images/image1.jpg" width="200" height="50">
		</a>
		</div>
		<div class="collapse navbar-collapse" id="collapse">
		<ul class="nav navbar-nav">
			<li class="nav-item"><a href="#">Home</a></li>
			<li class="nav-item" class="active"><a href="Blog.php" target="_blank">Blog</a></li>
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

<br>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
			<ul id="Side_Menu" class="nav nav-pills nav-stacked">
				<li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
				<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
				<li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categoris</a></li>
				<li><a href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
				<li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments
					<?php 
						$ConnectingDB;
						$QueryTotalUnApproved="select count(*) from comment where status='off' ";
						$ExecuteTotalUnApproved=mysqli_query($Connection, $QueryTotalUnApproved);
						$RowsTotalUnApproved=mysqli_fetch_array($ExecuteTotalUnApproved);
						$TotalUnApproved=array_shift($RowsTotalUnApproved);	
						if ($TotalUnApproved>0) {
					?>
					<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<span class="label label-warning"><?php echo $TotalUnApproved; ?></span>
					<?php } ?>	 		

				</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blogs</a></li>
				<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
			</ul>

		</div><!-- Ending of side area -->
		<div class="col-sm-10">
			<h1>Update Post</h1>
			<div><?php 
			echo Message(); 
			echo SuccessMessage();
			?></div>
			<div>
			<?php 
					$SearchQueryParameter=$_GET['Edit'];	
					global $ConnectingDB;
					$Query="select * from admin_panel where id='$SearchQueryParameter'";
					$ExecuteQuery=mysqli_query($Connection,$Query);
					while ($DataRows=mysqli_fetch_array($ExecuteQuery)) {
						$TitleToBeUpdated=$DataRows["title"];
						$CategoryToBeUpdated=$DataRows["category"];
						$ImageToBeUpdated=$DataRows["image"];
						$PostToBeUpdated=$DataRows["post"];					
				 	}
				 ?>
				
				<form action="EditPost.php?Edit=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
							<label for="title"><span class="FieldInfo">Title:</span></label>
	 						<input value="<?php echo $TitleToBeUpdated; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title...">
						</div>
						<div class="form-group">
						<label for="categoryselect"><span class="FieldInfo">Existing Category:</span></label>
					 	<?php echo $CategoryToBeUpdated; ?>
						<br>
							<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
					 		<select class="form-control" id="categoryselect" name="Category">
								<?php 
									global $ConnectingDB;
									$ViewQuery="select * from category order by datetime desc";
									$Execute=mysqli_query($Connection, $ViewQuery);	
									while ($DataRows=mysqli_fetch_array($Execute)) {
										$Id=$DataRows["id"];
										$CategoryName=$DataRows["name"];
								 ?>
								 <option><?php echo $CategoryName; ?></option>
								 <?php } ?>
							</select>	 
						</div> 
						<div class="form-group">
							<label for="Imageselect"><span class="FieldInfo">Existing Image:</span></label>
					 		<img src="Upload/<?php echo $ImageToBeUpdated; ?>" style="width: 170px;height: 70;">
							<br>
							<label for="Imageselect"><span class="FieldInfo">Select Image:</span></label>
							<input class="form-control" type="file" name="Image" id="imageselect">
						</div>
						<div class="form-group">
							<label for="postarea"><span class="FieldInfo">Post:</span></label>
							<textarea class="form-control" name="Post" id="postarea">
								<?php echo $PostToBeUpdated; ?>
							</textarea>
						</div>
						<br>
						<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Update Post">
						<br>
					</fieldset>
				</form>
			</div>
			</div>
		</div><!-- Ending of a main area. -->
	</div><!-- Ending of row -->
</div><!-- ending of container fluid -->
	
<div id="Footer">
	<hr><p>Theme By | Krishna Shankar | &copy;2016-2020 ---All Right Reserved.</p>
	<a style="color: white; text-decoration: none; cursor: pointer; font-weight: bold;" href="#" target="_blank">
		<p>This Side is only for a reference <br> And if you want download for a refernce than visit my &trade; github account.</hr></p>
	</a>
</div>
</body>
</html>