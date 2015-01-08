<?php
class AddressDataStore
{
	public $fileName = '';
	public function read_Address_Book(){
				$handle = fopen($this->fileName, 'r');

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
	public function saveFile($addressBook){
	    //open a file that you named
	    $handle = fopen($this->fileName, 'w');
	    //foreach loop to write each new array item
	    foreach ($addressBook as $value) {
	    //write each item into the file name you entered
	       fputcsv($handle, $value);
	    }
	    // echo 'file saved' . PHP_EOL;
	    fclose($handle);
	    	
		}


	
}