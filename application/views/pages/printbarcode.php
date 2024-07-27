

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
                    <button class="btn btn-primary mt-2 pr-2" style="width:20%;margin-left:80%;"> Print Barcode </button>
                       <div class="container mt-5 mb-5 col-md-6">

                          <?php foreach($allbarcode as $index => $allbar): ?>
                                <hr>
                                 <?=$allbar->prodname?>
                                <svg id="barcode<?= $index ?>"></svg>
                                <script>
                                    // Generate barcode
                                    JsBarcode("#barcode<?= $index ?>", "<?= $allbar->barcode ?>", {
                                        format: "CODE128",
                                        lineColor: "#000",
                                        width: 2,
                                        height: 100,
                                        displayValue: true
                                    });
                                </script>
                                </hr>
                                <?php endforeach; ?>

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
