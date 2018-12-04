<?php
 //session_start();
 $total = 0;
 $sr=0;
if (isset($_SESSION['products']) && $_SESSION['products'] != '') {
     foreach ($_SESSION['products'] as $cart) {
        $amt = $cart['amount'] * $cart['qty'];
        $total = $total + $amt;
        $sr;
        $sr++;
    }
}
?>
 <ul class="nav navbar-right cart-pop cartMenu">
        <li class="dropdown "> 
            <a href="<?php echo base_url();?>Cart" style="color: #ededed;" class="dropdown-toggle" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="itm-cont"><?php echo  $sr; ?></span> <i class="flaticon-shopping-bag"></i>

            </a>

        </li>
      </ul>
