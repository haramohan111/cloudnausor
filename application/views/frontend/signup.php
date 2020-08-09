               <div class="signup-form">
    <form action="<?php echo base_url("signup");?>" method="post">
		<h2>SIGN UP</h2>
		<p>Please fill in this form to create an account!</p>
		<hr>
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
        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user"></i></span>
				<input type="text" class="form-control" name="name" placeholder="Name" required="required" pattern="[a-zA-Z. ]*$"  value="<?php if(isset($name)) echo $name;?>">
			</div>
        </div>
        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				<input type="email" class="form-control" name="email" placeholder="Email Address" required="required" value="<?php if(isset($email)) echo $email;?>">
			</div>
        </div>
      <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
        <input type="text" class="form-control" name="mobile" placeholder="Mobile" required="required" maxlength="10" minlength="10" value="<?php if(isset($mobile)) echo $mobile;?>">
      </div>
        </div>
		  <div class="form-group">
      <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-eye toggle-password" toggle="#password-field"></i></span>
          <input type="password" class="form-control" name="fpassword" placeholder="Password" required="required" maxlength="10" minlength="4" id="password-field" value="<?php if(isset($fpassword)) echo $fpassword;?>">
      </div>
      </div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-lock"></i>
					<i class="fa fa-check"></i>
				</span>
				<input type="password" class="form-control" name="spassword" placeholder="Confirm Password" required="required" value="<?php if(isset($spassword)) echo $spassword;?>">
			</div>
        </div>
        <div class="form-group">
<!-- 			<label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label> -->
		</div>
		<div class="form-group end_sign">
            <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
        </div>
        <div class="text-center">Already have an account? <a href="<?php echo base_url("login");?>">Login here</a></div>
    </form>