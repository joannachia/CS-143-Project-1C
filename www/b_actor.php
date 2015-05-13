<body>
<?php


$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);

if (isset($_GET["aid"]))
	$aid = $_GET["aid"];
else
	$aid = "52794";

$query = "select last, first, sex, dob, dod from Actor where id=".$aid;
$results = mysql_query($query, $db_connection);

$actor_row = mysql_fetch_array($results, MYSQL_ASSOC);

echo "<b>---Actor Information---</b> <br/>";
echo "<b>Name:</b> ".$actor_row["first"]." ".$actor_row["last"]."<br/>";
echo "<b>Sex</b>: ".$actor_row["sex"]."<br/>";
echo "<b>Date of Birth:</b> ".$actor_row["dob"]."<br/>";
if ($actor_row["dod"])
	echo "<b>Date of Death:</b> ".$actor_row["dod"]."<br/>";
else
	echo "<b>Date of Death:</b> ---Still Alive---";

echo "<br/><br/><b>---Acted in following movies---</b> <br/>";

$query_actor = "select * from MovieActor where aid=".$aid;
$movieActor_results = mysql_query($query_actor, $db_connection);

while ($movieActor_row = mysql_fetch_array($movieActor_results, MYSQL_ASSOC))
{
	$temp_movie_results = mysql_query("select title from Movie where id=".$movieActor_row["mid"], $db_connection);
	$temp_movie_row = mysql_fetch_array($temp_movie_results, MYSQL_ASSOC);
	echo "Played role as ".$movieActor_row["role"]." in <a href = ./b_movie.php?mid=".$movieActor_row["mid"].">".$temp_movie_row["title"]."</a><br/>";
}



?>
</body>