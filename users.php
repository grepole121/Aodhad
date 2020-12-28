<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>
	AodHad - 
	<?php if(!empty($_GET['u'])){
	$u = $_GET['u'];
	echo $u . "'s Hub";
	}?>
	</title>
	<link href="video-js.css" rel="stylesheet" type="text/css">
	<script src="video.js"></script>
</head>
<body>
<div id="ederyting">
<?php
	include ('top_nav.php');
 if(isset($_COOKIE['aodhaduser'])){
      $_SESSION['username'] = $_COOKIE['aodhaduser'];
      $_SESSION['password'] = $_COOKIE['aodhadpass'];
   }


		
   echo '<section>';
		
		if(!empty($_GET['u'])){
		$users_dir = 'users';
		$users = scandir($users_dir, 0);
		unset($users[0], $users[1]);
		if(!$_SESSION['username']){
			$_SESSION['username'] = null;
		}
		if($u==$_SESSION['username']){			
			
			echo '<h3>Welcome to your page.</h3>';
			
		}
		$videos_check = file_get_contents('users/'.$u.'.php');

		if(in_array($u . '.php', $users)){
			include ($users_dir . '/' . $u . '.php');
		}
		
		}
?>
</section>
<aside>
<?php include ('sidebar.php'); ?>
</aside>
<footer><img src="copyrightimg.png"></img></footer>
</div>
</body>
</html>