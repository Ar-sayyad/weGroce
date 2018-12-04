<?php
//session_start();
//$root_path = 'http://localhost/asbshop/';
//db connection
$hostname = 'localhost';
$username = 'root';//
$password = '';//
$db = 'meratrainer_db';//meratrainer_db
$conn = mysqli_connect($hostname, $username, $password, $db);

//empty cart by distroying current session
if (isset($_GET["emptycart"]) && $_GET["emptycart"] == 1) {
    $return_url = base64_decode($_GET["return_url"]); //return url
    unset($_SESSION['products']);
//    header('Location:' . $return_url);
}

//add item in shopping cart
if (isset($_POST["type"]) && $_POST["type"] == 'add') {

    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING); //product code
    // echo $id;die;
   $amount =$_POST["amount"];
    $qty = 1; //product code
    //MySqli query - get details of item from db using product code
    mysqli_query($conn,"SET names utf8");
    $results = mysqli_query($conn,"SELECT * FROM products WHERE product_id='$id' LIMIT 1") or die(mysqli_error());
    $obj = mysqli_fetch_array($results);

    if ($results) { //we have the product info 
        //prepare array for the session variable
        $new_product = array(array('id' => $obj['product_id'], 'prod_name' => $obj['product_title'], 'amount' => $amount,  'qty' => 1,'trainer_id' => $obj['trainer_id'], 'image' => $obj['product_img']));

        if (isset($_SESSION["products"]) && $_SESSION['products'] != '') { //if we have the session
            $found = false; //set found item to false

            foreach ($_SESSION["products"] as $cart_itm) { //loop through session array
                if ($cart_itm["id"] == $id) { //the item exist in array
                     $amount = $cart_itm['amount'];
                   //  echo $amount;die;
                    $qty = $cart_itm['qty'];
                    if ($qty) {
                        $qty++;
                    } else {
                       
                        return 0;
                    }
//                    echo 'You can added';
                    $product[] = array('id' => $cart_itm["id"], 'prod_name' => $cart_itm['prod_name'], 'amount' =>  $amount , 'qty' => $qty,'trainer_id' => $cart_itm['trainer_id'], 'image' => $cart_itm["image"]);
                    $found = true;
                    setcookie("msgs", "Cart updated successfully.", time() + 3600, "/", "", 0);
                } else {
                    setcookie("msgs", "New product added to cart.", time() + 3600, "/", "", 0);
                    //item doesn't exist in the list, just retrive old info and prepare array for session var
                    $product[] = array('id' => $cart_itm["id"], 'prod_name' => $cart_itm['prod_name'], 'amount' =>  $cart_itm['amount'], 'qty' => $cart_itm['qty'],'trainer_id' => $cart_itm['trainer_id'], 'image' => $cart_itm["image"]);
                }
            }

            if ($found == false) { //we didn't find item in array
                //add new user item in array
                $_SESSION["products"] = array_merge($product, $new_product);
            } else {
                //found user item in array list, and increased the quantity
                $_SESSION["products"] = $product;
            }
        } else {
            //create a new session var if does not exist
            $_SESSION["products"] = $new_product;
        }
    }
    $total = 0;
    foreach ($_SESSION['products'] as $cart) {
        echo "<pre>";print_r($_SESSION['products']);die;
        $amt = $cart['amount'] * $cart['qty'];
        $total = $total + $amt;
    }
    //echo $total;
    ?>
<?php echo $total; ?>
                
  
                           
<?php
                       
}

/***add with qty****/

//add item in shopping cart
if (isset($_POST["type"]) && $_POST["type"] == 'add_qty') {

    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING); //product code
   $amount =$cart_itm["amount"];
  // echo $amount;die;
    $qty = 1; //product code
    //MySqli query - get details of item from db using product code
    mysqli_query($conn,"SET names utf8");
    $results = mysqli_query($conn,"SELECT * FROM tbl_products WHERE product_id='$id' LIMIT 1") or die(mysqli_error());
    $obj = mysqli_fetch_array($results);

    if ($results) { //we have the product info 
        //prepare array for the session variable
        $new_product = array(array('id' => $obj['product_id'], 'prod_name' => $obj['product_name'], 'amount' => $amount,  'qty' => 1,'trainer_id' => $obj['trainer_id'], 'image' => $obj['product_image']));
// echo "<pre>";print_r($new_product);die;
        if (isset($_SESSION["products"]) && $_SESSION['products'] != '') { //if we have the session
            $found = false; //set found item to false

            foreach ($_SESSION["products"] as $cart_itm) { //loop through session array
                if ($cart_itm["id"] == $id) { //the item exist in array
                     $amount = $cart_itm['amount'];
                   //  echo $amount;die;
                    $qty = $cart_itm['qty'];
                    if ($qty) {
                        $qty++;
                    } else {
                       
                        return 0;
                    }
//                    echo 'You can added';
                    $product[] = array('id' => $cart_itm["id"], 'prod_name' => $cart_itm['prod_name'], 'amount' =>  $amount , 'qty' => $qty,'trainer_id' => $cart_itm["trainer_id"], 'image' => $cart_itm["image"]);
                    $found = true;
                    setcookie("msgs", "Cart updated successfully.", time() + 3600, "/", "", 0);
                } else {
                    setcookie("msgs", "New product added to cart.", time() + 3600, "/", "", 0);
                    //item doesn't exist in the list, just retrive old info and prepare array for session var
                    $product[] = array('id' => $cart_itm["id"], 'prod_name' => $cart_itm['prod_name'], 'amount' =>  $cart_itm['amount'], 'qty' => $cart_itm['qty'],'trainer_id' => $cart_itm["trainer_id"], 'image' => $cart_itm["image"]);
                }
            }

            if ($found == false) { //we didn't find item in array
                //add new user item in array
                $_SESSION["products"] = array_merge($product, $new_product);
            } else {
                //found user item in array list, and increased the quantity
                $_SESSION["products"] = $product;
            }
        } else {
            //create a new session var if does not exist
            $_SESSION["products"] = $new_product;
        }
    }
    $total = 0;
    foreach ($_SESSION['products'] as $cart) {
        $amt = $cart['amount'] * $cart['qty'];
        $total = $total + $amt;
    }
    //echo $total;
    ?>
<?php echo $total; ?>
                
  
                           
<?php
                       
}


//add item in shopping cart
if (isset($_POST["type"]) && $_POST["type"] == 'update') {

    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING); //product code
     // $amount =$_POST["amount"];
  

    $m_qty = filter_var($_POST["qty"], FILTER_SANITIZE_STRING); 
 
     mysqli_query($conn,"SET names utf8");
    $results = mysqli_query($conn,"SELECT * FROM products WHERE product_id='$id' LIMIT 1") or die(mysqli_error());
    $obj = mysqli_fetch_array($results);

    if ($results) { 

$new_product = array(array('id' => $obj['product_id'], 'prod_name' => $obj['product_title'], 'amount' => $obj['price'],'qty' => $m_qty,'trainer_id' => $obj["trainer_id"], 'image' => $obj['product_img']));
   //    echo "<pre>"; print_r($new_product);die;

        if (isset($_SESSION["products"]) && $_SESSION['products'] != '') { //if we have the session
            $found = false; //set found item to false

            foreach ($_SESSION["products"] as $cart_itm) { //loop through session array
                if ($cart_itm["id"] == $id) { //the item exist in array
                    $amount = $cart_itm['amount'];
                    $qty = $cart_itm['qty'];
                  
                 
                    if ($qty) {
                      
                        $qty=$m_qty;
                    } else {
                       
                        return 0;
                    }

                $product[] = array('id' => $cart_itm["id"], 'prod_name' => $cart_itm['prod_name'], 'amount' => $amount, 'qty' => $qty, 'trainer_id' => $cart_itm["trainer_id"], 'image' => $cart_itm["image"]);
                   
                    $found = true;
                    setcookie("msgs", "Cart updated successfully.", time() + 3600, "/", "", 0);
                } else {
                    setcookie("msgs", "New product added to cart.", time() + 3600, "/", "", 0);
                    //item doesn't exist in the list, just retrive old info and prepare array for session var
                    $product[] = array('id' => $cart_itm["id"], 'prod_name' => $cart_itm['prod_name'], 'amount' => $cart_itm['amount'], 'qty' => $cart_itm['qty'], 'trainer_id' => $cart_itm["trainer_id"], 'image' => $cart_itm["image"]);
                    
                }
            }

            if ($found == false) { //we didn't find item in array
                //add new user item in array
                $_SESSION["products"] = array_merge($product, $new_product);

            } else {
                //found user item in array list, and increased the quantity
                $_SESSION["products"] = $product;

            }
        } else {
            //create a new session var if does not exist
            $_SESSION["products"] = $new_product;

        }
    }
    $total = 0;
    foreach ($_SESSION['products'] as $cart) {
        $amt = $cart['amount'] * $cart['qty'];
        $total = $total + $amt;
    }
    //echo $total;
    ?>
<?php echo $total; ?>
                
  
                           
<?php
                       
}

/***end add with qty******/



if (isset($_POST["type"]) && $_POST["type"] == 'minus') {

    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING); //product code
    $amount =$cart_itm["amount"];
     
    $qty = 1; //product code
    //MySqli query - get details of item from db using product code
    mysqli_query($conn,"SET names utf8");
    $results = mysqli_query($conn,"SELECT * FROM tbl_products WHERE product_id='$id' LIMIT 1") or die(mysqli_error());
    $obj = mysqli_fetch_array($results);

    if ($results) { //we have the product info 
        //prepare array for the session variable
         $new_product = array(array('id' => $obj['product_id'], 'prod_name' => $obj['product_name'], 'amount' => $amount,  'qty' => 1,'trainer_id' => $obj["trainer_id"], 'image' => $obj['product_image']));
//echo "<pre>"; print_r($new_product);die;
        if (isset($_SESSION["products"]) && $_SESSION['products'] != '') { //if we have the session
            $found = false; //set found item to false

            foreach ($_SESSION["products"] as $cart_itm) { //loop through session array
                
                if ($cart_itm["id"] == $id) { //the item exist in array
                   $amount = $cart_itm['amount'];
                    $qty = $cart_itm['qty'];
                    
                    if ($qty > 1) {
                        $qty--;
                        
                         $product[] = array('id' => $cart_itm["id"], 'prod_name' => $cart_itm['prod_name'], 'amount' => $cart_itm["amount"], 'qty' => $qty, 'trainer_id' => $cart_itm["trainer_id"], 'image' => $cart_itm["image"]);
                    $found = true;
                    setcookie("msgs", "Cart updated successfully.", time() + 3600, "/", "", 0);
                    }
                    else{
                        echo '0';
                        return FALSE;
                    }
 
                }
                else {
                  
//                    setcookie("msgs", "New product added to cart.", time() + 3600, "/", "", 0);
                    //item doesn't exist in the list, just retrive old info and prepare array for session var
                    $product[] = array('id' => $cart_itm["id"], 'prod_name' => $cart_itm['prod_name'], 'amount' => $cart_itm["amount"],  'qty' => $cart_itm['qty'],'trainer_id' => $cart_itm["trainer_id"], 'image' => $cart_itm["image"]);
                       //$found = false; 
                    // echo '1';
                      //  return FALSE;
                    
                }
            }

            if ($found == false) { //we didn't find item in array
                //add new user item in array
                echo '1';
                     return FALSE;
           // $_SESSION["products"] = array_merge($product, $new_product);
            } else {
                //found user item in array list, and increased the quantity
                $_SESSION["products"] = $product;
            }
        } else {
            //create a new session var if does not exist
           // $_SESSION["products"] = $new_product;
            echo '1';
            return FALSE;
        }
    }
    $total = 0;
    foreach ($_SESSION['products'] as $cart) {
        $amt = $cart['amount'] * $cart['qty'];
        $total = $total + $amt;
    }
    //echo $total;
    ?>
<?php echo $total; ?>
               

               
<?php
}


//remove item from shopping cart
if (isset($_POST["type"]) && $_POST["type"] == 'remove') {
     //$return_url = base64_decode($_GET["return_url"]); //return url
     //$return=$_GET['return'];
    $book_id = $_POST["id"];
    foreach ($_SESSION['products'] as $cart_itm) {
        if ($book_id != $cart_itm['id']) {
            $product[] = array('id' => $cart_itm["id"], 'prod_name' => $cart_itm['prod_name'], 'amount' => $cart_itm["amount"], 'qty' => $cart_itm['qty'],'trainer_id' => $cart_itm["trainer_id"], 'image' => $cart_itm["image"], );
        }
        if (isset($product)) {
            $_SESSION['products'] = $product;
        } else {
            $_SESSION['products'] = '';
        }
    }

}
?>