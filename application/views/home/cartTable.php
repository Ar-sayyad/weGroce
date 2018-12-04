
 <div class="box_cart">
        <table class="table cart-list">
                <thead>
                    <?php if (isset($_SESSION['products']) && $_SESSION['products'] != '') {?>
                        <tr>
                            <th style="text-align:center">
                                        Item
                                </th>
                                <th style="text-align:center">
                                    Name
                                </th>
                                <th style="text-align:center">
                                        Qty
                                </th>
                                <th style="text-align:center">
                                        Price
                                </th>
                                <th style="text-align:center">
                                        Total
                                </th>
                                <th style="text-align:center">
                                        Actions
                                </th>
                        </tr>
                          <?php } ?>
                </thead>
                <tbody>
                <?php
if (isset($_SESSION['products']) && $_SESSION['products'] != '') {
$sr=1;
foreach ($_SESSION['products'] as $cart)
{
//   echo "<pre>";print_r($cart);die;
$amt = $cart['amount'] * $cart['qty'];                                    

?>			<tr>
                                <td style="">
                                    <div class="" style="text-align: center;">
                                            <img class="cart-img" src="<?php echo base_url().'assets/uploads/products/'.$cart['image'];?>" alt="Image" onError="this.src = '<?php echo base_url().'assets/no_image.jpg';?>'">

                                        </div>

                                </td>
                                <td style="text-align:center">
                                      <span class="prd_nm"><?php echo $cart['prod_name'];?></span>
                                </td>
                                <td style="width: 15%;text-align:center">
                                     <input type="number" class="form-control prd_qty" min="1" value="<?php echo $cart['qty'];?>" data-value="<?php echo $cart['id'];?>" onchange="updateQty(this)"/>

                                </td> 
                                <td style="text-align:center">
                                    <strong class="prd_amt"><i class="fa fa-rupee"><?php echo $cart['amount'];?></i></strong>
                                </td>
                                <td style="text-align:center">
                                        <strong class="prd_amt"><i class="fa fa-rupee"><?php echo $amt;?></i></strong>
                                </td>
                                <td class="options" style="text-align:center">
                                        <a data-value="<?php echo $cart['id'];?>" onclick="removeCartItem(this)">
                                            <i class="prd-rem fa fa-trash"></i></a>
                                </td>
                        </tr>
                         <?php
                            $sr++;
                            }
                            }
                            else{ ?>
                            <center class="pheading" style="margin-top:60px;margin-bottom:60px;"> Your Cart is Empty</center>
                           <?php  }
                            ?>



                </tbody>
        </table>

</div>
