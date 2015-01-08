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
    // echo 'file saved' . PHP_EOL;
    fclose($handle);
}

	//function to open a file 
	function openfile($fileName){
		$contents_Array = [];
		
		if(filesize($fileName) > 0) {
			$fileName = 'data/list.txt';
			$handle = fopen($fileName, 'r');
			$contents = trim(fread($handle, filesize($fileName)));
			$contents_Array = explode("\n", $contents);
			fclose($handle);
		}
			return $contents_Array;
		}
	
	$todo_array = openfile('data/list.txt');
		
	if(isset($_POST['todo'])){
			$todo_array[] = htmlentities(strip_tags($_POST['todo']));
			saveFile('data/list.txt',$todo_array);
	
	
			}

	if(isset($_GET['remove'])) {
		$id = $_GET['remove'];
		unset($todo_array[$id]);
		saveFile('data/list.txt',$todo_array);
	}
	//Verify they're uploaded files and no errors
	if(count($_FILES) > 0 && $_FILES['file1']['error'] == UPLOAD_ERR_OK) {
		
		//destination directory for uploads
		$uploadDir = '/vagrant/sites/planner.dev/public/uploads/';

		//grab the fileName from uplaoded file 
		$fileName = basename($_FILES['file1']['name']);

		$fileType = substr($fileName, -3);
			if ($fileType == 'txt') {
				//create saved fileName using the files oringal name and our upload directory
				$savedFileName = $uploadDir . $fileName;
				
				//move the file from temp location to our uploads directory
				move_uploaded_file($_FILES['file1']['tmp_name'], $savedFileName);
				
			} else {

				echo "upload txt files only! " . PHP_EOL;
			}

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
						
						

						<? foreach($todo_array as $key => $value): ?>
							<li><?= $value; ?> | <a href="/todo_list.php?remove=<?= $key ?>">X</a></li>
						<? endforeach; ?>
						
						
					</ul>
				<h2>Upload File</h2>

					<!--check if file saved-->
				
				<?	if (isset($savedFileName)): ?>
						<!--if we did, show a link to the uploaded file-->
						<?=  "<p>You can download your file <a href='/uploads/{$fileName}'>here</a>.</p>"; ?>
					<? endif; ?>
				
				<form method="POST" enctype="multipart/form-data" >
					<p>
						<label for="file1">File to Upload:</label>
						<input type="file" id="file1" name="file1">
					</p>
					<p>
						<input type="submit" value="Upload">
					</p>


				</form>
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