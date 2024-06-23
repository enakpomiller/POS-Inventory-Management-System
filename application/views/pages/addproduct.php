

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
                <div class="col-xxl-12 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                    <div class="container mt-5 mb-5 col-md-9">
                        <h4>Add Products </h4>

                        <form>
                        <div class="row">
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="name">Product  Name</label>
                                    <input type="text"   class="nput100 form-control"  name="prodname" id="prodname" autocomplete="off" id="fname">
                                </div>
                             <div class="form-group">
                                 <label for="name">Product Proce</label>
                                 <input type="text"   class="nput100 form-control"  name="prodprice" id="prodprice"  autocomplete="off" id="fname">
                              </div>

                             <div class="form-group">
                                  <label for="email">Product Category</label>
                                  <input type="text"  class="nput100 form-control"   name="prodcategory" id="prodcategory" autocomplete="off">
                             </div>

                              <div class="form-group">
                                   <label for="email"> NAFDAC Reg N0</label>
                                   <input type="text"   class="nput100 form-control" name="nafdacno"  id="nafdacno" autocomplete="off">
                               </div> 
                              <div class="form-group">
                                   <label for="email"> Product Serial Number  </label>
                                   <input type="text"  class="nput100 form-control" name="prodserialno"  id="prodserialno" autocomplete="off">
                               </div> 
                            </div>


                         <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email"> Product Quantity</label>
                                  <input type="number"   class="input100 form-control" name="prodqty"  id="prodqty" autocomplete="off">
                               </div> 
                              <div class="form-group">
                                  <label for="email"> Date Purchased  </label>
                                   <input type="date"   class="input100 form-control" name="purchase_date"  id="purchase_date" autocomplete="off">
                               </div> 
                              <div class="form-group">
                                   <label for="email"> Expiry Date  </label>
                                  <input type="date"   class="input100 form-control" name="expiring_date"  id="expiring_date" autocomplete="off">
                              </div> 
                               <div class="form-group">
                                   <label for="email"> Brand  </label>
                                  <input type="text"   class="input100 form-control" name="prodbrand"  id="prodbrand" autocomplete="off">
                               </div> 
                        
                                <div class="form-group mt-4" style="position:relative;top:20px;">
                                   <button type="reset" class="btn btn-primary" style="width:24%;"> Reset Form  </button>
                                    <button type="submit"  class="btn text-light" id="butsave" style="width:75%;background:#8e54e9;"> Create Product </button>
                                  
                                </div>
                            
                            </div>
                        </div>
                    </form>
                  </div>

                 </div>
            </div>

                



            </div>



            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end app-main -->




    <script src="<?=base_url()?>assets/js/jquery.js"></script>
      <script>
            $(document).ready(function() {
                $('#butsave').on('click', function(event) {
                    event.preventDefault();
                     // location.reload();
                    var prodname = $('#prodname').val();
                    var prodprice = $('#prodprice').val();
                    var prodcategory = $('#prodcategory').val();
                    var nafdacno = $('#nafdacno').val();
                    var prodserialno = $('#prodserialno').val();
                    var prodqty = $('#prodqty').val();     

                    var purchase_date = $('#purchase_date').val();
                    var expiring_date = $('#expiring_date').val();
                    var prodbrand = $('#prodbrand').val();
                  
                    if( purchase_date !="" && prodname !="" && prodprice !="" && prodcategory !="" && nafdacno !="" || prodserialno !="" || prodqty !=""  && expiring_date !="" || prodbrand !=""){
                      
                            $("#butsave").attr("disabled", "disabled");
                                    $.ajax({
                                        url: "<?php echo base_url("products/addproduct");?>",
                                        type: "POST",
                                        data: {
                                            type: 1,
                                            prodname,
                                            prodprice,
                                            prodcategory,
                                            nafdacno,
                                            prodserialno ,
                                            prodqty,
                                            purchase_date,
                                            expiring_date,
                                            prodbrand

                                        },
                                        cache: false,
                                        success: function(res){
                                        if(res == true ){
                                            //alert(' product created successfully ');
                                              //swal.fire('success','Product Created Successfully','success');
                                            toastr.success('Product Created Successfully ');
                                                $("#butsave").removeAttr("disabled");
                                                $('#fupForm').find('input:text').val('');
                                                $("#success").show();
                                               
                                        }else if(res ==false){
                                            toastr.error(' unable to crate product ');
                                            $("#butsave").removeAttr("disabled");
                                            $('#fupForm').find('input:text').val('');
                                            $("#success").show();
                                        } 
                                    }
                                });       

                    }else {
                        toastr.error(' Please Fill All Given Entries ');

                    }
                });
            });



    // // Get the barcode number from PHP
    // var barcodeNumber = "<?= $barcode_number; ?>";
    // // Generate barcode
    // JsBarcode("#barcode", barcodeNumber, {
    //     format: "CODE128",
    //     lineColor: "#000",
    //     width: 2,
    //     height: 100,
    //     displayValue: true
    // });

 </script> 


