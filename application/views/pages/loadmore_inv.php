



           <?php if($invoices){  ?>
                <?php  $counter =1; foreach ($invoices as $inv) { ?>
                        <tr>
                            <th> <?=$counter++?>  </th>
                            <td>  <?=$inv['fname']?> </td>
                            <td>  <?=$inv['lname']?> </td>
                            <td>  <?=$inv['country']?> </td>
                            <td>  <?=$inv['phone']?> </td>
                            <td>  <?=$inv['email']?> </td>
                            <td><?= $inv['date'] ?></td>
                            <td>
                                <a href="<?=base_url('products/viewcustinvoice/'.$order->customerID)?>" class="btn btn-primary  pr-2 pl-2" title="view Record"> <i class='fa fa-eye'></i> </a>
                            </td>
                    </tr>
                <?php } ?>
          <?php }
          else {
           echo " no data captured ";
            } ?>