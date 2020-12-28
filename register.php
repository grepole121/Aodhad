<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>AodHad - Register</title>
</head>
<body>
<div id="ederyting">
<?php
	include ('top_nav.php');
?>
<section>
<div id="reg">

<form action="register_validate.php" method="POST">
	Username:<br> <input type="text" name="username"><br>
	Password:<br> <input type="password" name="password"><br>
	Confirm Password:<br> <input type="password" name="cpassword"><br>
	<input type="submit" name="submit" value="Log In">
</form>
</div>
</section>
<aside>
<?php include ('sidebar.php'); ?>
</aside>
<footer><img src="copyrightimg.png"></img></footer>
</div>
</body>
</html>