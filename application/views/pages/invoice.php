



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



            <div class="row justify-content-center">
                <div class="col-xxl-9 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                    <div class="container mt-5 mb-5 col-md-9">
                        <h4><?=$title." status"?></h4>

                        <form>
                        <div class="row">
                     
                            <div class="col-md-6">
                                <p>
                                  POS inventory System
                                  76A Kuburat Okoya Lane, Eleganza Garden Estate Opp VGC Lagos, Nigeria
                                </p>
                                
                            </div>
                            <div class="col-md-6 text-right">
                                 <p> Contact Address 
                                   www.inventorymamagement.com
                                    inventory@gmail.com <br>
                                    +23409087898789
                                     </p> 
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




 </script> 


