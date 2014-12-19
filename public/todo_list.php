<?php
	$todo_array = [];

	function saveFile($fileName, $array){
    //open a file that you named
    $handle = fopen($fileName, 'w');
    //foreach loop to write each new array item
    foreach ($array as $listItem) {
    //write each item into the file name you entered
       fwrite($handle, $listItem . PHP_EOL);
    }
    echo 'file saved' . PHP_EOL;
    fclose($handle);
}

	//function to open a file 
	function openfile($filename){
		$filename = 'data/list.txt';
		$handle = fopen($filename, 'r');
		$contents = trim(fread($handle, filesize($filename)));
		$contents_Array = explode("\n", $contents);
		fclose($handle);
		
			return $contents_Array;
		}
	
	$todo_array = openfile('data/list.txt');
		
	if(isset($_POST['todo'])){
			$todo_array[] = $_POST['todo'];
			$saveArray = saveFile('data/list.txt',$todo_array);
			}
	?>
<!DOCTYPE html>
	<html>
		<head>
			<title>TODO List</title>
			<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" type="text/css" href="style.css">
			
		</head>
		<body>

			<header>
				<h1 class="title">THE - TODO - LIST</h1>
			</header>
				<div class="list">
				<h2>For Today</h2>
					<ul>
						
						<?php 
						foreach ($todo_array as $key => $value){
							echo "<li>$value</li>";
							}
						
						?>
					</ul>
				</div>
				<div class="form">
					<form method="Post" action="/todo_list.php">
						<p>
						<textarea id="newItem" name="todo" rows="10" cols="40"></textarea>
					</p>
					<button type="Submit"  name="Submit" value="Submit">Submit</button>
				</div>
				
				</form>
		</body>
	</html>