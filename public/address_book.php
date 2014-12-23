<?php

// $addressBook = [
//     ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
//     ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
//     ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901']
// ];
//var_dump($addressBook);
$fileName = 'address_book.csv';


function saveFile($fileName, $array){
    //open a file that you named
    $handle = fopen($fileName, 'w');
    //foreach loop to write each new array item
    foreach ($array as $value) {
    //write each item into the file name you entered
       fputcsv($handle, $value);
    }
    // echo 'file saved' . PHP_EOL;
    fclose($handle);
    	
	}

function read_Address_Book($fileName){
			$handle = fopen($fileName, 'r');

			$addressBook = [];

			while(!feof($handle)) {
				
				$row = fgetcsv($handle);
				
				if (!empty($row)) {
					$addressBook[] = $row;
				}
			}
			return $addressBook;
		fclose($handle);
	
	}

$addressBook = read_Address_Book($fileName);

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
		saveFile($fileName, $addressBook);
	}	
//add data from form to address book
if(isset($_GET)) {
	$id = $_GET['remove'];
	unset($addressBook[$id]);
	saveFile('address_book.csv',$addressBook);
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