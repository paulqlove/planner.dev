<?php

$addressBook = [
    ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
    ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
    ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901']
];

$handle = fopen('address_book.csv', 'w');

foreach ($addressBook as $row) {
    fputcsv($handle, $row);

}

fclose($handle);

//Check for POST request 


		//add data from form to address book


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
			
			<?foreach ($addressBook as $entry): ?>
				<tr>
					<?php foreach ($entry as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach ?>
				
				</tr>
			<? endforeach; ?>

		</table>
		<form>
			<div>
				<input name="header" type="text" placeholder="header">
				<input name="Address" type="text" placeholder="Address">
				<input name="City" type="text" placeholder="City">
				<input name="State" type="text" placeholder="State">
				<input name="Zip" type="text" placeholder="Zipcode">

				<button name="Submit" type="Submit" value="Submit">Submit</button>
			</div>
		</form>
	</body>
</html>