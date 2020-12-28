<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>AodHad - Logout</title>
</head>
<body>
<div id="ederyting">
<?php
	include ('top_nav.php');
	session_destroy();

		setcookie("aodhaduser", $_SESSION['username'], time()-99999999999999);
		setcookie("aodhadpass", $_SESSION['password'], time()-99999999999999);
?>
<section>
<h3>Logged Out!</h3>

</section>
<aside>
<?php include ('sidebar.php'); ?>
</aside>
<footer><img src="copyrightimg.png"></img></footer>
</div>
</body>
</html>


		