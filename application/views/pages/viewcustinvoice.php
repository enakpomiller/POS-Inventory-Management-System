

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
            <h1> <?=$title?> </h1>

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
      <div class="col-xxl-8 m-b-30" style="margin:auto;">
        <div class="card card-statistics dating-contant  mb-0" style="height:700px">
          <div class="card-header">
            <!-- <h4 class="card-title">View Invoice History  </h4> -->
          </div>

          <div class="card-body pt-2 scroll_dark" style="height: 300px;">
            <div class="table-responsive">
              <!-- section menue -->
              <div id="articles">
                <?php if (!empty($custinvoice)){ ?>
                  <div class="row">
                     <div class="col-md-8">
                       <p class="text-left"> <?="Names: ".$custinvoice[0]->fname.'  '.$custinvoice[0]->lname?></p>
                        <p><?="Email: ".$custinvoice[0]->email?></p>
                       <p><?='Phone: '.$custinvoice[0]->phone?> </p>
                       <p><?='Country: '.$custinvoice[0]->country?> </p>
                       <p><?='Invoice Number : '.$custinvoice[0]->invoiceNumber?> </p>
                     </div>
                     <div class="col-md-3  " style="position:relative;left:50px;">
                       <p>
                        POS inventory System
                        76A Kuburat Okoya Lane, Eleganza Garden Estate Opp VGC Lagos, Nigeria
                       </p>

                     </div>
                   </div>

                      <table class="table mt-4" style="position:relative;top:50px;">
                            <thead>
                            <tr>
                              <th scope="col">S/n</th>
                              <th scope="col">PRODUCT NAME </th>
                              <th scope="col"> PRODUCT PRICE </th>
                              <th scope="col"> PRODUCT QUANTITY </th>
                              <th scope="col"> AMOUNT </th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $total =0; $counter=1; foreach($custinvoice as $invoices) {?>
                            <tr>
                              <th scope="row"><?=$counter++?></th>
                              <td><?=$invoices->prodname?></td>
                              <td><?=number_format(($invoices->prodprice),2)?></td>
                              <td class="text-center"><?=$invoices->prodqty?></td>
                              <td>  <?=(number_format($invoices->prodprice) * ($invoices->prodqty))?></td>
                              <?php $totasum += (($invoices->prodprice)*($invoices->prodqty)); ?>
                            </tr>
                          <?php } ?>
                          </tbody>
                     </table>

                <?php }else{?>
                   <?php echo " cannot find data " ;?>
               <?php   } ?>
              </div>


              <!-- close scroll section -->

              <div class="row mt-4" style="position:relative;top:50px;">
                 <div class="col-md-6">
                       <div id="qrcode"  style="position:relative;left:30px;top:40px;"></div>
                 </div>
                 <div class="col-md-4  " style="position:relative;left:90px;">
                     <h4> <?='TOTAL AMOUNT '.'&#8358;'.number_format(($totasum),2)?> </h4>
                          <div align="center">
                            <?php if($custinvoice[0]->paymentstatus == 'Paid'){ ?>
                                  <img src="<?=base_url('assets/img/paylogo.jpg!sw800')?>" style="width:70%">
                            <?php }else{ ?>
                                <h4 class="text-danger"> <?=$custinvoice[0]->paymentstatus?> </h4>
                             <?php }?>
                          </div>
                 </div>
               </div>


               <div class="row mt-4" style="position:relative;top:30px;">
                  <div class="col-md-6">

                  </div>
                  <div class="col-md-6" style="position:relative;left:40px;">
                    <a href="<?=base_url('products/viewallinvoice')?>" class="btn btn-danger"> Close </a>
                    <button class="btn btn-dark"> Print </button>
                    <a href="<?=base_url('products/sendcustemail')?>" class="btn btn-primary"> Send to  mail</a>
                </div>
              </div>



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
    url: '<?= base_url("products/loadallinvoice") ?>',
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




  // Generate a QR code when the page loads
  var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: "<?=$this->uri->segment(3)?>",  // Text or URL to encode
    width: 120, // Width of the QR code
    height: 100, // Height of the QR code
  });

  // Optional: Dynamically update the QR code based on user input
  function generateQRCode(content) {
    qrcode.clear(); // Clear the previous QR code
    qrcode.makeCode(content); // Generate a new QR code with the new content
  }

</script>
