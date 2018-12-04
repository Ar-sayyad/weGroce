<?php

if(!empty($_SESSION['email'])){
$status = $_POST["status"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$amount = $_POST['amount'];
$txnid = $_POST["txnid"];
$posted_hash = $_POST["hash"];
$key = $_POST["key"];
$email = $_POST["email"];
$salt = $_SESSION['salt'];

/**data insertion***/
$data['user_id'] =  $this->session->userdata('login_user_id');
$data['fname']  = ucfirst($_SESSION['fname']);
$data['lname']  = ucfirst($_SESSION['lname']);
$data['email']  = $_SESSION['email'];                
$data['contact']  = $_SESSION['contact'];
$data['date'] = date("d M,Y");
$data['shipping_address'] = $_SESSION['shipping_address'];
$data['city']   = ucfirst($_SESSION['city']);
$data['pincode']  = $_SESSION['pincode'];
$data['subtotal']  = $_SESSION['subtotal'];
$data['shipping_charges'] = $_SESSION['shipping_charges'];
$data['final_total'] = $_SESSION['totalCost'];
$data['order_status'] = 1;
$data['status'] = $status;
$data['txnid'] = $txnid;

// $data['fname'] = ucfirst(strtolower($_SESSION['fname']));
// $data['lname'] = ucfirst(strtolower($_SESSION['lname']));
// $data['email'] = $_SESSION['email'];
// $data['contact'] = $_SESSION['contact'];
// $data['date'] = date('d-m-Y');
// $data['amount'] = $_SESSION['totalCost'];



$insert = $this->db->insert('orders',$data);
 $order_id= $this->db->insert_id();
   if($order_id){
                     foreach ($_SESSION['products'] as $cart) {
                         $dat['order_id'] = $order_id;
                         $dat['product_id'] = $cart['id'];
                         $dat['prod_name'] = $cart['prod_name'];
                         $dat['prod_price'] = $cart['amount'];
                         $dat['qty'] = $cart['qty'];
                         $dat['trainer_id'] = $cart['trainer_id'];
                         $dat['amount'] = $cart['amount'] * $cart['qty'];
                       $this->db->insert('order_product',$dat);
                       $email=$_SESSION['email'];
                       $name=ucfirst($_SESSION['fname'])." ".ucfirst($_SESSION['lname']);
                       $contact=$_SESSION['contact'];
                       $address=$_SESSION['shipping_address'];
                       $city= ucfirst($_SESSION['city']);
                       $pincode  = $_SESSION['pincode'];
                       $subtotal  = $_SESSION['subtotal'];
                       $ship_charges = $_SESSION['shipping_charges'];
                       $final_total = $_SESSION['totalCost'];

                       $this->admin_model->send_mail($email,$name,$address,$city,$pincode,$subtotal,$ship_charges,$final_total);
                       redirect(base_url());

                        } 
                    }

//$package_id = $_SESSION['package_id'];



If (isset($_POST["additionalCharges"])) {
    $additionalCharges = $_POST["additionalCharges"];
    $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
} else {

    $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
}
$hash = hash("sha512", $retHashSeq);

/*if ($hash != $posted_hash) {
    echo "Invalid Transaction. Please try again";
} else {*/
if($insert){?>
redirect(base_url());
<html>
    <title>Payment Done</title>
<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<section id="main-content">
        <div class="container">
            <div class="row">
                        <div class="col-md-12">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="card-header m-b-20">
                                        <h4>Booking Confirmation</h4>                                        
                                    </div>
                                </div>
                                <div class="row">
                                     <table class="table table-bordered" style="">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <img src="<?php echo base_url();?>evanta/assets/img/bg/home-static-1.jpg" width="100%">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th> Transaction ID</th>
                                             <td><?php echo $txnid;?></td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td><?php echo ucfirst(strtolower($_SESSION['fname']))." ".ucfirst(strtolower($_SESSION['lname']));?></td>
                                        </tr>
                                        <tr>
                                            <th>Contact No.</th>
                                            <td><?php echo $_SESSION['contact'];?></td>
                                        </tr>                                       
                                        <tr>
                                            <th>Email</th>
                                            <td><?php echo $_SESSION['email'];?></td>
                                        </tr>
                                      
                                        <tr>
                                            <th>
                                                Amount
                                            </th>
                                            <td><?php echo $_SESSION['totalCost'];?></td>
                                        </tr>
                                        <tr>
                              
                             
                            </tr>                                        
                                       
                                    </thead>
                                    
                                </table>                                   
                                    <div class="modal-footer">
                                        <button type="button" onClick="PrintElem('main-content')" class="btn btn-info btn-lg  border-none sbmt-btn"><i class="ti-printer"></i> Print</button>
                                            
                                        </div> 
                                </div> 
                               
                            </div>
                        </div>
                    </div>
            
            <a href="<?php   echo base_url();?>"><h5>Home Page</h5></a> 
        </div>                 
                    
         
       
   </section>
</body>
</html>

<?php 
unset($_SESSION['fname']);
unset($_SESSION['lname']);
unset($_SESSION['email']) ;                
unset($_SESSION['contact']);

unset($_SESSION['shipping_address']);
unset($_SESSION['city']);
unset($_SESSION['pincode']);
unset($_SESSION['subtotal']);
unset($_SESSION['shipping_charges']);
unset($_SESSION['totalCost']);


 } 
}else{
     redirect(base_url());
}
?> 
<script type="text/javascript">
 function PrintElem(el){
    
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
        
	window.print();
        
	document.body.innerHTML = restorepage;
        window.location.reload();
      // return true;
}
</script>  