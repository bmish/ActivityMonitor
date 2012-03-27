<?php
class Video {
	private $filename;
	private $length;
	private $title;
	private $activeRanges;

	public function __construct($filename, $title, $activeRanges) {
		$this->filename = $filename;
		$this->length = 6;
		$this->title = $title;
		$this->activeRanges = $activeRanges;
	}
	
	public function getFilename() {
		return $this->filename;
	}
	
	public function getTitle() {
		return $this->title;
	}
		
	public function getActiveRanges() {
		return $this->activeRanges;
	}
	
	public function getRandomRange() {
		return Range::getRandomRange($this->length);
	}
}
?>