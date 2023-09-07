<?php
date_default_timezone_set('Asia/Kolkata');
header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

	// $buyerEmail = trim($_POST['buyerEmail']);
	// $buyerPhone = trim($_POST['buyerPhone']);
	// $buyerFirstName = trim($_POST['buyerFirstName']);
	// $buyerLastName = trim($_POST['buyerLastName']);
	// $buyerAddress = trim($_POST['buyerAddress']);
	// $amount = trim($_POST['amount']);
	// $buyerCity = trim($_POST['buyerCity']);
	// $buyerState = trim($_POST['buyerState']);
	// $buyerPinCode = trim($_POST['buyerPinCode']);
	// $buyerCountry = trim($_POST['buyerCountry']);
	// $orderid = trim($_POST['orderid']); //Your System Generated Order ID
	// // $hiddenmod = trim($_POST['directindexvar']);
	// $currency = trim($_POST['currency']);
	// $isocurrency = trim($_POST['isocurrency']);

	$buyerEmail = "hari@gmail.com";
	$buyerPhone = "1234567890";
	$buyerFirstName = "Hari";
	$buyerLastName = "Haran";
	$buyerAddress = "address";
	$amount = 100.00;
	$buyerCity = "banglore";
	$buyerState = "karnataka";
	$buyerPinCode = "560001";
	$buyerCountry = "INDIA";
	$orderid = rand(10000,99999); //Your System Generated Order ID
	$hiddenmod = "upi";
	$currency = "356";
	$isocurrency = "INR";
	
    include('config.php');
    include('checksum.php');
    // include('validation.php');
	

	$date = date('Y-m-d');
	$alldata   = $buyerEmail.$buyerFirstName.$buyerLastName.$buyerAddress.$buyerCity.$buyerState.$buyerCountry.$amount.$orderid.$hiddenmod;
	$privatekey = Checksum::encrypt($username.":|:".$password, $secret);
	$keySha256 = Checksum::encryptSha256($username."~:~".$password);
	$checksum = Checksum::calculateChecksum($alldata,$keySha256);

	$alldata   = $buyerEmail.$buyerFirstName.$buyerLastName.$buyerAddress.$buyerCity.$buyerState.$buyerCountry.$amount.$orderid;
	$privatekey = Checksum::encrypt($username.":|:".$password, $secret);
    $keySha256 = Checksum::encryptSha256($username."~:~".$password);
    $checksum = Checksum::calculateChecksumSha256($alldata.date('Y-m-d'),$keySha256);
  	$hiddenmod = "upi";
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3./org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Airpay</title>
<script type="text/javascript">
function submitForm(){
			var form = document.forms[0];
			form.submit();
			console.log("form -> ", form)
		}
</script>
</head>
<body onload="javascript:submitForm()">
<center>
<table width="500px;">
	<tr>
		<td align="center" valign="middle">Do Not Refresh or Press Back <br/> Redirecting to Airpay</td>
	</tr>
	<tr>
		<td align="center" valign="middle">
			<form action="	https://payments.airpay.co.in/pay/index.php" method="post">
                <input type="hidden" name="privatekey" value="<?php echo $privatekey; ?>">
                <input type="hidden" name="mercid" value="<?php echo $mercid; ?>">
				<input type="hidden" name="orderid" value="<?php echo $orderid; ?>">
 		        <input type="hidden" name="currency" value="<?php echo $currency; ?>">
		        <input type="hidden" name="isocurrency" value="<?php echo $isocurrency; ?>">
				<input type="hidden" name="chmod" value="<?php echo $hiddenmod; ?>">	
				<input type="hidden" name="buyerEmail" value="<?php echo $buyerEmail; ?>">					
				<input type="hidden" name="buyerPhone" value="<?php echo $buyerPhone; ?>">
				<input type="hidden" name="buyerFirstName" value="<?php echo $buyerFirstName; ?>">
				<input type="hidden" name="buyerLastName" value="<?php echo $buyerLastName; ?>">
				<input type="hidden" name="buyerAddress" value="<?php echo $buyerAddress; ?>">					
				<input type="hidden" name="amount" value="<?php echo $amount; ?>">
				<input type="hidden" name="buyerCity" value="<?php echo $buyerCity; ?>">
				<input type="hidden" name="buyerState" value="<?php echo $buyerState; ?>">
				<input type="hidden" name="buyerPinCode" value="<?php echo $buyerPinCode; ?>">
				<input type="hidden" name="buyerCountry" value="<?php echo $buyerCountry; ?>">
				<input type="hidden" name="orderid" value="<?php echo $orderid; ?>">
				<input type="hidden" name="hiddenmod" value="<?php echo $hiddenmod; ?>">
				<input type="hidden" name="currency" value="<?php echo $currency; ?>">
				<input type="hidden" name="isocurrency" value="<?php echo $isocurrency; ?>">
				<input type="hidden" name="keySha256" value="<?php echo $keySha256; ?>">
				<?php
				Checksum::outputForm($checksum);
				?>
			</form>
		</td>

	</tr>

</table>

</center>
</body>
</html>
