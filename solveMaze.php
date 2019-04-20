<?php
require("Problema.php");
require("Algorithm.php");
require_once("Node.php");
	$raw_image = $_FILES["maze"];
	
	$xsize = (int)$_POST["xsize"];
	$ysize = (int)$_POST["ysize"];
	
	$specs = getimagesize($raw_image["tmp_name"]);
	
	$height = (int)$specs[0];
	$width = (int)$specs[1];
	
	if($specs['mime']=="image/png")
		$im = imagecreatefrompng($raw_image["tmp_name"]);
	else
		$im = imagecreatefromjpeg($raw_image["tmp_name"]);
	
	$x_inc = (int) ($height/$xsize)/2;
	$y_inc = (int) ($width/$ysize)/2;
	
	
	$world = array();
	$startState = null;
	$goalStates = array();
	$i = 0;
	
	for($x = $x_inc;$x<$width;$x+=$x_inc*2){
		$j = 0;
		$world[$i] = array();
		
		for($y = $y_inc;$y<$height;$y+=$y_inc*2){
			$rgb = imagecolorat($im, $y, $x);
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
			if($r>180 && $g>180)
				$world[$i][$j] = 1;
			elseif($r>=150 && $g<=100){
				$world[$i][$j] = 2;  //El numero 2 representa color rojo
				if($startState==null)
					$startState = new Node(null,$i,$j);
			}
			elseif($g>=150 && $r<=100){
				$world[$i][$j] = 3;  //El numero 3 representa color verde
				array_push($goalStates, array($i,$j));
			}
			elseif($r<150 && $g<150 && $b<150)
				$world[$i][$j] = 0;  //El 0 representa negro
			else
				$world[$i][$j] = 1; // El 1 representa blanco
			$j++;
			
		}
		$i++;
		
	}
		
		
	if(count($goalStates)==0){
		echo "No se ha definido la meta";
		die();
	}
	if($startState==null){
		echo "No se ha definido el estado de inicio";
		die();
	}
	
	$problema = new Problema($world,$startState);
	
	if($_POST["algorithm"]=="breadth")
		$algoritmo = new Algorithm(new BreadthFirst($problema));
	elseif($_POST["algorithm"]=="depth")
		$algoritmo = new Algorithm(new DepthFirst($problema,"E"));
	elseif($_POST["algorithm"]=="manhattan")
		$algoritmo = new Algorithm(new Astar($problema,"M"));
	elseif($_POST["algorithm"]=="euclidean")
		$algoritmo = new Algorithm(new Astar($problema,"E"));
	
	
	$result = $algoritmo->findPath($goalStates);

	if(count($result)==0)
		echo "No hay solucion para el laberinto";
	else
		foreach($result as $point){
			$world[$point[0]][$point[1]] = 4; //El numero 4 representa color azul
	}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles/styles.css"/>
	<title>Proyecto 1 - IA - Task 1</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<table class="result">
<?php 
for($i=0;$i<count($world);$i++){
	echo "<tr>";
	for($j=0;$j<count($world[$i]);$j++){
		if($world[$i][$j]==0)
			echo "<td class='black'></td>";
		elseif($world[$i][$j]==2)
			echo "<td class='red'></td>";
		elseif($world[$i][$j]==3)
			echo "<td class='green'></td>";
		elseif($world[$i][$j]==4)
			echo "<td class='blue'></td>";
		else
			echo "<td class=''></td>";

	}
	echo "</tr>";
}
?>
</table>
</body>
</html>