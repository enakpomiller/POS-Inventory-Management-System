


<?php if(($getinv)>0) { ?>
        <?php  $counter =1; foreach ($getinv as $order) { ?>
            <tr>
                <th> <?=$counter++?>  </th>
                <td>  <?=$order->fname?> </td>
                <td>  <?=$order->lname?> </td>
                <td>  <?=$order->paymentstatus?> </td>
                <td>  <?=$order->paymentmethod?> </td>
                <td>  <?=$order->invoiceNumber?> </td>
                <td><?= $order->totalprice; ?></td>
                <td><?= $order->countryName; ?></td>
                <td>  <?= date('Y-M-D', strtotime($order->date_created)); ?> </td>
                <td>
                    <a href="<?=base_url('products/viewcustinvoice/'.$order->customerID)?>" class="btn btn-primary  pr-2 pl-2" title="view Record"> <i class='fa fa-eye'></i> </a>
                </td>
        </tr>
        <?php } ?>

<?php }else{?>

     

<?php }?>



