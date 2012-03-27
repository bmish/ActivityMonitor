var t;
var json;

function setupTimer() {
	highlightActiveVideos();
}

function highlightActiveVideos() {
	t = setTimeout("highlightActiveVideos()", 3000);
}