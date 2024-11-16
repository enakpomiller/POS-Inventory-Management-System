

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
        <div class="col-xxl-8 m-b-30">
            <div class="card card-statistics h-100 mb-0">
            <div class="container mt-5 mb-5 col-md-9">
                <h4><?=$subtitle?></h4>
                <?= form_open(base_url('users/processCustomer')) ?>
                    <div class="form-group">
                          <label for="name">First Name</label>
                          <input type="text" class="form-control"  name="fname" value="<?=set_value('fname')?>" autocomplete="off" id="fname" placeholder="Enter your first name">
                           <div class="text-danger"><?=form_error('fname')?></div>
                    </div>


                    <div class="form-group">
                        <label for="email">Last Name</label>
                        <input type="text" class="form-control"   name="lname" value="<?=set_value('lname')?>" id="lname" autocomplete="off" placeholder="Enter your lastname">
                        <div class="text-danger"><?=form_error('lname')?></div>
                    </div>
                    <div class="form-group">
                        <label for="email"> Country</label>
                          <select name="country" id="country" value="<?=set_value('country')?>" class="form-control select2">
                              <option disabled> Select Country   </option>
                             <?php foreach($countries as $county) { ?>
                                <option value="<?=$county->id?>">  <?=$county->country." "."(".$county->shortName.")" ?> </option>
                             <?php }?>
                          </select>
                          <div class="text-danger"><?=form_error('country')?></div>
                    </div>

                    <div class="form-group">
                        <label for="email"> PHone number* </label>
                           <input type="text" class="form-control" value="<?=set_value('phone')?>" name="phone"  id="phone" autocomplete="off" placeholder="Enter Phone Number">
                        <div class="text-danger">
                           <?php echo "<div class='text-danger'>".form_error('phone')."</div>"; ?>

                        </div>

                    </div>

                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="text" class="form-control" value="<?=set_?>" name="email"  id="email" autocomplete="off" placeholder="Enter Email">
                        <div class="text-danger"><?=form_error('email')?></div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" id="butsave"  class="btn id= text-light" style="width:100%;background:#8e54e9;"> Create Record </button>
                    </div>
                </form>
            </div>


        </div>
        </div>
        <div class="col-xxl-4 m-b-30">
            <div class="card card-statistics h-100 mb-0">
                <div class="card-header">
                    <h4 class="card-title">User Feedback</h4>
                </div>
                <div class="card-body">
                    <div class="mb-1">
                        <div class="d-flex">
                            <p>Positive</p>
                            <h5 class="text-muted ml-auto mb-0">4251</h5>
                        </div>
                        <div class="progress progress-sm m-b-10" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="d-flex">
                            <p>Negative</p>
                            <h5 class="text-muted ml-auto mb-0">1459</h5>
                        </div>
                        <div class="progress progress-sm m-b-10" style="height: 5px;">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="apexchart-wrapper">
                    <div id="datingdemo4"></div>
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

//     $(document).ready(function() {
//     $('#butsave').on('click', function(event) {
//         event.preventDefault(); // Prevent the default form submission

//         var fname = $('#fname').val();
//         var lname = $('#lname').val();
//         var country = $('#country').val();
//         var phone = $('#phone').val();
//         var email = $('#email').val();

//         if(fname !== "" && lname !== "" && country !== "" && phone !== "" && email !== "") {
//             if(phone.length < 11) {
//                      //toastr.error('Sorry! Phone Number Should be 11 digits and above');
//                 $(".line_error").html("Phone Number Must be 11 digits or more");
//             } else {
//                 $("#butsave").attr("disabled", "disabled");
//                 $.ajax({
//                     url: "<?php  echo base_url('users/processCustomer'); ?>",
//                     type: "POST",
//                     data: {
//                         type: 1,
//                         fname: fname,
//                         lname: lname,
//                         country: country,
//                         phone: phone,
//                         email: email
//                     },
//                     cache: false,
//                     success: function(res) {
//                         if(res == "200") {
//                             window.location = "<?=base_url('products/order')?>";
//                         } else if(res == "201") {
                            // toastr.error('Sorry! unable to create customer');
                            // $("#butsave").removeAttr("disabled");
                            // $('#fupForm').find('input:text').val('');
//                         }

//                     },
//                     error: function(xhr, status, error) {
//                         toastr.error('Error: ' + error);
//                         $("#butsave").removeAttr("disabled");
//                     }
//                 });
//             }
//         } else {
//             toastr.error('Please Fill All Given Entries');
//         }
//     });
// });

</script>
