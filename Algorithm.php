<?php
require_once("Astar.php");
require_once("BreadthFirst.php");
require_once("DepthFirst.php");
class Algorithm{
	
	public $graphSearch;
	
	public function __construct($algorithm){
		$this->graphSearch = $algorithm;
		
	}
	
	public function findPath($goalStates){
		return $this->graphSearch->calculate($goalStates);
	}
	
	
}