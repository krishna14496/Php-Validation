<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script scr="js/bootstrap.min.js"></script>
	<script scr="js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">
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
			<li class="nav-item" class="active">
			<a href="Blog.php<?php echo "?Page=1" ?>" target="_blank">Blog</a></li>
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
					<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<span class="label label-warning"><?php echo $TotalUnApproved; ?></span>
					<?php } ?>	 		
				</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blogs</a></li>
				<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
			</ul>

		</div><!-- Ending of side area -->
		<div class="col-sm-10"><!-- Main area -->
			<br>
			<div><?php echo Message(); 
			echo SuccessMessage();
			?></div>
			<h1>Admin Dashboard</h1>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No.</th>
						<th>Post Title</th>
						<th>Date& Time</th>
						<th>Author</th>
						<th>Category</th>
						<th>Banner</th>
						<th>Comments</th>
						<th>Action</th>
						<th>Details</th>
					</tr>
					<?php 
						global $ConnectingDB;
						$ViewQuery="select * from admin_panel order by datetime desc";
						$Execute=mysqli_query($Connection, $ViewQuery);
						$SrNo=0;
						while ($DataRows=mysqli_fetch_array($Execute)) {
							$Id=$DataRows["id"];
							$DateTime=$DataRows["datetime"];
							$Title=$DataRows["title"];
							$Category=$DataRows["category"];
							$Admin=$DataRows["author"];
							$Image=$DataRows["image"];
							$Post=$DataRows["post"];					
					 		$SrNo++;
					 ?>
					 <tr>
					 	<td><?php echo $SrNo; ?></td>
					 	<td style="color: #5e5eff;"><?php 
					 	if (strlen($Title)>20){$Title=substr($Title,0,20).'..';}
					 	echo $Title; ?></td>
					 	<td><?php 
					 	if (strlen($DateTime)>11){$DateTime=substr($DateTime,0,11).'..';}
					 	echo $DateTime; ?></td>
					 	<td><?php 
					 	if (strlen($Admin)>6){$Admin=substr($Admin,0,6).'..';}
					 	echo $Admin; ?></td>
					 	<td><?php 
					 	if (strlen($Category)>10){$Category=substr($Category,0,10).'..';}
					 	echo $Category; ?></td>
					 	<td><img src="Upload/<?php echo $Image; ?>" style="width: 170px; height: 50px;" ></td>
					 	<td>
							<?php 
								$ConnectingDB;
								$QueryApproved="select count(*) from comment where admin_panel_id='$Id' and status='on' ";
								$ExecuteApproved=mysqli_query($Connection, $QueryApproved);
								$RowsApproved=mysqli_fetch_array($ExecuteApproved);
								$TotalApproved=array_shift($RowsApproved);	
								if ($TotalApproved>0) {
							?>
							<span class="label label-success"><?php echo $TotalApproved; ?></span>
							<?php } ?>	
							<?php 
								$ConnectingDB;
								$QueryUnApproved="select count(*) from comment where admin_panel_id='$Id' and status='off' ";
								$ExecuteUnApproved=mysqli_query($Connection, $QueryUnApproved);
								$RowsUnApproved=mysqli_fetch_array($ExecuteUnApproved);
								$TotalUnApproved=array_shift($RowsUnApproved);	
								if ($TotalUnApproved>0) {
							?>
							<!-- <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							 --><span class="label pull-right label-danger"><?php echo $TotalUnApproved; ?></span>
							<?php } ?>	 		
					 	</td>
					 	<td>
					 	<a href="EditPost.php?Edit=<?php echo $Id; ?>">
					 	<span class="btn btn-warning">Edit</span>
					 	</a> 
					 	<a href="DeletePost.php?Delete=<?php echo $Id; ?>">
					 	<span class="btn btn-danger">Delete</span>
					 	</a>
					 	<td>
					 	<a href="FullPost.php?id=<?php echo $Id; ?> " target="_blank">
					 	<span class="btn btn-info">Live Preview</span>
					 	</a>
					 	</td>
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