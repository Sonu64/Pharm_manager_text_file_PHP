<?php
	$medicine = false;
	$num = false;
	$customer = false;
	if(isset($_POST["medicine_name"]) && isset($_POST["num"]) && isset($_POST["customer"]))
	{
		//GLOBALLY AVAILABLE IF THIS CODE-CHUNK RUNS
		$medicine = $_POST["medicine_name"];
		$num = $_POST["num"];
		$customer = $_POST["customer"];
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
			//$data is now an array with [0]->medicine_name, [1]->price, [2]->current_stock
			$data = explode(" ", $data);
			//GETTING THE PRICE
			$price = $data[1];
			//GETTING THE CURRENTLY AVAILABLE STOCK
			$current_stock = $data[2];
			/*CONVERTING $current_stock AND $num TO INTEGER, SUBTRACTING THE BOUGHT MEDICINES, I.E., $num, CONVERTING TO STRING AGAIN AS fwrite() CAN'T WRITE NUMBERS*/
			$current_stock += 0;
			$num += 0;
			$current_stock -= $num; //$current_stock changes here !!!
			//If current_stock is not enough for buying, writing to the file is skipped.
			if($current_stock < 0)
			{
				$data = "Insufficient Stock !";
			}
			//This part actually updates the file, writing to it.
			else
			{
							$current_stock = $current_stock."";	//to string
			$cost = $num * $price;
			/*WRITING CONTENTS, FILE OPENED -> MEDICINE NAME WRITTEN, GOT BY EXPLODING $data -> PRICE WRITTEN -> NEW STOCK WRITTEN*/
			$file = fopen($file_name, "w");
			fwrite($file, $medicine." ");
			fwrite($file, $price." ");
			fwrite($file, $current_stock);
									fclose($file);
			}
					}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Buy Medicine</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="main"> <!--THIS DIV ENDS IN CONTEXT AREA-->
			<form method="post">
				<h1 style="background: lime; text-shadow: 2px 2px 2px black; width: 100%; color: white; padding: 10px 30px; position: relative; right: 30px; top: -20px;">Buy Medicine</h1>
				<p>Name of Medicine to be bought (Case Sensitive)</p>
				<input type="text" name="medicine_name" id="medicine_name" placeholder="Medicine Name" required>
				<p>No. of bottles / Slips</p>
				<input type="number" name="num" id="num" min="1" required>
				<p>Customer Name</p>
				<input type="text" name="customer" id="customer" required>
				<br><br>
				<input type="submit" value="Proceed">
				<a href="index.html" class="btn-2">Return Home</a>
			</form>
			<!--CONTEXT DATA BELOW !!! WARNING !!!-->
			<?php
			if($medicine != false && $num != false && $customer != false)
			{
				if($error) {
						echo "<table>";
						echo "<tr><td><h3>STATUS<br> (Becomes empty on Page Close)</h3></td></tr>";
						echo "<tr><td><h2>", $data, "</h2></td></tr>";
						echo "</table>";
				}
				else if($current_stock < 0)
				{
						echo "<table>";
						echo "<tr><td><h3>STATUS<br> (Becomes empty on Page Close)</h3></td></tr>";
						echo "<tr><td><h2>", $data, "</h2></td></tr>";
						echo "</table>";
				}
				else
				{
					echo "<table>";
					echo "<tr><td><h3>RECENT BILL<br> (Becomes empty on Page Close)</h3></td></tr>";
					echo "<tr><td><h3> Customer Name : ", $customer, "</h3></td></tr>";
					echo "<tr><td><h3> Total Bill : Rs.", $cost, "</h3></td></tr>";
					echo "<tr><td><h3> Medicine bought : ", $medicine, "</h3></td></tr>";
					echo "<tr><td><h3> Currently available stock : ", $current_stock, "</h3></td></tr>";
					echo "</table></div>";
			    }
			}
			?>
			<!--CONTEXT DATA ENDS HERE-->
		</body>
	</html>