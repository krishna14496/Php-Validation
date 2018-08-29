<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>

<?php 
	if (isset($_POST["Submit"])) {
		$Category=$_POST["Category"];
		date_default_timezone_set("Asia/Kolkata");//select states of world
		$CurrentTime=time();      //current time
		//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);// describe month day year    hour mints and seconds.
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);// describe year month day    hour mints and seconds.
		$DateTime;
		$Admin=$_SESSION["Username"];
		if(empty($Category)) {
			$_SESSION["ErrorMessage"]="All Fields must be filled out";
			Redirect_to("categories.php");

		}
		elseif (strlen($Category)>99) {
				$_SESSION["ErrorMessage"]="Too long Name";
				Redirect_to("categories.php");
			}else{
				global $ConnectingDB;
				$Query="insert into category(datetime,name,creatorname) values('$DateTime','$Category','$Admin')";
				$Execute=mysqli_query($Connection,$Query);
				if ($Execute) {
					$_SESSION["SuccessMessage"]="Category Added Successfully  .";
					Redirect_to("categories.php");
				}else{
					$_SESSION["ErrorMessage"]="Category Faileed to Add .";
					Redirect_to("categories.php");
				}
			}
		}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
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
			<li class="nav-item" class="active"><a href="Blog.php<?php echo "?Page=1" ?>" target="_blank">Blog</a></li>
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
				<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
				<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span> Add New Post</a></li>
				<li class="active"><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categoris</a></li>
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
			<h1>Manage Categories</h1>
			<div><?php 
			echo Message(); 
			echo SuccessMessage();
			?></div>
			<div>
				<form action="categories.php" method="post">
					<fieldset>
						<div class="form-group">
							<label for="categoryname"><span class="FieldInfo">Name:</span></label>
	 						<input class="form-control" type="text" name="Category" id="categoryname" placeholder="Enter Your Name...">
						</div>
						<br>
						<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
						<br>
					</fieldset>
				</form>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>Sr No.</th>
						<th>Date & Time</th>
						<th>Category Name</th>
						<th>Creator Name</th>
						<th>Action</th>
					</tr>
					<?php 
						global $ConnectingDB;
						$ViewQuery="select * from category order by datetime desc";
						$Execute=mysqli_query($Connection, $ViewQuery);
						$SrNo=0;	
						while ($DataRows=mysqli_fetch_array($Execute)) {
							$Id=$DataRows["id"];
							$DateTime=$DataRows["datetime"];
							$CategoryName=$DataRows["name"];
							$CreatorName=$DataRows["creatorname"];
							$SrNo++;
					 ?>
					 <tr>
					 	<td><?php echo $SrNo; ?></td>
					 	<td><?php echo $DateTime; ?></td>
					 	<td><?php echo $CategoryName; ?></td>
					 	<td><?php echo $CreatorName; ?></td>
					 	<td><a href="DeleteCategory.php?id=<?php echo $Id; ?> ">
					 	<span class="btn btn-danger">Delete</span></a></td>
					 </tr>
					 <?php } ?>
				</table>
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