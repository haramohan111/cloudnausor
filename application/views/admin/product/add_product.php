<?php $aproduct="2";?>
<?php require_once dirname(__DIR__)."/includes/header.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard");?>">Home</a></li>
              <li class="breadcrumb-item active">Add Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
<!--               <div class="card-header">
              </div> -->
        <?php if($this->session->flashdata('success')){
          echo "<div class='alert alert-success' id='successMessage'>".$this->session->flashdata('success')."</div>";  
          }
          if($this->session->flashdata('failed')){
          echo "<div class='alert alert-danger' id='successMessage'>".$this->session->flashdata('failed')."</div>"; 
          } 
          if(!empty(validation_errors())){
          echo "<div class='alert alert-danger'>".validation_errors()."</div>";
        }
        if(isset($error)){
          echo "<div class='alert alert-danger'>".$error."</div>";
        }
        ?>  
              <!-- /.card-header -->
          <form action="<?php echo base_url("admin/product/add_product");?>" method="post" id="signup_form" enctype="multipart/form-data">    
              <div class="card-body">
            <div class="row">

              <!-- /.col -->

              <div class="col-md-6">
                <div class="form-group">
                  <label>Product name</label> <span class="text-danger">*</span>
                    <input type="text"class="form-control" name="pname" id="pname" placeholder="Enter" value="<?php if(isset($pname)) echo $pname;?>">
                </div><span class="text-danger" id="p_err"></span> 
              </div>


     <p id="get_no_of_price" class="text-danger"></p>
     <p id="get_no_of" class="text-danger"></p>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group" id="single_price">
                  <label>SKU</label> <span class="text-danger">*</span>
                    <input type="text"class="form-control" name="sku"  placeholder="Enter" value="<?php if(isset($sku)) echo $sku;?>">
                </div><span class="text-danger" id="price_err"></span> 

              </div>

</div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group" id="single_price">
                  <label>Stock</label> <span class="text-danger">*</span>
                    <input type="text"class="form-control" name="stock"  placeholder="Enter" value="<?php if(isset($stock)) echo $stock;?>">
                </div><span class="text-danger" id="price_err"></span> 

              </div>
            </div>
          <div class="row">
              <div class="col-md-6">
                <div class="form-group" id="single_price">
                  <label>Price</label> <span class="text-danger">*</span>
                    <input type="text"class="form-control" name="price"  placeholder="Enter" value="<?php if(isset($price)) echo $price;?>">
                </div><span class="text-danger" id="price_err"></span> 

              </div>
            </div>
        <div class="row">
              <div class="col-md-6">
                <div class="form-group" id="single_price">
                  <label>Image</label> <span class="text-danger">*</span>
                    <input type="file"class="form-control" name="image"  placeholder="Enter">
                </div><span class="text-danger" id="price_err"></span> 

              </div>
            </div>
           <div id="dynamic_field"></div>
              <!-- /.card-body -->

            </div>
            <button type="submit" class= "btn btn-primary" style="width: 100px; margin: 13px 500px;">Submit</button>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
     </form>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view("admin/includes/footer");?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#menu').on('change',function(){
    var category_id=$(this).val();
    if(category_id)
    {
             $.ajax({
              type:'POST',
              url:'<?php echo base_url();?>superadmin/product_controller/get_submenu',
              data:'did='+category_id,
              success:function(data){

                if(data.trim()=="200"){
                 // $("#single_price").hide();
                 // $("#full_price").hide();
                 // $("#price").show();
                 $('#submenu').html('<option value="">Not required</option>');
                }else{

                // $("#single_price").show();
                //  $("#full_price").show();  
                // $("#price").hide();
                $('#submenu').html('<option value="">select submenu</option>');
                $('#submenu').html(data);
              }
              }
             });
    }
    else
    {
      $('#submenu').html('<option value="">select submenu</option>');
    }
  });
});
  

  $(document).ready(function(){
  $('#menu').on('change',function(){
    var category_id=$(this).val();
    if(category_id)
    {
             $.ajax({
              type:'POST',
              url:'<?php echo base_url();?>superadmin/product_controller/get_result',
              data:'did='+category_id,
              success:function(data){

                if(data.trim()=="400"){
              //alert("1");
              $('#get_no_of_price').remove();
                 //$('#submenu').html('Not required');
                }else{
                $('#get_no_of').remove();
                $('#get_no_of_price').html(data);
              }
              }
             });
    }
    else
    {
      $('#submenu').html('<option value="">select submenu</option>');
    }
  });
});

    $(document).ready(function(){
  $('#submenu').on('change',function(){
    var category_id=$(this).val();
    if(category_id)
    {
             $.ajax({
              type:'POST',
              url:'<?php echo base_url();?>superadmin/product_controller/get_submenu_data',
              data:'gid='+category_id,
              success:function(data){
              if(data.trim()=="400"){
              //alert("1");
              //$('#get_no_of').remove();
              $('#get_no_of').html(data);
                }else{
                $('#get_no_of_price').remove();
                $('#get_no_of').html(data);
              }
              }
             });
    }
    else
    {
      $('#submenu').html('<option value="">select submenu</option>');
    }
  });
});
</script>
 <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<div class="row" id="row'+i+'"><div class="col-md-6"><div class="form-group" id="single_price"><label>Price</label> <span class="text-danger">*</span><input type="text"class="form-control" name="price[]"  placeholder="Enter"></div><span class="text-danger" id="price_err"></span> </div><div class="col-md-5"><div class="form-group" id="full_price"><label>Price Type</label> <span class="text-danger">*</span><input type="text"class="form-control" name="p_type[]"  placeholder="Enter price,single,full,family,jumbo"></div><span class="text-danger" id="price_err"></span> </div><div class="col-md-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm" style="margin-top:33px">X</button></div></div>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });  
 </script> 

  <script type="text/javascript">
   $("#signup_form").submit(function(){

     $("#cmp_err,#dia_err,#price_err,#qty_err,#price_err,#pri_err,#p_err").html("");
      var cmp= $("#menu").val().trim();
      var dia= $("#submenu").val().trim();
      var pname= $("#pname").val().trim();
      var qty= $("#qty").val().trim();
      var price= $("#price").val().trim();
      var pri= $("#pri").val().trim();
      var numbers = /^[0-9.]+$/;
      var str=true;

    if(cmp == '')
     {
        $("#cmp_err").html('menu name is required');
        str = false;
     }
     else if(!numbers.test(cmp))
     {
        $("#cmp_err").html('menu name is invalid');
        str = false;
     }
      if(pname == '')
     {
        $("#p_err").html('Product name is required');
        str = false;
     }
    else if(!numbers.test(pname))
     {
        $("#p_err").html('Product name is invalid');
        str = false;
     }
      if(price == '')
     {
        $("#price_err").html('Price is required');
        str = false;
     }
      else if(!numbers.test(price))
     {
        $("#price_err").html('Price is invalid');
        str = false;
     }
      if(qty == '')
     {
        $("#qty_err").html('Qty is required');
        str = false;
     }
    else if(!numbers.test(qty))
     {
        $("#qty_err").html('Qty is invalid');
        str = false;
     }
    if(pri == '')
     {
        $("#pri_err").html('Priority is required');
        str = false;
     }
    else if(!numbers.test(pri))
     {
        $("#pri_err").html('Priority is invalid');
        str = false;
     }
     return str;
});
  </script>
</body>
</html>
