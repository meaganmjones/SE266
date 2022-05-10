<?php
   include_once __DIR__ . "/model/Schools.php";
   include_once __DIR__ . "/include/function.php";
      

   $configFile = __DIR__ . '/model/dbconfig.ini';
   try{
       $schoolDatabase = new Schools($configFile);
   }catch(Exception $error){
       echo "<h2>" . $error->getMessage() . "</h2>";
   }

   define("UPLOAD_DIRECTORY", "upload");

    if (isset ($_FILES['fileToUpload'])) 
    {
        // upload the file to "upload" directory and then call insertSchoolsFromFile 
        //      *** Make sure that the upload directory is writeable!

        $path = getcwd(). DIRECTORY_SEPARATOR . UPLOAD_DIRECTORY;
        $tmp_name = $_FILES['fileToUpload']['tmp_name']; 
        $target_file = $path . DIRECTORY_SEPARATOR . $_FILES['fileToUpload']['name'];

        move_uploaded_file($tmp_name, $target_file);
        echo $target_file;

        $insertSchool = $schoolDatabase->insertSchoolsFromFile($target_file);

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