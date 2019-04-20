<?php

class Node{
	
	public $previous; 
	public $x;
	public $y;
	public $g;
	public $h;
	public $id;
	
	function __construct($previous,$x,$y){ 
		$this->previous = $previous;
		$this->x = $x;
		$this->y = $y;
		$this->g = 0;
		$this->h = 0;
		$this->id = "$x-$y";
	
	}
	
	
	
}