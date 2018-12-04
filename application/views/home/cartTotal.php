 <?php
    $total = 0;
    if (isset($_SESSION['products']) && $_SESSION['products'] != '') {
    foreach ($_SESSION['products'] as $cart) {
    $amt = $cart['amount'] * $cart['qty'];
    $total = $total + $amt;
    }
    }
    ?>
   <div class="side-filter">
                <div class="total_div" style="font-size: 20px;">
                    <table>
                        <tr>
                            <th>
                                Total : <i class="fa fa-rupee"><?php echo $total; ?></i>
                            </th>
                        </tr>
                        
                    </table>
                    </div>                
                <hr>
                <div style="text-align: center">
     <?php if (isset($_SESSION['products']) && $_SESSION['products'] != '') {?>
                <!--<a href="<?php echo base_url();?>cart/filldetail" class="btn" >Next</a>-->                  
                     <!--<hr>-->
    <?php } ?>
                    <a href="<?php echo base_url();?>Category" class="btn"><i class="fa fa-right"></i> Continue</a>
                </div>
    </div>