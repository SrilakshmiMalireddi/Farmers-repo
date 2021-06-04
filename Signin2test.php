<?php
session_start(); //starting the session which enables us to use variables declared on other pages
?>

<!DOCTYPE html>
<html>
<head>

	<!-- a function to remove the back button on the webpage -->
	<script>
		window.location.hash = "no-back-button";
		window.location.hash = "again-no-back-button";
		window.onhashchange = function(){window.location.hash = "no-back-button";}
	</script>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>eSagu - Document Repoistory</title>

	<link rel = "stylesheet" type = "text/css" href = "Uploadtestcss.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
</head>

<body>
	<?php
		//establishing mysql connection
		$connection = mysqli_connect("localhost","root","1234","DR");

		if(!$connection)
		{
			die("Connection failed: " . mysqli_connect_error());
		}
	
		
		if(isset($_POST['submit'])) //when the submit button is pressed
		{
			$userid = $_POST["userid"]; //storing the userid in the variable $userid
			$password = md5($_POST["password"]);  //encrypting the password with md5 and storing it

			$query = "select Password from Login where UserId LIKE '$userid' ";
			
			$result1 = mysqli_query($connection, $query);
			
			while($row = $result1->fetch_assoc())
			{
				$pass = $row['Password']; //The password extracted is stored in the variable is $pass
			}
			
			$result = strcmp($pass, $password); //the two passwords are compared. if they are the same strcmp() returns 0
	
			if($result == 0) //if the authentication is verified the pageis redirected to the home page
			{
				$_SESSION["Signin"] = $_POST;  //storing the details entered in the form in a session 
				$_SESSION["Login_user"] = $userid; //storing the userid in another session variable
				header("Location: Signinhome.php");
			}
			else //if the authentication fails the page is redirected to second signin page
			{
				header("Location: Signin2test.php");
			}
			
		}
	?>
	
	<header>
		<div class="container">
			<div id="branding">
			  <h1><span class = "highlight">eSagu</span> Document Repository</h1>
			</div>
			<nav>
			  <ul>
			  	<li><a href="Hometest.php">Home</a></li>
			  	<li><a href="Abouttest.php">About</a></li>
				<li><a href="Viewtest.php">View</a></li>
			  </ul>
			</nav>
		</div>
	</header>
	
	<section>
		<div class="container">
			<div class="loginbox">
				<h1 id="title">SIGN IN</h1>
				<!-- form to fill in the login details-->
				<form action="" method="POST">
					<h1 id="subtitle">Username :</h1> 
					<input type="text" name="userid" required><br>
					<h1 id="subtitle">Password :</h1>
					<input type="password" name="password" required><br><br>
					<button type="submit" name = "submit" class="button_1"/>Log In</button>
				</form>
				<h4>Invalid username or password. Try again.</h4>
			</div>
		</div>
	</section>
	<footer>
		<p>eSagu Document Repository, Copyright &copy; <?php echo date("Y");?></p>
	</footer>
</body>
</html>
