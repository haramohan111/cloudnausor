  <!-- Shipping address -->
    <form class="form-horizontal" method="post">
    <div class="ship-info">
        <h4>Shipping Info</h4>
        <div class="form-group">
            <label class="control-label col-sm-2">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="<?php echo !empty($custData['name'])?$custData['name']:''; ?>" placeholder="Enter name">
                <?php echo form_error('name','<p class="help-block error">','</p>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="<?php echo !empty($custData['email'])?$custData['email']:''; ?>" placeholder="Enter email">
                <?php echo form_error('email','<p class="help-block error">','</p>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Phone:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" value="<?php echo !empty($custData['phone'])?$custData['phone']:''; ?>" placeholder="Enter contact no">
                <?php echo form_error('phone','<p class="help-block error">','</p>'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Address:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="address" value="<?php echo !empty($custData['address'])?$custData['address']:''; ?>" placeholder="Enter address">
                <?php echo form_error('address','<p class="help-block error">','</p>'); ?>
            </div>
        </div>
    </div>
    <div class="footBtn">
        <a href="<?php echo base_url('cart/'); ?>" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Back to Cart</a>
        <button type="submit" name="placeOrder" class="btn btn-success orderBtn">Place Order <i class="glyphicon glyphicon-menu-right"></i></button>
    </div>
    </form>