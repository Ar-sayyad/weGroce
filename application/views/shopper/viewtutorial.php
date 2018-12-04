<?php 
$single_tutorial_info = $this->db->get_where('tutorial', array('tutorial_id' => $param2))->result_array();
foreach ($single_tutorial_info as $row) {
?>
<style>
        .required{
            color:red;
        }
    </style>
    <section id="main-content">
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card alert">
                                <div class="card-body">
                                    <div class="card-header m-b-20">
                                        <h4>Tutorial Information</h4>                                        
                                    </div>
                                </div>
                                <div class="row">
                                     <table class="table table-bordered" style="">
                                    <thead>                                        
                                        
                                        
                                        <tr>
                                            <th>Tutorial Video</th>
                                            <td>
                                                <video width="250" oncontextmenu="return false;" controls controlsList="nodownload">
                                                    <source src="<?php echo base_url().'assets/uploads/tutorial/'.$row['tutorial_path']; ?>" type="video/mp4">
                                                    Your browser does not support HTML5 video.
                                                  </video>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tutorial Title</th>
                                            <td><?php echo $row['tutorial_title'];?></td>
                                        </tr>
                                         <tr>
                                            <th>Series</th>
                                            <td><?php echo $this->admin_model->getseriesName($row['series_id']);?> </td>
                                        </tr>
                                        
                                       
                                        <tr>
                                            <th>Price Range(<i class='fa fa-inr'></i>)</th>
                                            <td><?php echo $this->admin_model->getPriceRangeName($row['price_range_id']);?> </td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td><i class='fa fa-inr'></i><?php echo $row['price'];?></td>                                                        
                                        </tr>
                                         
                                        
                                         <tr>
                                            <th>Duration</th>
                                            <td><?php echo $row['duration'];?></td>
                                        </tr>
                                         
                                        
                                         <tr>
                                            <th>Description</th>
                                            <td style="width:70%"><?php echo $row['tutorial_description'];?></td>
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