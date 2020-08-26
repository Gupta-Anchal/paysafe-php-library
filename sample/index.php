<?php

		$db = mysqli_connect('localhost', 'root', 'anchal', 'neteller'); 

		require_once('config.php');
		require_once('../source/paysafe-neteller-api.php');

		use Neteller\PaymentHandle;
		use Neteller\Link;
		use Neteller\Neteller;
		use Neteller\BillingDetails;

?>

				<?php if(isset($_POST['deposit'])){ 

                $amount = mysqli_real_escape_string($db, $_POST['amount']);
                $gateway = $_POST['gateway'];
                $username = "test" ;
                $user_id = "1" ;
                $email = "test@gmail.com";
                $mode = "Deposit";
                $transaction_id = date("Ymdhis");
                $query = "INSERT INTO payment_info (username, user_id, amount, payment_gateway, mode, transaction_id) 
                VALUES('$username', '$user_id', '$amount', '$mode', '$gateway', '$transaction_id')"; 
                mysqli_query($db, $query); 
            }

            ?>

            <?php if(isset($_POST['withdraw'])){ 

                $amount = mysqli_real_escape_string($db, $_POST['amount']);
                $gateway = $_POST['gateway'];
                $username = "test" ;
                $user_id = "1" ;
                $email = "test@gmail.com";
                $mode = "Withdraw";
                $transaction_id = date("Ymdhis");
                $query = "INSERT INTO payment_info (username, user_id, amount, payment_gateway, mode, transaction_id) 
                VALUES('$username', '$user_id', '$amount', '$mode', '$gateway', '$transaction_id')"; 
                mysqli_query($db, $query); 
            } ?>

			<!DOCTYPE html> 
			<html> 
			<head> 
			     <script src="https://hosted.test.paysafe.com/checkout/v2/paysafe.checkout.min.js"></script>
			    <title>Payment</title> 
			    <link rel="stylesheet" type="text/css"
			                    href="style.css"> 
			</head> 
			<body> 
			    <div class="header"> 
			        <h2>Payment Info</h2> 
			    </div> 
			    <form action="" method="POST">

			<div class="input-group"> <strong>Enter Amount</strong>
            <input type="text" name="amount" min="1" max="10000"
                value="<?php echo @$amount; ?>">
            </div>
            <div class="input-group"><strong><label for="gateway">Payment Gateway : </label></strong>
                <select name="gateway" style="width: 100%; height: 40px;">
                    <option value="Netller">Netller</option>
                </select>
            </div> <br> <br>
            <span class="input-group" style="float: right; margin-top: -30px;"> 
            <button type="submit" class="btn"
                                name="withdraw" value="withdraw"> 
                Withdraw 
            </button> 
            </span>
            <span class="input-group" style="float: right; margin-top: -30px;"> 
            <button type="submit" class="btn"
                                name="deposit" value="deposit">
                Deposit 
            </button> 
            </span>

            </form> 

            <?php if(isset($_POST['deposit'])) {  ?>

            	<?php

					$paymentHandle = new PaymentHandle;

					$paymentHandle->paymentType = "NETELLER";
					//this should contain your unuique transaction ID
					$paymentHandle->merchantRefNum =  $transaction_id;
					//change this to your transaction currency
					$paymentHandle->currencyCode = "USD";
					//change this to the desired deposit amount
					$paymentHandle->amount = ($amount * 100);

					$defaultLink = new Link;
					$defaultLink->rel = "default";
					$defaultLink->href = "http://localhost/netlr/paysafe-php-library/sample/lookup-payment-handle-by-merchantRefNum.php?merchantRefNum=".$paymentHandle->merchantRefNum;

					$paymentHandle->returnLinks = $defaultLink;

					$paymentHandle->transactionType = "PAYMENT";

					$neteller = new Neteller;
					//change this to the email of the customer
					$neteller->consumerId = "netellertest_USD@neteller.com";

					$paymentHandle->neteller = $neteller;
					//and the below to the country of the customer
					$billingDetails = new BillingDetails;
					$billingDetails->country = "GB";
					$paymentHandle->billingDetails = $billingDetails;

					try{
					    $paymentHandle->create($netellerApiKey, $netellerApiUrl);
					    
					    print "Redirect URL: " . $paymentHandle->links[0]->href. "<br />";
					    header("Location: ". $paymentHandle->links[0]->href);
					    print "Payment Handle ID: " . $paymentHandle->id . "<br />";
					    print "PaymentHandleToken: " . $paymentHandle->paymentHandleToken;
					    /* Do something with the data here */

					}catch(NetellerException $e){
					    print $e->getMessage(); //handle the exception
					}

					?>

           		<?php } ?>

           		<?php if(isset($_POST['withdraw'])) {  ?>

           		<?php

					$paymentHandle = new PaymentHandle;

					$paymentHandle->paymentType = "NETELLER";
					//this should contain your unique transaction ID
					$paymentHandle->merchantRefNum =  $transaction_id;
					//change this to your transaction currency
					$paymentHandle->currencyCode = "USD";
					//change this to the desired payout (withdrawal) amount
					$paymentHandle->amount = ($amount * 100);

					$paymentHandle->transactionType = "STANDALONE_CREDIT";

					$neteller = new Neteller;
					//change this to the email of the recipient
					$neteller->consumerId = "netellertest_USD@neteller.com";

					$paymentHandle->neteller = $neteller;

					try{
					    $paymentHandle->create($netellerApiKey, $netellerApiUrl);

					    print "Payment Handle ID: " . $paymentHandle->id . "<br />";
					    print "PaymentHandleToken: " . $paymentHandle->paymentHandleToken . "<br />";
					    print $paymentHandle->merchantRefNum;
					    header("Location: http://localhost/netlr/paysafe-php-library/sample/create-standalone-credit.php?merchantRefNum=".$paymentHandle->merchantRefNum."&PaymentHandleToken=".$paymentHandle->paymentHandleToken);
					    //echo "<pre>";print_r ($paymentHandle);
					    //header("Location: http://localhost/paysafe-php-library/sample/create-standalone-credit.php?PaymentHandleToken=".$paymentHandle->paymentHandleToken);
					    //echo "<pre>";print_r ($paymentHandle);
					    /* Do something with the data here */

					}catch(NetellerException $e){
					    print $e->getMessage(); //handle the exception
					}

					?>

				<?php } ?>
</body> 
</html>



