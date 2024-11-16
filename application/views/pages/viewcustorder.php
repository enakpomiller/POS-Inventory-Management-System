

    <style>

.toggle-password {
    position: absolute;
    top: 82%;
    right: 40px;
    transform: translateY(-50%);
    cursor: pointer;
    font-size:15px;
}
</style>


<!-- begin app-main -->
<div class="app-main" id="main">
<!-- begin container-fluid -->
<div class="container-fluid">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-12 m-b-30">
            <!-- begin page title -->
            <div class="d-block d-sm-flex flex-nowrap align-items-center">
          <div class="page-title mb-2 mb-sm-0">

                <h4> <?=$title?>  </h4>

                </div>

                <div class="ml-auto d-flex align-items-center">
                    <nav>
                        <ol class="breadcrumb p-0 m-b-0">
                            <li class="breadcrumb-item">
                                <a href="<?=site_url('/')?>"><i class="ti ti-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                            <a href="<?=site_url('/')?>">
                                Dashboard
                            </a>
                            </li>
                            <li class="breadcrumb-item active text-primary" aria-current="page"> Managers Role</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- end row -->



    <div class="row">
        <div class="col-xxl-8 m-b-30">
            <div class="card card-statistics h-100 mb-0">
            <div class="card-header">
                    <h4 class="card-title"> Ordered Items  </h4>
                </div>

          <div class="container">
            <table class="table" style="position:relative;padding-left:10px; padding-right:10px;">
                <thead class="bg-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prod Name</th>
                        <th scope="col">Prod Price</th>
                        <th scope="col"> Prod Qty</th>
                        <th scope="col"> Total Price</th>
                        <th scope="col" class="text-right"> Action </th>
                        </tr>
                    </thead>
                <tbody>
                    <?php $counter =1; foreach($custorder as $orders) {  ?>
                    <tr id="<?=$orders->orderID?>">
                        <td> <?=$counter++?> </td>
                        <td><?=$orders->prodname?></td>
                        <td><?=$orders->prodprice?></td>
                        <td><?=$orders->prodqty?></td>
                        <td> <?=(($orders->prodprice) * ($orders->prodqty))?></td>
                        <td align="right">
                            <!-- <a href="" class="remove"> remove </a> -->
                            <button type="submit" class="btn btn-primary pr-2 pl-2" data-toggle="modal"  data-target="#exampleModal<?=$orders->orderID?>"><i class="fa fa-pencil"></i></button>
                            <?php if($this->session->role == 'Supper Admin') { ?>
                            <button type="submit" class="btn btn-danger pr-2 pl-2 remove"><i class='fa fa-trash'></i> Delete</button>
                          <?php } ?>
                        </td>
                    </tr>

                     <!-- modal open -->

                        <div class="modal fade" id="exampleModal<?=$orders->orderID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="exampleModalLabel"><p>  Edit Customer Order </p> </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                 <form action="<?=base_url('products/updatecustorder/'.$orders->customerID)?>" method="POST">
                                    <div class="modal-body">
                                    <input type="hidden" name="prodID"  class="form-control" value="<?=$orders->prodID?>">
                                    <input type="hidden" name="orderID"  class="form-control" value="<?=$orders->orderID?>">
                                    <div class="form-group">
                                        <label> Product Name </label>
                                        <input type="text" name="prodname"  class="form-control" value="<?=$orders->prodname?>">
                                    </div>

                                    <div class="form-group">
                                    <label> Product Price  </label>
                                        <input type="text" name="prodprice"  class="form-control" value="<?=$orders->prodprice?>">
                                    </div>
                                    <div class="form-group">
                                    <label> Product Quantiry  </label>
                                        <input type="number" autocomplete="off" name="prodqty"  class="form-control" value="<?=$orders->prodqty?>">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                                </div>
                            </div>
                            </div>

                         <!-- modal close -->

                    <?php }?>
                </tbody>
             </table>
        </div>


         </div>
        </div>
        <div class="col-xxl-4 m-b-30">
            <div class="card card-statistics h-100 mb-0">
                <div class="card-header">
                    <h4 class="card-title"> Customer Info  </h4>
                </div>

                <table class="table table-borderless">
                    <thead>
                        <tr>
                        <th scope="col" class="w-50"> Names </th>
                        <th scope="col"><?=(ucfirst($custorder[0]->fname).' '.ucfirst($custorder[0]->lname))?></th>
                        </tr>
                        <tr>
                        <th scope="col" class="w-50"> Country </th>
                        <th scope="col" class="w-50"> <?=$custorder[0]->country?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                        <td>Email</td>
                        <td><?=$custorder[0]->email?></td>
                        </tr>
                        <tr>
                        <td>Phone</td>
                        <td><?=$custorder[0]->phone?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- end row -->
</div>
<!-- end container-fluid -->
</div>
<!-- end app-main -->






 <script>


       $(".remove").click(function(){
            var id = $(this).parents("tr").attr("id");

            if(confirm(' THIS ACTION CANNOT BE REVERSED ?'))

            {
                $.ajax({
                url: '<?=base_url('products/deletecustorder/')?>'+id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if(data == true){
                        $("#"+id).remove();
                        //alert("Record removed successfully");
                        swal.fire("success"," ORDER DELETED SUCCESSFULLY","success");
                    }else{
                        swal.fire("error","UNABLE TO DELETE RECORD","error");
                    }

                }
                });
            }else{
            //alert(" ACTION IS BEEN CANCELLED");
            swal.fire("error","ACTION IS CANCELLED","error");
            }
        });


</script>
