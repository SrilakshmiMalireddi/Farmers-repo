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
	<meta name="viewport" content="width=device-width">
	<title>eSagu - Document Repoistory</title>

	<link rel = "stylesheet" type = "text/css" href = "Uploadtestcss.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	.container{
		width:90%;
		margin:auto;
		overflow:hidden;
	}
	</style>
</head>

<body>
	<header>
		<div class="container">
			<div id="branding">
			  <h1><span class = "highlight">eSagu</span> Document Repository</h1>
			</div>
			<nav>
			  <ul>
			  	<li><a href="Signinhome.php">Home</a></li>
			  	<li><a href="Signinabout.php">About</a></li>
				<li class="current"><a href="Signinview.php">View</a></li>
				<li><a href="Uploadtest.php">Upload</a></li>
				<li><a href="logout.php">Sign Out</a></li>
			  </ul>
			</nav>
		</div>
	</header>

	<?php
		$date = 2004;
		$curdate = date("Y");
		$year = array(); //$year is an array which stores the list of years from 2004 to the current year
		for($i = 0;$date<=$curdate; $i++)
		{
			$year[$i] = $date;
			$date++;
		}
	?>
	
	<?php
		$set = array(); //it is an array which stores all the publication names
		$lang = array(); //it is an array which stores all the languages
		
		$conn = mysqli_connect("localhost", "root", "1234", "DR");
		//establishing mysql connection
		
		if(!$conn)
		{
			die("Connection failed: " . mysqli_connect_error());
		}
							
		$query =  "select distinct(PublicationName) as name from Files where PublicationName not like ''";
		$result = mysqli_query($conn, $query);
		
		$l = 0; //length of the array $set which stores all the publication names
		
		while($row = $result->fetch_assoc())
		{
			$set[$l] = $row['name'];
			$l++;
		}	
		
		$query2 = "select distinct(Language) as language from Files where Language not like ''";
		$result = mysqli_query($conn, $query2);
		
		$p = 0; //length of the array $lang which stores all the languages
		
		while($row = $result->fetch_assoc())
		{	
			$lang[$p] = $row['language'];				
			$p++;
		}		
		mysqli_close($conn);						
	?>	
					
	<section>
		<div class="container">
							
				<form method=POST action="<?php echo $_SERVER["PHP_SELF"];?>"> 
						
						<br/>
						<!-- drop down box for FileFormat-->
						<span id="dropdown-head">FILE FORMAT:</span>
						<select name="typeoffile">
							<option value="Images">Images</option>
							<option value="Videos">Videos</option>
							<option value="Pdfs">Pdfs</option>
							<option value="Docs">Docs</option>
							<option value="Text">Text</option>
							<option value="Ppts">Presentations</option>
							<option value="All" selected>All</option>
						</select>
					
						<br/>
						<br/>
						
						<!-- drop down box for the type of document-->
						<span id="dropdown-head">TYPE OF DOCUMENT:</span>
						<select name="documenttype">
							<option value="Media">Media</option>
							<option value="Research">Research</option>
							<option value="Project">Project</option>
							<option value="All" selected>All</option>
						</select>
						
						<br/>
						<br/>
						
						<!-- drop down for the list of publication names stored in the array $set-->
						<span>PUBLICATION NAME:</span>
						<select name="source">
							<?php
							for($j = 0; $j < $l; $j++)
							{
								echo "<option value='".$set[$j]."'>".$set[$j]."</option>";
							}
							?>
							<option value="Any" selected>Any</option>	
						</select>
						<br/>
						<br/>
						
						<!-- drop down for the list of languages stored in the array $lang-->
						<span>LANGUAGE:</span>
						<select name="lang">
							<?php
							for($j = 0; $j < $p; $j++)
							{
								echo "<option value=".$lang[$j].">".$lang[$j]."</option>";
							}
							?>
							<option value="Any" selected>Any</option>	
						</select>
						<br/>
						<br/>									
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ LIST FOR BETWEEN DATES ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->	
					
					
					 <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~from DATE~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->			
					
						<input type="radio" name="date" value="between">
							
							<span style="font-size:15px">BETWEEN</span>

							<select name="fromyear">
								<?php
								for($j = 0; $j < $i; $j++)
								{
									echo "<option value=".$year[$j].">".$year[$j]."</option>";
								}
								?>
							</select>
						
	                  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~TO DATE~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                  		
							<span id="dropdown-head">TO</span>
				
							<select name="toyear">
								<?php
								for($j = 0; $j < $i; $j++)
								{
									echo "<option value=".$year[$j].">".$year[$j]."</option>";
								}
								?>
							</select>
										
						</input> 
						<br/>				
						<br/>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ LIST FOR LESS THAN DATES ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->



						<input type="radio" name="date" value="lessthan">
							<span style="font-size:15px">LESS THAN</span>

							<select name="ltyear">
								<?php
								for($j = 0; $j < $i; $j++)
								{
									echo "<option value=".$year[$j].">".$year[$j]."</option>";
								}
								?>
							</select>
				
						</input>
						<br/>
						<br/>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ LIST FOR GREATER THAN DATES ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


						<input type="radio" name="date" value="greaterthan">
							<span style="font-size:15px">GREATER THAN</span>

							<select name="gtyear">
								<?php
								for($j = 0; $j < $i; $j++)
								{
									echo "<option value=".$year[$j].">".$year[$j]."</option>";
								}
								?>
							</select>
				
						</input>	
						<br/>
						<br/>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ LIST FOR SINGLE DATES ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

						<input type="radio" name="date" value="single">
							<span style="font-size:15px">IN</span>

							<select name="syear">
								<?php
								for($j = 0; $j < $i; $j++)
								{
									echo "<option value=".$year[$j].">".$year[$j]."</option>";
								}
								?>
							</select>
						</input>
					
					<br/>
					<br/>
															
					<button type="submit" name = "submit"/>Search</button>
				</form>
			
		</div>
	</section>
		
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ DATE CHECKING ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<?php
	if(isset($_POST['submit'])) //when the submit button is pressed
	{
		if($_POST['fromyear'] <= $_POST['toyear'])
		{
			$checkd = 1;
		}
		else
		{
			$checkd = 0;
		}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~CHECKING THE TYPE OF FILE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
			
		if(strcmp($_POST['typeoffile'], "Images") == 0)
		{
			$fileformat = 0;
		}
		else if(strcmp($_POST['typeoffile'], "Videos") == 0)
		{
			$fileformat = 1;
		}
		else if(strcmp($_POST['typeoffile'], "Pdfs") == 0)
		{
			$fileformat = 2;
		}
		else if(strcmp($_POST['typeoffile'], "Docs") == 0)
		{
			$fileformat = 3;
		}
		else if(strcmp($_POST['typeoffile'], "Text") == 0)
		{
			$fileformat = 4;
		}
		else if(strcmp($_POST['typeoffile'], "Ppts") == 0)
		{
			$fileformat = 5;
		}
		else if(strcmp($_POST['typeoffile'], "All") == 0)
		{
			$fileformat = 6;									
		}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~CHECKING THE TYPE OF DOC ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

		if(strcmp($_POST['documenttype'], "Media") == 0)
		{
			$documenttype = 0;
		}
		else if(strcmp($_POST['documenttype'], "Research") == 0)
		{
			$documenttype = 1;
		}
		else if(strcmp($_POST['documenttype'], "Project") == 0)
		{
			$documenttype = 2;
		}
		else if(strcmp($_POST['documenttype'], "All") == 0)
		{
			$documenttype = 3;
		}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~CHECKING THE SOURCE SELECTED~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
		if(strcmp($_POST['source'], 'Any') == 0)
		{
			$source = 0;
		}
		else
		{
			$source = 1;
		}
		
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ CHECKING THE LANGUAGE SELECTED ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
		if(strcmp($_POST['lang'], 'Any') == 0)
		{
			$language = 0;
		}		
		else
		{
			$language = 1;
		}
	}
?>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~CODES ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<!-- For all the different kinds of selections that can be made by the user-->

	<section id="view">
	<div class="container">
	<?php
	
		//establishing mysql connection
		
		$connection = mysqli_connect("localhost", "root", "1234", "DR");
		if(!$connection)
		{
			die("Connection failed: " . mysqli_connect_error());
		}
		
		if(isset($_POST['submit'])) //if the submit button is pressed
		{


/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~WHEN A PARTIULAR TYPE OF FILE AND A PARTICULAR TYPE OF DOC ARE SELECTED ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
			if($fileformat != 6 && $documenttype != 3)
			{
			
				/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~ BETWEEN DATE CODE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/	
				
				if(strcmp($_POST['date'], "between") == 0)//between dates
				{					
					if($checkd == 1)//if the dates are entered correctly
					{
						if($source == 1 && $language == 1) //if a particular source and language are selected
						{		
							$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
						}
					
						else if($source == 0 && $language == 1) //if only a particular language is selected
						{
							$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
					
						}
					
						else if($source == 1 && $language == 0) //if only a particular source is selected
						{
							$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' order by FileId desc";					
						}
						
						else if($source == 0 && $language == 0)  //if no particular source and language are selected
						{
							$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' order by FileId desc";						
						}
					}
					else
					echo "Please check the entered dates";
				}
					
				
				/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ LESS THAN DATE CODE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/	
				else if(strcmp($_POST['date'], "lessthan") == 0)
				{
						
					if($source == 1 && $language == 1) //if a particular source and language are selected
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear < '".$_POST["ltyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					
					else if($source == 1 && $language == 0) //if only a particular source is selected
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear < '".$_POST["ltyear"]."' order by FileId desc";
					}
					
					else if($source == 0 && $language == 1)	 //if only a particular language is selected
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationYear < '".$_POST["ltyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";					
					}
					
					else if($source == 0 && $language == 0) //if no particular source and language are selected
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationYear < '".$_POST["ltyear"]."' order by FileId desc";
							
					}
				}
					
				
				/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ GREATER THAN DATE CODE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/	
				else if(strcmp($_POST['date'], "greaterthan") == 0)
				{
						
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear > '".$_POST["gtyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationYear > '".$_POST["gtyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";

					}
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear > '".$_POST["gtyear"]."' order by FileId desc";

					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationYear > '".$_POST["gtyear"]."' order by FileId desc";
							
					}						
				}
					
				/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ SINGLE DATE CODE ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/	
				else if(strcmp($_POST['date'], "single") == 0)
				{ 
						
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear = '".$_POST["syear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationYear = '".$_POST["syear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}					
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear = '".$_POST["syear"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationYear = '".$_POST["syear"]."' order by FileId desc";
								
					}						
				}
				
				
				/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ IF NO DATE IS SELECTED ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
				else if(strcmp($_POST['date'], '') == 0)
				{		
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype Language LIKE '".$_POST["lang"]."' order by FileId desc";
												
					}
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' order by FileId desc";
							
					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and DocumentTypeId = $documenttype order by FileId desc";			
					}						
				}	
								
			} 

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ WHEN ONLY A PARTICULAR FILE IS SELECTED ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
			else if($fileformat != 6 && $documenttype == 3)
			{
				if(strcmp($_POST['date'], "between") == 0)//between dates
				{
					if($checkd == 1)
					{
					if($source == 1 && $language == 1)
					{		
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
					
					}
					
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' order by FileId desc";					
					}
						
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' order by FileId desc";						
					}
					}
					else
					echo "Please check the entered date";				
				}
				
				
				else if(strcmp($_POST['date'], "lessthan") == 0) //when less than is selected
				{
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear < '".$_POST["ltyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear < '".$_POST["ltyear"]."' order by FileId desc";
					}
					
					else if($source == 0 && $language == 1)	
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationYear < '".$_POST["ltyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";					
					}
					
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationYear < '".$_POST["ltyear"]."' order by FileId desc";
							
					}
				}
				
				
				else if(strcmp($_POST['date'], "greaterthan") == 0) //when greater than is selected
				{
						
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear > '".$_POST["gtyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationYear > '".$_POST["gtyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";

					}
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear > '".$_POST["gtyear"]."' order by FileId desc";

					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationYear > '".$_POST["gtyear"]."' order by FileId desc";
							
					}						
						
				}
				
				
				else if(strcmp($_POST['date'], "single") == 0) //when a single date is selected
				{
						
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear = '".$_POST["syear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationYear = '".$_POST["syear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}					
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear = '".$_POST["syear"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationYear = '".$_POST["syear"]."' order by FileId desc";
								
					}						
				}
				
				else if(strcmp($_POST['date'], '') == 0) //when no date is selected
				{	
				
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationName LIKE '%".$_POST["source"]."%' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat Language LIKE '".$_POST["lang"]."' order by FileId desc";
												
					}
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat and PublicationName LIKE '%".$_POST["source"]."%' order by FileId desc";
							
					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where FileFormatId = $fileformat order by FileId desc";			
					}												
				}
																					
			}//all tyoes of documents but specific files
			
			
			
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ WHEN ONLY A PARTICULAR DOCUMENT TYPE IS SELECTED ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
			else if($fileformat == 6 && $documenttype != 3) // all types of file formats but specific doc
			{
				if(strcmp($_POST['date'], "between") == 0)//between dates
				{
					if($checkd == 1)
					{
					if($source == 1 && $language == 1)
					{		
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
					
					}
					
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' order by FileId desc";					
					}
						
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' order by FileId desc";						
					}
					}
					else
					echo "Please check the entered dates";
				}
				
				
				else if(strcmp($_POST['date'], "lessthan") == 0) //when less than date is selected
				{
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear < '".$_POST["ltyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear < '".$_POST["ltyear"]."' order by FileId desc";
					}
					
					else if($source == 0 && $language == 1)	
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationYear < '".$_POST["ltyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";					
					}
					
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationYear < '".$_POST["ltyear"]."' order by FileId desc";
							
					}
				}				
				
				
				else if(strcmp($_POST['date'], "greaterthan") == 0) //when greater than date is selected
				{
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear > '".$_POST["gtyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationYear > '".$_POST["gtyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";

					}
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear > '".$_POST["gtyear"]."' order by FileId desc";

					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationYear > '".$_POST["gtyear"]."' order by FileId desc";
							
					}							
				}	
				
				
				else if(strcmp($_POST['date'], "single") == 0) //when a single date is selected
				{
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear = '".$_POST["syear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationYear = '".$_POST["syear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}					
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear = '".$_POST["syear"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationYear = '".$_POST["syear"]."' order by FileId desc";
								
					}											
				}
				
				else if(strcmp($_POST['date'], '') == 0) //when no date is selected
				{	
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype Language LIKE '".$_POST["lang"]."' order by FileId desc";
												
					}
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype and PublicationName LIKE '%".$_POST["source"]."%' order by FileId desc";
							
					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where DocumentTypeId = $documenttype order by FileId desc";			
					}						
				}				
																	
			} // all types of file formats but specific doc
			
			
	/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ CODE FOR ALL TYPES OF FILES AND DOCUMENTS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
			else if($fileformat == 6 && $documenttype == 3) //any type of file and doc
			{
				if(strcmp($_POST['date'], "between") == 0)//between dates
				{
					if($checkd == 1)
					{
					if($source == 1 && $language == 1)
					{		
						$query = "SELECT * from Files where PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
					
					}
					
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' order by FileId desc";					
					}
						
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where PublicationYear between '".$_POST["fromyear"]."' and '".$_POST["toyear"]."' order by FileId desc";						
					}
					}
					else
					echo "Please check the entered dates";
				}				
				
				
				else if(strcmp($_POST['date'], "lessthan") == 0) //when less than is selected
				{
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear < '".$_POST["ltyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear < '".$_POST["ltyear"]."' order by FileId desc";
					}
					
					else if($source == 0 && $language == 1)	
					{
						$query = "SELECT * from Files where PublicationYear < '".$_POST["ltyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";					
					}
					
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where PublicationYear < '".$_POST["ltyear"]."' order by FileId desc";
							
					}
				}
				

				else if(strcmp($_POST['date'], "greaterthan") == 0) //when greater than is selected
				{
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear > '".$_POST["gtyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where PublicationYear > '".$_POST["gtyear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";

					}
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear > '".$_POST["gtyear"]."' order by FileId desc";

					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where PublicationYear > '".$_POST["gtyear"]."' order by FileId desc";
							
					}						
				}
				
				else if(strcmp($_POST['date'], "single") == 0) // when a single date is selected
				{
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear = '".$_POST["syear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where PublicationYear = '".$_POST["syear"]."' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}					
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where PublicationName LIKE '%".$_POST["source"]."%' and PublicationYear = '".$_POST["syear"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files where PublicationYear = '".$_POST["syear"]."' order by FileId desc";
					}						
				}
				
				else if(strcmp($_POST['date'], '') == 0) //when no date is selected
				{	
					if($source == 1 && $language == 1)
					{
						$query = "SELECT * from Files where PublicationName LIKE '%".$_POST["source"]."%' and Language LIKE '".$_POST["lang"]."' order by FileId desc";
							
					}
					else if($source == 0 && $language == 1)
					{
						$query = "SELECT * from Files where Language LIKE '".$_POST["lang"]."' order by FileId desc";
												
					}
					else if($source == 1 && $language == 0)
					{
						$query = "SELECT * from Files where PublicationName LIKE '%".$_POST["source"]."%' order by FileId desc";
					
					}
					else if($source == 0 && $language == 0)
					{
						$query = "SELECT * from Files order by FileId desc";	
							
					}										
				}				
																		
			} //any type of file and doc
			
			
			
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ CODE FOR DISPLAYING THE RESULT ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/	
				
				$counter = 0; //checks if there are any files which satisfy the selected conditions
				
				for($j = 0; $j < $i; $j++) //$i is the size of the array list which has the list of PublicationYears
				{
					$result = mysqli_query($connection, $query);
				
					$count = 0; //checks if a particular year from $list is a part of the result or not
					
					while($row = $result->fetch_assoc())
					{
						$date = $row['PublicationYear'];
						$id = $row['FileId'];
						
						if(strcmp($date, $year[$j]) == 0)
						{
							$count++;
							$counter++;
						}
					}
					
					if($count != 0)
					{
			?>
			<h1><?php echo $year[$j]; ?></h1>
			<?php
						$result = mysqli_query($connection, $query);
					
						$k = 0; //indexes the files
						
						while($row = $result->fetch_assoc())
						{
							$id = $row['FileId'];
							$date = $row['PublicationYear'];
							$desc = $row['Description'];
							$name = $row['PublicationName'];
							$ff = $row['FileFormatId'];
							$delete = "[DELETE]";
							
							if(strcmp($date, $year[$j]) == 0)
							{
								$k++;
							
								$query1 =  "select Format from FileFormat where Id = $ff"; //gets the format type of the file
								$result1 = mysqli_query($connection, $query1);							
			?>					
									
								<h2 id="head"><?php echo $k.".  ".$name; ?></h2>
								<p id="desc"><?php echo $desc; ?>
								<span>
			<?php 				
								while($row = $result1->fetch_assoc())
								{
									$format = $row['Format']; //the format of the file is stored in the variable $format
								}
								echo "<a href = 'Displaytest.php?id=".$id."' target='_blank'>[".$format."]</a> ";
								echo " <a href = 'Deleterow.php?id=".$id."'>".$delete."</a>";				
			?>
								</span>
								</p>
			<?php
							}
						}
					}	
					
				}
				if($counter == 0) //if there are no files which satisfy the selected conditions
				{
			?>
					<p id="desc">No files to show.</p>
			<?php
				}
				
		}// submit button
	?>
			
	</div>
	</section>
		
	<footer>
		<p>eSagu Document Repository, Copyright &copy; <?php echo date("Y"); ?></p>
	</footer>

<?php
}
?>
</body>
</html>
