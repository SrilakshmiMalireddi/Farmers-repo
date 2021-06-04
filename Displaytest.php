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
			  <h1><span class = "highlight">eSagu</span> Document Repository</h1>
			</div>
		</div>
	</header>
	
	<section class="container">
		<?php
		$connection = mysqli_connect("localhost","root","1234","DR");

		if(!$connection)
		{
			die("Connection failed: " . mysqli_connect_error());
		}

		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
		
			$query = "SELECT * FROM Files where FileId = $id";
			$result = mysqli_query($connection, $query);
			while($row = $result->fetch_assoc())
			{
				$name = $row['PublicationName'];
				$url = $row['FilePath'];
				$fileid = $row['FileFormatId'];
			}
		}
		else
		echo "Error";
	
		if($fileid == 0) //if the file is an image
		{
	?>	
			<h3 style="font-family:Arial, Helvetica, sans-serif; text-align:center">You are viewing <?php echo $name; ?></h3>
			<img id="displayimg" src="<?php echo $url; ?>" alt = "Image<?php echo $id; ?>" width=500px height=450px style="margin:30px 25px 0px 270px">
			
			<p style="text-align:center;"><a href="<?php echo $url; ?>" download id="download">Click to download image</a><p>
	
	<?php
		}
		else if($fileid == 1) //if the file is a video
		{
	?>
			<h3 style="font-family:Arial, Helvetica, sans-serif; text-align:center">You are viewing <?php echo $name; ?></h3>
			<video id="displayvid" controls  width='560' height='315' style="padding:20px; margin:30px 25px 40px 200px"> 
			<source src="<?php echo $url; ?>" type="video/mp4">
			Sorry, your browser doesn't support the video element.
			</source>
			</video>
			<p style="text-align:center;"><a href="<?php echo $url; ?>" download id="download">Click to download video</a></p>
	<?php
		}
		else if($fileid == 2) //if the file is a pdf
		{
	?>
			<h3 style="font-family:Arial, Helvetica, sans-serif; text-align:center">You are viewing <?php echo $name; ?></h3>
			<embed id="displaypdf" src="<?php echo $url; ?>" type="application/pdf" width=1000 height=500 style="margin:30px 25px 40px 20px">
			<p style="text-align:center;"><a href="<?php echo $url; ?>" download id="download">Click to download pdf</a></p>
	<?php
		}
		else if($fileid == 3) //if the file is a doc file
		{
	?>
			<h3 style="font-family:Arial, Helvetica, sans-serif; text-align:center"><?php echo $name; ?></h3>
			<p style="text-align:center;"><a href="<?php echo $url; ?>" download id="download">Click to view or download the document</a></p>
	
	<?php
		}
		else if($fileid == 4) //if the file is a text file
		{
	?>
			<h3 style="font-family:Arial, Helvetica, sans-serif; text-align:center">You are viewing <?php echo $name; ?></h3>
			<embed id="displatxt" src="<?php echo $url; ?>" width=1000 height=500 style="margin:30px 25px 40px 20px">
			<p style="text-align:center;"><a href="<?php echo $url; ?>" download id="download">Click to download text</a></p>		
			
	<?php
		}
		else if($fileid == 5) //if the file is a ppt
		{
	?>
			<h3 style="font-family:Arial, Helvetica, sans-serif; text-align:center"><?php echo $name; ?></h3>
			<p style="text-align:center;"><a href="<?php echo $url; ?>" download id="download">Click to view or download the ppt</a></p>		
							
	<?php
		}
		mysqli_close($connection);
	?>
	</section>
	
	<footer>
		<p>eSagu Document Repository, Copyright &copy; <?php echo date("Y");?></p>
	</footer>
</body>
</html>		
