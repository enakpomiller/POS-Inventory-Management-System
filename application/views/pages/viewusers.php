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



            <div class="row">
                <div class="col-xxl-12 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                    <div class="container mt-5 mb-5 col-md-12">
                        <h4><?=$title?></h4>
               <?php if(!empty($allusers)) { ?>
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col"> Last Name</th>
                                    <th scope="col"> Phone Number  </th>
                                    <th scope="col"> Role </th>
                                    <th scope="col"> Username </th>
                                    <th scope="col"> Password</th>
                                    <th scope="col" class="text-center"> Action  </th>
                                </tr>
                            </thead>
                            <tbody>

                                  <?php
                                  $counter =1;   //foreach($allprod as $product) {
                                    foreach($allusers as $index => $user) {
                                     ?>
                                   <tr id="<?=$user->userID?>">
                                       <td>  <?=$counter++?>  </td>
                                        <td>  <?=$user->fname?></td>
                                        <td>  <?=$user->lname?></td>
                                        <td>  <?=$user->phone?></td>
                                        <td>  <?=$user->office?></td>
                                        <td>  <?=$user->username?></td>
                                        <td>  <?=$user->plainpassword?></td>
                                        <td>
                                            <button type="submit" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>
                                            <a href="<?=base_url('users/resetpassword/'.$user->userID)?>" class="btn btn-primary" onclick="return confirm('Do you wish to proceed?')"> Reset Password   </a>
                                            <button type="submit" class="btn btn-primary" data-toggle="modal"  data-target="#exampleModal<?=$user->userID?>"><i class="fa fa-pencil"></i></button>
                                        </td>
                                   </tr>

                                     <!-- modal -->
                                        <div class="modal fade" id="exampleModal<?=$user->userID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title" id="exampleModalLabel"><p>  Edit Staff Details</p> </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                               <form action="<?=base_url('users/updateusers')?>" method="POST">
                                                    <div class="modal-body">
                                                    <input type="text" name="userID"  class="form-control" value="<?=$user->userID?>">
                                                    <div class="form-group">
                                                        <label> First Name </label>
                                                        <input type="text" name="fname"  class="form-control" value="<?=$user->fname?>">
                                                    </div>
                                                    <div class="form-group">
                                                       <label> Last Name </label>
                                                        <input type="text" name="lname" class="form-control" value="<?=$user->lname?>">
                                                    </div>
                                                    <div class="form-group">
                                                    <label> Phone Number </label>
                                                        <input type="text" name="phone" class="form-control" value="<?=$user->phone?>">
                                                    </div>
                                                    <div class="form-group">
                                                    <label> Ofice/Role </label>
                                                         <select name ="office" class="form-control"> 
                                                               <option disabled>Select Office </option>
                                                              <?php foreach($roles as $staff) { ?>
                                                                  <option value="<?=$staff->staffrole?>"> <?=$staff->staffrole?> </option>
                                                               <?php } ?>
                                                            </select>
                                                    </div>

                                                    <div class="form-group">
                                                    <label> Username </label>
                                                        <input type="text" name="username" readonly class="form-control" value="<?=$user->username?>">
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
                               <?= "<h4> No Rcord Found Yet! </h4> " ?>
                           </center>

                      <?php } ?>


                  </div>
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

            if(confirm(' ARE YOU SURE YOU WANT TO DELETE THIS USER ?'))

            {
                $.ajax({
                url: '<?=base_url('users/deleteproduct/')?>'+id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if(data == true){
                        $("#"+id).remove();
                        //alert("Record removed successfully");
                        swal.fire("success"," USER RECORDDELETED SUCCESSFULLY","success");
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



        $(".resetpassword").click(function(){
            var id = $(this).parents("tr").attr("id");

            if(confirm('ARE YOU SURE YOU WANT TO RESET PASSWORD?')){
                $.ajax({
                    url: '<?=base_url('users/resetpassword/')?>'+id,
                    type: 'POST',  // Use POST instead of DELETE for this type of action
                    error: function() {
                        Swal.fire("Error", "Something is wrong", "error");
                    },
                    success: function(data) {
                        if(data == "true") {  // Assuming the server returns a string "true"
                             //location.reload();
                            Swal.fire("Success", "Password successfully reset", "success");
                        } else {
                            Swal.fire("Error", "Unable to reset password", "error");
                        }
                    }
                });
            } else {
                Swal.fire("Cancelled", "Action is cancelled", "error");
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

</script>
