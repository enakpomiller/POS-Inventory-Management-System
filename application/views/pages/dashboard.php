




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
                            <h1> Dashboard </h1>

                            <ol class="breadcrumb p-0 m-b-0 pt-4">
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
                                        echo " Good Morning ".(ucfirst($this->session->title." ".($this->session->firstname) ));
                                      }elseif($timer == 12 || $tminer ==13 || $timer ==14 || $timer == 15 || $timer <= 16){
                                        echo " Good Afternoon ".(ucfirst($this->session->title." ".($this->session->firstname) ));
                                      }else{
                                        echo " Good Evening ".$this->session->title." ".(ucfirst($this->session->firstname));
                                     }
                                 ?>
                                        </li>
                                </ol>
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
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Dating</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end page title -->
                </div>
            </div>
            <!-- end row -->
            <!-- begin row -->
            <div class="row">
                <div class="col-lg-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                        <div class="card-body">
                            <div class="d-flex h-100">
                                <div class="align-self-center">
                                    <div class="apexchart-wrapper">
                                        <div id="datingdemo5"></div>
                                    </div>
                                </div>
                                <div class="align-self-center ml-auto">
                                    <h3 class="f-26 mb-0"><span class="count">45.8k</span></h3>
                                    <p class="text-muted mb-0">New User</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                        <div class="card-body">
                            <div class="d-flex h-100">
                                <div class="align-self-center">
                                    <div class="apexchart-wrapper">
                                        <div id="datingdemo6"></div>
                                    </div>
                                </div>
                                <div class="align-self-center ml-auto">
                                    <h3 class="f-26 mb-0"><span class="count">64.6k</span></h3>
                                    <p class="text-muted mb-0">Free Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                        <div class="card-body">
                            <div class="d-flex h-100">
                                <div class="align-self-center">
                                    <div class="apexchart-wrapper">
                                        <div id="datingdemo7"></div>
                                    </div>
                                </div>
                                <div class="align-self-center ml-auto">
                                    <h3 class="f-26 mb-0"><span class="count">48.7k</span></h3>
                                    <p class="text-muted mb-0">Paid Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xxl-3 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                        <div class="card-body">
                            <div class="d-flex h-100">
                                <div class="apexchart-wrapper">
                                    <div id="datingdemo8"></div>
                                </div>
                                <div class="align-self-center ml-auto">
                                    <h3 class="f-26 mb-0"><span class="count">67.3k</span></h3>
                                    <p class="text-muted mb-0">Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-8 m-b-30">
                    <div class="card card-statistics h-100 mb-0">
                        <div class="card-header d-block d-sm-flex justify-content-between align-items-center">
                            <div class="card-heading mb-2 mb-sm-0">
                                <h4 class="card-title"> User Registrations</h4>
                            </div>
                            <div class="dropdown">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-light">Weekly </button>
                                    <button type="button" class="btn btn-light">Monthly</button>
                                    <button type="button" class="btn btn-light">Yearly</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="apexchart-wrapper">
                                <div id="datingdemo1" class="chart-fit"></div>
                            </div>
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
            <div class="row">
                <div class="col-xxl-3">
                    <div class="card card-statistics bg-gradient">
                        <div class="card-header border-0">
                            <h4 class="card-title text-white">Ad Mod</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="text-white">Enable for all users</p>
                                <div class="form-group ml-auto">
                                    <div class="checkbox checbox-switch switch-success">
                                        <label>
                                            <input type="checkbox" name="switch8" checked="">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <p class="text-white">Enable for free users</p>
                                <div class="form-group ml-auto">
                                    <div class="checkbox checbox-switch switch-success">
                                        <label>
                                            <input type="checkbox" name="switch8">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-statistics">
                        <div class="card-header border-0">
                            <h4 class="card-title">Users Upload Image</h4>
                        </div>
                        <div class="card-body datting-upload-image">
                            <div class="tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="successed-tab" data-toggle="tab" href="#successed" role="tab" aria-controls="successed" aria-selected="true">Successed</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show p-0 border-top" id="successed" role="tabpanel" aria-labelledby="successed-tab">
                                        <div class="d-flex align-items-center justify-content-between row">
                                            <div class="upload-image d-flex align-items-center col">
                                                <div class="icon-container m-r-10 img-icon img-icon-sm">
                                                    <i class="fa fa-male"></i>
                                                </div>
                                                <div class="report-details">
                                                    <h4 class="m-b-0">516</h4>
                                                    <p>Male</p>
                                                </div>
                                            </div>
                                            <div class="upload-image d-flex align-items-center col">
                                                <div class="icon-container m-r-10 img-icon img-icon-sm">
                                                    <i class="fa fa-female"></i>
                                                </div>
                                                <div class="report-details">
                                                    <h4 class="m-b-0">658</h4>
                                                    <p>Female</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade p-0 border-top" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                        <div class=" d-flex align-items-center justify-content-between row">
                                            <div class="upload-image d-flex align-items-center col">
                                                <div class="icon-container m-r-10 img-icon img-icon-sm">
                                                    <i class="fa fa-male"></i>
                                                </div>
                                                <div class="report-details">
                                                    <h4 class="m-b-0">879</h4>
                                                    <p>Male</p>
                                                </div>
                                            </div>
                                            <div class="upload-image d-flex align-items-center col">
                                                <div class="icon-container m-r-10 img-icon img-icon-sm">
                                                    <i class="fa fa-female"></i>
                                                </div>
                                                <div class="report-details">
                                                    <h4 class="m-b-0">957</h4>
                                                    <p>Female</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 m-b-30">
                    <div class="card card-statistics dating-contant h-100 mb-0">
                        <div class="card-header">
                            <h4 class="card-title">View all tickets</h4>
                        </div>
                        <div class="card-body pt-2 scrollbar scroll_dark" style="height: 300px">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">No.</th>
                                            <th class="border-top-0">User Name</th>
                                            <th class="border-top-0">Subject</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Date</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-muted">
                                        <tr>
                                            <td>00001</td>
                                            <td>
                                                <div class="bg-img">
                                                    <img class="img-fluid" src="assets/img/avtar/01.jpg" alt="user">
                                                </div>
                                                <p>Adrian Demiandro</p>
                                            </td>
                                            <td>Support Lead</td>
                                            <td>
                                                <label class="badge mb-0 badge-success-inverse">Completed</label>
                                            </td>
                                            <td>27/3/2018</td>
                                            <td>
                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>00002</td>
                                            <td>
                                                <div class="bg-img">
                                                    <img class="img-fluid" src="assets/img/avtar/02.jpg" alt="user2">
                                                </div>
                                                <p>Jenny Smithdro</p>
                                            </td>
                                            <td>Office Manager</td>
                                            <td>
                                                <label class="badge mb-0 badge-danger-inverse">Cancelled</label>
                                            </td>
                                            <td>29/3/2018</td>
                                            <td>
                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>00003</td>
                                            <td>
                                                <div class="bg-img">
                                                    <img class="img-fluid" src="assets/img/avtar/03.jpg" alt="user3">
                                                </div>
                                                <p>Brian Joedro</p>
                                            </td>
                                            <td>Sales Assistant</td>
                                            <td>
                                                <label class="badge mb-0 badge-warning-inverse">Pending</label>
                                            </td>
                                            <td>01/04/2018</td>
                                            <td>
                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>00004</td>
                                            <td>
                                                <div class="bg-img">
                                                    <img class="img-fluid" src="assets/img/avtar/04.jpg" alt="user4">
                                                </div>
                                                <p>Sandradro Garett</p>
                                            </td>
                                            <td>Integration Specialist</td>
                                            <td>
                                                <label class="badge mb-0 badge-success-inverse">Completed</label>
                                            </td>
                                            <td>10/04/2018</td>
                                            <td>
                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>00005</td>
                                            <td>
                                                <div class="bg-img">
                                                    <img class="img-fluid" src="assets/img/avtar/05.jpg" alt="user5">
                                                </div>
                                                <p>Garydro</p>
                                            </td>
                                            <td>Senior Javascript Developer</td>
                                            <td>
                                                <label class="badge mb-0 badge-success-inverse">Completed</label>
                                            </td>
                                            <td>15/04/2018</td>
                                            <td>
                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>00006</td>
                                            <td>
                                                <div class="bg-img">
                                                    <img class="img-fluid" src="assets/img/avtar/06.jpg" alt="user6">
                                                </div>
                                                <p>Andrew dro</p>
                                            </td>
                                            <td>Accountant</td>
                                            <td>
                                                <label class="badge mb-0 badge-warning-inverse">Pending</label>
                                            </td>
                                            <td>22/04/2018</td>
                                            <td>
                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>00007</td>
                                            <td>
                                                <div class="bg-img">
                                                    <img class="img-fluid" src="assets/img/avtar/01.jpg" alt="user7">
                                                </div>
                                                <p>Stonedro</p>
                                            </td>
                                            <td>System Architect</td>
                                            <td>
                                                <label class="badge mb-0 badge-danger-inverse">Cancelled</label>
                                            </td>
                                            <td>27/04/2018</td>
                                            <td>
                                                <a href="javascript:void(0)" class="mr-2"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>
                                                <a href="javascript:void(0)"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end app-main -->
