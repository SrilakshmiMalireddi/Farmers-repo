<?php
	//mysql connection
	$connection = mysqli_connect("localhost", "root", "1234", "DR");
	if(!$connection)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
		
	if(isset($_GET['id'])) //gets the id from the url
	{
		$id = $_GET['id']; //stored the id in the variable
	
		$query = "select FilePath from Files where FileId = $id"; //selects the file path of the file
		$result = mysqli_query($connection, $query);
		
		while($row = $result->fetch_assoc())
		{
			$filename = $row['FilePath']; //the path of the file is stored in the variable $filename
		}
	
		$query = "delete from Files where FileId = $id"; //deleted the file from the database
	
		$result = mysqli_query($connection,$query);
		unlink($filename);
	}
	

	
	mysqli_close($connection);
	header("Location: Signinview.php"); //after deleting the file is redirected to the view page
?>
