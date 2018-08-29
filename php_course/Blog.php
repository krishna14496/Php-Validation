<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog Page</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script scr="js/bootstrap.min.js"></script>
	<script scr="js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/publicstyles.css">

	<style>
		.nuv ul li{
			float: left;
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
			<li class="nav-item" class="active"><a href="Blog.php<?php echo "?Page=1" ?>">Blog</a></li>
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
				<?php 
				global $ConnectingDB;
				if (isset($_GET["SearchButton"])) {
					$Search=$_GET["Search"];
					//Query when search button is active
					$ViewQuery="select * from admin_panel
					where datetime like '%$Search%' or title like '%$Search%' or category like '%$Search%' or post like '%$Search%'";
				}
				//Query when category is active url web
				elseif (isset($_GET["Category"])) {
					$Category=$_GET["Category"];
					$ViewQuery="select * from admin_panel where category='$Category' order by datetime desc";
				}
				elseif (isset($_GET["Page"])) {
					//Query when pagination is active ie. page=1
					$Page=$_GET["Page"];
					if ($Page==0||$Page<1) {
						$ShowPostFrom=0;
					}else{
					$ShowPostFrom=($Page*5)-5;}
					$ViewQuery="select * from admin_panel order by datetime desc limit $ShowPostFrom,5";	
				
				}
				else{
					//the Default blof for blog.php
				global $Connection;
				$ViewQuery="select * from admin_panel order by datetime desc limit 0,3";
			}
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
			 		<h1 id="heading"><?php echo htmlentities($Title); ?></h1>
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
			 		<p class="post"><?php 
			 		if (strlen($Post)>150){$Post=substr($Post,0,150).'...';}
			 		echo $Post; ?></p>
			 	</div>
			 	<a href="FullPost.php?id=<?php echo $PostId; ?> ">
			 		<span class="btn btn-info">Read More &rsaquo;&rsaquo; </span>
			 	</a>
			 </div>
			 <?php } ?>
			 <nav>
			 <ul class="pagination pull-left pagination-lg">
			 <!-- Creating backward button -->
			 <?php 
			 	if (isset($Page))
			 	 {
			 		if ($Page>1) {
			  ?>
			  <li><a href="Blog.php?Page=<?php echo $Page-1 ?>">&laquo;</a></li>
			  <?php } 
				}
			  ?>
			 <?php 
			 $ConnectingDB;
			 $QueryPagination="select count(*) from admin_panel";
			 $ExecutePagination=mysqli_query($Connection, $QueryPagination);
			 $RowPagination=mysqli_fetch_array($ExecutePagination);
			 	$TotalPost=array_shift($RowPagination);
			 	// echo $TotalPost;
			 	$PostPagination=$TotalPost/5;
			 	$PostPagination=ceil($PostPagination);
			 	// echo $PostPagination;
			 	for ($i=1; $i <=$PostPagination ; $i++) { 
			 	if (isset($Page)) {
			 		// Pagination 1 to 7
			 		if ($i==$Page) {
					  ?>
					  <li class="active"><a href="Blog.php?Page=<?php echo $i; ?> "><?php echo $i; ?></a></li>
					  <?php 
					}else{	?>
						<li><a href="Blog.php?Page=<?php echo $i; ?> "><?php echo $i; ?></a></li>
					  <?php  	
			  		}
			  	}
			  } ?>
			  <!-- Creating forward button -->
			  <?php 
			 	if (isset($Page))
			 	 {
			 		if ($Page+1<=$PostPagination) {
			  ?>
			  <li><a href="Blog.php?Page=<?php echo $Page+1 ?>">&raquo;</a></li>
			  <?php } 
				}
			  ?>
			  </ul>
			  </nav>
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
				<br>
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