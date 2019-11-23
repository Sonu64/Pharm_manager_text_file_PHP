<?php
	$medicine = false;
	$price = false;
	$stock = false;
if(isset($_POST["medicine_name"]) && isset($_POST["price"]) && isset($_POST["stock"]))
{
	//GLOBALLY AVAILABLE IF THIS CODE-CHUNK RUNS
	$medicine = $_POST["medicine_name"];
	$price = $_POST["price"];
	$stock = $_POST["stock"];
	$file_name = $medicine.".txt";
	//If the file already exists, show ERROR
	if(file_exists($file_name))
	{
		$error = true;
		$data = "Medicine already added !";
	}
	//Else, do the following operations
	else
	{
		$error = false;
		//open the file, "w" access mode can create it too.
		//write contents, with a space as delimeter
		$file = fopen($file_name, "w");
		fwrite($file, $medicine." ");
		fwrite($file, $price." ");
		fwrite($file, $stock);
		fclose($file);
		/*open the file again for reading the written data
		generally not used, but can be used in DOM
		*/
		$file = fopen($file_name, "r");
		$data = fgets($file);
		fclose($file);
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Add Medicine</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="main"> <!--THIS DIV ENDS IN CONTEXT AREA-->
			<form method="post">
				<h1 style="background: lime; text-shadow: 2px 2px 2px black; width: 100%; color: white; padding: 10px 30px; position: relative; right: 30px; top: -20px;">Add Medicine</h1>
				<p>Name of Medicine (Case Sensitive)</p>
				<input type="text" name="medicine_name" id="medicine_name" placeholder="Medicine Name" required >
				<p>Price of the medicine</p>
				<input type="number" name="price" id="price" min="1" required >
				<p>Currently available stock</p>
				<input type="number" name="stock" id="stock" min="1" required >
				<br><br>
				<input type="submit" value="Add Medicine">
				<a href="index.html" class="btn-2">Return Home</a>
			</form>
			<!--CONTEXT DATA BELOW !!! WARNING !!!-->
			<?php
			if($medicine != false && $price != false && $stock != false)
			{
				if ($error) {
					    echo "<table>";
						echo "<tr><td><h3>STATUS<br> (Becomes empty on Page Close)</h3></td></tr>";
						echo "<tr><td><h2>", $data, "</h2></td></tr>";
					    echo "</table></div>";
				}
				else
				{
					echo "<table>";
					echo "<tr><td><h3>RECENT STATUS<br> (Becomes empty on Page Close)</h3></td></tr>";
					echo "<tr><td><h3> Recent Succesful Add : ", $medicine, "</h3></td></tr>";
					echo "<tr><td><h3> Price Provided : Rs.", $price, "</h3></td></tr>";
					echo "<tr><td><h3> Stock Provided : ", $stock, "</h3></td></tr>";
					echo "</table></div>";
				}
			}
			?>
			<!--CONTEXT DATA ENDS HERE-->
		</body>
	</html>