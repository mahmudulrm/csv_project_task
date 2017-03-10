<?php
	ini_set('auto_detect_line_endings', true);
	$returnVal = array();
		$header = null;
		$file = fopen('chart.metric.csv', 'r') or die('Unable to open file!');
		
		while(($row = fgetcsv($file)) !== false){
			if($header === null){
				$header = $row;
				continue;
			}
				$Total = ($row[0]);
				$Time = ($row[1]);
				$WUPH = ROUND($row[2],2);
			
		}
		fclose($file);
?>
	<div class="metric_body"> 
		<div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4"> <div class="metric total_bg"> <span>Total</span><?php echo $Total; ?></div> </div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> <div class="metric time_bg"> <span>Time</span><?php echo $Time; ?></div> </div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> <div class="metric avg_bg"> <span>Average</span><?php echo $WUPH; ?></div> </div>
	</div>
	

