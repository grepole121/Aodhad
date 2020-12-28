<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>AodHad - Search</title>
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
	include ('mysql_conn.php');
	
	if(isset($_GET['top_search'])){
		$search = $_GET['top_search'];
		if(!empty($search)){
			$query = "SELECT * FROM `search` WHERE `search` LIKE '%".mysql_real_escape_string($search)."%'";
			$query_u = "SELECT * FROM `users` WHERE `username` LIKE '%".mysql_real_escape_string($search)."%'";
			$query_run = mysql_query($query);
			$query_run_u = mysql_query($query_u);
		}else{
			$query = "SELECT * FROM `search`";
			$query_u = "SELECT * FROM `search`";
			$query_run = mysql_query($query);
			$query_run_u = mysql_query($query);
		}
		if(mysql_num_rows($query_run_u)>=1){
			if(!mysql_num_rows($query_run)>=1){
				echo '<h3 style="font-size:20pt;color:#987654;margin:12px;padding:10px;">Results For ' . $search . '</h3><br><br>';
			}
		
		while($query_row_u = mysql_fetch_assoc($query_run_u)){
				echo '<div style="border:1px solid #453516;width:500px;padding:0px;">
				<h3 style="font-size:20pt;color:#987654;margin:12px;padding:10px;width:500px;">'. $query_row_u['link_username'] . ', Hub</div></h3><br><br></div>';
			}
			}
		if(mysql_num_rows($query_run)>=1){
			if(!mysql_num_rows($query_run_u)>=1){
			echo '<h3 style="font-size:20pt;color:#987654;margin:12px;padding:10px;">Results For ' . $search . '</h3><br><br>';
			}
			
			while($query_row = mysql_fetch_assoc($query_run)){
				
				$height = $query_row['description'];
				$height = strlen($height);
				$height = $height / 2;
				if($height<40){
					$height = $height + 35;
				}
				if($height<70){
					$height = $height + 45;
				
				}
				if($height<100){
					$height = $height + 59;
				}
				
				echo '<div style="border:1px solid #453516;width:500px;padding:0px;height:'.$height.'px;">
				<h3 style="font-size:20pt;color:#987654;margin:12px;padding:10px;width:500px;">' .
				$query_row['search'] . '<br><div id="search_description">' . $query_row['description'] . '<br>Uploaded By: '. $query_row['username'] .'<br>Uploaded On: '.$query_row['date'].' : '.$query_row['time'].'</div></h3><br><br></div>';
				
			}
			}else{
			echo '<h3 style="font-size:20pt;color:#987654;margin:12px;padding:10px;">No Results Found For: ' . $search . '</h3>';
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