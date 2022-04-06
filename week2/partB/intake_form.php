<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy Living Intake</title>
</head>
<body>
    <h1>ADD THE NAV PLS</h1>


    <?php
        //validate name fields for a string
        function isValidName($name){
            $valid = false;
            if(is_string($name) == 1){
                $valid = true;
            }else{
                $valid = false;
            }
            return ($valid);
        }

        //use height and weight to calculate BMI
        function calc_BMI($feet, $inch, $weight){
            $meter = ($feet * 12 + $inch) * 0.0254;
            return ($meter);
        }

        $firstName = "";
        $lastName = "";

        if (isset($_POST['submit_btn'])){
            $firstName = filter_input(INPUT_POST, "fName");
            $lastName = filter_input(INPUT_POST, 'lName');

            if ($firstName == "" or $lastName == ""){
                echo "ERROR: first/last name required";
            }else{
                echo "$firstName" . " " . "$lastName";
            }
           // echo 'Form Submitted';
            //var_dump ($_POST);
        }else{
            //echo "$firstName";
        }
    ?>

<!--Patient Intake Form-->
    <h1>Patient Intake</h1>
    <form name="patient_form" method="post" action="intake_form.php">

        <div class="container">
            <div class="label">
                <label>First Name:</label>
                <input type="text" name="fName" value="" />
            </div>
            <div>
                <label>Last Name:</label>
                <input type="text" name="lName" value="" />
            </div>
            <div>
                <label>Marital Status:</label>
                <input type="radio" name="status" value="Not Married"/>Not Married
                <input type="radio" name="status" value="Married"/>Married
            </div>
            <div>
                <label>Date of Birth:</label>
                <input type="date" name="dob" value="" />
            </div>
            <div>
                <label>Height:</label>
                <input type="text" name="feet" value="" />
                <input type="text" name="inches" value="" />
            </div>
            <div>
                <label>Weight:</label>
                <input type="text" name="weight" value="" />
            </div>
            <div>
                <input type="submit" name="submit_btn" value="submit" />
            </div>




</body>
</html>