
<?php
include_once "checking.php";
include_once "savings.php";
include_once "account.php";

//initialize variables

        //grabbing the info from the form
        //savings
        
        $saving_ID =  filter_input(INPUT_POST, 'savingsAccountId');
        $saving_bal = filter_input(INPUT_POST, 'savingsBalance');
        $saving_date = filter_input(INPUT_POST, 'savingsDate');
        $saving_withdraw = filter_input(INPUT_POST, 'savingsWithdrawAmount');
        $saving_deposit = filter_input(INPUT_POST, 'savingsDepositAmount');
        $savings = new SavingsAccount($saving_ID, $saving_bal, $saving_date);
        //checking
        
        $checking_ID = filter_input(INPUT_POST, 'checkingAccountId');
        $checking_bal = filter_input(INPUT_POST, 'checkingBalance');
        $checking_date = filter_input(INPUT_POST, 'checkingDate');
        $checking_withdraw = filter_input(INPUT_POST, 'checkingWithdrawAmount');
        $checking_deposit = filter_input(INPUT_POST, 'checkingDepositAmount');
        $checking = new CheckingAccount($checking_ID, $checking_bal, $checking_date);

//when buttons get pressed do this:
    if (isset ($_POST['withdrawChecking'])) 
    {
        
        if($checking->withdrawal($checking_withdraw)){
            $checking = new CheckingAccount($checking_ID, ($checking_bal - $checking_withdraw), $checking_date);
            echo $checking->getAccountDetails();
        }else{
            echo 'insufficient funds';
        }
     
    } 
    else if (isset ($_POST['depositChecking'])) 
    {
        $checking->deposit($checking_deposit);
        echo $checking->getAccountDetails();
    } 
    else if (isset ($_POST['withdrawSavings'])) 
    {

        //calling withdrawal function THIS AINT WORKING THO!!!!!!!!
        if($savings->withdrawal($saving_withdraw)){
     
            //$saving_bal = $saving_bal - $saving_withdraw;
            $savings = new SavingsAccount($saving_ID, ($saving_bal - $saving_withdraw), $saving_date);
            echo $savings->getAccountDetails();
            
        }else{
            echo 'insufficient funds';
        }


            

    } 
    else if (isset ($_POST['depositSavings'])) 
    {
        $savings->deposit($saving_deposit);
        echo $savings->getAccountDetails();
    } 
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
    <style type="text/css">
        body {
            margin-left: 120px;
            margin-top: 50px;
        }
       .wrapper {
            display: grid;
            grid-template-columns: 300px 300px;
        }
        .account {
            border: 1px solid black;
            padding: 10px;
        }
        .label {
            text-align: right;
            padding-right: 10px;
            margin-bottom: 5px;
        }
        label {
           font-weight: bold;
        }
        input[type=text] {width: 80px;}
        .error {color: red;}
        .accountInner {
            margin-left:10px;margin-top:10px;
        }
    </style>
</head>
<body>

    <form method="post">
       
       
        
        

        
    <h1>ATM</h1>
        <div class="wrapper">
            
            <div class="account">
              
                    
                    <div class="accountInner">
                        <h3>Checking</h3>
                        <input type="hidden" name="checkingAccountId" value="C123" />
                        <input type="hidden" name="checkingDate" value="12-20-2019" />
                        <input type="hidden" name="checkingBalance" value="1000" />

                        <input type="text" name="checkingWithdrawAmount" value="" />
                        <input type="submit" name="withdrawChecking" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="text" name="checkingDepositAmount" value="" />
                        <input type="submit" name="depositChecking" value="Deposit" /><br />
                    </div>
            
            </div>

            <div class="account">
               
                    
                    <div class="accountInner">
                    <h3>Savings</h3>
                    <input type="hidden" name="savingsAccountId" value="S123" />
                    <input type="hidden" name="savingsDate" value="03-20-2020" />
                    <input type="hidden" name="savingsBalance" value="5000" />
                    <input type="text" name="savingsWithdrawAmount" value="" />
                    <input type="submit" name="withdrawSavings" value="Withdraw" />
                    </div>
                    <div class="accountInner">
                        <input type="text" name="savingsDepositAmount" value="" />
                        <input type="submit" name="depositSavings" value="Deposit" /><br />
                    </div>
            
            </div>
            
        </div>
    </form>
</body>
</html>
