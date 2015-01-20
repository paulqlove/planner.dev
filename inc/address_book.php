<?php

include_once 'inc/address_data_store.php';

class AddressDataStore {


$AddressDataStore1 = new AddressDataStore;

$AddressDataStore1->fileName = 'address_book.csv';

$addressBook = $AddressDataStore1->read_Address_Book();


//Check for POST request 
if (!empty($_POST)) {
		
		$addressBook[] = $_POST;
		//saveFile($fileName, $addressBook);
		$AddressDataStore1->saveFile($addressBook);

	}	
//add data from form to address book
if(isset($_GET['remove'])) {
	$id = $_GET['remove'];
	unset($addressBook[$id]);
	//saveFile('address_book.csv',$addressBook);
	$AddressDataStore1->saveFile($addressBook);
}
	
	
	// //Verify they're uploaded files and no errors
	// if(count($_FILES) > 0 && $_FILES['file1']['error'] == UPLOAD_ERR_OK) {
		
	// 	//destination directory for uploads
	// 	$uploadDir = '/vagrant/sites/planner.dev/public/uploads/';

	// 	//grab the fileName from uplaoded file 
	// 	$uploadfile = basename($_FILES['file1']['name']);
		
	// 	$savedFileName = $uploadDir . $uploadfile;

	// 	$uploadedAddressData = new AddressDataStore($savedFileName);
		

	// 	if(substr($savedFileName, -3) == 'csv') {
			
	// 			//move the file from temp location to our uploads directory
	// 			move_uploaded_file($_FILES['file1']['tmp_name'], $savedFileName);
	// 			//create saved fileName using the files oringal name and our upload directory
	// 			$read = $uploadedAddressData->read_Address_Book();
	// 			$addressBook = array_merge($addressBook, $read);
	// 			//var_dump($addressBook);
	// 			$AddressDataStore1->saveFile($addressBook);
				

	// 		} else {

	// 			echo "upload csv files only! " . PHP_EOL;
	// 		}

	// }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
		<title>Address Book</title>
	</head>
	<body>
			<table >
				<nav class="navbar navbar-default">
					<th class="col-md-2">Header</th> 
					<th class="col-md-2">Address</th>
					<th class="col-md-2">City</th>
					<th class="col-md-2">State</th>
					<th class="col-md-2">Zip</th>
				</nav>
			</table>
				<!-- start working with php, and echoing out the data from $addressBook -->
			<table>
				<?foreach ($addressBook as $key => $entry): ?>
					<tr>
						<?php foreach ($entry as $value): ?>
							<td><?= $value ?></td>
						<?php endforeach ?>
							<td><a href="/address_book.php?remove=<?= $key ?>">X</a></td>
					
					</tr>
				<? endforeach; ?>

			</table>
		<div class="container">
		<form method="Post" action="/address_book.php">
			<div>
				<input name="header" type="text" placeholder="header">
				<input name="Address" type="text" placeholder="Address">
				<input name="City" type="text" placeholder="City">
				<input name="State" type="text" placeholder="State">
				<input name="Zip" type="text" placeholder="Zipcode">

				<button  type="Submit" value="Submit">Submit</button>
			</div>
		</form>
			<div>
				<h1>UPLOAD FILE</h1>
				<form method="POST" enctype="multipart/form-data" action="/address_book.php">
					<p>
						<label for="file1">File to upload: </label>
						<input type="file" id="file1" name="file1">
					</p>
					<p>
						<input type="submit" value="Upload">
					</p>
				</form>
			</div>
		</div>
		<!--container-->
	</body>
</html>