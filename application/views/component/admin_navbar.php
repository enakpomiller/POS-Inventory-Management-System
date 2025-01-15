
<!-- begin app-container -->

    <!-- begin app-nabar -->
    <aside class="app-navbar">
        <!-- begin sidebar-nav -->

        <div class="sidebar-nav scrollbar scroll_ligh bg-infot">



            <ul class="metismenu " id="sidebarNav">


                <?php if($this->session->role == 'Staff'){?>

                          <?php
                            $this->db->where('userID',$this->session->userID );
                            $getuserID = $this->db->get('tbl_privilleges')->row();

                            if($getuserID){  ?>
                                    <li class="text-light text-center" > <?="Role: ".$getuserID->office?>  </li>
                                    <a class="text-light" href="<?=base_url('dashboard')?>"><center> Dashboardxx </center> </a>
                                    <?php if(in_array('1', json_decode($getuserID->user_roles))){ ?>
                                               <li class="active">
                                                <a class="has-arrow" href="" aria-expanded="false">
                                                    <i class="nav-icon ti ti-rocket"></i>
                                                    <span class="nav-title"> User Management  </span>
                                                    <span class="nav-label label label-danger">9</span>
                                                </a>
                                                <ul aria-expanded="false">
                                                   <li> <a href="<?=base_url('users/create_manager')?>" class="nav-link<?=$this->uri->segment(2)=='create_manager'?'active':''?>" aria-expanded="false"><i class="nav-icon ti ti-email"></i><span class="nav-title"> Create User </span></a> </li>
                                                    <li> <a href='<?=base_url('users/manageusers')?>'><i class="fa fa-eye"></i> View All  Users </a> </li>
                                                </ul>
                                            </li>
                                                    <!-- <li class="active">
                                                        <a class="has-arrow" href="" aria-expanded="false">
                                                            <i class="nav-icon ti ti-rocket"></i>
                                                            <span class="nav-title">Invoice Management   </span>
                                                            <span class="nav-label label label-danger">9</span>
                                                        </a>
                                                        <ul aria-expanded="false">
                                                            <li> <a href='index-crm.html'> Create New Product  </a> </li>
                                                            <li> <a href='index-real-estate.html'> View Staff Records </a> </li>
                                                            <li> <a href="<?=base_url('users/create_manager')?>"> Create Staff Account </a> </li>
                                                        </ul>
                                                    </li> -->
                                                    <!-- <li class="active">
                                                        <a class="has-arrow" href="" aria-expanded="false">
                                                            <i class="nav-icon ti ti-rocket"></i>
                                                            <span class="nav-title"> Sales Management    </span>
                                                            <span class="nav-label label label-danger">9</span>
                                                        </a>
                                                        <ul aria-expanded="false">
                                                            <li> <a href='index-crm.html'> Create New Order  </a> </li>
                                                            <li> <a href='index-real-estate.html'> Confirm Order  </a> </li>
                                                            <li> <a href="<?=base_url('users/create_manager')?>"> View Order History  </a> </li>
                                                        </ul>
                                                    </li> -->

                                  <?php  }if(in_array('3',json_decode($getuserID->user_roles))){ ?>
                                    <li class="active">
                                        <a class="has-arrow" href="" aria-expanded="false">
                                            <i class="nav-icon ti ti-rocket"></i>
                                            <span class="nav-title"> Sales Management    </span>
                                            <span class="nav-label label label-danger">9</span>
                                        </a>
                                        <ul aria-expanded="false">
                                            <li> <a href='<?=base_url('users/addcustomers')?>'><i class="fa fa-book"></i>  Create Customers  </a> </li>
                                            <li> <a href="<?=base_url('')?>"> <i class="fa fa-eye"></i> View Order History  </a> </li>
                                            <li> <a href="<?=base_url('products/viewallinvoice')?>"> <i class="fa fa-eye"></i> View  All Invoices  </a> </li>
                                        </ul>
                                    </li>
                                    <?php  }if(in_array('2', json_decode($getuserID->user_roles))) { ?>

                                            <li class="active">
                                                <a class="has-arrow" href="" aria-expanded="false">
                                                    <i class="nav-icon ti ti-rocket"></i>
                                                    <span class="nav-title">Inventory Management   </span>
                                                    <span class="nav-label label label-danger">9</span>
                                                </a>
                                                <ul aria-expanded="false">
                                                    <li> <a href='<?=base_url("products/addproduct")?>'> Create Product  </a> </li>
                                                    <li> <a href='<?=base_url("products/add_multiple_prod")?>'> Add Multiple   </a> </li>
                                                    <li> <a href="<?=base_url('products/viewprod')?>"> View Products </a> </li>
                                                    <li> <a href="<?=base_url('products/printbarcode')?>"> Print Barcodes </a> </li>
                                                </ul>
                                            </li>
                                    <?php }if(in_array('4', json_decode($getuserID->user_roles))) {?>

                                        <li class="active">
                                                <a class="has-arrow" href="" aria-expanded="false">
                                                    <i class="nav-icon ti ti-rocket"></i>
                                                    <span class="nav-title">Log Management   </span>
                                                    <span class="nav-label label label-danger">9</span>
                                                </a>
                                                <ul aria-expanded="false">
                                                    <li> <a href='<?=base_url("products/addproduct")?>'>  Login Logs  </a> </li>
                                                    <li> <a href='<?=base_url("products/add_multiple_prod")?>'> Feature Access Logs  </a> </li>


                                                </ul>
                                            </li>
                                    <?php }if(in_array('5', json_decode($getuserID->user_roles))){ ?>
                                            <li class="active">
                                                <a class="has-arrow" href="" aria-expanded="false">
                                                    <i class="nav-icon ti ti-rocket"></i>
                                                    <span class="nav-title">Customer Management   </span>
                                                    <span class="nav-label label label-danger">9</span>
                                                </a>
                                                <ul aria-expanded="false">
                                                    <li> <a href='<?=base_url("users/addcustomers")?>'>  Creatte Customer </a> </li>
                                                    <li> <a href='<?=base_url("products/add_multiple_prod")?>'> View Customer History </a> </li>


                                                </ul>
                                            </li>
                                     <?php }else{ ?>
                                         <?="<p class='text-center'>No Role Yet </p>"?>
                                       <?php } ?>


                          <?php } else{ ?>

                                    <li class="active">
                                        <a class="has-arrow" href="" aria-expanded="false">
                                            <i class="nav-icon ti ti-rocket"></i>
                                            <span class="nav-title"> User Management  </span>
                                            <span class="nav-label label label-danger">9</span>
                                        </a>
                                        <ul aria-expanded="false">
                                            <li> <a href="<?=base_url('users/create_manager')?>" class="nav-link<?=$this->uri->segment(2)=='create_manager'?'active':''?>" aria-expanded="false"><i class="nav-icon ti ti-email"></i><span class="nav-title"> Create User </span></a> </li>
                                            <li> <a href='<?=base_url('users/manageusers')?>'><i class="fa fa-eye"></i> View All  Users </a> </li>
                                            <li> <a href="<?=base_url('users/create_manager')?>"> Create Staff Account </a> </li>
                                        </ul>
                                    </li>
                          <?php } ?>

        <?php }else{ ?>
                <!-- <li class="active">
                    <a class="has-arrow" href="" aria-expanded="false">
                        <i class="nav-icon ti ti-rocket"></i>
                        <span class="nav-title"> Menu Options</span>
                        <span class="nav-label label label-danger">9</span>
                    </a>
                    <ul aria-expanded="false">
                        <li> <a href='index.html'>Default</a> </li>
                        <li> <a href='index-ecommerce.html'>Ecommerce</a> </li>
                        <li> <a href='index-car-dealer.html'>Car Dealer</a> </li>
                        <li> <a href='index-stock-market.html'>Stock Market</a> </li>
                        <li class="active"> <a href='index-dating.html'>Dating</a> </li>
                        <li> <a href='index-job-portal.html'>Job Portal</a> </li>
                        <li> <a href='index-crm.html'>CRM</a> </li>
                        <li> <a href='index-real-estate.html'>Real Estate</a> </li>
                        <li> <a href='index-crypto-currency.html'>Crypto Currency</a> </li>
                    </ul>
                </li> -->

              <li class="text-light text-center" > <?=$this->session->role?>  </li>
              <a class="text-light" href="<?=base_url('dashboard')?>"><center>Back To Dashboard </center> </a>
                <li class="active">
                    <a class="has-arrow" href="" aria-expanded="false">
                        <i class="nav-icon ti ti-rocket"></i>
                        <span class="nav-title">Inventory Management   </span>
                        <span class="nav-label label label-danger">9</span>
                    </a>
                    <ul aria-expanded="false">
                        <li> <a href='<?=base_url("products/addproduct")?>'> Create Product  </a> </li>
                        <li> <a href='<?=base_url("products/add_multiple_prod")?>'> Add Multiple   </a> </li>
                        <li> <a href="<?=base_url('products/viewprod')?>"> View Products </a> </li>
                        <li> <a href="<?=base_url('products/printbarcode')?>"> Print Barcodes </a> </li>
                    </ul>
                </li>
                <li> <a href="<?=base_url('products/viewallinvoice')?>"> <i class="fa fa-eye"></i> View  All Invoices  </a> </li>
               <li> <a href="<?=base_url('users/create_manager')?>" class="nav-link<?=$this->uri->segment(2)=='create_manager'?'active':''?>" aria-expanded="false"><i class="nav-icon ti ti-email"></i><span class="nav-title"> Create User </span></a> </li>
               <li> <a href='<?=base_url('users/manageusers')?>'><i class="fa fa-eye"></i> View All  Users </a> </li>

         <?php  } ?>


     </ul>
</div>
        <!-- end sidebar-nav -->
    </aside>
    <!-- end app-navbar -->
