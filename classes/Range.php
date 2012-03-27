<?php
class Range {
	private $startSecond;
	private $endSecond;
	
	public function __construct($startSecond, $endSecond) {
		$this->startSecond = $startSecond;
		$this->endSecond = $endSecond;
	}
	
	public function getStartSecond() {
		return $this->startSecond;
	}
	
	public function getEndSecond() {
		return $this->endSecond;
	}
	
	public static function getRandomRange($maxSecond) {
		$startSecond = 0;
		$endSecond = 0;
		
		while ($startSecond >= $endSecond) {
			$startSecond = rand(0, $maxSecond);
			$endSecond = rand(0, $maxSecond);
		}
		
		return new Range($startSecond, $endSecond);
	}
}
?>