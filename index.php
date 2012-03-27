<?php
require_once("classes/config.php");
require_once("classes/fns.php");
require_once("classes/Range.php");
require_once("classes/Video.php");

// Get videos.
$videos = readInVideos();
$videoCount = count($videos);
$rowCount = getRowCount($videoCount);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title; ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/fns.js"></script>
</head>
<body>
<div id="wrapper">
	<div id="page">
		<table>	
		<?php
		for($row = 0; $row < $rowCount; $row++) {
			echo '<tr>';
			
			for($col = 0; $col < getRowSize($row); $col++) {
				$videoIndex = getIndexByRowAndCol($row, $col);
				$video = $videos[$videoIndex];
				$activeRanges = $video->getActiveRanges();
				$activeRange = $activeRanges[0];
				
				echo '<td class="videoCell" id="videoCell'.$videoIndex.'">';
				echo '<div class="videoHeader" id="videoHeader'.$videoIndex.'">';
				echo $video->getTitle();
				echo '</div>';
				echo '<video width="'.$videoWidth.'" height="'.$videoHeight.'" loop controls="" id="video'.$videoIndex.'">';
				echo '<source src="videos/'.$video->getFilename().'" />';
				echo '</video>';
				echo '</td>';
			}
			
			echo '</tr>';
		}	
		?>
		</table>
	</div>
	
	<script>
	setupTimer();
	</script>
</div>
</body>
</html>