<?php $mproduct="2";?>
<?php require_once dirname(__DIR__)."/includes/header.php";?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">

.editable {
  
  box-shadow: inset 0 0 10px;

}
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url("dashboard");?>">Home</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
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
        <?php if($this->session->flashdata('success')){
          echo "<div class='alert alert-success' id='successMessage'>".$this->session->flashdata('success')."</div>";  
          }
          if($this->session->flashdata('failed')){
          echo "<div class='alert alert-danger' id='successMessage'>".$this->session->flashdata('failed')."</div>"; 
          } 
          if(!empty(validation_errors())){
          echo "<div class='alert alert-danger'>".validation_errors()."</div>";
        }
        ?>  
              <!-- /.card-header -->
          <form action="<?php echo base_url("admin/product/update_product");?>" method="post" id="signup_form" enctype="multipart/form-data">    
              <div class="card-body">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label>Product name</label> <span class="text-danger">*</span>
                    <input type="text"class="form-control" name="pname" id="pname" placeholder="Enter" value="<?php echo $result->name;?>">
                </div><span class="text-danger" id="price_err"></span> 
              </div>


              <div class="col-md-6">
                <div class="form-group">
                  <label>Sku</label> <span class="text-danger">*</span>
                    <input type="text"class="form-control" name="sku" id="pi" placeholder="Enter" value="<?php echo $result->sku;?>">
                </div><span class="text-danger" id="pri_err"></span> 

              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Stock</label> <span class="text-danger">*</span>
                    <input type="text"class="form-control" name="stock" id="pri" placeholder="Enter" value="<?php echo $result->stock;?>">
                </div><span class="text-danger" id="pri_err"></span> 

              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>price</label> <span class="text-danger">*</span>
                    <input type="text"class="form-control" name="price" id="price" placeholder="Enter" value="<?php echo $result->price;?>">
                </div><span class="text-danger" id="pri_err"></span> 

              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Image</label> <span class="text-danger">*</span>
                    <input type="file"class="form-control" name="image" id="pri" placeholder="Enter" value="">
                </div><span class="text-danger" id="pri_err"></span> 
                 <td><img src="<?php echo base_url();?>upload/<?php echo $result->image;?>" style="width: 40px;height: 40px;"></td>
              </div>

                                
              <input type="hidden" name="update_url" value="<?php echo current_url();?>">
              <input type="hidden" name="user_where" value="<?php echo $this->uri->segment(4);?>">
              <!-- /.col -->
            </div>
              <!-- /.card-body -->
            </div>
            <button type="submit" class= "btn btn-primary" style="width: 100px; margin: 13px 500px;">Update</button>
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

  <script type="text/javascript">
   $("#signup_form").submit(function(){

     $("#cmp_err,#dia_err,#price_err,#qty_err,#price_err,#pri_err").html("");
      var cmp= $("#menu").val().trim();
      var dia= $("#submenu").val().trim();
      var qty= $("#qty").val().trim();
      var price= $("#price").val().trim();
      var pri= $("#pri").val().trim();
      var numbers = /^[0-9]+$/;
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
    //   if(dia == '')
    //  {
    //     $("#dia_err").html('submenu is required');
    //     str = false;
    //  }
    // else if(!numbers.test(dia))
    //  {
    //     $("#dia_err").html('submenu is invalid');
    //     str = false;
    //  }
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

    <script type="text/javascript">
  $('.pen').click(function(){
       if($(this).find("i").attr('class') == "fa fa-pencil float-right"){
        $(this).find("i").removeClass();
        $(this).find("i").addClass("fa fa-save float-right");
        //$(this).find("i").empty();
      }
      else{
        $(this).find("i").removeClass();
        $(this).find("i").addClass("fa fa-pencil float-right");  
        //$(this).find("i").text("you");   
      }

});
</script> 
<script type="text/javascript">
  $('div.box span').click(function(){
    $(this).prev().toggleClass('editable');
    $('.text').attr('contenteditable', 'true');

    if($(this).prev().attr('class') == "text"){
         $(this).prev().removeAttr('contenteditable', 'true');
         $('.text').removeAttr('contenteditable', 'true');

        var price_id = $(this).prev().attr("id");
        var str = $(this).prev().text();
        //alert(price_id);
        //alert(price);
        var items = str.split( "-" );
        var price = items[items.length - 1 ];
        var price_type = items[items.length - 2];


               $.ajax({ 
                dataType:'text',
                type:'post', 
                data:{'price_id':price_id,'price':price,'price_type':price_type},  
                url:"<?php echo base_url();?>superadmin/product_controller/update_price", 
                success:function(res){
                  //alert(res);
                $("#price_error").html(res);
                },
                error:function(res){
                console.log(res);
                }   
           });
      }
});
</script>
</body>
</html>
