


<style>
.article { margin-bottom: 20px; padding: 10px; border: 1px solid #ddd; }
.load-more { text-align: center; margin-top: 20px; }
#loadMoreBtn { padding: 10px 20px; cursor: pointer; background-color: #8e54e9; color: #fff; border: none; }
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
            <h1> <?=$title?></h1>

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
      <div class="col-lg-6 col-xxl-12 m-b-30">
        <div class="card card-statistics h-100 mb-0">
          <div class="card-body">
          <form id="filterForm">
            <div class="row">
              <div class="col-md-4">
                <input type="text" class="form-control" placeholder=" Enter Invice Number " onkeyup="SearchKeyOrderData()"  id="searchKey">
              </div>
           
              <div class="col-md-4">                          
                  <div class="input-group" data-date="23/11/2018" data-date-format="mm/dd/yyyy">
                      <input type="text" class="form-control range-from" autocomplete="off" id="start_date" placeholder="Start date" name="start_date">
                      <span class="input-group-addon">To</span>
                      <input class="form-control range-to" type="text" autocomplete="off" id="end_date" name="end_date" placeholder="End date">
                  </div>                           
              </div>
               <div class="col-md-4">
                  <button type="submit" class="btn btn-primary w-100" onclick="SearchOrderData();" id="filterBtn"> <i class="fa fa-filter"></i>Filter by date</button>
            </div>
           </form>
            </div>
          </div>
        </div>
      </div>
    </div>




    <div class="row">
      <div class="col-xxl-12 m-b-30">
        <div class="card card-statistics dating-contant h-100 mb-0">
          <div class="card-header">
            <h4 class="card-title"> Invoice History  </h4>
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
                    <tbody class="list form-check-all">
                      <?php  $counter =1; foreach ($articles as $article): ?>
                        <tr  id="<?=$article->customerID?>">
                          <td class="text-success">
                            <input type="checkbox">
                          </td>
                          <td><?= $article->fname; ?></td>
                          <td><?= $article->lname; ?></td>
                          <td><?= $article->paymentstatus == 'Paid'?'<div class="text-success">Paid</div>':'<div class="text-danger">'.$article->paymentstatus.' </div>' ; ?></td>
                          <td><?= $article->paymentmethod; ?></td>
                          <td><?= $article->invoiceNumber; ?></td>
                          <td><?= $article->totalprice; ?></td>
                          <td><?= $article->countryName; ?></td>
                          <td>  <?= date('Y-M-D', strtotime($article->date_created)); ?> </td>
                          <td>
                            <?php if($this->session->role == 'Supper Admin'){ ?>
                            <a href="<?=base_url('products/deleteinvoice/'.$article->customerID)?>"  class="btn btn-danger  pr-2 pl-2 subscribeForm remove"  title="Delete Record"> <i class='fa fa-trash'></i> </a>
                            <a href="<?=base_url('products/editcustinvoice/'.$article->customerID)?>" class="btn btn-info  pr-2 pl-2" title="Edit Record"> <i class='fa fa-pencil'></i> </a>
                            <a href="<?=base_url('products/viewcustinvoice/'.$article->customerID)?>" class="btn btn-primary  pr-2 pl-2" title="view Record"> <i class='fa fa-eye'></i> </a>
                            <?php }else{?>
                              <a href="<?=base_url('products/viewcustinvoice/'.$article->customerID)?>" class="btn btn-primary  pr-2 pl-2" title="view Record"> <i class='fa fa-eye'></i> </a>
                            <?php  }?>
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




function SearchKeyOrderData(){

    $('#filterBtn').html(`<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
    <circle cx="50" cy="50" fill="none" stroke="#ffffff" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
      <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
    </circle></svg>`);

    var key = $('#searchKey').val();
    // var offset = $(".order-each").length;
    if (key == ""){
      toastr.error(' Please Enter Invoice Keyword ');
            //errorMessage('Please enter a search data!')
      $('#filterBtn').html('<i class="ri-equalizer-fill me-1 align-bottom"></i> Filter by Date');
      return false;
    }else{
      $.ajax({
        type: "POST",
        url: '<?=base_url('products/searchKey')?>',
        data: {key},
        success: function(res){
          $('#filterBtn').html('<i class="ri-equalizer-fill me-1 align-bottom"></i> Filter by Date');
          if(res == 400){
            toastr.error(' Invoice Number not found');
               //errorMessage('Order ID not found!')
          }else{
            $('.form-check-all').html(res);
          }
        }
      });
    }
  }





$('.remove').click(function(e) {
        e.preventDefault();
        var id = $(this).parents("tr").attr("id");
         console.log(id);
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
                      url: "<?= base_url(); ?>" + "/products/deleteinvoice/"+id,
                      error: function() {
                        alert('Something is wrong');

                      },
                      success: function(res) {
                        if(res == true){
                         $("#"+id).remove();
                         swal("Deleted!", "Your Invoice  has been deleted.", "success");
                        }else{ alert ('cannot'); }
                      }

                  });

            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your Invoice Record is safe :)',
                    'error'
                )
            }
        })
    });


  
  $(document).ready(function () {

    $("#filterForm").submit(function (e) {
        e.preventDefault(); 

        $('#filterBtn').html(`<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <circle cx="50" cy="50" fill="none" stroke="#ffffff" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
          <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
        </circle></svg>`);

        var startDate = $("#start_date").val();
        var endDate = $("#end_date").val();
      
        // Check if dates are valid
        if (!startDate || !endDate) {
          $('#filterBtn').html('<i class="ri-equalizer-fill me-1 align-bottom"></i> Filter by date');
          toastr.error(' Please select both start and end date ');
            return;
        }
        $.ajax({
            url: "<?= base_url('products/filter_by_date') ?>", 
            type: "POST",
            data: {
               start_date: startDate,
                end_date: endDate
               },
            dataType: "html", // Expect HTML response for rendering
            success: function (response) {
                $('#filterBtn').html('<i class="ri-equalizer-fill me-1 align-bottom"></i> Filter');
                $(".form-check-all").html(response); // Display the result
               
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
                $('#filterBtn').html('<i class="ri-equalizer-fill me-1 align-bottom"></i> Filter');
                toastr.error(' Error occured while tring to fetch record ');
               
            }
        });
    });
});

 

</script>

