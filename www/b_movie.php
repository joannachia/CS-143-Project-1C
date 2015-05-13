<body>
<?php


$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);

if (isset($_GET["mid"]))
	$mid = $_GET["mid"];
else
	$mid = "1075";

$query = "select title, year, rating, company from Movie where id=".$mid;
$results = mysql_query($query, $db_connection);

$movie_row = mysql_fetch_array($results, MYSQL_ASSOC);

echo "<b>---Movie Information---</b> <br/>";
echo "<b>Title:</b> ".$movie_row["title"]." ".$movie_row["last"]."<br/>";
echo "<b>Year:</b> ".$movie_row["year"]."<br/>";
echo "<b>Rating:</b> ".$movie_row["rating"]."<br/>";
echo "<b>Production Company:</b> ".$movie_row["company"]."<br/>";
echo "<b>Director:</b> ";
//Printing out director relations
$director_html = "";
$query_director = "select first, last, dob from Director d where d.id = any (select md.did from MovieDirector md where md.mid = ".$mid.")";
$movieDirector_results = mysql_query($query_director, $db_connection);
while ($movieDirector_row = mysql_fetch_array($movieDirector_results, MYSQL_ASSOC))
	$director_html.= $movieDirector_row["first"]." ".$movieDirector_row["last"]." (".$movieDirector_row["dob"]."), ";
$director_html = substr($director_html, 0, -2);
echo $director_html;

//Printing out relevant genres
echo "<br/><b>Genre(s):</b> ";
$genre_html = "";
$query_genre = "select genre from MovieGenre mg where mg.mid = ".$mid;
$movieGenre_results = mysql_query($query_genre, $db_connection);
while ($movieGenre_row = mysql_fetch_array($movieGenre_results, MYSQL_ASSOC))
	$genre_html.= $movieGenre_row["genre"].", ";
$genre_html = substr($genre_html, 0, -2);
echo $genre_html;


echo "<br/><br/><b>---Actors in this Movie---</b> <br/>";

$query_movieActor = "select * from MovieActor where mid=".$mid;
$movieActor_results = mysql_query($query_movieActor, $db_connection);

while ($movieActor_row = mysql_fetch_array($movieActor_results, MYSQL_ASSOC))
{
	$temp_actor_results = mysql_query("select first, last from Actor where id=".$movieActor_row["aid"], $db_connection);
	$temp_actor_row = mysql_fetch_array($temp_actor_results, MYSQL_ASSOC);
	echo "<a href = ./b_actor.php?aid=".$movieActor_row["aid"].">".$temp_actor_row["first"]." ".$temp_actor_row["last"]."</a> acted as ".$movieActor_row["role"]."<br/>";
}


?>
</body>