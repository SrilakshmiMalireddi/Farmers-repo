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
	<?php
		
		$connection = mysqli_connect("localhost","root","1234","DR");
		// connection being established
		
		if(!$connection)
		{
			die("Connection failed: " . mysqli_connect_error());
		}

		if(isset($_POST['submit'])) //when the submit button is pressed
		{
			//retrieving the data from the SESSION, POST, FILES
			$userid = $_SESSION["Signin"]["userid"]; //retrieving the userid from the session variable Signin
			$name = $_FILES['file']['name'];
			$temp = $_FILES['file']['tmp_name'];
			$description = $_POST["description_entered"];
			$doctype = $_POST["doctype"];
			$source = $_POST["source"];
			$lang = $_POST["lang"];
			$year = $_POST["syear"];
			$ff = $_POST["fileformat"];
			$ext = substr($name, -4); //it gets the last 4 letters from the file name. i.e the file extension
			
			if($ff == 0) //if the file is an image
			{
				if(strcmp($ext, '.jpg') == 0 || strcmp($ext, 'jpeg') == 0 || strcmp($ext, '.png') == 0) //checking the format of the file selected
				{
				
					if(strcmp($doctype, "Media") == 0) //if the file belongs to media related information
					{
					
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/images/media/".$name ); //moving the file to the folder to be stored in the PC
						chmod("/home/eshita/apache/html/DR/uploads/images/media/".$name, 0666);
						$url = "./uploads/images/media/".$name; //filepath
				
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language, Description, FileName, FilePath, UploadDate, UserId) VALUES (0,0,'$source','$year','$lang','$description','$name','$url', CURDATE(), '$userid')";
					}
				
					else if(strcmp($doctype,"Research") == 0) //if the file belongs to research related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/images/research/".$name ); //moving the file to the folder to be stored in the PC
						
						chmod("/home/eshita/apache/html/DR/uploads/images/research/".$name, 0666);
						$url = "./uploads/images/research/".$name; //filepath
				
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language, Description, FileName, FilePath, UploadDate, UserId) VALUES (0,1,'$source','$year','$lang','$description','$name','$url', CURDATE(), '$userid')";
					}
				
					else if(strcmp($doctype,"Project") == 0)//if the file belongs to project related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/images/project/".$name ); //moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/images/project/".$name, 0666);
						$url = "./uploads/images/project/".$name; //filepath
				
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language, Description, FileName, FilePath, UploadDate, UserId) VALUES (0,2,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
								
					$result = mysqli_query($connection, $query); //storing the query's result in the variable result
	
					if($result)
					{
						echo $name." has been uploaded";
					}
					else
					{
						echo "Error uploading. Please make sure that the descirption is not longer than 50 characters";
					}
				}
				else
				{
					echo "Images of format jpeg, png, jpg can be uploaded!";
				}	
			}
			
			else if($ff == 1) //if the file is a video
			{
				if(strcmp($ext,'.mp4') == 0) //checking the format of the file selected
				{
					if(strcmp($doctype, "Media") == 0) //if the file belongs to media related information
					{
					
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/videos/media/".$name ); //moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/videos/media/".$name , 0666);
						$url = "./uploads/videos/media/".$name;  //filepath
						
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (1,0,'$source','$year','$lang','$description','$name','$url', CURDATE(), '$userid')";
					
					}
				
					else if(strcmp($doctype,"Research") == 0) //if the file belongs to research related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/videos/research/".$name ); //moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/videos/research/".$name , 0666);
						$url = "./uploads/videos/research/".$name; //filepath
				
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (1,1,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
				
					else if(strcmp($doctype,"Project") == 0) //if the file belongs to project related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/videos/project/".$name ); //moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/videos/project/".$name , 0666);
						$url = "./uploads/videos/project/".$name; //filepath 
					
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language, Description, FileName, FilePath, UploadDate, UserId) VALUES (1,2,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
								
					$result = mysqli_query($connection, $query); //storing the query's result in the variable result
	
					if($result)
					{
						echo $name." has been uploaded";
					}
					else
					{
						echo "Error";
					}			
				}
				else
				{
					echo "Videos of mp4 format can be uploaded!";
				}
			}	
			
			else if($ff == 2) //if the file is a pdf
			{
				if(strcmp($ext,'.pdf') == 0) //checking the format of the file selected
				{
					if(strcmp($doctype, "Media") == 0) //if the file belongs to media related information
					{
					
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/pdfs/media/".$name ); //moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/pdfs/media/".$name  , 0666);
						$url = "./uploads/pdfs/media/".$name;  //filepath 
						
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear,Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (2,0,'$source','$year','$lang','$description','$name','$url', CURDATE(), '$userid')";
					
					}
				
					else if(strcmp($doctype,"Research") == 0) //if the file belongs to research related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/pdfs/research/".$name );//moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/pdfs/research/".$name  , 0666);
						$url = "./uploads/pdfs/research/".$name; //filepath 
				
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language, Description, FileName, FilePath, UploadDate, UserId) VALUES (2,1,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
				
					else if(strcmp($doctype,"Project") == 0)  //if the file belongs to project related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/pdfs/project/".$name );//moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/pdfs/project/".$name  , 0666);
						$url = "./uploads/pdfs/project/".$name; //filepath
					
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (2,2,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
								
					$result = mysqli_query($connection, $query); //storing the query's result in the variable result
	
					if($result)
					{
						echo $name." has been uploaded";
					}
					else
					{
						echo "Error";
					}			
				}
				else
				{
					echo "Only pdfs can be uploaded!";
				}
			}
			
			else if($ff == 3) //if the file is a document
			{
				if(strcmp($ext, '.odt') == 0 || strcmp($ext, 'docx') == 0) //checking the format of the file selected
				{
					if(strcmp($doctype, "Media") == 0) //if the file belongs to media related information
					{
					
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/doc/media/".$name ); //moving the file to the folder to be stored in the PC

						chmod( "/home/eshita/apache/html/DR/uploads/doc/media/".$name , 0666);
						$url = "./uploads/doc/media/".$name; //filepath 
						
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (3,0,'$source','$year','$lang','$description','$name','$url', CURDATE(), '$userid')";
					
					}
				
					else if(strcmp($doctype,"Research") == 0) //if the file belongs to research related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/doc/research/".$name ); //moving the file to the folder to be stored in the PC

						chmod( "/home/eshita/apache/html/DR/uploads/doc/research/".$name , 0666);
						$url = "./uploads/doc/research/".$name; //filepath  
				
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear,Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (3,1,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
				
					else if(strcmp($doctype,"Project") == 0) //if the file belongs to project related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/doc/project/".$name ); //moving the file to the folder to be stored in the PC

						chmod( "/home/eshita/apache/html/DR/uploads/doc/project/".$name , 0666);
						$url = "./uploads/doc/project/".$name; //filepath
					
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear,Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (3,2,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
								
					$result = mysqli_query($connection, $query);
	
					if($result)
					{
						echo $name." has been uploaded";
					}
					else
					{
						echo "Error";
					}
				}
				else
				{
					echo "Files of format odt and docx can be uploaded!";
				}
			}
			
			else if($ff == 4) //if the file is a text file
			{
				if(strcmp($ext, '.txt') == 0) //checking the format of the file selected
				{
					if(strcmp($doctype, "Media") == 0) //if the file belongs to media related information
					{
					
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/text/media/".$name );//moving the file to the folder to be stored in the PC

						chmod( "/home/eshita/apache/html/DR/uploads/text/media/".$name , 0666);
						$url = "./uploads/text/media/".$name; //filepath
						
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (4,0,'$source','$year','$lang','$description','$name','$url', CURDATE(), '$userid')";
		
					}
				
					else if(strcmp($doctype,"Research") == 0) //if the file belongs to research related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/text/research/".$name ); //moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/text/research/".$name  , 0666);
						$url = "./uploads/text/research/".$name; //filepath
				
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language, Description, FileName, FilePath, UploadDate, UserId) VALUES (4,1,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
				
					else if(strcmp($doctype,"Project") == 0) //if the file belongs to project related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/text/project/".$name ); //moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/text/project/".$name, 0666);
						$url = "./uploads/text/project/".$name; //filepath
					
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language, Description, FileName, FilePath, UploadDate, UserId) VALUES (4,2,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
								
					$result = mysqli_query($connection, $query);
	
					if($result)
					{
						echo $name." has been uploaded";
					}
					else
					{
						echo "Error";
					}				
				}
				else
				{
					echo "Files of format txt can be uploaded!";
				}	
			}
			
			else if($ff == 5) //if the file is a ppt
			{
				if(strcmp($ext, '.ppt') == 0 || strcmp($ext, '.odp') == 0 ) //checking the format of the file selected
				{
					if(strcmp($doctype, "Media") == 0) //if the file belongs to media related information
					{
					
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/ppt/media/".$name ); //moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/ppt/media/".$name , 0666);
						$url = "./uploads/ppt/media/".$name; //filepath
						
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (5,0,'$source','$year','$lang','$description','$name','$url', CURDATE(), '$userid')";
			
					}
				
					else if(strcmp($doctype,"Research") == 0) //if the file belongs to research related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/ppt/research/".$name ); //moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/ppt/research/".$name , 0666);
						$url = "./uploads/ppt/research/".$name; //filepath
				
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear,Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (5,1,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
				
					else if(strcmp($doctype,"Project") == 0) //if the file belongs to project related information
					{
						move_uploaded_file($temp, "/home/eshita/apache/html/DR/uploads/ppt/project/".$name ); //moving the file to the folder to be stored in the PC

						chmod("/home/eshita/apache/html/DR/uploads/ppt/project/".$name , 0666);
						$url = "./uploads/ppt/project/".$name; //filepath
					
						$query = "INSERT INTO Files (FileFormatId, DocumentTypeId, PublicationName, PublicationYear, Language,Description, FileName, FilePath, UploadDate, UserId) VALUES (5,2,'$source','$year','$lang','$description','$name','$url',CURDATE(), '$userid')";
					}
								
					$result = mysqli_query($connection, $query);
	
					if($result)
					{
						echo $name." has been uploaded";
					}
					else
					{
						echo "Error";
					}				
				}
				else
				{
					echo "Presentations of format .ppt and .odp can be uploaded!";
				}
			
			}
		}	
		mysqli_close($connection);					
	?>

	<header>
	<div class="container">
	<!-- navigation bar -->
		<div id="branding">
		  <h1><span class = "highlight">eSagu</span> Document Repository</h1>
		</div>
		<nav>
		  <ul>
		  	<li><a href="Signinhome.php">Home</a></li>
		  	<li><a href="Signinabout.php">About</a></li>
			<li><a href="Signinview.php">View</a></li>
			<li class="current"><a href="Uploadtest.php">Upload</a></li>
			<li><a href="logout.php">Sign Out</a></li>
		  </ul>
		</nav>
	</div>
	</header>

	<section id="boxes">
		<div class="containier">
			<div class="uploadbox">

				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					
					<h1 id="subtitle">Publication Name:</h1> 
					<input type="text" name="source" required><br>
					<h1 id="subtitle">Publication Year:</h1> 
					<input type="text" name="syear" required><br>					
					
					<h1 id="subtitle">Description of file:</h1> 
					<input type="text" name="description_entered" required><br>
					
					<!-- drop down for file format-->
					<h1 id="subtitle">File Format</h1>
					<select name="fileformat">
						<option value="0">Images</option>
						<option value="1">Videos</option>
						<option value="2">Pdfs</option>
						<option value="3">Docs</option>
						<option value="4">Text</option>
						<option value="5">Presentations</option>
					</select>					
					
					<!-- drop down for document type-->
					<h1 id="subtitle">Document Type:</h1> 
					<select name="doctype">
						<option value="Media" selected>Media</option>
						<option value="Research">Research</option>
						<option value="Project">Project</option>
					</select>
					
					<h1 id="subtitle">Language:</h1> 					
					<input type="text" name="lang" required><br>										
					
					<h1 id="subtitle">Select File:</h1>
					<input type="file" name="file" required/>
					
					<button type="submit" name = "submit" class="button_1"/>Upload File</button>
				</form>
			</div>
	</div>
	</section>
	
	<footer>
		<p>eSagu Document Repository, Copyright &copy; <?php echo date("Y");?></p>
	</footer>	
<?php
}
?>	
</body>
</html>
