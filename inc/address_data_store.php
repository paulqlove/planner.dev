 <?php

 // TODO: require Filestore class
 require_once('../inc/filestore.php');

 class AddressDataStore extends Filestore
 {
    function __construct($fileName)
      {
        parent:: __construct(strtolower($fileName));
       
      }

     
 }