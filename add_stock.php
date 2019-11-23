<?php
	$medicine = false;
	$stock = false;
	if(isset($_POST["medicine_name"]) && isset($_POST["stock"]))
	{
		//GLOBALLY AVAILABLE IF THIS CODE-CHUNK RUNS
		$medicine = $_POST["medicine_name"];
		$stock = $_POST["stock"];
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
			//Open the file for reading the line, assigned to $data
			$file = fopen($file_name, "r");
			$data = fgets($file);
			fclose($file);
			//$data is now an array with [0]->medicine_name, [1]->price, [2]->stock
			$data = explode(" ", $data);
			//GETTING THE CURRENTLY AVAILABLE STOCK
			$current_stock = $data[2];
			//PRICE REQUIRED ONLY FOR WRITING AS fwrite() TRUNCATES THE WHOLE FILE
			$price = $data[1];
			/*CONVERTING $current_stock AND $stock TO INTEGER, ADDING THE NEW STOCK, I.E., $stock, CONVERTING TO STRING AGAIN AS fwrite() CAN'T WRITE NUMBERS*/
			$current_stock += 0;
			$stock += 0;
			$current_stock += $stock; //$current_stock changes here !!!
			$current_stock = $current_stock."";
			/*WRITING CONTENTS, FILE OPENED -> MEDICINE NAME WRITTEN, GOT BY EXPLODING $data -> PRICE WRITTEN -> NEW STOCK WRITTEN*/
			$file = fopen($file_name, "w");
			fwrite($file, $medicine." ");
			fwrite($file, $price." ");
			fwrite($file, $current_stock);
			fclose($file);
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Add Stock</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
				<div class="main">
		<form method="post">

			<h1 style="background: lime; text-shadow: 2px 2px 2px black; width: 100%; color: white; padding: 10px 30px; position: relative; right: 30px; top: -20px;">Add Stock</h1>
			<p>Name of Medicine (Case Sensitive)</p>
			<input type="text" name="medicine_name" id="medicine_name" placeholder="Medicine Name" required>
			<p>Stock to be added</p>
			<input type="number" name="stock" min="1" id="stock" required>
			<br><br>
			<input type="submit" value="Add Stock">
							<a href="index.html" class="btn-2">Return Home</a>
		</form>
		<!--CONTEXT DATA BELOW !!! WARNING !!!-->
		<?php
		if($medicine != false && $stock != false)
		{
			if($error)
			{
			    echo "<table>";
				echo "<tr><td><h3>RECENT STATUS<br> (Becomes empty on Page Close)</h3></td></tr>";
				echo "<tr><td><h2>", $data, "</h2></td></tr>";
			    echo "</table></div>";
			}
			else
			{
				echo "<table>";
				echo "<tr><td><h3>RECENT STATUS<br> (Becomes empty on Page Close)</h3></td></tr>";
				echo "<tr><td><h3>Successful Addition : ", $medicine," </h3></td></tr>";
				echo "<tr><td><h3>Stock Added : ", $stock, "</h3></td></tr>";
				echo "<tr><td><h3>New stock : ", $current_stock, " </h3></td></tr>";
				echo "</table></div>";
				
			}
		}
		?>
		<!--CONTEXT DATA ENDS HERE-->
	</body>
</html>