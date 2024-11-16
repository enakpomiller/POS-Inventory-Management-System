
    <style>

.toggle-password {
    position: absolute;
    top: 82%;
    right: 40px;
    transform: translateY(-50%);
    cursor: pointer;
    font-size:15px;
}

@media print {
      body * {
        visibility: hidden;
      }
      #printableArea, #printableArea * {
        visibility: visible;
      }
      #printableArea {
        position: absolute;
        top: 0;
        left: 0;
      }
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
    <?php if(isset($order)) {?>
        <div class="col-xxl-8 m-b-30">
      <div class="card card-statistics h-100 mb-0">
        <div class="container mt-5 mb-5 col-md-9">
            <form  class="needs-validation"  action="<?=base_url('products/customercart')?>"  novalidate id="invoice_form" method="POST">
            <div id="invoice">
                 <div id="printableArea">
                    <table border="0" width="100%">
                        <tr>
                            <th width="50%">  <h4> Invoice  Details </h4> </th>
                            <th> <h4 class="text-right"> Customer Details </h4> </th>
                        </tr>
                        <tr>
                            <td>
                            <p>
                             POS inventory System
                             76A Kuburat Okoya Lane, Eleganza Garden Estate Opp VGC Lagos, Nigeria
                            </p>
                          </td>
                            <td class="text-right">
                            <p> Names:  <?=(ucfirst($custdetails->fname)." ".(ucfirst($custdetails->lname)))?>
                             <p><i class='fa fa-envelope'></i> Email : <?=$custdetails->email?> </p>
                             <p><i class='fa fa-phone'></i> Phone Number : <?=$custdetails->phone?> </p>
                             <p> Country : <?=$custdetails->country?> </p>
                             </p>
                        </td>
                        </tr>
                    </table>

             <div class="row">
               <div class="container">
                   <h5 class="mt-4"> Payment Details </h5>
                  <table border="0" width="100%">
                     <tr>
                        <th> <p class="text-center"> Invoice Number<p> </th>
                        <th> <p class="text-center"> payment method</p> </th>
                        <th> <p class="text-center"> payment Status</p> </th>
                    </tr>
                    <tr>
                        <td>
                           <p class="text-center"> <?="INV-000".$_SESSION['custID']?></p>

                         </td>
                        <td>
                           <p class="text-center"><?=$custdetails->paymentmethod?></p>
                         </td>
                        <td>
                        <p class="text-center">
                             <?=$custdetails->paymentstatus=='Paid'?'<span class="text-success">'.$custdetails->paymentstatus.'</span>':'<span class="text-danger">'.$custdetails->paymentstatus. '</span>'?>
                            </p>

                     </td>
                    </tr>
               </table>


                <h5 class="mt-4"> Ordered Items </h5>

             <table  class="table " style="position:relative;top:0px;bottom:100px;width:100%;">
                 <thead class="">
                     <tr>
                     <th scope="col">#</th>
                     <th scope="col"> Product Name</th>
                     <th scope="col"> Product Price </th>
                     <th scope="col">Quantity</th>
                     <th scope="col"> Total Amount </th>
                     <th scope="col" class="text-right"> Action  </th>
                     </tr>
                 </thead>
                 <tbody>

                 <?php  $total = 0; $counter =1; foreach($order as $orders){ ?>
                    <tr>
                      <td> <?=$counter++?>  </td>
                        <td> <?= $orders->prodname ?></td>
                            <input type="hidden" name="customerID" value="<?= $orders->customerID ?>">
                            <input type="hidden" name="invoiceNumber" value="<?= "INV-000" . $_SESSION['custID'] ?>">
                            <input type="hidden" name="prodname[]" value="<?=$orders->prodname?>">
                            <td> <?= number_format($orders->prodprice) ?></td>
                            <input type="hidden" name="prodprice[]" value="<?= $orders->prodqty ?>">
                            <td> <?= $orders->prodqty ?></td>
                            <input type="hidden" name="prodqty[]" value="<?= $orders->prodqty ?>">
                            <td> <?= number_format($orders->totalprice, 2) ?></td>
                        <td>
                         <a href="" class="btn" style="float:right;" title="Edit record" data-toggle="modal"  data-target="#exampleModal<?=$orders->orderID?>"><i class="fa fa-pencil"></i></a>
                      </td>
                    </tr>
                        <!-- modal open -->
                          <div class="modal fade" id="exampleModal<?=$orders->orderID?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title justify-content-center" id="exampleModalLabel"><p> Edit Ordered Items</p> </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" name="orderID" class="form-control"  id="orderID" value="<?=$orders->orderID?>">
                                            <input type="hidden" name="prodID" class="form-control"  id="prodID" value="<?=$orders->prodID?>">
                                            <label for="recipient-name" class="col-form-label"> Product Name :</label>
                                            <input type="text" name="prodname"  class="form-control"  id="prodname" value="<?=$orders->prodname?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label"> Product Price :</label>
                                            <input type="number" name="prodprice"  class="form-control"  id="prodprice" value="<?=$orders->prodprice?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label"> Product Quantity :</label>
                                            <input type="number" name="prodqty"  class="form-control"  id="prodqty" value="<?=$orders->prodqty?>">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                                    <button  id="ord" class="btn btn-primary"> Save Changes</button>
                                </div>

                                </div>
                            </div>
                            </div>
                       <!-- close modal -->
                    <?php }?>
                 </body>
              </table>
              <label class="text-right " style="position:relative;top:10px;float:right;"><h4> Grand Total :  <?=number_format(($sumprice->sumtotal),2)?> </h4></label>
          </div>
          <div id="qrcode" style="position:relative;left:30px;"></div>
       </div>
     </div>
     </div>
     <button type="submit" class="btn btn-primary"  style="position:relative;top:30px;float:right;"><i class="fa fa-lock"></i>  Save Invoice  </button>
     </form>
     <div class="row">
            <div class="row mt-4 mb-4" style="position:relative;left:10px;bottom:20px;left:30px;">
            <a href="<?=base_url('dashboard')?>" class="btn btn-dark" style="position:relative;top:30px;float:right;"> <i class="fa fa-book"></i>  Close </a>
                <button  class="btn btn-danger ml-4" id="downloadinvoicecc" style="position:relative;top:30px;float:right;"><i class="fa fa-download"></i> Download  </button>
                <a href="" class="btn btn-success ml-4"  style="position:relative;top:30px;float:right;" id="printinvoice"><i class="fa fa-print"></i> Print Invoice   </a>
        </div>
     </div>
    </div>
</div>



     <?php }else{?>
         <?="No Record"?>
       <?php } ?>

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
<input type="text" id="text" placeholder="Enter text or URL" />
<button onclick="generateQRCode()">Generate QR Code</button>
<!-- QR CODE CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

  <!-- Include the html2pdf.js library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


<script>


$(document).ready(function() {
        $('#printinvoice').on('click', function(event) {
            event.preventDefault();
        window.print();
     });
    });


$(document).ready(function() {
        $('#downloadinvoicecc').on('click', function(event) {
            event.preventDefault();
                // Get the invoice section element
            const invoice = document.getElementById('invoice');
            // Options for html2pdf
            const options = {
            margin: 1,
            filename: 'invoice.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            // Convert the invoice section to a PDF and download it
            html2pdf().from(invoice).set(options).save();

        });
    });



  // Generate a QR code when the page loads
  var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: "<?=$_SESSION['custID']?>",  // Text or URL to encode
    width: 120, // Width of the QR code
    height: 100, // Height of the QR code
  });

  // Optional: Dynamically update the QR code based on user input
  function generateQRCode(content) {
    qrcode.clear(); // Clear the previous QR code
    qrcode.makeCode(content); // Generate a new QR code with the new content
  }



</script>



 <script>
    $(document).ready(function() {
        $('#ord').on('click', function(event) {
        event.preventDefault();
        const orderID =  $('#orderID').val();
        const prodID =  $('#prodID').val();
        const prodname =  $('#prodname').val();
        const prodprice =  $('#prodprice').val();
        const prodqty =  $('#prodqty').val();

        //const price = $('#price'+id).val();
        //e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('products/updateorder'); ?>",
                data: {
                    orderID,
                    prodID,
                    prodname,
                    prodprice,
                    prodqty

                  },
            //dataType: "JSON",
            success: function(data){
              if(data == true){
                 location.reload();
              }else{
               alert(' cannot update');
              }
            },
            error: function() { alert("Error posting feed."); }
        });


        });
    });


document.querySelector('.toggle-password').addEventListener('click', function (e) {
const passwordInput = document.getElementById('password');
const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
passwordInput.setAttribute('type', type);

// Toggle the text of the button
 //this.textContent = type === 'password' ? "show" : 'Hide';
});

</script>
