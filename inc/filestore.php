<?php


 class Filestore
{
    public $fileName;

    protected $isCSV = TRUE;

    function __construct($fileName)
    {
        // Sets $this->filename
        $this->fileName = $fileName;

        $extension = substr($fileName,-3);

          if ($extension == 'csv') {
               $this->isCSV = TRUE;
          } elseif ($extension == 'txt') {
              $this->isCSV = FALSE;
          }
    }

    /**
     * Returns array of lines in $this->filename
     */
    private function readLines()
    {
        $todo_array = [];

          if(filesize($this->fileName) > 0) {
            $handle = fopen($this->fileName, 'r');
            $contents = trim(fread($handle, filesize($this->fileName)));
            $contentsArray = explode("\n", $contents);
            fclose($handle);
            return $contentsArray;

          }

        return $todo_array;
     }
      
    

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    private function writeLines($array)
    {
         //open a file that you named
      $handle = fopen($this->fileName, 'w');

      //foreach loop to write each new array item
      foreach ($array as $listItem) {
      //write each item into the file name you entered
       
        fwrite($handle, $listItem . PHP_EOL);
      }
      // echo 'file saved' . PHP_EOL;
      fclose($handle);
        
    }
    

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    private function readCSV()
    {
      $handle = fopen($this->fileName, 'r');

      $addressBook = [];

        while(!feof($handle)) {
          
          $row = fgetcsv($handle);
          
          if (!empty($row)) {
            $addressBook[] = $row;
          }
        }
        fclose($handle);
        return $addressBook;
    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    private function writeCSV($array)
    {
                      //Verify they're uploaded files and no errors
//open a file that you named
      $handle = fopen($this->fileName, 'w');
      //foreach loop to write each new array item
      foreach ($array as $value) {
      //write each item into the file name you entered
         fputcsv($handle, $value);
      }
      // echo 'file saved' . PHP_EOL;
      fclose($handle);

  }
    

    public function read(){
      if($this->isCSV){
         return  $this->readCSV();
         
      
      } else {

         return  $this->readLines();
         

      }
    }

    public function write($array){
      if($this->isCSV){
          $this->writeCSV($array);
      } else {
          $this->writeLines($array);
      }
    }
}