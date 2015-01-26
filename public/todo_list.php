<?php


require_once('../inc/filestore.php');


// 	function saveFile($fileName, $array){
    
// }

// 	//function to open a file 
// 	function openfile($fileName){
// 		$contents_Array = [];
		
// 		if(filesize($fileName) > 0) {
// 			$fileName = 'data/list.txt';
// 			$handle = fopen($fileName, 'r');
// 			$contents = trim(fread($handle, filesize($fileName)));
// 			$contents_Array = explode("\n", $contents);
// 			fclose($handle);
// 		}
// 			return $contents_Array;
// 		}
	
	$upload = new Filestore('data/list.txt');
	$todo_array = $upload->read();
	// read('data/list.txt');
	
	var_dump($todo_array);
	
	
	

	if(isset($_POST['todo'])){
			try {
				
				if($_POST['todo'] == ''){
					
					 throw new Exception("Enter in something to do");
					
					
				 } elseif (strlen($_POST['todo']) > 25) {
				 	throw new Exception("To many words");
				 } else  {
					$todo_array[] = htmlentities(strip_tags($_POST['todo']));
					// write('data/list.txt',$todo_array);
					$upload->write($todo_array);
			
					}
			} catch (Exception $e) {
				echo $e;
			}
		

	}



	


	if(isset($_GET['remove'])) {
		$id = $_GET['remove'];
		
		unset($todo_array[$id]);
		// array_values($todo_array);
		$upload->write($todo_array);
	}
	//Verify they're uploaded files and no errors
	if(count($_FILES) > 0 && $_FILES['file1']['error'] == UPLOAD_ERR_OK) {
		
		//destination directory for uploads
		$uploadDir = '/vagrant/sites/planner.dev/public/uploads/';

		//grab the fileName from uplaoded file 
		$fileName = basename($_FILES['file1']['name']);

		// $fileType = substr($fileName, -3);
			// if ($fileType == 'txt') {
				//create saved fileName using the files oringal name and our upload directory
				$savedFileName = $uploadDir . $fileName;
				
				$uploadedFile = 'uploads/' . $fileName;

				//move the file from temp location to our uploads directory
				move_uploaded_file($_FILES['file1']['tmp_name'], $savedFileName);
				//making a new object filestore
				$uploadDoc = new Filestore($uploadedFile);
				//with this new object, i am going to call read method and store that in this var
				$newListItems = $uploadDoc->read();
				//merge array newlistitems and todo array
				$todo_array = array_merge($todo_array, $newListItems);
				//call write method on original object upload
				$upload->write($todo_array);
				
			// } else {

			// 	echo "upload txt files only! " . PHP_EOL;
			// }

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
				
				<form method="POST" enctype="multipart/form-data" action="todo_list.php">
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