<div id="divid">
<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script>
/* Update item quantity */
function updateCartItem(obj, rowid){
	$.get("<?php echo base_url('cart/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value}, function(resp){
		if(resp == 'ok'){
			location.reload();
		}else{
			alert('Cart update failed, please try again.');
		}
	});
}
</script>
<style type="text/css">
    li{list-style: none;}
</style>
<h2>Shopping Cart</h2>
         <?php if(empty($this->session->userdata(FRONTEND_SESS_CODE.'log_id'))){?>
       <a href="<?php echo base_url("login")?>"> <button type="button" class="btn btn-info btn-lg head_log">LOGIN</button></a>
                <!-- <button type="button" class="btn btn-info btn-lg head_log" data-toggle="modal" data-target="#myModal">Login</button> -->
      <?php } else {?>
      <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MY ACCOUNTS <span class="caret"></span></a>
    <ul class="dropdown-menu">
    <li><a href="<?php echo base_url("logout")?>">LOGOUT</a></li>
        </ul> 
      </li>
      <?php } ?>  
<div class="row cart" >
    <table class="table">
    <thead>
        <tr>
            <th width="10%"></th>
            <th width="30%">Product</th>
            <th width="15%">Price</th>
            <th width="13%">Quantity</th>
            <th width="20%">Subtotal</th>
            <th width="12%"></th>
        </tr>
    </thead>
    <tbody>
        <?php  if(!empty($cartItems)){ foreach($cartItems as $item){    ?>
        <tr>
            <td>
                <?php $imageURL = !empty($item["image"])?base_url('upload/'.$item["image"]):base_url('assets/images/pro-demo-img.jpeg'); ?>
                <img src="<?php echo $imageURL; ?>" width="50"/>
            </td>
            <td><?php echo $item["name"]; ?></td>
            <td><i class="fa fa-inr"></i>  <?php echo $item["price"]; ?></td>
<!--             <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td> -->

            <td> <button type="button" class="value-button"  onclick="decreaseValue('<?php echo $item["qty"];?>','<?php echo $item["rowid"];?>')" id="inc"><span class="glyphicon glyphicon-minus"></span></button>
             <input type="number" value="<?php echo $item["qty"]; ?>" onclick="<?php echo $item["qty"];?>" min="1" max="100" disabled>
             <button type="button" class="value-button"  onclick="increaseValue('<?php echo $item["qty"];?>','<?php echo $item["rowid"];?>')" id="desc"><span class="glyphicon glyphicon-plus"></span></button></td>

            <td><i class="fa fa-inr"></i> <?php echo $item["subtotal"]; ?></td>

<!--                 <a href="<?php echo base_url('cart/removeItem/'.$item["rowid"]); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></a> -->
<td><i class="glyphicon glyphicon-trash"  onclick="removeItem('<?php echo $item["rowid"];?>')" style="cursor:pointer"></i></td>
    
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="6"><p>Your cart is empty.....</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td><a href="<?php echo base_url(''); ?>" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a></td>
            <td colspan="3"></td>
            <?php if(empty($this->session->userdata(FRONTEND_SESS_CODE.'log_id'))){?>
            <td class="text-left">Grand Total: <b><i class="fa fa-inr"></i> <?php echo $this->cart->total(); ?></b></td>
            <td><a href="<?php echo base_url('checkout/'); ?>" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } else { ?>

            <td class="text-left">Grand Total: <b><i class="fa fa-inr"></i> <?php echo $subtotal->subtotal; ?></b></td>
            <td><a href="<?php echo base_url('checkout/'); ?>" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } ?>    
        </tr>
    </tfoot>
    </table>
</div>
<script type="text/javascript">
  window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}
</script>

<script type="text/javascript">
    /* Update item quantity */
function increaseValue(qty, cart_id){

    $("#inc").attr("disabled", true);
    // var ajaxDisplay = document.getElementById("imgload");
    // ajaxDisplay.innerHTML = "<center style='margin-top:-20px;'><img src='uploads/ajax-loader.gif' /></center>";
    // var ajaxDisplay1 = document.getElementById("imgload1");
    // ajaxDisplay1.innerHTML = "<center style='margin-top:-20px;'><img src='uploads/ajax-loader.gif' /></center>";
  $.get("<?php echo base_url('incItemQty'); ?>", {cart_id:cart_id, qty:qty}, function(resp){
    //console.log(resp);
    if(resp.trim("") == 'ok'){
      //location.reload();
      $("#divid").load(" #divid");
    }else{
      //alert('Cart update failed, please try again.');
    }
  });
}

function decreaseValue(qty, cart_id){
   $("#desc").attr("disabled", true);
    // var ajaxDisplay = document.getElementById("imgload");
    // ajaxDisplay.innerHTML = "<center style='margin-top:-20px;'><img src='uploads/ajax-loader.gif' /></center>";
    // var ajaxDisplay1 = document.getElementById("imgload1");
    // ajaxDisplay1.innerHTML = "<center style='margin-top:-20px;'><img src='uploads/ajax-loader.gif' /></center>";
  $.get("<?php echo base_url('decItemQty'); ?>", {cart_id:cart_id, qty:qty}, function(resp){
    if(resp.trim("") == 'ok'){
      //location.reload();
      $("#divid").load(" #divid");
    }else{
      $("#divid").load(" #divid");
      //alert('Cart update failed, please try again.');
    }
  });
}


function removeItem(cart_id){
  if(confirm("Are you sure you want to delete this?")){
   // alert(cart_id);
  $.get("<?php echo base_url('removeItem'); ?>", {cart_id:cart_id}, function(resp){
    if(resp.trim("") == 'ok'){
     // location.reload();
      $("#divid").load(" #divid");
    }else{
     // alert('Delete Cart failed, please try again.');
    }
  });
  }
    else{
        return false;
    }
}
</script>
</div>