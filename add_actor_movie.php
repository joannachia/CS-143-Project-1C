<body>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);


$movie_query = "select id, title from Movie";
$actor_query = "select id, first, last from Actor";

$movie = mysql_query($movie_query, $db_connection);
$actor = mysql_query($actor_query, $db_connection);

if (isset($_POST["role"])){
	$insert_query = sprintf("insert into MovieActor values (%s, %s, '%s')",
							mysql_real_escape_string($_POST["movie"]),
							mysql_real_escape_string($_POST["actor"]),
							mysql_real_escape_string($_POST["role"]));


	$success = mysql_query($insert_query, $db_connection);

	$query_status = "";

	if ($success){
		$query_status = "Successful add!";
	}
	else {
		$query_status = "Fail add!";
	}
}
else {
	$query_status = "Must add role!";
}


?>

<form action="add_actor_movie.php" method="POST">
Add New Actor in Movie:<br>
Movie: <?php 
		echo '<select name="movie">';
		while($movie_row = mysql_fetch_row($movie)){
			echo '<option value="'.$movie_row[0].'">'.$movie_row[1].'</option>';
		}
		echo '</select>';
		?>
<br>
Actor: <?php 
		echo '<select name="actor">';
		while($actor_row = mysql_fetch_row($actor)){
			echo '<option value="'.$actor_row[0].'">'.$actor_row[1].' '.$actor_row[2].'</option>';
		}
		echo '</select>';
		?>
<br>
Role: <input type="text" name="role" /><br>
<input type="submit" value="Add it!!"/>
</form>

<?php
echo $query_status;
?>

</body>
