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

echo "---Actor Information--- <br/>";
echo "Name: ".$actor_row["first"]." ".$actor_row["last"]."<br/>";
echo "Sex: ".$actor_row["sex"]."<br/>";
echo "Date of Birth: ".$actor_row["dob"]."<br/>";
if ($actor_row["dod"])
	echo "Date of Death: ".$actor_row["dod"]."<br/>";
else
	echo "Date of Death: ---Still Alive---";

echo "<br/><br/>---Acted in following movies--- <br/>";

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