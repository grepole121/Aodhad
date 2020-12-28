<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>AodHad - Edit</title>
	<link href="video-js.css" rel="stylesheet" type="text/css">
	<script src="video.js"></script>
</head>
<body>
<div id="ederyting">
<?php
	include ('top_nav.php');
	include ('mysql_conn.php');
 if(isset($_COOKIE['aodhaduser'])){
      $_SESSION['username'] = $_COOKIE['aodhaduser'];
      $_SESSION['password'] = $_COOKIE['aodhadpass'];
   }


		
   echo '<section>';

   if(!empty($_GET['e'])){
		$e = $_GET['e'];
		$username = file_get_contents('videos/name' . $e . '.txt');
		
		if($username==$_SESSION['username']){
		$e = $_GET['e'];
		$description = file_get_contents('videos/description' . $e . '.txt');
		$title = file_get_contents('videos/title' . $e . '.txt');
		
		if(isset($_REQUEST['title'])){
			if(isset($_REQUEST['description'])){
				$description = $_REQUEST['description'];
			}else{
				$description = 'No Description Typed.';
			}
				$title = $_REQUEST['title'];
				$title = strip_tags($title);
				$description = strip_tags($description);
				$username = $_SESSION['username'];
				$title_handle = fopen('videos/title' . $e . '.txt', 'w');	
				$description_handle = fopen('videos/description' . $e . '.txt', 'w');
				if(preg_match("/$e/", 'users/'.$username.'.php')) {
				$redo_account = file_get_contents('users/'.$username.'.php', 'a');
				$orig_title = file_get_contents('videos/title'.$e.'.txt');
				
				$replace = str_replace($orig_title, $title, $redo_account);
				}
				
				$account = 'users/'.$username.'.php';
				
				$href = '"watch.php?w='.$e.'"';

				mysql_query("UPDATE  `aodhad`.`search` SET  `search` =  '<a href=$href>$title</a>' WHERE  `search`.`id` =$e");
				mysql_query("UPDATE  `aodhad`.`search` SET  `description` =  '$description' WHERE  `search`.`id` =$e");
				
				fwrite($title_handle, $title);
				fwrite($description_handle, $description);
				
				
				echo '<div id="save"><h3>Saved</h3><p><a href="watch.php?w='.$e.'">Click Me To View It</a></p></div>';
		}else{

		
		echo '<form action="edit.php?e='.$e.'" method="POST">
					<div style="color:black;">Title:</div> <textarea type="text" name="title" cols="70" rows="3">'.$title.'</textarea><br><br>
					Description:<br> <textarea name="description" rows="10" cols="50">'.$description.'</textarea><br>
					<div id="save">
					<input type="submit" name="submit" value="Save">
					</div>
					</form>';
		}
		}else{
			echo 'This Is Not Your Video.';
		}
		$e = $_GET['e'];
		$users_dir = 'users';
		$users = scandir($users_dir, 0);
		unset($users[0], $users[1]);

		if(in_array($e . '.php', $users)){
			include ($users_dir . '/' . $e . '.php');
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