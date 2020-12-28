<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>AodHad - Home</title>
</head>
<body>
<div id="ederyting">
<?php
	include ('top_nav.php');
?>
<section>


<?php
	if((!empty($_POST['signinkeep']))){
		$signinbox = ($_POST['signinkeep']);
	}else 
	$signinbox = '';
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];


if($username&&$password){
	// on upload change from root to users and change back for testing purposes
	include ('mysql_conn.php');
	$query = "SELECT * FROM users WHERE username = '$username'";
	$result = mysql_query($query);
	if($result){
	$numrows = mysql_num_rows($result);
	}else die('ERROR Connecting To DataBase.');
	if($numrows!=0){
		while($row = mysql_fetch_assoc($result)){
			$dbusername = $row['username'];
			$dbpassword = $row['password'];
		}
		
		
		if($username==$dbusername&&md5($password)==$dbpassword){
			echo 'Logged In <a href="index.php">Click Me</a> To Go Back To The Homepage.';
			$_SESSION['username']=$dbusername;
			$_SESSION['password']=$dbpassword;
			if($signinbox!=''){
			setcookie("aodhaduser", $_SESSION['username'], time()+99999999999999);
			setcookie("aodhadpass", $_SESSION['password'], time()+99999999999999);
		
			}
			
		}else
			echo 'Incorrect Password.';
		
	}else
		die('User Does Not Exist.');
	
	
}else
	die('Please Enter A Username And Password.');

?>
</section>
<aside>

</aside>
<footer><img src="copyrightimg.png"></img></footer>
</div>
</body>
</html>