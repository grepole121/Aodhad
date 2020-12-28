<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<title>AodHad - Upload</title>
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
if(!empty($_SESSION['username'])){
	echo '<form action="upload_file.php" method="post"
enctype="multipart/form-data" style="font-size:20pt; color:#8B4500;">

<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<p id="name_css">Name(Please Enter A Name Or No One Will Be Able To Search For It Probably.):</p><input id="name" type="text" name="name">
<br />
Description:<textarea id="description" name="description" rows="5" cols="23"></textarea>
<br />
<input type="submit" name="submit" value="Submit" />
</form>
';
}else{
		echo '<h4 id="user" style="text-align:left;margin:15px;">You Need To Login To Upload.</h4><br><br>';
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