<body>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);

if (isset($_POST["title"]))
{
	$query_movie = sprintf("insert into Movie (title, year, rating, company) values ('%s', '%s', '%s', '%s')",
				mysql_real_escape_string($_POST["title"]),
				mysql_real_escape_string($_POST["year"]),
				mysql_real_escape_string($_POST["rating"]),
				mysql_real_escape_string($_POST["company"]));

	$search_id_query = sprintf("select id from Movie where title = '%s' and year = '%s' and rating = '%s' and company = '%s'",
				mysql_real_escape_string($_POST["title"]),
				mysql_real_escape_string($_POST["year"]),
				mysql_real_escape_string($_POST["rating"]),
				mysql_real_escape_string($_POST["company"]));

	mysql_query($query_movie, $db_connection);
	$affected = mysql_affected_rows($db_connection);

	$query_status = "";

	if ($affected > 0) {
		$id = mysql_query($search_id_query, $db_connection);
		$id_val = mysql_fetch_row($id);
		$query_genre = "insert into MovieGenre (mid, genre) values";
		$genres = $_POST["genre"];

		foreach ($genres as $genre){
			$query_genre .= "('".$id_val[0]."', '".$genre."'),";
		}
		$query_genre = rtrim($query_genre, ",");
		$query_genre .= ";";
		mysql_query($query_genre, $db_connection);
		if (mysql_affected_rows($db_connection) > affected) {
			$query_status = "Sucessfully inserted movie.";
		}
		else {
			$query_status = "Insert Genre failed. Try again. ";
			$query_delete_movie = "delete from Movie where id = '".$id_val[0]."';";
			}
	}
	else if ($affected == 0) {
		$query_status = "Insert failed. Try again. ";
	}
}


?>



<form action="add_movie.php" method="POST">
Add New Movie:<br>
Title: <input type="text" name="title" /><br>
Company: <input type="text" name="company" /><br>
Year: <input type="text" name="year" maxlength="4" /><br>
MPAA Rating: <select name="rating">							<!--CHECK THIS DROP DOWN MENU PLS-->
			<option value="PG-13">PG-13</option>
			<option value="R">R</option>
			<option value="PG">PG</option>
			<option value="NC-17">NC-17</option>
			<option value="surrendere">surrendere</option>
			<option value="G">G</option>
	</select>
<br>
Genre : 
	<input type="checkbox" name="genre[]" value="Action">Action</input>
	<input type="checkbox" name="genre[]" value="Adult">Adult</input>
	<input type="checkbox" name="genre[]" value="Adventure">Adventure</input>
	<input type="checkbox" name="genre[]" value="Animation">Animation</input>
	<input type="checkbox" name="genre[]" value="Comedy">Comedy</input>
	<input type="checkbox" name="genre[]" value="Crime">Crime</input>
	<input type="checkbox" name="genre[]" value="Documentary">Documentary</input>
	<input type="checkbox" name="genre[]" value="Drama">Drama</input>
	<input type="checkbox" name="genre[]" value="Family">Family</input>
	<input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input>
	<input type="checkbox" name="genre[]" value="Horror">Horror</input>
	<input type="checkbox" name="genre[]" value="Musical">Musical</input>
	<input type="checkbox" name="genre[]" value="Mystery">Mystery</input>
	<input type="checkbox" name="genre[]" value="Romance">Romance</input>
	<input type="checkbox" name="genre[]" value="Sci-Fi">SciFi</input>
	<input type="checkbox" name="genre[]" value="Short">Short</input>
	<input type="checkbox" name="genre[]" value="Thriller">Thriller</input>
	<input type="checkbox" name="genre[]" value="War">War</input>
	<input type="checkbox" name="genre[]" value="Western">Western</input><br>
<input type="submit" value="Add it!!"/>

</form>


<?php
echo $query_status;
?>





</body>