<!-- <?php 
date_default_timezone_set("Asia/Kolkata");//select states of world
$CurrentTime=time();      //current time
$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);// describe year month day    hour mints and seconds.
echo $DateTime;
 ?>
 <!-- 2nd method -->
 <br>
<!-- Sql method of date and time -->
 <?php 
date_default_timezone_set("Asia/Kolkata");//select states of world
$CurrentTime=time();      //current time
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);// describe year month day    hour mints and seconds.
echo $DateTime;
 ?>