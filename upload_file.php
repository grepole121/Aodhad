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
	 if(isset($_COOKIE['aodhaduser'])){
      $_SESSION['username'] = $_COOKIE['aodhaduser'];
      $_SESSION['password'] = $_COOKIE['aodhadpass'];
   }

?>
<section>
<?php
if(!empty($_SESSION['username'])){
if(isset($_POST['description'])){
	$description = $_POST['description'];
	$description = wordwrap($description, 70, "<br>\n", true);
	
}else{
$description = 'No Description Typed';
}

if ((($_FILES["file"]["type"] == "video/mp4")
|| ($_FILES["file"]["type"] == "video/flv")
|| ($_FILES["file"]["type"] == "video/mpeg")
|| ($_FILES["file"]["type"] == "video/wmv")
|| ($_FILES["file"]["type"] == "video/avi")
|| ($_FILES["file"]["type"] == "video/mxf")
|| ($_FILES["file"]["type"] == "video/ogg")
|| ($_FILES["file"]["type"] == "video/webm"))
&& ($_FILES["file"]["size"] < 5368709120))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {


      move_uploaded_file($_FILES["file"]["tmp_name"],
      "videos/" . $_FILES["file"]["name"]);
      
    }
  }
else
  {
  echo "Invalid file the file must be mp4, flv, avi, mpeg or wmv";
}
if ((($_FILES["file"]["type"] == "video/mp4")|| ($_FILES["file"]["type"] == "video/flv")|| ($_FILES["file"]["type"] == "video/mpeg")|| ($_FILES["file"]["type"] == "video/wmv")|| ($_FILES["file"]["type"] == "video/avi"))&& ($_FILES["file"]["size"] < 5368709120)){


$vid_name = '<h3>' . $_FILES["file"]["name"] . '</h3>';
$filename = $_FILES["file"]["name"];
$name = substr($filename, 0, strrpos($filename, '.')); 


$dir = 'videos/';
$number_of_files = sizeof (scandir ($dir) ) -2;
$count = $number_of_files + 5;

$vid_src = $count . '.flv';


$click_me = 'watch.php?w=' . $count;
echo 'Uploaded <a href="'.$click_me.'">Click Me</a> To View It';

$username = $_SESSION['username'];
$link_username = '<a href="users.php?u='.$username.'">'.$username.'</a>';
$username_file = fopen('videos/name' . $count . '.txt', 'w');
fwrite($username_file, $username);
$my_videos_add = fopen('users/' . $username . '.php', 'a');
		
		$handle = fopen($dir . '/views' . $count . '.txt', 'w');
		fwrite($handle, '0');

$handle2 = fopen('videos/title' . $count . '.txt', 'w');
$description_handle = fopen('videos/description' . $count . '.txt', 'w');
if(isset($_REQUEST['name'])){
			$vid_name = $_REQUEST['name'];
			$videos_check = file_get_contents('users/'.$username.'.php');
			
			$edit = "<div id='edit'><a href='edit.php?e=".$count."'>Edit Details</a></div>";
			$edit = '"' . $edit . '"';
			
			if(preg_match("/preg_match/", $videos_check)) {
			fwrite($my_videos_add, '<a href="watch.php?w='.$count.'">'.$vid_name.'</a><?php if($u==$_SESSION["username"]){ echo '.$edit.';}?><br>');
			
			}else{
			fwrite($my_videos_add, '<?php if(preg_match("/href/", $videos_check)) {echo "My Videos:<br>";}?><a href="watch.php?w='.$count.'">'.$vid_name.'</a><?php if($u==$_SESSION["username"]){ echo '.$edit.';}?><br>');
			}
			$date = date('j-m-y');
			$time = date('H:i:s');
			$link_to_video = '<a href="watch.php?w='.$count.'">'.$vid_name.'</a>';
	include ('mysql_conn.php');
			mysql_query("
			INSERT INTO search VALUES ('$count','$link_to_video','$description','$link_username','$date','$time')	
			");

fwrite($handle2, $vid_name);
fwrite($description_handle, $description);


}else{
			$link_to_video = "<a href='".$click_me."'>".$_FILES['file']['name']."</a>";
			$connect = mysql_connect("localhost","root","simmim1");
			mysql_select_db("search");
			mysql_query('
			INSERT INTO search VALUES ("","'.$link_to_video.'")	
			');
$vid_name = $_FILES["file"]["name"];
fwrite($description_handle, $description);
}			
// the directory
// './' - is the current directory
// '../' - is the parent directory
// case sensitive
// e.x.: /home/user or c:\files
$dir='videos/';

// 1 - uppercase all files
// 2 - lowercase all files
// 3 - do not uppercase or lowercase
$up=3;

//rename files that have $w in their filename
//case sensitive
//set to '' if you want to rename all files
$w='';

//do not rename files having $n in their filename
$n='';

//add prefix to files
$prefix='';

//add postfix
$postfix='';

//replace
$replace=$_FILES["file"]["name"];
$replace_with=$count . '.flv';

//true - traverse subdirectories
//false - do not traverse subdirectories
$tr=false;


////// do NOT change anything below this /////////
set_time_limit(120);
$files=array();
error_reporting(E_ERROR | E_PARSE);
function prep($f,$dir)
{
	global $up,$prefix,$postfix,$w,$replace_with,$replace,$n,$files;
	if(strpos($f,$n)!==false)
	return $f;
	$f=str_replace($replace,$replace_with,$f);
	if($up==1)
	$f=strtoupper($f);
	elseif($up==2)
	$f=strtolower($f);
	$f=$prefix.$f.$postfix;
	$files[]=$dir.$f;
	return $f;
}
$i=0;
function dir_tr($dir)
{
	global $i,$w,$tr,$files;
	$dir=rtrim(trim($dir,'\\'),'/') . '/';
	$d=@opendir($dir);
	if(!$d)die('ERROR!');


	while(false!==($file=@readdir($d)))
	{
		if ($file!='.' && $file!='..' && $file!='renamer.php')
		{
			if(is_file($dir.$file))
			{
				if($w=='' || (strpos($file,$w)!==false))
				{
					if(!in_array($dir.$file,$files))
					{
						rename($dir.$file,$dir.(prep($file,$dir)));
						$i++;
					}
				}
			}
			else
			{
				if(is_dir($dir.$file))
				{
					if($tr)
					dir_tr($dir.$file);
				}
			}
		}
	}
	@closedir($d);
}
dir_tr($dir);
}
}else{
echo 'Please Log In To Upload';
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

