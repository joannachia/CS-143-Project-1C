<body>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);

$query_actor = "insert into Actor ('last', 'first', 'sex', 'dob', 'dod') values ('".$_POST["l_name"]."', '".$_POST["f_name"]."', '".$_POST["sex"]."', '".$_POST["dob"]."', ";
if (!isset($_POST["dod"]) || trim($_POST["dod"]) == '' ) { 
	$query_actor .= "'NULL');";
}
else {
	$query_actor.= "'".$_POST["dod"]."');";
}

mysql_query($query_movie, $db_connection);
$affected = mysql_affected_rows($db_connection);
$query_status = "";

if ($affected > 0){
	$query_status = "Successful add!";
}
else {
	$query_status = "Fail add!";
}


?>

<form action="add_actor.php" method="POST">
Add New Actor:<br>
First Name: <input type="text" name="f_name" /><br>
Last Name: <input type="text" name="l_name" /><br>
Gender: <input type="radio" name="gender" value="Male" checked="true"> Male <input type="radio" name="gender" value="Female"> Female<br>
Date of Birth: <input type="text" name="dob" /><br>
Date of Death: <input type="text" name="dod" /> (Leave blank if still alive) <br>
<input type="submit" value="Add it!!"/>
</form>

<?php
echo $query_status;
?>

</body>
