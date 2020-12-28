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
	 if(isset($_COOKIE['aodhaduser'])){
      $_SESSION['username'] = $_COOKIE['aodhaduser'];
      $_SESSION['password'] = $_COOKIE['aodhadpass'];
   }

?>
<section>

<?php
		$submit = strip_tags($_POST['submit']);
		$username = strip_tags($_REQUEST['username']);
		$password = strip_tags($_REQUEST['password']);
		$cpassword = strip_tags($_REQUEST['cpassword']);
		$username = strtolower($username);
	if($submit){
	
			include ('mysql_conn.php');
			
			
			$namecheck = mysql_query('SELECT username FROM users WHERE username = "'.$username.'"');
			$count = mysql_num_rows($namecheck);
			if($count!=0){
				die('Username Has Been Taken Please <a href="register.php">Click Me</a> To Go Back To Register');
			}
		if($username&&$password&&$cpassword){
			
			if($password==$cpassword){
			
			$click_me = 'users.php?u=' . $username;

			$handle2 = fopen('users/' . $username . '.php', 'w');
			fwrite($handle2, "<div id='user_page'><h2>".$username."'s Account Hub</h2><br>Videos:</div>");
			$link_to_users = "<a href='$click_me'>$username</a>";
			
			$password = md5($password);
			$cpassword = md5($cpassword);
			$link_username = '<a href=users.php?u='.$username.'>'.$username.'</a>';
			mysql_query("INSERT INTO users VALUES ('','$username','$password','$link_username','')");
			mysql_query("INSERT INTO search VALUES ('','','','$link_username','','')");
			
			echo 'Registered <a href="sign_in.php">Click Me To Login</a>';
			
			
			
			}else{
			echo 'Passwords Do Not Match.';
			}
			
				
			
			
		
		}else{
			echo 'Please Fill In <b>Every</b> Box!';
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