<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css" />
    <title>Healthy Living Intake</title>
</head>
<body>
<!--NAV BAR -->    
<ul class="nav">
  <li class="nav-item">
    <a class="nav-link" href="main_coursepg.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="https://github.com/meaganmjones/SE266">GitHub Repo</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="learnGit.php">Learn Git</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="hobbies.php">Meagan's Hobbies</a>
  </li>

</ul>

<h1>Patient Intake</h1>

<!--START OF PHP JUNK -->
    <?php
        //validate name fields for a string
        // function isValidName($name){
        //     $valid = false;
        //     if(is_string($name) == 1){
        //         $valid = true;
        //     }else{
        //         $valid = false;
        //     }
        //     return ($valid);
        // }

        //use height and weight to calculate BMI
        function calc_BMI($feet, $inch, $weight){
            $meter = ($feet * 12 + $inch) * 0.0254;
            $kg = ($weight / 2.20462);
            $bmi = ($kg / ($meter * $meter));

            return ($bmi);
        }

        function bmi_sort($bmi){
            if($bmi < 18.5){
                $group = "underweight";
            }elseif($bmi > 18.5 and $bmi < 24.9){
                $group = "normal weight";
            }elseif($bmi > 25 and $bmi < 29.9){
                $group = "overweight";
            }else{
                $group = "obese";
            }
            return ($group);
        }

        function isValidDate($dob){
            $date = explode('-', $dob);
            return checkdate($date[1], $date[2], $date[0]);
        }

        function age($dob){
            $date = new DateTime($dob);
            $now = new DateTime();
            $age = $now->diff($date);
            return $age->y;
        }

        function display($first, $last, $status, $age, $bmi){
            echo "Name: " . "$first" . " " . "$last" . ", ";
            echo "Age: " . "$age" . ", ";
            echo "$status" . ", ";

            $round_BMI = round($bmi, 1);
            echo "BMI: " . "$round_BMI" . ", ";

            $group = bmi_sort($bmi);

            echo "(" . "$group" . ")";
        }

//************* END OF FUNCTION FACTORY ***************** */

//############# START OF FORM VALIDATION / PRINTING ############
        //initialize variables
        $firstName = "";
        $lastName = "";
        $status = "";
        $dob = "";
        $feet = 0;
        $inch = 0;
        $weight = 0;

        //this occurs when submit button is pressed
        if (isset($_POST['submit_btn'])){
            //reassign variables to their coressponding form field input
            $firstName = filter_input(INPUT_POST, 'fName');
            $lastName = filter_input(INPUT_POST, 'lName');
            $status = filter_input(INPUT_POST, 'status');
            $dob = filter_input(INPUT_POST, 'dob');
            $feet = filter_input(INPUT_POST, 'feet');
            $inch = filter_input(INPUT_POST, 'inches');
            $weight = filter_input(INPUT_POST, 'weight');

            //if first/last name is empty:
            if ($firstName == "" or $lastName == ""){
                //display error
                echo "ERROR: first/last name required /";
            }else{
                //otherwise print the name
                //echo "$firstName" . " " . "$lastName" . " /";
            }

            //if marital status is empty:
            if ($status == ""){
                //display error
                echo "ERROR: marital status is required /";
            }else{
                //otherwise print the status
                //echo "$status" . " /";
            }

            //if date of birth is empty:
            if ($dob == ""){
                //display error
                echo "ERROR: dob is required /";
            }else{
                //otherwise print dob
                //echo "$dob". " /";
            }

            //if date of birth IS valid:
            if (isValidDate($dob)){
                //display nothing right now
                //echo "ERROR: Enter valid date of birth /";
            }else{
                //otherwise display error
                echo "ERROR: Invalid date of birth";
            }

            //if they're suspiciously short/tall:
            if ($feet < 3 or $feet > 7 or $inch > 11){
                //display error
                echo "ERROR: enter valid feet /";
            }else{
                //otherwise display feet
                //echo "$feet". " " . "$inch";
            }

            //if they're waaay too heavy:
            if ($weight > 750){
                //display error
                echo "ERROR: invalid weight";
            }else{
                //otherwise show weight
                //echo "$weight";
            }

            $bmi = calc_BMI($feet, $inch, $weight);

            $age = age($dob);
            

            echo display($firstName, $lastName, $status, $age, $bmi);
           // echo 'Form Submitted';
            //var_dump ($_POST);
        }else{
            echo "Welcome";
        }
    ?>
<!--END OF PHP JUNK-->

<!--Patient Intake Form-->
    
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
                <input type="text" name="feet" value="" style="width: 25px"  /><span>feet</span>
                <input type="text" name="inches" value="" style="width: 25px" /><span>inches</span>
            </div>
            <div>
                <label>Weight:</label>
                <input type="text" name="weight" value="" style="width: 45px" /><span>pounds</span>
            </div>
            <div>
                <input type="submit" name="submit_btn" value="submit" />
            </div>




</body>
</html>