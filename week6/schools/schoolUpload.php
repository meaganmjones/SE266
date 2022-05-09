<?php
   include_once __DIR__ . "/model/Schools.php";
   include_once __DIR__ . "/include/function.php";
      

   $configFile = __DIR__ . '/model/dbconfig.ini';
   try{
       $schoolDatabase = new Schools($configFile);
   }catch(Exception $error){
       echo "<h2>" . $error->getMessage() . "</h2>";
   }


    if (isset ($_FILES['fileToUpload'])) 
    {
        // upload the file to "upload" directory and then call insertSchoolsFromFile 
        //      *** Make sure that the upload directory is writeable!

        $temp_name = $_FILES['fileToUpload']['tmp_name']; //not sure whats supposed to go in 2nd brackets
        $path = getcwd(). DIRECTORY_SEPARATOR. 'upload';
        $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['fileToUpload']['name'];

        $file = move_uploaded_file($temp_name, $new_name);
        //echo 'success';


        if(!file_exists("upload/schools.csv")){
            echo 'File does not exist';
            exit;
        }
        
        $file = fopen('upload/schools.csv', 'rb');

        $getschool = $schoolDatabase->insertSchoolsFromFile($file);
        //$i = 0;
        var_dump($getschool);

        // while(!feof($file) && $i<10){
        //     $school =  $schoolDatabase->insertSchoolsFromFile($file);
        //     $i++;
        //     //echo ($school[1]) . "<br />";
        // }
    }

?>  
    <h2>Upload File</h2>
    <p>
        Please specify a file to upload and then be patient as the upload may take a while to process.
    </p>
<!--CURRENTLY THIS STAYS ON SAME PAGE. switch back to action="schoolSearch.php" after testing!!!!!!!-->
    <form action="schoolUpload.php" method="post" enctype="multipart/form-data">

        <input type="file" name="fileToUpload">
        <input type="submit" value="Upload">

    </form>    