

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

            <div class="container mt-5 mb-5 col-md-11">
                <h3><?=$title?></h3>
                    <div class="row">
                    <div class="col-md-4">
                <?= form_open(base_url('products/process_createorder')) ?>
                    <div class="form-group">
                        <label for="name"> Select Product</label>
                        <select name="prodID" class="form-control select" id="mySelect">
                            <option disabled>select</option>
                             <?php foreach($allprod as $prod) { ?>
                                 <option value="<?=$prod->prodID?>"> <?=$prod->prodname?>   </option>
                              <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name"> Price  </label>
                        <input type="text" class="form-control" id="records"  name="prodprice" autocomplete="off"  placeholder=" price ">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name"> Quantity </label>
                        <input type="number" class="form-control" id="quantity"  name="prodqty" autocomplete="off"  placeholder="QTY">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name"> Total </label>
                        <input type="number" class="form-control" id="totalPrice" name="totalprice" autocomplete="off"  placeholder=" Total Price ">
                    </div>
                </div>
                <div class="col-md-2" style="position:relative;top:30px;">
                    <div class="form-group">
                       <button class="btn btn-primary"> Add Product </button>
                    </div>
                </div>
            </div>    
        </form>

             
       <?php if($allorder){ ?>
       
               <div class="page-title mt-4 mb-sm-0">
                    <h4> <?=$this->session->fname." Ordered Items"?>  </h4>
               </div>
   
        <table class="table table-hover mt-4">
             <thead class="bg-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col"> Product Name</th>
                <th scope="col"> Product Price </th>
                <th scope="col">Quantity</th>
                <th scope="col"> Total Amount </th>
                <th scope="col" class="text-right"> Action  </th>
                </tr>
            </thead>
            <tbody>
            <?php $counter =1; foreach($allorder as $orders){  ?>
                <tr id="<?=$orders->orderID?>">
                  <th scope="row"><?=$counter++?></th>
                    <td> <?=$orders->prodname?> </td>
                    <td> <?=$orders->price?> </td>
                    <td> <?=$orders->prodqty?> </td>
                      <td>
                        <?=number_format(($orders->price)*($orders->prodqty),2)?>
                      </td>
                    <td> 
                    <a href=""  class="btn btn-danger remove" style="float:right;" title="delete record"><i class="fa fa-trash"></i></a> 
                    <a href="" class="btn btn-primary" style="float:right;" title="Edit record" data-toggle="modal"  data-target="#exampleModal<?=$orders->orderID?>"><i class="fa fa-pencil"></i></a>
                  </td>
                 </tr>

            <!-- modal -->
            <div class="modal fade" id="exampleModal<?=$orders->orderID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel"><p>  Edit Qty </p> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?=base_url('products/updateorderqty')?>" method="POST">
                        <div class="modal-body">
                            <label> Product Quantity  </label>
                        <input type="hidden" name="prodid" id="prodid"  class="form-control" value="<?=$orders->orderID?>">
                        <input type="number" name="prodqty" id="prodqty"  class="form-control" value="<?=$orders->prodqty?>">
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
        <?php }else{?>
            <center><img src="<?=base_url('assets/img/browser-logo/cart.png')?>" style="width:17%"></center>
           <h4 class="mt-4 text-center" style="position:relative;top:0px;"> Cart is Empty  </h4>
          <?php } ?>

          <form action="<?=base_url('products/processpayment')?>" method="POST">
             <div class="row mt-4" style="position:relative;top:20px;">

             <div class="col-md-4">
                    <div class="form-group">
                        <label for="paymentmethod"> Payment Method </label>
                             <?php
                                $payment_arr = [
                                    'Online Banking'=>"Online Banking",
                                    'Offline Banking'=> "Offline Banking",
                                    'Cash' => "Cash",
                                     'POS' => "POS",
                                     'Transfer' =>"Transfer"
                                ];
                            ?>
                         <select name="paymentmethod" class="form-control" required>
                                <option disabled>    select payment method </option>
                              <?php foreach($payment_arr as $payment){ ?>
                                    <option> <?=$payment?>    </option>
                               <?php }?>
                         </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="paymentmethod"> Payment Status </label>
                             <?php
                                $payment_arr = [
                                    'Paid'=>" Paid",
                                    'Partially Paid'=> "Partially Paid",
                                    'Pending' => "Pending",
                                    'Refund' => "Refund",
                                    'Unpaid' =>"Unpaid"
                                ];
                                ?>
                         <select name="paymentstatus" required class="form-control">
                                <option disabled>    select payment Status </option>
                              <?php foreach($payment_arr as $payment){ ?>
                                    <option> <?=$payment?>    </option>
                               <?php }?>
                         </select>
                    </div>
                </div>
                <div class="col-md-4" style="margin-top:30px;">
                    <div class="form-group">
                        <button class="btn btn-primary w-100"> Proceed to Place Order </button>
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

 <script>
    $(document).ready(function() {
        $('#butsave').on('click', function() {
             //location.reload();
            var prodid = $('#prodid').val();
            var prodqty = $('#prodqty').val();
            

            if(prodid!="" && prodqty!=""){
              
                if(password.length < 7){
                    toastr.error(' Sorry! Password should be more than 8 characters ');

                 }else if(phone.length < 11){
                    toastr.error(' Sorry! Phone Number Should be 11 digits and above');
                  }else{ 
                       $("#butsave").attr("disabled", "disabled");
                            $.ajax({
                                url: "<?php echo base_url("products/updateorderqty");?>",
                                type: "POST",
                                data: {
                                    type: 1,
                                    prodid,
                                    prodqty
                             
                                },
                                cache: false,
                                success: function(res){
                                if(res == '401' ){
                                    toastr.error(' Sorry! Password Mismatch ');
                                        $("#butsave").removeAttr("disabled");
                                        $('#fupForm').find('input:text').val('');
                                        $("#success").show();
                                }else if(res == true){
                                    window.location = "<?=base_url('products/order')?>";
                                }else{
                                    toastr.error(' User Already Exist ');
                                  $("#butsave").removeAttr("disabled");
                                    $('#fupForm').find('input:text').val('');
                                    $("#success").show();
                                }
                            }
                        });

                    }


            }else {
                toastr.error(' Please Fill All Given Entries ');

            }
        });
    });


        // Function to handle onchange event
        $('#mySelect').change(function() {
        var selectedValue = $(this).val(); // Get the selected value

        // Send AJAX request to the server
        $.ajax({
            url: '<?php echo base_url("products/fetch_records"); ?>',
            type: 'POST',
            data: {selected_value: selectedValue}, // Pass selected value to the server
            success: function(response) {
              if(response){
                var responseData = JSON.parse(response);
                      //var id = responseData.id;
                var prodprice = responseData.prodprice;
                // Display the fetched records in the 'records' div
                $('#records').val(prodprice);
                     //$('#facID').val(id);
              }else{
                alert(' faculty not found ');
              }

            }
        });
    });


    $(".remove").click(function(event){
        event.preventDefault();
            var id = $(this).parents("tr").attr("id");
      
            if(confirm(' ARE YOU SURE YOU WANT TO DELETE THIS PRODUCT ?'))

            {
                $.ajax({
                url: '<?=base_url('products/deleteorder/')?>'+id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if(data == true){
                        $("#"+id).remove();
                        //alert("Record removed successfully");
                        swal.fire("success"," PRODUCT REMOVED SUCCESSFULLY ","success");
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



    document.addEventListener('DOMContentLoaded', (event) => {
            const itemPriceInput = document.getElementById('records');
            const quantityInput = document.getElementById('quantity');
            const totalPriceInput = document.getElementById('totalPrice');

            // Function to calculate and update total price
            const updateTotalPrice = () => {
                const itemPrice = parseFloat(itemPriceInput.value);
                const quantity = parseInt(quantityInput.value);
                const totalPrice = itemPrice * quantity;
                totalPriceInput.value = totalPrice.toFixed(2); // Format to 2 decimal places
            };

            // Event listener for quantity input changes
            quantityInput.addEventListener('input', updateTotalPrice);
        });

</script>
