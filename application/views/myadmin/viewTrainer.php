<?php 
$opts = array('http'=>array(
                  'method'=>"GET",
                  'header'=>"token: 9f67c0d60108e71da0f7264f1675c124"
            ));
            $context = stream_context_create($opts);
            $trainer_info = file_get_contents($this->api_url.'api/web/users/profile/'.$param2, false, $context);
             $trainer = json_decode($trainer_info,true);
             //echo count($trainer['data']);
             $t = array($trainer['data']);
              
            foreach($t as $row){    
             //echo $row['message'];
			 $str = explode('/', $row['attachmentUrl']);
                   $imgstr = end($str);
?>

    <section id="main-content">
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="card-header m-b-20">
                                        <h4>Trainer Information</h4>                                        
                                    </div>
                                </div>
                                <div class="row">
                                     <table class="table table-bordered" style="">
                                    <thead>                                        
                                        <tr>
                                            <th>Image</th>
                                            <td><img id="product_imgess" src="<?php echo $this->api_url;?>attachments/w400/<?php echo $imgstr;?>" onerror="this.onerror=null;this.src='<?php echo base_url();?>home/images/img/trainer.png';"  width="150px" height="auto"> </td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td><?php echo $row['firstName']." ".$row['lastName'];?></td>
                                        </tr>
                                         
                                         <tr>
                                            <th>Email</th>
                                            <td><?php echo $row['email'];?></td>
                                        </tr>
                                       
                                        <tr>
                                            <th>mobile</th>
                                            <td><?php echo $row['mobile'];?> </td>
                                        </tr>
                                        <tr>
                                            <th>Followers</th>
                                            <td><?php echo !empty($row['totalFollowers'])?$row['totalFollowers']:'';?></td>                                                        
                                        </tr>
                                         <tr>
                                            <th>Designation</th>
                                            <td><?php echo !empty($row['designation'])?$row['designation']:'';?></td>
                                        </tr>
                                        
                                        <?php $address = !empty($trainer['data']['address'])?$trainer['data']['address']:'';
                                       // print_r($address);?>
                                         <tr>
                                            <th>Address</th>
                                            <td style="width:70%">
                                                <table class="table table-bordered table-striped">
                                                     <thead>
                                                    <tr>
                                                        <th>Area</th>
                                                        <td>
                                                            <?php echo !empty($address['area'])?$address['area']:'';?>
                                                        </td>
                                                    </tr>                                                    
                                                    <tr>
                                                        <th>City</th>
                                                        <td>
                                                            <?php echo !empty($address['city'])?$address['city']:'';?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Country</th>
                                                        <td>
                                                            <?php echo !empty($address['country'])?$address['country']:'';?>                                                           
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>State</th>
                                                        <td>
                                                             <?php echo !empty($address['state'])?$address['state']:'';?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Zipcode</th>
                                                        <td>
                                                             <?php echo !empty($address['zipcode'])?$address['zipcode']:'';?>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                </table>
                                            </td>
                                           
                                        </tr>
                                       
                                         
                                    </thead>

                                      </table>                                   
                                          <div class="modal-footer">
                                              <button type="button" onClick="PrintElem('main-content')" class="btn btn-info btn-lg  border-none sbmt-btn"><i class="ti-printer"></i> Print</button>
                                                  <button type="button" class="btn btn-primary btn-lg border-none sbmt-btn" data-dismiss="modal"><i class="ti-close"></i> Close</button>
                                              </div> 
                                 </div>                                
                              
                            </div>
                        </div>
                    </div>
                  
                    
         
                    
   </section>

    <!-- scripit init-->
<?php }?>
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