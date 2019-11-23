<?php
	$medicine = false;
	if(isset($_POST["medicine_name"]))
	{
		//GLOBALLY AVAILABLE IF THIS CODE-CHUNK RUNS
		$medicine = $_POST["medicine_name"];
		$file_name = $medicine.".txt";
				//If the file doesn't exists, show ERROR
		if(!file_exists($file_name))
		{
			$error = true;
			$data = "Medicine not found in Main Stock !";
			}
		//Else, do the following operations
		else
		{
			$error = false;
			//unlink() bulit-in function deletes a file
			unlink($file_name);
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Delete Medicine Stock</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="main">
		<form method="post">
			<h1 style="background: lime; text-shadow: 2px 2px 2px black; width: 100%; color: white; padding: 10px 30px; position: relative; right: 30px; top: -20px;">Delete Medicine</h1>
			<p>Name of Medicine to be deleted from Stock  (Case Sensitive)</p>
			<input type="text" name="medicine_name" id="medicine_name" placeholder="Medicine Name" required>
			<br><br>
			<input type="submit" value="Delete Stock">
							<a href="index.html" class="btn-2">Return Home</a>
		</form>
		<!--CONTEXT DATA BELOW !!! WARNING !!!-->
		<?php
			if($medicine != false)
			{
				if($error) {
			    echo "<table>";
				echo "<tr><td><h3>RECENT STATUS<br> (Becomes empty on Page Close)</h3></td></tr>";
				echo "<tr><td><h2>", $data, "</h2></td></tr>";
			    echo "</table></div>";					
				}
				else
				{
  			      echo "<table>";
  				  echo "<tr><td><h3>RECENT STATUS<br> (Becomes empty on Page Close)</h3></td></tr>";	
			      echo "<tr><td><h3>Recent Successful Deletion : ", $medicine, "</h3></td></tr>";
			      echo "</table></div>";
				}
			}
		?>
		<!--CONTEXT DATA ENDS HERE-->
	</body>
</html>