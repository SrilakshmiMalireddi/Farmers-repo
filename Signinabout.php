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
	<!-- navigation bar -->
	<header>
		<div class="container">
			<div id="branding">
			  <h1><span class = "highlight">eSagu</span> Document Repository</h1>
			</div>
			<nav>
			  <ul>
			  	<li><a href="Signinhome.php">Home</a></li>
			  	<li class="current"><a href="Signinabout.php">About</a></li>
				<li><a href="Signinview.php">View</a></li>
				<li><a href="Uploadtest.php">Upload</a></li>
				<li><a href="logout.php">Sign Out</a></li>
			  </ul>
			</nav>
		</div>
	</header>
	
	<section id="main">
		<div class="container">
			<article id="main-col">
				<h1 class="page-title">About Us</h1>
				<!-- text to be displayed -->
				<p>
				orem ipsum dolor sit amet, consectetur adipiscing elit. Sed mollis, metus ut ultricies pulvinar, purus lacus fermentum erat, sed fermentum eros lectus eu nisi. Fusce condimentum quam ac mi tempus, at convallis arcu sollicitudin. Pellentesque facilisis justo vel urna ornare, eget efficitur mi viverra. Morbi lacinia ullamcorper tincidunt. Nullam in risus non quam fermentum porta. Vestibulum vitae orci et nunc auctor egestas. Aenean molestie commodo purus, suscipit tempus urna congue sit amet. In dapibus, sem nec consectetur eleifend, tortor ante faucibus lectus, non convallis libero nunc sit amet diam. Cras ante nibh, interdum eget commodo eget, placerat sit amet dui. Sed ullamcorper risus sed est fermentum cursus. Ut at odio sodales, convallis lectus et, tincidunt diam.
			</p>
			<p>
	Aliquam gravida tortor quis orci tempus, id sodales mauris 	accumsan. Phasellus justo lorem, bibendum vel pulvinar ac, congue ac est. Duis ullamcorper erat vitae est ultrices gravida. Sed euismod sed ipsum sed vehicula. Donec id lacus bibendum, maximus diam eu, lobortis sem. Quisque at ex ipsum. Quisque at tellus est. Nulla nec eros eu risus scelerisque faucibus. Suspendisse potenti. Aliquam dapibus libero odio, nec aliquet purus elementum sed. 
			</p>
		</article>
		
		<!-- a brief about esagu -->
		<aside id="sidebar">
			<div class="dark">
				<h3>What We Do</h3>
				<p>Aliquam gravida tortor quis orci tempus, id sodales mauris 	accumsan. Phasellus justo lorem, bibendum vel pulvinar ac, congue ac est. Duis ullamcorper erat vitae est ultrices gravida.	</p>
			</div>
		</aside>	
		
		</div>
	</section>
	
	<footer  style="margin: 100px 0px 0px 0px">
		<p>eSagu Document Repository, Copyright &copy; <?php echo date("Y");?></p>
	</footer>

<?php
}
?>

</body>
</html>
