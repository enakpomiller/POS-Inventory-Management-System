

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
                <?php if (!empty($editcustinvoice)){ ?>
                  <div class="row">
                     <div class="col-md-8">
                       <p class="text-left"> <?="Names: ".ucfirst($editcustinvoice[0]->fname).'  '.ucfirst($editcustinvoice[0]->lname) ?></p>
                        <p><?="Email: ".$editcustinvoice[0]->email?></p>
                       <p><?='Phone: '.$editcustinvoice[0]->phone?> </p>
                       <p><?='Country: '.$editcustinvoice[0]->country?> </p>
                       <p><?='Invoice Number : '.$editcustinvoice[0]->invoiceNumber?> </p>
                     </div>
                     <div class="col-md-3  " style="position:relative;left:50px;">
                       <p>
                        POS inventory System
                        76A Kuburat Okoya Lane, Eleganza Garden Estate Opp VGC Lagos, Nigeria
                       </p>
                     </div>
                   </div>

                   <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark pl-2 pr-2 pt-0 pb-0 mt-4" data-toggle="modal" data-target="#exampleModalCenter">
                        Edit Bio
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" stylee="position:relative;bottom:200px;">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="position:relative;bottom:150px;left:100px;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Customer Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <form action="<?=base_url('products/updatecustbio')?>" method ="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                <input type="hidden" name="customerID" class="form-control" value="<?=$editcustinvoice[0]->customerID?>">
                                <input type="text" name="fname" class="form-control" value="<?=$editcustinvoice[0]->fname?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="lname" class="form-control" value="<?=$editcustinvoice[0]->lname?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" value="<?=$editcustinvoice[0]->email?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" value="<?=$editcustinvoice[0]->phone?>">
                            </div>
                            <div class="form-group">
                                <select name="countries" class="form-control">
                                 <?php foreach($country as $countries){ ?>
                                     <option value="<?=$countries->id?>" <?=$editcustinvoice[0]->country==$countries->country?'selected':''?>><?=$countries->country?></option>
                                  <?php } ?>
                              </select>
                            </div> 
                          </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                             </div>
                           </div>
                       </form>
                      </div>
                    </div>
                    <!-- close modal --> 



                      <table class="table mt-4" style="position:relative;top:50px;">
                            <thead>
                            <tr>
                              <th scope="col">S/n</th>
                              <th scope="col">PRODUCT NAME </th>
                              <th scope="col"> PRODUCT PRICE </th>
                              <th scope="col"> PRODUCT QUANTITY </th>
                              <th scope="col"> AMOUNT </th>
                              <th scope="col"> ACTION </th>
                     
                            </tr>
                            </thead>
                            <tbody>
                              <?php $total =0; $counter=1; foreach($editcustinvoice as $invoices) { ?>
                                  <tr>
                                    <th scope="row"><?=$counter++?></th>
                                    <td><?=$invoices->prodname?></td>
                                    <td><?=number_format(($invoices->prodprice),2)?></td>
                                    <td class="text-center"><?=$invoices->prodqty?></td>
                                    <td>  <?=(number_format($invoices->prodprice) * ($invoices->prodqty))?></td>
                                  
                                    <td id="<?=$invoices->cartID?>">
                                       <a href="<?=base_url('products/deletecustinvoice/'.$invoices->cartID)?>" class='btn btn-danger remove p-2'><i class='fa fa-trash'></i></a> 
                                       <a href="<?=base_url('products/updatecustinvoice/'.$invoices->cartID)?>" data-toggle="modal" data-target="#exampleModalCenter2<?=$invoices->cartID?>" class='btn btn-info p-2'><i class='fa fa-pencil'></i></a> 
                                      </a>
                                    <?php $totasum += (($invoices->prodprice)*($invoices->prodqty)); ?>
                                  </tr>

                            <!-- Modal -->
                              <div class="modal fade" id="exampleModalCenter2<?=$invoices->cartID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" stylee="position:relative;bottom:200px;">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content" style="position:relative;bottom:150px;left:100px;">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">Edit product Details</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                    <form action="<?=base_url('products/updateprodDetails')?>" method="POST">
                                      <div class="modal-body">
                                          <div class="form-group">
                                          <input type="hidden" name="cartID" class="form-control" value="<?=$invoices->cartID?>">
                                          <input type="hidden" name="customerID" class="form-control" value="<?=$editcustinvoice[0]->customerID?>">
                                      </div>
                                      <div class="form-group">
                                          <input type="text" name="prodname" class="form-control" value="<?=$invoices->prodname?>">
                                      </div>
                                      <div class="form-group">
                                          <input type="text" name="prodprice" class="form-control" value="<?=number_format(($invoices->prodprice),2)?>">
                                      </div>
                                      <div class="form-group">
                                         <input type="text" name="prodqty" class="form-control" value="<?=$invoices->prodqty?>"> 
                                      </div>
                                        
                                      </div>
                                      <div class="modal-footer">
                                          <button type="" class="btn btn-danger" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                      </div>
                                      </div>
                              </form>
                                </div>
                              </div>
                          <!-- close modal -->
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
                     <h4 class="text-center"> <?='TOTAL AMOUNT '.'&#8358;'.number_format(($totasum),2)?> </h4>
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




$('.remove').click(function(e) {
        e.preventDefault();
        var id = $(this).parents("td").attr("id");
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            reverseButtons: true
        }).then((result) => {
            if(result.value){
                  $.ajax({
                      type: 'POST',
                      url: "<?= base_url(); ?>" + "/products/deletecustinvoice/"+id,
                      error: function() {
                        alert('Something is wrong');

                      },
                      success: function(res) {
                        if(res == true){
                         $("#"+id).remove();
                         swal("Deleted!", "item deleted.", "success");
                        }else{ toastr.error(' Please select both start and end date '); }
                      }

                  });

            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Cart Item is safe :)',
                    'error'
                )
            }
        })
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
