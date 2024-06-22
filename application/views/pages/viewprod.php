       <!-- datatable bootstrap --> 
           <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
		<!-- enddatatable bootstrap -->



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
                                        <a href="index.html"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Dashboard
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page"> Product Display </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end page title -->
                </div>
            </div>
            <!-- end row -->



            <div class="row">
                <div class="col-xxl-12 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                    <div class="container mt-5 mb-5 col-md-12">
                        <h4><?=$title?></h4>

                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">NAFDAC NO</th>
                                    <th scope="col">Date Purchased</th>
                                    <th scope="col">Expiring Date </th>
                                    <th scope="col" class="text-center"> Action  </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($allprod) { ?>
                                  <?php $counter =1; foreach($allprod as $product) {  ?>
                                   <tr>
                                   <td>  <?=$counter++?>    </td> 
                                    <td>  <?=$product->prodname?></td> 
                                    <td>  <?=$product->prodprice?></td>
                                    <td>  <?=$product->prodcategory?></td>
                                    <td>  <?=$product->nafdacno?></td>
                                    <td>  <?=$product->purchase_date?></td>
                                    <td>  <?=$product->prodname?></td>
                                    <td> 
                                       <a href="" class="bg-danger pt-2 pb-2 pl-2 pr-2 text-light" onclick="btndelete()">delete</a>
                                       <a href="" class="bg-primary pt-2 pb-2 pl-2 pr-2 text-light" data-toggle="modal" data-target="#exampleModal<?=$product->prodID?>">Edit Prod </a>
                                    </td>
                                   </tr>

                                     <!-- modal --> 
                                        <div class="modal fade" id="exampleModal<?=$product->prodID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title" id="exampleModalLabel">  Edit Product </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                               <form action="<?=base_url('products/updateproducts')?>" method="POST">
                                                    <div class="modal-body">
                                                    <input type="hidden" name="prod_id" class="form-control" value="<?=$product->prodID?>">
                                                    <div class="form-group">
                                                        <label> Product Name </label>
                                                        <input type="text" name="prodname"  class="form-control" value="<?=$product->prodname?>">
                                                    </div>
                                                    <div class="form-group">
                                                       <label> Product Price </label>
                                                        <input type="text" name="prodprice" class="form-control" value="<?=$product->prodprice?>">
                                                    </div>
                                                    <div class="form-group">
                                                    <label> Product Category </label>
                                                        <input type="text" name="prodcategory" class="form-control" value="<?=$product->prodcategory?>">
                                                    </div>
                                                    <div class="form-group">
                                                    <label> Product Quantity </label>
                                                        <input type="text" name="prodqty" class="form-control" value="<?=$product->prodqty?>">
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
                                 <!-- close modal --> 
                                <?php } ?>
                             <?php }else {?>
                                 <?= " No Record Found  " ?>
                               <?php } ?>
                            </tbody>
                        </table>
     



                  </div>
                 </div>
            </div>
        </div>

        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end app-main -->





<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();
    });

    function btndelete(){
    
      alert('hello');
    }
</script>