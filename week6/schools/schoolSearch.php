<?php

    include_once __DIR__ . "/model/schools.php";
    include_once __DIR__ . "/include/function.php";
   
    $schoolName = "";
    $city = "";
    $state = "";
    $configFile = __DIR__ . '/model/dbconfig.ini';
    try{
        $schoolDatabase = new Schools($configFile);
    }catch(Exception $error){
        echo "<h2>" . $error->getMessage() . "</h2>";
    }
    $schools = [];


    if (isPostRequest()) 
    {
        //*******************************************************************//
        //************     TODO     *****************************************//
        //
        // Create an object to represent the schools table in the database 
        //
        //  Add your search logic here. 
        // 
        // Call getSchools with the appropriate arguments
        //
        //*******************************************************************//

        
        $schoolName = filter_input(INPUT_POST, 'schoolName');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');

        $row = $schoolDatabase->getSchoolCount();
        $schools = $schoolDatabase->getSelectedSchools($schoolName, $city, $state); 

    }
?>

    <h2>Search Schools</h2>
    <form method="post" action="schoolSearch.php">
        <div class="rowContainer">
            <div class="col1">School Name:</div>
            <div class="col2"><input type="text" name="schoolName" value="<?php echo $schoolName; ?>"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">City:</div>
            <div class="col2"><input type="text" name="city" value="<?php echo $city; ?>"></div> 
        </div>
        <div class="rowContainer">
            <div class="col1">State:</div>
            <div class="col2"><input type="text" name="state" value="<?php echo $state; ?>"></div> 
        </div>
            <div class="rowContainer">
            <div class="col1">&nbsp;</div>
            <div class="col2"><input type="submit" name="search" value="Search" class="btn btn-warning"></div> 
        </div>
    </form>


    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>School Name</th>
                <th>City</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody>
            
        <!-- <?php //foreach ($schools as $row): //loop through the patients in the DB and display one by one?>
            <tr>
                <td>
  </form>      

                    <form action='view.php' method = 'post'>
                        <input type='hidden' name='schoolId' value=<?php echo $row['id']; ?>>
                    </form>
                </td>
                <td><?php echo $row['schoolName']; ?></td>
                <td><?php echo $row['schoolCity']; ?></td>
                <td><?php echo $row['schoolState']; ?></td> 
            
            </tr>
        <?php //endforeach; ?> -->

        <?php var_dump( $schools ); ?>
