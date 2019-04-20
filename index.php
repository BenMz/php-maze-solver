<!--Benito Maza 11088-->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/styles.css"/>
<title>Proyecto 1 - IA - Task 1</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

<div class="wrapper">

<form class="formulario" method="post" enctype="multipart/form-data" action="solveMaze.php">
	<label for="maze">Suba laberinto a resolver</label>
		<div>
			<input  type="file" name="maze"  accept="image/*" capture/>
		</div>
		<br>
	<label for="xsize">X: </label>
		<input type="text" name="xsize" id=""/>
		<br>	
	<label for="ysize">Y: </label>
		<input type="text" name="ysize" id=""/>
		<br>
		<label for="ysize">Algoritmo: </label>
	<select name="algorithm">
		<option value="breadth">Breadth-First</option>
		<option value="depth">Depth-First</option>
		<option value="manhattan">A*(Manhattan)</option>
		<option value="euclidean">A*(Euclidean)</option>
	</select>
	
		
	<input type="submit" value="Resolver"/>
</form>
</div>
</body>
</html>