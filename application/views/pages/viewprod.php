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
                                    <th scope="col"> Action  </th>
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
                                      <i class="fa fa-trash" style="width:30%;"></i>
                                      <i class="fa fa-pencil"></i>
                                    </td>
                                   </tr>
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



            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end app-main -->




<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>