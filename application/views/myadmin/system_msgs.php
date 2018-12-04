<?php if ($this->session->flashdata('msg_ok')){?>
    <div id="mssg" style="margin-bottom:0px;margin-top:5px;color: green;text-align: center;background-color: #fff; width: 75%;margin-left: 100px;padding: 7px; border: 1px solid green;border-radius: 2px;">
             <?php echo $this->session->flashdata('msg_ok'); ?>
     </div>  
 <?php $this->session->set_flashdata('msg_ok', '');}?>

     <?php if ($this->session->flashdata('err_msg')){?>
   <div id="mssg" style="margin-bottom:0px;margin-top:5px;color: RED;text-align: center;background-color: #fff; width: 75%;margin-left: 100px;padding: 7px; border: 1px solid red;border-radius: 2px;">
         <?php echo$this->session->flashdata('err_msg'); ?>
     </div> 
 <?php $this->session->set_flashdata('err_msg', '');}?>