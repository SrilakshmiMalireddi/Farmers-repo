<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>eSagu - Document Repoistory</title>
	<link rel = "stylesheet" type = "text/css" href = "Uploadtestcss.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
</head>
<body>
<header>
	<div class="container">
		<div id="branding">
			<h1><span class = "highlight">Esagu</span> Document Repository</h1>
		</div>	
	</div>
</header>

<section>
	<div class="container">
		<div class="loginbox">		
			<h1 id="title">SIGN IN</h1>
				<form method="post">
					<h1 id="subtitle">User Id :</h1> 
					<input type="text" name="userid" required><br>
					<h1 id="subtitle">Password :</h1> 
					<input type="password" name="password" required><br><br>
					<button type="submit" name = "submit" class="button_1"/>Sign Up</button>
				</form>
			</div>
		</div>
</section>
	
<?php
		$connection = mysqli_connect("localhost","root","1234","DR");
                
		if(!$connection)
		{
			die("Connection failed: " . mysqli_connect_error());
               
		}
          
          if(isset($_POST['submit']))
		{
			$userid = $_POST['userid'];
			$password = md5($_POST['password']);
			
			$query ="INSERT INTO Login (UserId,Password) VALUES ('$userid','$password')";
               $result = mysqli_query($connection, $query);

               if($result)
               {
               	echo "<p style='font-size:20px;'>succssfully signed up</p>";
               }
          }
?>

<footer>
		<p>Esagu Document Repository, Copyright &copy; <?php date("Y"); ?></p>
</footer>

</body>
</html>
