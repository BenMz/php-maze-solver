<?php
abstract class Framework{
	
	public $world; 
	public $startState;
	
	abstract  public function actions($state);
	abstract  public function canWalk($x,$y);
	abstract  public function goalTest($state);
	abstract  public function result($state,$action);
	abstract  public function stepCost($state,$action,$newState);
	abstract  public function pathCost($states);
	
	
	
	
	
}