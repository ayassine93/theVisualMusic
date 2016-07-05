<!DOCTYPE html>

<html>

<head>
<title>The Visual Music</title>
<link href="thestyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<img class="logo" src="logo2.png" alt="Main Logo"> <br>
<img class="description" src="description.png" alt="Description"> <br>
<br> <br> <br> <br> <br> 

<div id="wrapper">

<img class="center" src="beatlesconcert.jpg" alt="Beatles Concert" height="200" width="448">
<img class="center" src="zepplinconcert.jpg" alt="Led Zepplin Concert" height="200" width="448">

<div id="themenu">
<ul id="menu">
	<li><a href="upload.php"> Home </a></li>
	<li><a href="videolist.php"> All Videos </a></li>
	<li><a href=""> Categories </a>
		<ul class = "sub1">
			<li><a href="musicvideos.php">Music Videos</a></li>
			<li><a href="liveshows.php">Live Shows</a></li>
			<li><a href="other.php">Other</a></li>
		</ul>
	</li>
	<li><a href=""> Search </a>
		<ul class = "sub1">
		<li><a href="search.php">Search Keyword</a></li>
		<li><a href="searchartist.php">Search Specific Artist</a></li>
		</ul>
	<li><a href="userguide.html"> Help </a>
</ul>
</div>



<div class="content">
<h1>Upload Your Music Content!</h1>

<p id="margining">
This site is dedicated for people who love music and love sharing their music content with the world. 
Whether you wish to share that song that you recorded at a concert, a music 
interview, or you simply want to upload a music video, this is the place to do so! </p>
 <br> <br>
 
 

<form action="upload.php" method="POST" enctype="multipart/form-data">
<div class="form">

<p>Artist/Band:  <input class="artisttext" type="text" name="artist"> </p>
<p>Song/Content:  <input class="titletext" type="text" name="song"> </p>
<p>Category: <br>
  <input class = "radios" type="radio" name="category" value="musicvideo"> Music Video <br>
  <input class = "radios" type="radio" name="category" value="live"> Live Show  <br>
  <input class = "radios" type="radio" name="category" value="other"> Interview/Other <br>
  </p>
<p>Video to Upload (Max 30MB): <input class="browse" type="file" name="video"/></p>
<p><input type="submit" name="Submit" value="Submit"/></p>

</div>
</form>


<br> <br>



<?php

//$videoname = $_FILES["video"]["name"];
//$tmp_name = $_FILES["video"]["tmp_name"];

$location = "C:/xampp/htdocs/MainSite/vids_upload/";



$conn = mysql_connect('localhost:3306', 'root', 'Mayonaise93');
mysql_select_db('vid_upload');

$sql = "SELECT vidTitle, url FROM Videos";
$result = mysql_query($sql);

/*while ($row = mysql_fetch_assoc($result)) {
    echo $row['vidTitle'];
    echo $row['url'];
}*/

if (isset($_POST['Submit']))
{

	// artist has to be at least 2 chars 
	// songs have to be at least 1 char
	if (isset($_POST["artist"]) && strlen ($_POST["artist"]) > 1
	&& isset($_POST["song"]))
	{
		if (!empty($_POST["category"]))
		{
			$video_artist = htmlspecialchars($_POST["artist"]);
			$video_song = htmlspecialchars($_POST["song"]);
		
			$video_name = $_FILES['video']['name'];
			$temp = $_FILES['video']['tmp_name'];
			
			$video_category = ($_POST["category"]);
		
			if (isMP4($video_name) == true)
			{
				move_uploaded_file($temp, $location.$video_name);
		
				$storefile = "INSERT INTO Videos (artist, song, url, category) Values ('$video_artist', '$video_song'," . "'$video_name', '$video_category')";
				mysql_query($storefile);
			
				echo "<strong><em> Video has been successfully uploaded </em></strong> <br> <br>";
			}
			else{
				echo "<strong><em> Error uploading: Input file has to be a video with '.mp4' extension. </em></strong> <br> <br>" ;
			}
		}
		else{
			echo "<strong><em>Error uploading: Please choose a category before uploading the video </em></strong> <br> <br>" ;
		}
	}
	else{
		echo "<strong><em>Error uploading: Please try again. If you need help, click on the user guide. </em> </strong> <br> <br>";
	}
	
}


/* Checks to see if uploaded input has .mp4 extension */
function isMP4($input)
{
	if (substr ($input , strlen($input)-4) == ".mp4")
	{
		return true;
	}
	return false;
}


/*if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	echo $video_title;
}*/



/*
$location = "MainSite/";

$thevideos = array();

$thevideos = array_diff( scandir($location), array(".", "..") );

for ($i = 2; $i <= count($thevideos); $i++)
	{
		echo "<b>Title: </b>" . $thevideos[$i] . ": <br>" ;
		echo "<video width=\"420\" height=\"340\" controls>
		<source src=\"/uploaded/" .$thevideos[$i]. "\">
		</video> <br> <br>";
	}

if (isset($videoname))
{
	if (!empty($videoname)) 
	{
		
		
		move_uploaded_file($tmp_name, $location.$videoname);
		
/*garbage
		//$thevideos[] = $videoname;
		
		//$thevideos = scandir($location); end garbage*/
		
	/*	
	}
	else
	{
		echo "Please choose a file.";
	}

}*/

?>

<br><br>
</div>
</div>
</body>

</html>