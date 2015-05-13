<body>
<?php



if (isset($_POST["search"])){

	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("CS143", $db_connection);


	$search_strings = $_POST["search"];
	$search_array = explode(" ", $search_strings);


	$query_movie = "select id, title, year from Movie where ";
	$query_actor = "select id, first, last, dob from Actor where ";


	foreach ($search_array as $i){
		$query_actor.= "(first like '%".$i."%' or last like '%".$i."%')";
		$query_actor.= " and "; 

		$query_movie.= "title like '%".$i."%' and ";
	}

	$query_actor = substr($query_actor, 0, -5);
	$query_movie = substr($query_movie, 0, -5);

	$movie = mysql_query($query_movie, $db_connection);
	$actor = mysql_query($query_actor, $db_connection);




}


?>

Search for actors/movies
<br>
<form method="post" action="search.php">
Search: <input type="text" name="search" />
<input type="submit" name="submit" value="Search"/>
</form>

<?php

if($movie || $actor){
	echo "<hr><br> You are searching ";
	foreach ($search_array as $i){
		echo "[".$i."] ";
	}
	echo "results... <br><br>";

	echo "Movie search matches: <br>";
	while ($movie_row = mysql_fetch_row($movie)){
		echo 'Movie: <a href="b_movie.php?mid='.$movie_row[0].'">'.$movie_row[1].'</a> ('.$movie_row[2].')<br>';
	}

	echo "<br>Actor search matches: <br>";
	while ($actor_row = mysql_fetch_row($actor)){
		echo 'Actor: <a href="b_actor.php?aid='.$actor_row[0].'">'.$actor_row[1].' '.$actor_row[2].'</a> - '.$actor_row[3].'<br>';
	}


}

?>



</body>