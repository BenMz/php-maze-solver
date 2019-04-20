<?php

abstract class GraphSearch{
	
	public $problema;
	public $start;
	public $visited;
	public $frontier;
	public $explored;
	
	
	
	public function __construct($problema){
		$this->problema = $problema;
		$this->start = $this->problema->startState;
		$this->visited = array($this->start->id); //Nodos que ya visitamos y guardamos id
		$this->frontier = array($this->start); //Nodos que tenemos que visitar
		$this->explored =  array(); //Nodos que ya calculamos sus acciones
		
	}
	
	abstract public function calculate($goalStates);
	
	
}