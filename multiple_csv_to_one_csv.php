<?php
	ini_set('auto_detect_line_endings', true);
	$dir = "include/*.csv";
	$returnVal = array();
	foreach (glob($dir) as $file) {
		$header = null;
		$file = fopen($file, 'r') or die('Unable to open file!');
		
		while(($row = fgetcsv($file)) !== false){
			if($header === null){
				$header = $row;
				continue;
			}
			$newRow = array();
			for($i = 0; $i<count($row); $i++){
				
				$newRow[] = $row[$i];	
			}
			if($newRow[0] == null)
			break;
			else
			$returnVal[] = $newRow;
		}
		fclose($file);
	}
	
	//var_dump($returnVal);
	
	$output = fopen("temp/times.csv",'w') or die("Can't open output");
	fputcsv($output, array('Date','Name','APH'));
	foreach($returnVal as $product) {
		fputcsv($output, $product);
	}
fclose($output) or die("Can't close php://output");

include 'drop_create_insert_to_mysql.php';
?>