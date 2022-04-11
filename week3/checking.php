<?php
 
 	include "account.php";
   // include "atm_starter.php";
    ini_set('memory_limit', '1024M');
    class CheckingAccount extends Account 
    {
        const OVERDRAW_LIMIT = -200;
        protected $checking_ID;
        protected $checking_bal;
        protected $date;

        public function __construct ($id, $bal, $dt) 
        {
           $this->checking_ID = $id;
           $this->checking_bal = $bal;
           $this->date = $startDt;

           parent::__construct($id,$bal,$dt);
        } // end constructor


        public function withdrawal($amount) 
        {

            if($amount <= ($checking_bal - 200)){
                return True;
            }else{
                return False;
            }
        } // end withdrawal

        //freebie. I am giving you this code.
        public function getAccountDetails() 
        {
            $accountDetails = "<h2>Checking Account</h2>";
            $accountDetails = parent::getAccountDetails();
            
            return $accountDetails;
        }
    }

    //************************************************************* */

// The code below runs everytime this class loads and 
// should be commented out after testing.
    
    $checking = new CheckingAccount ('C123', 1000, '12-20-2019');
    $checking->withdrawal(200);
    $checking->deposit(500);
    
    echo $checking->getAccountDetails();
    echo $checking->getStartDate();
    
?>
