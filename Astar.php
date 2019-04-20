<?php
require_once("GraphSearch.php");
class Astar extends GraphSearch{

	public $heuristicType;
	
	public function __construct($problema,$heuristicType){ 
		$this->heuristicType = $heuristicType;
		
		parent::__construct($problema);
	
	}
	
	public function calculate($goalStates){
		$worldSize = count($this->problema->world)*count($this->problema->world[0]);
		
		$goals = array();
		foreach($goalStates as $goal){
			array_push($goals,new Node(null,$goal[0],$goal[1]));
		}
		
		$result = array();
		
		while(count($this->frontier)>0){
			$max = $worldSize;
			$min = -1;
			for($i = 0;$i<count($this->frontier);$i++){
				if($this->frontier[$i]->h < $max){
					$max = $this->frontier[$i]->h;
					$min = $i;
				}
			}
			
			$currentNode = array_splice($this->frontier,$min,1)[0];

			if($this->problema->goalTest($currentNode)){
				array_push($this->explored,$currentNode);
				$path = end($this->explored);
				
				while($path->previous!=null){
					array_push($result,array($path->x,$path->y));
					$path = $path->previous;
				}
				$result = array_reverse($result);
				$this->frontier = array();
			}
			else{
				$actions = $this->problema->actions($currentNode);
				foreach($actions as $action){
					$nextNode = $this->problema->result($currentNode,$action);
					if(!in_array($nextNode->id,$this->visited)){
						$nextNode->g = $currentNode->g + 1;
						$nextNode->h = $nextNode->g + $this->calculateHeuristic($nextNode,$goals);
						array_push($this->frontier,$nextNode);
						array_push($this->visited,$nextNode->id);
					}
				}
				
				array_push($this->explored,$currentNode);
			}
		}

		return $result;
	}
	
	private function calculateHeuristic($state,$goalStates){
		if($this->heuristicType=="M")
			return $this->calculateManhattan($state,$goalStates);		
	  if($this->heuristicType=="E")
			return $this->calculateEuclidean($state,$goalStates);
	}
	
	private function calculateManhattan($state,$goalStates){
		$goals = array();
		foreach($goalStates as $goal){
			$h = abs($state->x - $goal->x) + abs($state->y - $goal->y);
			array_push($goals,$h);
		}
		return min($goals);
		
	}	
	
	private function calculateEuclidean($state,$goalStates){
		$goals = array();
		foreach($goalStates as $goal){
			$dx = abs($state->x - $goal->x);
			$dy = abs($state->y - $goal->y);
			$h = sqrt($dx*$dx + $dy*$dy);
			array_push($goals,$h);
		}
		
		return min($goals);
		
	}
	
	
	
	
}