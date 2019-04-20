<?php
require_once("GraphSearch.php");
class DepthFirst extends GraphSearch{

	
	public function calculate($goalStates){
		$worldSize = count($this->problema->world)*count($this->problema->world[0]);
		
		$goals = array();
		foreach($goalStates as $goal){
			array_push($goals,new Node(null,$goal[0],$goal[1]));
		}
		
		$result = array();
		
		while(count($this->frontier)>0){
			$max = -1;
			$min = -1;
			for($i = 0;$i<count($this->frontier);$i++){
				if($this->frontier[$i]->g > $max){
					$max = $this->frontier[$i]->g;
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
						array_push($this->frontier,$nextNode);
						array_push($this->visited,$nextNode->id);
					}
				}
				
				array_push($this->explored,$currentNode);
			}
		}

		return $result;
	}

	
	
}