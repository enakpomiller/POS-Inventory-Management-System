



    <style>
        .article { margin-bottom: 20px; padding: 10px; border: 1px solid #ddd; }
        .load-more { text-align: center; margin-top: 20px; }
        #loadMoreBtn { padding: 10px 20px; cursor: pointer; background-color: #007BFF; color: #fff; border: none; }
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
                <div class="col-xxl-12 m-b-30">
                    <div class="card card-statistics dating-contant h-100 mb-0">
                        <div class="card-header">
                            <h4 class="card-title">View Order History  </h4>

                        </div>

                        <div class="card-body pt-2 scrollbar scroll_dark" style="height: 300px;">
                            <div class="table-responsive">
                                     <!-- section menue -->
                                        <div id="articles">
                                            <?php if (!empty($articles)): ?>

                                                    <table class="table table-striped">
                                                    <thead class="">
                                                        <tr>
                                                        <th scope="col"><h4>#</h4></th>
                                                        <th scope="col">First Name</th>
                                                        <th scope="col">Last Name</th>
                                                        <th scope="col">payment status</th>
                                                        <th scope="col">Payment Method</th>
                                                        <th scope="col">Invoice No</th>
                                                        <th scope="col">Total Amount</th>
                                                        <th scope="col">Country</th>
                                                        <th scope="col"> Date </th>
                                                        <th scope="col"> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php  $counter =1; foreach ($articles as $article): ?>
                                                        <tr>
                                                        <td class="text-success">
                                                        <input type="checkbox">
                                                              </td>
                                                        <td><?= $article->fname; ?></td>
                                                        <td><?= $article->fname; ?></td>
                                                        <td><?= $article->paymentstatus == 'Paid'?'<div class="text-success">Paid</div>':'<div class="text-danger">'.$article->paymentstatus.' </div>' ; ?></td>
                                                        <td><?= $article->paymentmethod; ?></td>
                                                        <td><?= $article->invoiceNumber; ?></td>
                                                        <td><?= $article->totalprice; ?></td>
                                                        <td><?= $article->countryName; ?></td>
                                                         <td>  <?= date('Y-M-D', strtotime($article->date_created)); ?> </td>
                                                        <td>
                                                          <a href="<?=base_url('products/viewcustorder/'.$article->customerID)?>" class="btn btn-info  pr-2 pl-2" title="view Record"> <i class='fa fa-eye'></i> </a>

                                                    </td>
                                                        </tr>
                                                  <!-- modal open -->

                                                    <div class="modal fade" id="exampleModal<?=$article->customerID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h5 class="modal-title" id="exampleModalLabel"><p>  Edit Customer</p> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        <form action="<?=base_url('dashboard/updatecustomer')?>" method="POST">
                                                                <div class="modal-body">
                                                                <input type="hidden" name="customerID"  class="form-control" value="<?=$article->customerID?>">
                                                                <div class="form-group">
                                                                    <label> First Name </label>
                                                                    <input type="text" name="fname"  class="form-control" value="<?=$article->fname?>">
                                                                </div>

                                                                <div class="form-group">
                                                                <label> Username </label>
                                                                    <input type="text" name="lname"  class="form-control" value="<?=$article->lname?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> Ofice/Role </label>
                                                                        <select name ="office" class="form-control">
                                                                            <option disabled>Select Office </option>
                                                                            <?php foreach($country as $countries) { ?>
                                                                                <option value="<?=$countries->id?>"> <?=$countries->country?> </option>
                                                                            <?php } ?>
                                                                            </select>
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

                                        <!-- modal close -->
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                    </table>

                                            <?php endif; ?>
                                        </div>

                                        <div class="load-more">
                                            <button id="loadMoreBtn">Load More</button>
                                        </div>
                                     <!-- close scroll section -->

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







    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        var offset = 3; // Initially loaded 5 articles
        var limit = 3;
        var busy = false;

        $('#loadMoreBtn').click(function() {
            if (busy) return;
            busy = true;

            $.ajax({
                url: '<?= base_url("dashboard/loadMoreArticles") ?>',
                method: 'POST',
                data: { offset: offset },
                beforeSend: function() {
                    $('#loadMoreBtn').text('Loading...');
                },
                success: function(data) {
                    if (data.trim() == 'no_more') {
                        toastr.error(' No more record ');
                        $('#loadMoreBtn').text('No More Recored').prop('disabled', true);
                    } else {
                        $('#articles').append(data);
                        offset += limit;
                        $('#loadMoreBtn').text('Load More');
                        busy = false;
                    }
                }
            });
        });
    </script>
