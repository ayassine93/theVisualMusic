<!DOCTYPE html>

<html>

<head>
<title>Search Keyword</title>
<link href="thestyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<img class="logo" src="logo2.png" alt="Main Logo"> <br>
<img class="description" src="description.png" alt="Description"> <br>
<br> <br> <br> <br> <br> 

<div id="wrapper">

<img class="center" src="damienrice.png" alt="Damien Rice Concert" height="200" width="448">
<img class="center" src="sharonvanetten.png" alt="Sharon Van Etten Concert" height="200" width="448">

<div id="themenu">
<ul id="menu">
	<li><a href="upload.php"> Home </a></li>
	<li><a href="videolist.php"> All Videos </a></li>
	<li><a href="#"> Categories </a>
		<ul class = "sub1">
			<li><a href="musicvideos.php">Music Videos</a></li>
			<li><a href="liveshows.php">Live Shows</a></li>
			<li><a href="other.php">Other</a></li>
		</ul>
	</li>
	<li><a href="#"> Search </a>
		<ul class = "sub1">
		<li><a href="search.php">Search Keyword</a></li>
		<li><a href="searchartist.php">Search Specific Artist</a></li>
		</ul>
	<li><a href="userguide.html"> Help </a>
</ul>
</div>




<div class="content">

<form action="searchartist.php" method="POST" enctype="multipart/form-data">
<div class="form">

<p>Search:  <input class="artisttext" type="text" name="artist_word">  &nbsp;
<input type="submit" name="Submit" value="Submit"/>
</p>
</div>
</form>

<?php

$conn = mysql_connect('localhost:3306', 'root', 'Mayonaise93');


$location = "vids_upload/";

mysql_select_db('vid_upload');


$sql = "SELECT id, artist, song, url,category FROM Videos";
$result = mysql_query($sql);

if (isset($_POST['Submit']))
{

	if (isset($_POST["artist_word"]) && strlen ($_POST["artist_word"]) > 2)
	{
		$search_artist = htmlspecialchars($_POST["artist_word"]);
	
		if (mysql_num_rows($result) > 0) {
			
			while($row = mysql_fetch_assoc($result)) {
				if (strcasecmp($row["artist"], $search_artist) == 0)
					{
						$final_location = $location . $row["url"];
						echo "<strong>" . $row["artist"] . " - " . $row["song"] . "</strong> <br>";
						echo "<video width='420' height='340' controls>" . 
						"<source src='$final_location'" . "type='video/mp4'>" .
						"Your browser does not support the video tag." .
						"</video> ";
						echo "<br> <br> <br>";
					}
			}
				
		}
		else
			echo "<strong><em>No results found</strong></em>";
	}
	else
		echo "<strong><em>Error search: Please type in a minimum of 3 characters in the search box</strong></em>";
	
}






?>
</div>


</div>

</body>

</html>