

   <!-- jQuery (required by Toastr) -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            <?php if ($this->session->flashdata('toastr')){ ?>
                toastr.<?php echo $this->session->flashdata('toastr')['type']; ?>('<?php echo $this->session->flashdata('toastr')['message']; ?>');
            <?php }else{?>
                toastr.<?php echo $this->session->flashdata('toastr')['type']; ?>('<?php echo $this->session->flashdata('toastr')['message']; ?>');
             <?php } ?>
        });
    </script>

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

                             <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="<?=base_url('/')?>"><i class="ti ti-timer"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       <?php 
                                          date_default_timezone_set('Africa/Lagos');
                                          $timer =  date('H'); 
                                          echo date('Y-m-d H:i:s');
                                        ?>
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">
                                 <?php
                                    if($timer ==00){
                                        echo " Good Morning ".$this->session->username;
                                      }elseif($timer <= 11){
                                        echo " Good Morning ".(ucfirst($this->session->username));
                                      }elseif($timer == 12 || $tminer ==13 || $timer ==14 || $timer == 15 || $timer == 16 || $timer == 17){
                                        echo " Good Afternoon".$this->session->username;
                                      }else{
                                        echo " Good Evening ".$this->session->username;
                                     }
                                 ?>
                                        </li>
                                </ol>
                            </nav>

                           
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
                        <h2>User Form</h2>
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                            </div>                            
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="subscribe">
                                <label class="form-check-label" for="subscribe">Subscribe to newsletter</label>
                            </div>
                            <button type="submit" class="btn btn-primary"> Create User </button>
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
