       
       <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    .copy-container {
      margin-bottom: 20px;
    }
    button {
      padding: 10px 15px;
      font-size: 16px;
      cursor: pointer;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
    }
    button:hover {
      background-color: #45a049;
    }
    </style>
       
       <!-- datatable bootstrap -->
           <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
		<!-- enddatatable bootstrap -->
    <!-- barcode -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>


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

            
            <!-- The text field -->
            <!-- <input type="text" value="Hello World" id="myInput"> -->
            <!-- The button used to copy the text -->
            <!-- <button onclick="myFunction()">Copy text</button> -->


            <div class="row">
                <div class="col-xxl-12 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                    <div class="container mt-5 mb-5 col-md-12">
                        <h4><?=$title?></h4>
               <?php if(!empty($allprod)) { ?>

                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col" class="text-center"> Barcode</th>
                                    <th scope="col">Date Purchased</th>
                                    <th scope="col">Expiring Date </th>
                                    <th scope="col"> NafDac  </th>
                                    <th scope="col"> Status  </th>
                                    <th scope="col" class="text-center"> Action  </th>
                                </tr>
                            </thead>
                            <tbody>

                                  <?php
                                  $counter =1;   //foreach($allprod as $product) {
                                    foreach($allprod as $index => $product) {
                                     ?>
                                   <tr id="<?=$product->prodID?>">
                                       <td>  <?=$counter++?>  </td>
                                        <td id="text1"> <?=$product->prodname?></td>
                                        <td>  <?= number_format($product->prodprice) ?></td>
                                        <td>
                                          <?//=$product->barcode?>

                                          <svg id="barcode<?= $index ?>"></svg>
                                          <script>
                                              // Generate barcode
                                              JsBarcode("#barcode<?= $index ?>", "<?= $product->barcode ?>", {
                                                  format: "CODE128",
                                                  lineColor: "#000",
                                                  width: 2,
                                                  height: 50,
                                                  displayValue: true
                                              });
                                          </script>

                                         </td>
                                       
                                        <td>  <?=$product->purchase_date?></td>
                                        <td>  <?=$product->expiring_date?></td>
                                        <td> 
                                          <?=$product->nafdacno?>
                                        </td> 
                                        <td> 
                                            <?php 
                                                $currentdate =  date("Y-m-d");
                                                if($currentdate >= $product->expiring_date){ ?>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <p class="text-primary"> Expired </p>
                                                </div>
                                                    <div class="col-md-2">
                                                    <span class="notify">
                                                        <span class="blink"></span>
                                                        <span class="dot"></span>
                                                        </span>
                                                    </div>
                                            </div>
                                                    

                                            <?php  }else{?>

                                             <p class="text-success"> Not Expired  </p>
                                             <?php 
                                                
                                             }
                                            ?>
                                      
                                                 

                                            
                                         </td>
                                        <td align="center">
                                            <?php if($this->session->office =="MANAGER" || $this->session->role == "Supper Admin"){ ?>
                                           <button type="submit" class="btn btn-danger remove" tooltip="delete"><i class="fa fa-trash"></i></button>
                                           <button type="submit" class="btn btn-primary" data-toggle="modal"  data-target="#exampleModal<?=$product->prodID?>"><i class="fa fa-pencil"></i></button>
                                           <?php }else ?>

                                            <?php 
                                             { 
                                            ?>
                                           <!-- delete expired item --> 
                                           <?php 
                                                $currentdate =  date("Y-m-d");
                                                if($currentdate >= $product->expiring_date){ ?>
                                                <button type="submit" class="btn btn-danger removeexpiredprod btn-sm" tooltip="delete"><i class="fa fa-trash"></i></button>
                                         
                                            <?php  }else{?>
                                                <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal"  data-target="#exampleModal<?=$product->prodID?>"><i class="fa fa-pencil"></i></button>
                                             <?php 
                                                
                                             }
                                            ?>
                                            <!-- end notify for delete expired item --> 

                                        <?php } ?>
                                        </td>
                                   </tr>

                                     <!-- modal -->
                                        <div class="modal fade" id="exampleModal<?=$product->prodID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title" id="exampleModalLabel"><p>  Edit Product</p> </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                               <form action="<?=base_url('products/updateproducts')?>" method="POST">
                                                    <div class="modal-body">
                                                    <input type="hidden" name="prod_id"  class="form-control" value="<?=$product->prodID?>">
                                                    <div class="form-group">
                                                        <label> Product Name </label>
                                                        <input type="text" name="prodname"  class="form-control" value="<?=$product->prodname?>">
                                                    </div>
                                                    <div class="form-group">
                                                       <label> Product Price </label>
                                                        <input type="number" name="prodprice" class="form-control" value="<?=$product->prodprice?>">
                                                    </div>
                                                    <div class="form-group">
                                                    <label> Product Category </label>
                                                        <input type="text" name="prodcategory" class="form-control" value="<?=$product->prodcategory?>">
                                                    </div>
                                                    <div class="form-group">
                                                    <label> Product Quantity </label>
                                                        <input type="number" name="prodqty" class="form-control" value="<?=$product->prodqty?>">
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
                                      </tbody>
                                  </table>

                      <?php }else {?>
                               <center>
                                 <img  src="<?=base_url('assets/img/notfound.png')?>" height="200px" width="25%" >
                               <?= "<h4> No Product Found Yet! </h4> " ?>
                           </center>

                      <?php } ?>


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


        $(".remove").click(function(){
            var id = $(this).parents("tr").attr("id");

            if(confirm(' ARE YOU SURE YOU WANT TO DELETE THIS PRODUCT? ?'))

            {
                $.ajax({
                url: '<?=base_url('products/deleteproduct/')?>'+id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if(data == true){
                        $("#"+id).remove();
                        //alert("Record removed successfully");
                        swal.fire("success"," PRODUCT DELETED SUCCESSFULLY","success");
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


        $(".removeexpiredprod").click(function(){
            var id = $(this).parents("tr").attr("id");

            if(confirm(' REMOVE EXPIRED ITEM FROM CHELF ?'))

            {
                $.ajax({
                url: '<?=base_url('products/deleteexpiredproduct/')?>'+id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if(data == true){
                        $("#"+id).remove();
                        //alert("Record removed successfully");
                        swal.fire("success"," ITEM REMOVED SUCCESSFULLY","success");
                    }else{
                        swal.fire("error","UNABLE TO REMOVE ITEM ","error");
                    }

                }
                });
            }else{
            //alert(" ACTION IS BEEN CANCELLED");
            swal.fire("error","ACTION IS CANCELLED","error");
            }
        });


        // Get the barcode number from PHP
        var barcodeNumber = "<?=$allbarcode?>";
        // Generate barcode
        JsBarcode("#barcode", barcodeNumber, {
            format: "CODE128",
            lineColor: "#000",
            width: 2,
            height: 100,
            displayValue: true
        });



    function myFunction() {
        // Get the text field
        var copyText = document.getElementById("myInput");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied the text: " + copyText.value);
    }




    function copyText(elementId) {
      // Get the text content from the specified element
      const copyText = document.getElementById(elementId).innerText;

      // Copy the text to the clipboard
      navigator.clipboard.writeText(copyText).then(() => {
        alert("Copied the text: " + copyText);
      }).catch(err => {
        console.error("Failed to copy text: ", err);
        alert("Failed to copy text.");
      });
    }
    
</script>
