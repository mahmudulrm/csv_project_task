<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "demo";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	// sql to DROP table
	$d_table = "DROP TABLE IF EXISTS mahmudul";
	
	if ($conn->query($d_table) === TRUE) {
		echo "Table Delete successfully  <br />";
		} else {
		echo "Error creating table: " . $conn->error;
	}
	
	// sql to create table
	$c_table = "CREATE TABLE mahmudul (
	id INT(6) AUTO_INCREMENT PRIMARY KEY, 
	`Date` 	Date NOT NULL,
	`Name`   VARCHAR(50) NOT NULL,
	`APH`  FLOAT
	)";
	
	
	if ($conn->query($c_table) === TRUE) {
		echo "Table demo created successfully <br />";
		} else {
		echo "Error creating table: " . $conn->error;
	}
	
	
	foreach (glob("temp/times.csv") as $file) {
		// INSERT from CSV
		$csv_file = $file; 
		if (($handle = fopen($csv_file, "r")) !== FALSE) {
			fgetcsv($handle);   
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				for ($c=0; $c < $num; $c++) {
					$col[$c] = $data[$c];
				}
				$col1 = $col[0];
				$date = new DateTime($col1);
				$newdate = $date->format('Y-m-d');
				$col2 = $col[1];
				$col3 = $col[2];
				$sql = "INSERT INTO `demo` (`Date`, `Name`, `APH`) VALUES ('$newdate', '".$col2."', ".$col3.")";
				
				if ($conn->query($sql) === TRUE) {
					echo $col1 ." ". $col2 ." ". $col3 ."  New record created successfully <br />";
					} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
			fclose($handle);
		}
		echo "File data successfully imported to database!!<br />";
	}
	
	$conn->close();
?>