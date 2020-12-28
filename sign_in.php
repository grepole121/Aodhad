<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>AodHad - Log In</title>
</head>
<body>
<div id="ederyting">
<?php
	include ('top_nav.php');
?>
<section>
<div id="signin">
<?php
 if(isset($_COOKIE['aodhaduser'])){
      $_SESSION['username'] = $_COOKIE['aodhaduser'];
      $_SESSION['password'] = $_COOKIE['aodhadpass'];
   }
if(!empty($_SESSION['username'])){
	echo "You're Already Logged In.";
}else{
echo '<form action="login.php" method="POST">
	<div style="color:black;">Username:</div><br>(Please Type Lowercase<br> For Login As Will Automatically<br> Be ConvertedTo Lowercase Anyway)<br> <input type="text" name="username"><br>
	Password:<br> <input type="password" name="password"><br>
	Keep Me Signed In:<input type="checkbox" name="signinkeep"><br>
	<input type="submit" name="submit" value="Log In">
</form>';
}
?>
</div>

</section>
<aside>
<?php include ('sidebar.php'); ?>
</aside>
<footer><img src="copyrightimg.png"></img></footer>
</div>
</body>
</html>