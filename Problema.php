<?php
require_once("Framework.php");

class Problema extends Framework{
	
	public function __construct($world,$startState){
		$this->world = $world;
		$this->startState = $startState;
	}
	
	public function actions($state){
		$north = $state->y - 1;
		$south = $state->y + 1;
		$west = $state->x - 1;
		$east = $state->x + 1;
		$result = array();
		if($this->canWalk($state->x,$north))
			array_push($result,"N");
		if($this->canWalk($state->x,$south))
			array_push($result,"S");
		if($this->canWalk($west,$state->y))
			array_push($result,"W");
		if($this->canWalk($east,$state->y))
			array_push($result,"E");
		
		
	  return $result;
	}
	
	public function canWalk($x,$y){
		return (isset($this->world[$x]) && isset($this->world[$x][$y]) && $this->world[$x][$y]>0); //Revisa que este entre los margenes del mundo y que no sea 0 la casilla
	}
	
	
	public function goalTest($state){
	
		return $this->world[$state->x][$state->y]==3;  //El numero 3 representa el estado final
			
	}
	
	public function result($state,$action){
		if($action=="N")
			return new Node($state,$state->x,$state->y-1);
		if($action=="S")
			return new Node($state,$state->x,$state->y+1);
		if($action=="E")
			return new Node($state,$state->x+1,$state->y);
		if($action=="W")
			return new Node($state,$state->x-1,$state->y);
		
	}
	
	public function stepCost($state,$action,$newState){
		return 1;
	}
	
	public function pathCost($states){
		
		
		return count($states)-1;
	}
	
	
	
	
	
}