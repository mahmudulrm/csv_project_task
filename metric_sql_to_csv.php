<?php
	$host = "localhost";
    $username = "";
    $password = "";
    $dbname = "";
	
    // open connection to mysql database
    $connection = mysqli_connect($host, $username, $password, $dbname) or die("Connection Error " . mysqli_error($connection));
	
    // fetch mysql table rows
	
	$results = mysqli_query($connection,'select SUM(((LF*4)+LB)) AS Total, my_SEC_TO_TIME(SUM(TIME_TO_SEC(Time))) AS Time, ROUND((SUM(((LF*4)+LB))/SUM(TIME_TO_SEC(Time)/60/60)), 2) AS WUPH from demo');
	$row = mysqli_fetch_row($results);
	$Total = ($row[0]);
	$Time = ($row[1]);
	$WUPH = ROUND($row[2],2);
	
	$fp = fopen('chart.metric.csv', 'w');
	fputcsv($fp, array('Total', 'Time', 'Average'));
	fputcsv($fp, array($Total, $Time,$WUPH));
	fclose($fp);
	mysqli_close($connection);
?>
