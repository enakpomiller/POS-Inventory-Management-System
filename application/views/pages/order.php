

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
                        <input type="number" class="form-control" id="quantity"  name="prodqty" autocomplete="off"  placeholder="tqy">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name"> Total </label>
                        <input type="number" class="form-control" id="totalPrice" name="prodtotal" autocomplete="off"  placeholder=" ">
                    </div>
                </div>
                <div class="col-md-2" style="position:relative;top:30px;">
                    <div class="form-group">
                       <button class="btn btn-primary"> Add Product </button>
                    </div>
                </div>
            </div>    
       </form>
            </div>

         </div>
        </div>

    </div>


    <div id="strength">Weak password!</div>
    <!-- end row -->
</div>
<!-- end container-fluid -->
</div>
<!-- end app-main -->

 <script>
    $(document).ready(function() {
        $('#butsave').on('click', function() {
               //location.reload();
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var phone = $('#phone').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var confpass = $('#confpass').val();
            

            if(fname!="" && lname!="" && phone!="" && username!="" || password!="" || confpass !=""){
              
                if(password.length < 7){
                    toastr.error(' Sorry! Password should be more than 8 characters ');

                 }else if(phone.length < 11){
                    toastr.error(' Sorry! Phone Number Should be 11 digits and above');
                  }else{ 
                       $("#butsave").attr("disabled", "disabled");
                            $.ajax({
                                url: "<?php echo base_url("users/process_manager");?>",
                                type: "POST",
                                data: {
                                    type: 1,
                                    fname,
                                    lname,
                                    phone,
                                    username,
                                    password,
                                    confpass
                                },
                                cache: false,
                                success: function(res){
                                if(res == '401' ){
                                    toastr.error(' Sorry! Password Mismatch ');
                                        $("#butsave").removeAttr("disabled");
                                        $('#fupForm').find('input:text').val('');
                                        $("#success").show();
                                }else if(res == true){
                                    window.location = "<?=base_url('users/assign_role')?>";
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
