 <?php

 // TODO: require Filestore class
 require_once 'filestore.php';

 class AddressDataStore extends Filestore
 {
    

     function readAddressBook()
     {
         // TODO: refactor to use new $this->readCSV() method
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

     function writeAddressBook($addressesArray)
     {
         // TODO: refactor to use new writeCSV() method
                //Verify they're uploaded files and no errors
  if(count($_FILES) > 0 && $_FILES['file1']['error'] == UPLOAD_ERR_OK) {
    
    //destination directory for uploads
    $uploadDir = '/vagrant/sites/planner.dev/public/uploads/';

    //grab the fileName from uplaoded file 
    $uploadfile = basename($_FILES['file1']['name']);
    
    $savedFileName = $uploadDir . $uploadfile;

    $uploadedAddressData = new AddressDataStore($savedFileName);
    

    if(substr($savedFileName, -3) == 'csv') {
      
        //move the file from temp location to our uploads directory
        move_uploaded_file($_FILES['file1']['tmp_name'], $savedFileName);
        //create saved fileName using the files oringal name and our upload directory
        $read = $uploadedAddressData->read_Address_Book();
        $addressBook = array_merge($addressBook, $read);
        //var_dump($addressBook);
        $AddressDataStore1->saveFile($addressBook);
        

      } else {

        echo "upload csv files only! " . PHP_EOL;
      }

  }
     }
 }