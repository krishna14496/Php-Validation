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
				<li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
				<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
				<li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categoris</a></li>
				<li><a href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
				<li class="active"><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments
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
		<div class="col-sm-10"><!-- Main area -->
			<br>
			<div><?php echo Message(); 
			echo SuccessMessage();
			?></div>
			<h1>Un-Approved Comments</h1>
						<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Date& Time</th>
						<th>Comment</th>
						<th>Approve</th>
						<th>Delete Comment</th>
						<th>Details</th>
					</tr>
					<?php 
					global $ConnectingDB;
					$Query="select * from comment where status='Off' order by datetime desc";
					$Execute=mysqli_query($Connection, $Query);
						$SrNo=0;
						while ($DataRows=mysqli_fetch_array($Execute)) {
							$CommentId=$DataRows["id"];
							$DateTimeOfComment=$DataRows["datetime"];
							$PersonName=$DataRows["name"];
							$PersonComment=$DataRows["comment"];
							$CommentedPostId=$DataRows["admin_panel_id"];
						 	$SrNo++;
							if (strlen($PersonComment)>30){$PersonComment=substr($PersonComment,0,30).'..';}
							if (strlen($PersonName)>12){$PersonName=substr($PersonName,0,12).'..';}
						 ?>
					 <tr>
					 	<td><?php echo htmlentities($SrNo); ?></td>
					 	<td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?></td>
					 	<td><?php echo htmlentities($DateTimeOfComment); ?></td>
					 	<td><?php echo htmlentities($PersonComment); ?></td>
					 	<td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>">
					 	<span class="btn btn-success">Approve</span></a>
					 	</td>
					 	<td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>">
					 	<span class="btn btn-danger">Delete</span></a>
					 	</td>
					 	<td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?> " target="_blank">
					 	<span class="btn btn-primary">Live Preview</span></a>
					 	</td>
					 </tr>
					<?php } ?>

				</table>
			</div>
			<hr>
			<h1>Approved Comments</h1>
						<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Date& Time</th>
						<th>Comment</th>
						<th>Approve By</th>
						<th>Revert Approve</th>
						<th>Delete Comment</th>
						<th>Details</th>
					</tr>
					<?php 
						global $ConnectingDB;
						$Query="select * from comment where status='On' order by datetime desc";
						$Execute=mysqli_query($Connection, $Query);
						$SrNo=0;
						while ($DataRows=mysqli_fetch_array($Execute)) {
							$CommentId=$DataRows["id"];
							$DateTimeOfComment=$DataRows["datetime"];
							$PersonName=$DataRows["name"];
							$PersonComment=$DataRows["comment"];
							$ApprovedBy=$DataRows["approvedby"];
							$CommentedPostId=$DataRows["admin_panel_id"];
						 	$SrNo++;
						 	if (strlen($PersonComment)>30){$PersonComment=substr($PersonComment,0,30).'..';}
							if (strlen($PersonName)>12){$PersonName=substr($PersonName,0,12).'..';}
						 ?>
					 <tr>
					 	<td><?php echo htmlentities($SrNo); ?></td>
					 	<td style="color: #5e5eff;"><?php echo htmlentities($PersonName); ?></td>
					 	<td><?php echo htmlentities($DateTimeOfComment); ?></td>
					 	<td><?php echo htmlentities($PersonComment); ?></td>
					 	<td><?php echo htmlentities($ApprovedBy); ?></td>
					 	<td><a href="DisApproveComments.php?id=<?php echo $CommentId; ?>">
					 	<span class="btn btn-warning">Dis-Approve</span></a>
					 	</td>
					 	<td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>">
					 	<span class="btn btn-danger">Delete</span></a>
					 	</td>
					 	<td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?> " target="_blank">
					 	<span class="btn btn-primary">Live Preview</span></a>
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