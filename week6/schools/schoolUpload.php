<?php
   include_once __DIR__ . "/model/schools.php";
   include_once __DIR__ . "/include/function.php";
      
   if (!isUserLoggedIn())
   {
       //redirect to the login page
       header ('Location: login.php');
   }

   $configFile = __DIR__ . '/model/dbconfig.ini';
   try{
       $schoolDatabase = new Schools($configFile);
   }catch(Exception $error){
       echo "<h2>" . $error->getMessage() . "</h2>";
   }

   define("UPLOAD_DIRECTORY", "upload");

    if (isset ($_FILES['fileToUpload'])) 
    {

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

    <form action="schoolUpload.php" method="post" enctype="multipart/form-data">

        <input type="file" name="fileToUpload">
        <input type="submit" value="Upload">

    </form>    

    <?php 
        if (isset ($_FILES['fileToUpload'])) {
            echo "File uploaded";
            header('Location: ./schoolSearch.php');
        }
    ?>