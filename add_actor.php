<body>
<?php
$db_connection = mysql_connect("localhost", "cs143", "");
mysql_select_db("CS143", $db_connection);


if (isset($_POST["l_name"]) && isset($_POST["f_name"]) && isset($_POST["dob"])){

	$query_actor = sprintf("insert into Actor (last, first, sex, dob, dod) values ('%s', '%s', '%s', '%s',",
				mysql_real_escape_string($_POST["l_name"]),
				mysql_real_escape_string($_POST["f_name"]),
				mysql_real_escape_string($_POST["gender"]),
				mysql_real_escape_string($_POST["dob"]));


	$dod = "";
	if (!isset($_POST["dod"]) || trim($_POST["dod"]) == '' ) { 
		$query_actor.= "NULL)";
	}
	else {
		$query_actor.= "'".$_POST["dod"]."')";
	}




	$success = mysql_query($query_actor, $db_connection);

	$query_status = "";

	if ($success){
		$query_status = "Successful add!";
	}
	else {
		$query_status = "Fail add!";
	}

	
}
else {
	$query_status = "Fields are empty. Please add name and dob";

	

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
