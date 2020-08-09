<?php $mproduct="2";?>
<?php require_once dirname(__DIR__)."/includes/header.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div

            <!-- /.card -->
          </div>
          <!-- /.col -->

          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
 <form method="post" action="<?php echo base_url('admin/product/manage_product')?>">
                <div class="card-tools" style="float: left;">
                  <div class="input-group input-group-sm">

                    <input type="text" name="search" class="form-control float-right" placeholder="Search Product" value="<?php echo $this->session->userdata('search_product')?>">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default" id="search_btn"><i class="fas fa-search"></i></button>
                    </div>
                  </div> 
                </div>
</form>
<button class="btn btn-default" style="float: left;margin-left: 15px;padding: 2px;"><a href="<?php echo base_url("superadmin/product_controller/productRefresh");?>"><i class="fas fa-sync"></i></a></button>
          <div class="card-tools">
          <div class="input-group input-group-sm" style="margin: 1px 36px;margin-right: 31px;">
         <a href="<?php echo base_url("admin/product/add_product");?>"> <button type="button" class="btn btn-primary" style="margin-right:2px;"> <i class="fa fa-plus"></i> Create</button></a>
          <form action="<?php echo base_url("admin/product/product_act_inact");?>" method="post">
          <button type="submit" class="btn btn-success" name="active" style="margin-right:2px;"> <i class="fa fa-dot-circle-o"></i> Active</button>
          <button type="submit" class="btn btn-warning" name="inactive" style="margin-right:2px;"> <i class="fa fa-warning"></i> InActive</button>
          <button type="submit"  onclick="return confirm('Confirm to delete')" class="btn btn-danger" name="delete" style="margin-right:2px;"> Delete</button>
                    <div class="input-group-append">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
        <?php if($this->session->flashdata('success')){
          echo "<div class='alert alert-success' id='successMessage'>".$this->session->flashdata('success')."</div>";  
          }
          if($this->session->flashdata('failed')){
          echo "<div class='alert alert-danger' id='successMessage'>".$this->session->flashdata('failed')."</div>"; 
          } 
        ?>  
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th><div class="form-group">
                      <div class="controls">
                      <input type="checkbox" id="checkAll" value="single" aria-invalid="false">
                      <label for="checkAll"></label>
                      <div class="help-block"></div></div>  
                      </div></th>
                      <th>Sl.N</th>
                      <th>Product Name</th>
                      <th>Sku</th>
                      <th>Stock</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
          <?php
          if(isset($result)){
           $i = $this->uri->segment(4)+1; 
           foreach($result as $result){ 
          ?>
                  <tbody>
                    <tr>
                      <td><div class="form-group">
                        <div class="controls">
                        <input type="checkbox" id="<?php echo $result->id;?>" name="multiple[]" value="<?php echo $result->id;?>">
                        <label for="<?php echo $result->id;?>"></label>
                        <div class="help-block"></div></div>  
                        </div>
                     </td>
                      <td><?php echo $i;?></td>
                      <td><?php echo ucwords($result->name);?></td>

                      <td><?php echo $result->sku;?></td>
                      <td><?php echo $result->stock;?></td>
                      <td><?php echo $result->price;?></td>
                      <td><a href="<?php echo base_url("admin/product/edit_product").'/'.base64_encode($result->id);?>"  class="btn btn-primary"> Edit </a></td>
                      </tr>
                      <?php
                      $i++;
                      }
                      }else{
                      ?>
                      <tr><td>No records found....</td></tr>
                      <?php  } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
</form><?php echo $links;?>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view("admin/includes/footer");?>
<script type="text/javascript">
    $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
     $("#status").change(function(){
     $("#search_btn").click();
    });
     $("#sstatus").change(function(){
     $("#search_btn").click();
    });
</script>
</body>
</html>
