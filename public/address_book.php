<?php

include_once 'includes/ClassData.php';

// $addressBook = [
//     ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
//     ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
//     ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901']
// ];
//var_dump($addressBook);
$fileName1 = new AddressDataStore;

$fileName1->fileName = 'address_book.csv';

$addressBook = $fileName1->read_Address_Book();



// function openFile($fileName){
// 			$contents_Array = [];
		
// 		if(filesize($fileName) > 0) {
// 			$handle = fopen($fileName, 'r');
// 			$contents = trim(fread($handle, filesize($fileName)));
// 			//$contents_Array = explode("\n", $contents);
// 			fclose($handle);
// 		}
// 			return $contents_Array;
// 	}

//Check for POST request 
if (!empty($_POST)) {
		
		$addressBook[] = $_POST;
		//saveFile($fileName, $addressBook);
		$fileName1->saveFile($addressBook);
	}	
//add data from form to address book
if(isset($_GET['remove'])) {
	$id = $_GET['remove'];
	unset($addressBook[$id]);
	//saveFile('address_book.csv',$addressBook);
	$fileName1->saveFile($addressBook);
}
		
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Address Book</title>
	</head>
	<body>
		<table>
			<tr>
				<th>Header</th>
				<th>Address</th>
				<th>City</th>
				<th>State</th>
				<th>Zip</th>
			</tr>
			<!-- start working with php, and echoing out the data from $addressBook -->
			
			<?foreach ($addressBook as $key => $entry): ?>
				<tr>
					<?php foreach ($entry as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach ?>
						<td><a href="/address_book.php?remove=<?= $key ?>">X</a></td>
				
				</tr>
			<? endforeach; ?>

		</table>
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
	</body>
</html>