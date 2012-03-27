var t;
var videos;

function Range(startSeconds, endSeconds) {
	this.startSeconds = startSeconds;
	this.endSeconds = endSeconds;
	this.contains = function (second) {
		return second >= this.startSeconds && second <= this.endSeconds;
	};
}

function Video(filename, activeRanges) {
	this.filename = filename;
	this.activeRanges = activeRanges;
	this.isActiveDuring = function (second) {
		for (var i = 0; i < this.activeRanges.length; i++) {
			if (this.activeRanges[i].contains(second)) {
				return true;
			}
		}
		
		return false;
	}
}

function setupTimer() {
	$.getJSON('videos/activity.json', function (data) {
		var jsonVideos = data.videos;
		videos = [];
		
		for (var videoIndex in jsonVideos) {
			var jsonVideo = jsonVideos[videoIndex];
			var jsonActiveRanges = jsonVideo.activeRanges;
			var filename = jsonVideo.filename;
			
			var activeRanges = [];
			for (var activeRangeIndex in jsonActiveRanges) {
				var jsonActiveRange = jsonActiveRanges[activeRangeIndex];
				var startSecond = jsonActiveRange.startSecond;
				var endSecond = jsonActiveRange.endSecond;
				
				activeRanges[activeRangeIndex] = new Range(startSecond, endSecond);
			}
			
			videos[videoIndex] = new Video(filename, activeRanges);
		}
		
		highlightActiveVideos();
	});
}

function highlightActiveVideos() {	
	for (var i = 0; i < videos.length; i++) {
		var video = videos[i];
		var videoElement = document.getElementById("video-" + video.filename);
		if (video.isActiveDuring(videoElement.currentTime)) {
			videoElement.style.opacity = 1;
		} else {
			videoElement.style.opacity = 0.3;
		}
	}
	
	t = setTimeout("highlightActiveVideos()", 1000);
}