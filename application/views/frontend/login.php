 <?php
 if($this->session->flashdata('success')){
          echo "<div class='alert alert-success' id='successMessage'>".$this->session->flashdata('success')."</div>";  
          }
          if($this->session->flashdata('failed')){
          echo "<div class='alert alert-danger' id='successMessage'>".$this->session->flashdata('failed')."</div>"; 
          }
          if(!empty(validation_errors())){
          echo "<div class='alert alert-danger'>".validation_errors()."</div>";
        }?>
<form action="<?php echo base_url("login");?>" method="post">
	Email:<input type="text" name="email"><br><br>
	Password:<input type="password" name="password"><br><br>
	<input type="submit" name="submit" value="submit">
	<a href="<?php echo base_url('signup');?>">Signup</a>
	<a href="<?php echo base_url('');?>">Home</a>
</form>