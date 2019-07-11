<?PHP
include_once("config.php");

      // define a constant for the maximum upload size
      define ('MAX_FILE_SIZE', 10500000);
      $file  = $_FILES['image'];
      $fileName = $_FILES['image']['name'];
      $fileTmpName = $_FILES['image']['tmp_name'];
      $fileSize = $_FILES['image']['size'];
      $fileError = $_FILES['image']['error'];
      $fileType = $_FILES['image']['type'];

      $fileExt         =  explode('.',$fileName);
      $fileActualExt   = strtolower(end($fileExt));
      //$allowed = array('jpg','jpeg','png',);
      $allowed = array('jpg');
     // date(format,[timestamp]);
      date_default_timezone_set("Africa/Dar_es_Salaam");
       echo  date("H:i:s")."<br>";
       echo   date("Y-m-d");; 

     $userId=$_POST['userId']; 
     $time =Date("H:i:s"); 
     $date =date("Y-m-d");; 
     echo  $fileError;

                   if(in_array($fileActualExt,$allowed )){
                          if($fileSize < 10500000){

                              
                              $fileNameNew =  $userId.".".$fileActualExt;
                              //C:/uploadedFiles/'.$fileNameNew; 

                              $fileDestination = 'uploadedFiles/'.$fileNameNew;


                              move_uploaded_file($fileTmpName,$fileDestination);

                              //insert the name into the db.

                              $insert_img = "INSERT INTO image (userId,name,date,time) VALUES ('$userId','$fileDestination',' $date','$time')";

                              if ($conn->query($insert_img) === TRUE) {
                                  echo 'file uploaded to '.$fileDestination;

                              }else{
                                  echo 'error writing to database';
                              }





                          }else{
                              echo 'the image you are uploading is too big, please upload a file less than 10 MB';
                          }
                  }else{
                      echo 'only image file type of jpg,png and jpeg are allowed';
                  }
              
    mysqli_close($conn);
 
?>
