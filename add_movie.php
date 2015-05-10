<body>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);

$query_movie = "insert into Movie ('title', 'year', 'rating', 'company') values ('".$_POST["title"]."', '".$_POST["year"]."', '".$_POST["rating"]."', '".$_POST["company"]."');";
$search_id_query = "select id from Movie where title = '".$_POST["title"]."' and year = '".$_POST["title"]."' and rating = '".$_POST["rating"]."' and comapny = '".$_POST["company"]."';";
mysql_query($query_movie, $db_connection);
$id = mysql_query($search_id_query, $db_connection);


$query_genre = "insert into MovieGenre ('mid', 'genre') values ('')";



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
	<input type="checkbox" name="genre_"Action"" value=""Action"">"Action"</input>
	<input type="checkbox" name="genre_"Adult"" value=""Adult"">"Adult"</input>
	<input type="checkbox" name="genre_"Adventure"" value=""Adventure"">"Adventure"</input>
	<input type="checkbox" name="genre_"Animation"" value=""Animation"">"Animation"</input>
	<input type="checkbox" name="genre_"Comedy"" value=""Comedy"">"Comedy"</input>
	<input type="checkbox" name="genre_"Crime"" value=""Crime"">"Crime"</input>
	<input type="checkbox" name="genre_"Documentary"" value=""Documentary"">"Documentary"</input>
	<input type="checkbox" name="genre_"Drama"" value=""Drama"">"Drama"</input>
	<input type="checkbox" name="genre_"Family"" value=""Family"">"Family"</input>
	<input type="checkbox" name="genre_"Fantasy"" value=""Fantasy"">"Fantasy"</input>
	<input type="checkbox" name="genre_"Horror"" value=""Horror"">"Horror"</input>
	<input type="checkbox" name="genre_"Musical"" value=""Musical"">"Musical"</input>
	<input type="checkbox" name="genre_"Mystery"" value=""Mystery"">"Mystery"</input>
	<input type="checkbox" name="genre_"Romance"" value=""Romance"">"Romance"</input>
	<input type="checkbox" name="genre_"Sci-Fi"" value=""Sci-Fi"">"Sci-Fi"</input>
	<input type="checkbox" name="genre_"Short"" value=""Short"">"Short"</input>
	<input type="checkbox" name="genre_"Thriller"" value=""Thriller"">"Thriller"</input>
	<input type="checkbox" name="genre_"War"" value=""War"">"War"</input>
	<input type="checkbox" name="genre_"Western"" value=""Western"">"Western"</input><br>
<input type="submit" value="Add it!!"/>

</form>





</body>