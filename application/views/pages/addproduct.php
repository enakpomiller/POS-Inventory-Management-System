




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


                        <div class="row">
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="name">Product  Name</label>
                                    <input type="text" class="nput100 form-control"  name="fname" autocomplete="off" id="fname">
                                </div>
                             <div class="form-group">
                                 <label for="name">Product Category </label>
                                 <input type="text" class="nput100 form-control"  name="fname" autocomplete="off" id="fname">
                              </div>

                             <div class="form-group">
                                  <label for="email">Product Price</label>
                                  <input type="text" class="nput100 form-control"   name="lname" id="lname" autocomplete="off">
                             </div>

                              <div class="form-group">
                                   <label for="email"> NAFDAC Reg N0</label>
                                   <input type="text" class="nput100 form-control" name="phone"  id="phone" autocomplete="off">
                               </div> 
                              <div class="form-group">
                                   <label for="email"> Product Serial Number  </label>
                                   <input type="text" class="nput100 form-control" name="username"  id="username" autocomplete="off">
                               </div> 
                            </div>


                         <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email">  Quantity</label>
                                  <input type="number" class="input100 form-control" name="password"  id="password" autocomplete="off">
                               </div> 
                              <div class="form-group">
                                  <label for="email"> Date Purchased  </label>
                                   <input type="date" class="input100 form-control" name="confpass"  id="confpass" autocomplete="off">
                               </div> 
                              <div class="form-group">
                                   <label for="email"> Expiry Date  </label>
                                  <input type="text" class="input100 form-control" name="confpass"  id="confpass" autocomplete="off">
                              </div> 
                               <div class="form-group">
                                   <label for="email"> Brand  </label>
                                  <input type="date" class="input100 form-control" name="confpass"  id="confpass" autocomplete="off">
                               </div> 
                              


                               <div class="form-group mt-4">
                               <input type="checkbox"  name="confpass" required  id="confpass" autocomplete="off" placeholder="Confirm Password"> I Agree to consent 
                                  <!-- <button type="submit" class="btn btn-primary" id="butsave"> Proceed </button> -->
                                  <button type="submit" id="butsave"  class="btn id= text-light" style="width:100%;background:#8e54e9;"> Create Product </button>
                               </div>
                            </div>
                        </div>
                    </form>
                  </div>
                   




                 </div>
            </div>

                

           



                                <!-- 
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
                                </div> -->



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
                    var fname = $('#fname').val();
                    var lname = $('#lname').val();
                    var phone = $('#phone').val();
                    var username = $('#username').val();
                    var password = $('#password').val();
                    var confpass = $('#confpass').val();
                  
                    if(fname!="" && lname!="" && phone!="" && username!="" || password!="" || confpass !=""){
                      
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
                                        if(res == '400' ){
                                            toastr.info(' Sorry! This user already exist or Password mismatch, please check entries ');
                                                $("#butsave").removeAttr("disabled");
                                                $('#fupForm').find('input:text').val('');
                                                $("#success").show();
                                        }else if(res == true){
                                            window.location = "<?=base_url('users/assign_role')?>";
                                        }else{
                                            toastr.error(' please check enyries before submision ');
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