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
				$videoFilename = $video->getFilename();
				$activeRanges = $video->getActiveRanges();
				$activeRange = $activeRanges[0];
				
				echo '<td class="videoCell" id="videoCell-'.$videoFilename.'">';
				echo '<div class="videoCellDiv">';
				echo '<div class="videoHeader" id="videoHeader-'.$videoFilename.'">'.$video->getTitle().'</div>';
				echo '<video width="'.$videoWidth.'" height="'.$videoHeight.'" loop autoplay controls="" id="video-'.$videoFilename.'">';
				echo '<source src="videos/'.$videoFilename.'" />';
				echo '</video>';
				echo '</div>';
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