<div id="header">
<a href="index.php"><img src="aodhad.png" height="105px" width="261px"></img></a>
</div>

<nav id="nav">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="sign_in.php">Sign In/Register</a></li>
		<li><a href="uploadpage.php">Upload</a></li>
		<?php 
		session_start();
	
		if(isset($_COOKIE['aodhaduser']))
		{
			$_SESSION['username'] = $_COOKIE['aodhaduser'];
			$_SESSION['password'] = $_COOKIE['aodhadpass'];
		}
	
		if(!empty($_SESSION['username'])){
		echo '<li><a href="users.php?u='.$_SESSION["username"].'">'.$_SESSION["username"].'</a></li>';
		} 
		?>
		</ul>
		<div id="search">
		<form method="GET" action="search.php">
		<input type="image" name="search_button" id="search" src="search.jpg" width="24px" height="24px">
		<input type="text" name="top_search" id="search_box">
		<script type="text/javascript">
			var text_input = document.getElementById ('search_box');
			text_input.focus ();
			text_input.select ();
		</script>
		</form>
		<?php 
		if(!empty($_SESSION['username'])){
		echo '<div id="user"><h4>Hello ' . $_SESSION['username'] . '!<br><a href="logout.php">Log Out</a></h4></div>';
		}elseif(strpos($_SERVER['PHP_SELF'], 'sign_in.php')){
			echo '<h3 id="reg_text"><a href="register.php">Register</a></h3>';
		}
		?>
		</div>
</nav>
