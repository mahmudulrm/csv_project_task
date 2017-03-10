<?php
    // mysql database connection details
    $host = "localhost";
    $username = "";
    $password = "";
    $dbname = "";

    // open connection to mysql database
    $connection = mysqli_connect($host, $username, $password, $dbname) or die("Connection Error " . mysqli_error($connection));
    
    // fetch mysql table rows   
	$sql = "SELECT Name, SUM(((LF*4)+LB)) AS Total, ROUND(SUM(TIME_TO_SEC(Time)/60/60), 2) as Time, ROUND((SUM(((LF*4)+LB))/SUM(TIME_TO_SEC(Time)/60/60)), 2) AS Average, MAX(ROUND((((LF*4)+LB)/(TIME_TO_SEC(Time)/60/60)), 2)) AS Maximum, MIN(ROUND((((LF*4)+LB)/(TIME_TO_SEC(Time)/60/60)), 2)) AS Minimum, COUNT(Name) AS Count FROM demo GROUP BY Name ORDER BY Minimum DESC";
	$result = mysqli_query($connection, $sql) or die("Selection Error " . mysqli_error($connection));

    $fp = fopen('chart.user.min.csv', 'w');

	fputcsv($fp, array('Name', 'Total', 'Time', 'Average', 'Maximum', 'Minimum', 'Count' ));
		while($row = mysqli_fetch_assoc($result)){
			fputcsv($fp, $row);
		}
    
    fclose($fp);
    //close the db connection
    mysqli_close($connection);
?>
