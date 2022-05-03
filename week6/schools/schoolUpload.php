<?php
   include_once __DIR__ . "/model/Schools.php";
   include_once __DIR__ . "/include/function.php";
      
    if (isset ($_FILES['fileToUpload'])) 
    {
        // upload the file to "upload" directory and then call insertSchoolsFromFile 
        //      *** Make sure that the upload directory is writeable!

        $temp_name = $_FILES['fileToUpload']['temp']; //not sure whats supposed to go in 2nd brackets
        $path = getcwd(). DIRECTORY_SEPARATOR. 'upload';
        $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['fileToUpload']['name'];

        move_uploaded_file($temp_name, $new_name);
        echo 'success';

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