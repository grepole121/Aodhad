<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>AodHad - Watching</title>
	<link href="video-js.css" rel="stylesheet" type="text/css">
	<script src="video.js"></script>
</head>
<body>
<div id="ederyting">
<?php
	if(empty($_GET['w'])){
		die('<h2>Page Not Found.</h2>');
		$w = $_GET['w'];
		$w = 'videos/' . $w . '.php';
		if(!empty($w)){
			die('<h1>Video Not Found.</h1>');
		}
	}
	
	include ('top_nav.php');
 if(isset($_COOKIE['aodhaduser'])){
      $_SESSION['username'] = $_COOKIE['aodhaduser'];
      $_SESSION['password'] = $_COOKIE['aodhadpass'];
   }
		

		if(!empty($_GET['w'])){
			$w = $_GET['w'];
			$videotxt = 'videos/name' . $w . '.txt';
			if(!file_exists($videotxt)){
				die('<h1 style="text-align:center;color:#893041;">Video No Longer Exists</h1><aside>
				<?php include ("sidebar.php"); ?>
				</aside>
				<footer><img src="copyrightimg.png"></img></footer>
				</div>
				</body>
				</html>');
			}
			$usernameopen = fopen('videos/name' . $w . '.txt', 'r');
			$username = fgets($usernameopen);
			fclose($usernameopen);

			$views_count = ("videos/views" . $w . ".txt");
			$views = file($views_count);
			$views[0] ++;
			$fp = fopen($views_count , "w");
			fputs($fp , "$views[0]");
			fclose($fp);
			
			echo '<div id="username"><h4>Uploaded By: ' . $username . '</h4><br><h3 id="views">Views: '.$views[0].'</h3><br><h4 style="text-align:right;font-size:8pt;">(Please Do Not Exploit The Views System.)</h4></div> ';
		}
		
   echo '<section>';

		if(!empty($_GET['w'])){
		$videos_dir = 'videos';
		$videos = scandir($videos_dir, 0);
		unset($videos[0], $videos[1]);
		
		$w = $_GET['w'];
		$src = $videos_dir . '/' . $w . '.flv';
		$poster = $src;
		
		$title = file_get_contents('videos/title' . $w . '.txt');
		$description = file_get_contents('videos/description' . $w . '.txt');
		echo '<h3 style="font-family:Tahoma; color:#583495;">Title:<br><br>
		'.$title.'
		</h3><br><h3 style="font-family:Tahoma; color:#583495;">Description:</h3><h4 style="font-family:Tahoma; color:#583495;">
		'.$description.'
		</h4>';

		if(in_array($w . '.txt', $videos)){
			include ($videos_dir . '/' . $w . '.txt');
		}else{
			$src = 'error.flv';
			$poster= 'not_found.jpg';
		}
		}
?>
  <br>
  <video id="example_video_1" class="video-js vjs-default-skin" <?php echo 'poster="'.$poster.'"'; ?>controls preload="none" width="640" height="264"
      data-setup="{}">
   <?php
   echo '<source src="'.$src.'" type="video/mp4" />'; 
   ?>
  </video>
<aside>
<?php include ('sidebar.php'); ?>
</aside>
<footer><img src="copyrightimg.png"></img></footer>
</div>
</body>
</html>