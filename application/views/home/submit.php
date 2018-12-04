<?php  
define('MERCHANT_KEY', 'duMPGPHe');
define('SALT', 'EdHyvx4rBw');
//define('PAYU_BASE_URL', 'https://test.payu.in');    //Testing url
define('PAYU_BASE_URL', 'https://secure.payu.in');  //actual URL
define('SUCCESS_URL', base_url().'Cart/success');  //have complete url
define('FAIL_URL', base_url());    //add complete url 
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);


 $email = $_POST['email'];//session
 $mobile = $_POST['contact'];//session
 $firstName = $_POST['fname'];//session
 $lastName = $_POST['lname'];//session
 $totalCost = $_POST['totalCost'];//session

 $final_total = $_POST['final_total'];//session
 $shipping_address = $_POST['shipping_address'];//session
 $shipping_charges = $_POST['shipping_charges'];
 $city = $_POST['city'];//session
 $pincode = $_POST['pincode'];//session
 $subtotal = $_POST['subtotal'];//session
 $user_id = $_POST['user_id'];//session
 $order_status = 1;
 $status = 1;



  $_SESSION['final_total'] = $final_total;
  $_SESSION['shipping_address'] = $shipping_address;
  $_SESSION['shipping_charges'] = $shipping_charges;
  $_SESSION['city'] = $city;
  $_SESSION['pincode'] = $pincode;
  $_SESSION['subtotal'] = $subtotal;

  $_SESSION['fname'] = $firstName;
  $_SESSION['lname'] = $lastName;
  $_SESSION['email'] = $email;
  $_SESSION['contact'] = $mobile;
  $_SESSION['totalCost'] = $totalCost;
  $_SESSION['salt'] = SALT;
  $hash         = '';
//Below is the required format need to hash it and send it across payumoney page. UDF means User Define Fields.
//$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
$hash_string = MERCHANT_KEY."|".$txnid."|".$totalCost."|"."productinfo|".$firstName."|".$email."|||||||||||".SALT;
$hash = strtolower(hash('sha512', $hash_string));
$action = PAYU_BASE_URL . '/_payment'; 

?>
<form action="https://secure.payu.in/_payment" method="post" name="payuForm" id="payuForm" style="display: none;">
    <input type="text" name="key" value="<?php echo MERCHANT_KEY; ?>" />
     <input type="text" name="salt" value="<?php echo SALT; ?>" />
    <input type="text" name="hash" value="<?php echo $hash ?>"/>
    <input type="text" name="txnid" value="<?php echo $txnid ?>" />
    <input name="amount" type="number" value="<?php echo $totalCost; ?>" />
    <input type="text" name="firstname" id="firstname" value="<?php echo $firstName; ?>" />
    <input type="email" name="email" id="email" value="<?php echo $email; ?>" />
    <input type="text" name="phone" value="<?php echo $mobile; ?>" />
     <textarea name="productinfo"><?php echo "productinfo"; ?></textarea>
    <input type="text" name="surl" value="<?php echo SUCCESS_URL; ?>" />
    <input type="text" name="furl" value="<?php echo  FAIL_URL?>"/>
    <input type="text" name="service_provider" value="payu_paisa"/>
    <input type="text" name="lastname" id="lastname" value="<?php echo $lastName ?>" />
    <input type="submit">
</form>
<script type="text/javascript">
    var payuForm = document.forms.payuForm;
    payuForm.submit();
</script>