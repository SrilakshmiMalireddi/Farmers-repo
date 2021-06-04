<?php
session_start();
if(!isset($_SESSION["Login_user"])) //if the session is not set then the page will be redirected to the sign in page 
{
header("Location: Signintest.php");
}
else
{
?>

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
	<!-- navigation bar -->
		<div class="container">
			<div id="branding">
			  <h1><span class = "highlight">eSagu</span> Document Repository</h1>
			</div>
			<nav>
			  <ul>
			  	<li class="current"><a href="Signinhome.php">Home</a></li>
			  	<li><a href="Signinabout.php">About</a></li>
				<li><a href="Signinview.php">View</a></li>
				<li><a href="Uploadtest.php">Upload</a></li>
				<li><a href="logout.php">Sign Out</a></li>
			  </ul>
			</nav>
		</div>
	</header>
	
	<section id="slides">
		<div class="container">
		<img src="./Agriculture.jpg" style="height:100%; width:100%; margin:1% 15% 0.1% 3%"> <!-- background image -->
		</div>
	</section>
	
	<footer>
		<p>eSagu Document Repository, Copyright &copy; <? php echo date("Y");?></p>
	</footer>
<?php
}
?>
</body>
</html>
