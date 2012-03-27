<?php
function readInVideos() {
	global $videoListFilename;
	
	$json = readJSONFromFile($videoListFilename);
	return parseJSONIntoVideos($json);
}

function parseJSONIntoVideos($json) {
	$videos = array();
	for ($videoIndex = 0; $videoIndex < count($json["videos"]); $videoIndex++) {
		$jsonVideo = $json["videos"][$videoIndex];
		
		$jsonVideoActiveRanges = $jsonVideo["activeRanges"];
		$activeRanges = array();
		for ($activeRangeIndex = 0; $activeRangeIndex < count($jsonVideoActiveRanges); $activeRangeIndex++) {
			$startSecond = $jsonVideoActiveRanges[$activeRangeIndex]["startSecond"];
			$endSecond = $jsonVideoActiveRanges[$activeRangeIndex]["endSecond"];
			
			$activeRanges[] = new Range($startSecond, $endSecond);
		}
		
		$filename = $jsonVideo["filename"];
		$title = $jsonVideo["title"];
		
		$videos[] = new Video($filename, $title, $activeRanges);
	}
	
	return $videos;
}

function readJSONFromFile($filename) {
	$jsonString = file_get_contents($filename);
	
	return json_decode($jsonString, true);
}

function getRowCount($videoCount) {
	global $videosPerRow;
	
	return ceil($videoCount / $videosPerRow);
}

function getIndexByRowAndCol($rowIndex, $colIndex) {
	global $videosPerRow;
	
	return $rowIndex * $videosPerRow + $colIndex;
}

function getRowSize($rowIndex) {
	global $videoCount, $videosPerRow, $rowCount;
	
	if ($rowIndex == $rowCount - 1 && $videoCount % $videosPerRow != 0) {
		return $videoCount % $videosPerRow;
	}
	
	return $videosPerRow;
}
?>