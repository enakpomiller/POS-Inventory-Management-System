
  <style>
    .select2-container .select2-selection--single {
        height: 40px;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 18px; /* Adjust based on the desired padding */
    }

    .select2-container--default .select2-selection--multiple {
        padding: 5px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        line-height: 28px; /* Adjust based on the desired padding */
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
                        <h2>Role Form</h2>
                            <?//=form_open(base_url('users/processstaffrole')) ?>
                            <div class="form-group">
                                <label for="name"> Role </label>
                                 <input type="hidden" name="userID" id="userID" value="<?=$_SESSION['userID']?>">
                                        <select name="office" id="office" class="form-control select2" style="padding:20px;">
                                            <?php 
                                                if (!empty($staffrole)) {
                                                    foreach ($staffrole as $num_roles) {
                                                        // Determine if the current role should be selected
                                                        $selected = ($num_roles->staffrole == $office) ? "selected" : "";
                                                        
                                                        // Output the option element with properly escaped values
                                                        echo "<option value='" . htmlspecialchars($num_roles->staffrole) . "' $selected>" . htmlspecialchars($num_roles->staffrole) . "</option>";
                                                    }
                                                }
                                            ?>
                                       </select>
                              
                            </div>

                            <div>
                                <label for="basiInput" class="form-label pt-2"> Previlleges </label>
                               </div>
                              <?php foreach($getroles as $allroles) {  ?>
                                <div class="list-group-item clearfix">
                                    <input type="checkbox"   name="user_roles[]" id="user_roles" value="<?=$allroles->roleID?>" <?=$allrole->roleID=='9'?'checked':'' ?> >
                                    <?php echo $allroles->role_name;?>
                                </div>
                              <?php }?>
                            
                            <div class="form-group mt-4">
                                <button type="submit" id="butsave"  class="btn id= text-light" style="width:20%;background:#8e54e9;"> Create Role  </button>
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


<!-- 
    <script>
$(document).ready(function() {
	$('#butsave').on('click', function() {
         //location.reload();
		  var userid = $('#userID').val();
		 var office = $('#office').val();


          var roles = [];
            $('input[name="user_roles[]"]:checked').each(function() {
                roles.push($(this).val());
            });


      
		if(userid!="" && office!="" && roles!=""){
			 $("#butsave").attr("disabled", "disabled");
			$.ajax({
				url: "<?php echo base_url("users/processstaffrole");?>",
				type: "POST",
				data: {
					type: 1,
					userid,
                    office,
                    roles
			
				},
				cache: false,
				success: function(res){
					if(res == '400'){

						//  $("#butsave").removeAttr("disabled");
						// $('#fupForm').find('input:text').val('');
						// $("#success").show();
						// $('#success').html('Data added successfully !'); 
                        alert('success');						
					}
					else if(res == false){
					   alert("Error occured !");
					}
					
				}


			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});
</script> -->



   <script>
        $(document).ready(function() {
            $('#butsave').on('click', function() {
                var userid = $('#userID').val();
                var office = $('#office').val();
                var roles = [];
                $('input[name="user_roles[]"]:checked').each(function() {
                    roles.push($(this).val());
                });

                if(userid != "" && office != "" && roles.length > 0){
                    $("#butsave").attr("disabled", "disabled");
                    $.ajax({
                        url: "<?php echo base_url('users/processstaffrole'); ?>",
                        type: "POST",
                        data: {
                            type: 1,
                            userid: userid,
                            office: office,
                            roles: roles
                        },
                        cache: false,
                        success: function(res){
                            if(res == true){
                                toastr.success(' Privillege Assigned Successfully ');                    
                            }
                            else if(res == 'false'){
                            toastr.success(' Unable to  Assigned Privillege');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle any errors
                            alert("An error occurred: " + xhr.responseText);
                        },
                        complete: function() {
                            // Re-enable the submit button
                            $("#butsave").removeAttr("disabled");
                        }
                    });
                }
                else{
                    toastr.error(' Please  select optional entris   ');
                }
            });
        });


</script>

