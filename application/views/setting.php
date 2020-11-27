<div class="main-content">

  <div class="content-wrapper"><!--Statistics cards Starts-->

      <div class="row">

        <div class="col-sm-12">

          <div class="card">

            <div class="card-header">

              <h4 class="card-title">Setting</h4>
            </div>

            <div class="card-body">

              <div class="card-block">
              	<?php if($this->session->flashdata('success')) { ?>
                  <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?=$this->session->flashdata('success')?>
                  </div>
                <?php } ?>

                <form action="<?php echo site_url("admin/update_setting");?>" method="POST">
                    <input type="hidden" name="is_editing" value="<?=@$record['is_editing'];?>">
                    <table class="table table-striped table-bordered">
                    	<tr>
                    		<th>Order No#</th>
                            <td>
                                <?php if ($auths->order_no=='yes') {
                                    $order_no='checked';
                                }else{
                                    $order_no='';
                                } ?>
                                <input type="checkbox" name="order_no" value="yes" <?=$order_no?>>
                            </td>
                    		<th>Date Ordered</th>
                    		<td>
                    			<?php if ($auths->date_order=='yes') {
                    				$date_order='checked';
                    			}else{
                    				$date_order='';
                    			} ?>
                    			<input type="checkbox" name="date_order" value="yes" <?=$date_order?>>
                    		</td>
                    		<th>Received Date No#</th>
                    		<td>
                    			<?php if ($auths->received_date=='yes') {
                    				$received_date='checked';
                    			}else{
                    				$received_date='';
                    			} ?>
                    			<input type="checkbox" name="received_date" value="yes" <?=$received_date?>>
                    		</td>
                    	</tr>
                    	<tr>
                            <th>Customer</th>
                            <td>
                                <?php if ($auths->customer=='yes') {
                                    $customer='checked';
                                }else{
                                    $customer='';
                                } ?>
                                <input type="checkbox" name="customer" value="yes" <?=$customer?>>
                            </td>
                    		<th>Status</th>
                    		<td><?php if ($auths->status=='yes') {
                    				$status='checked';
                    			}else{
                    				$status='';
                    			} ?>
                    			<input type="checkbox" name="status" value="yes" <?=$status?>>
                    		</td>
                    		<th>Description</th>
                    		<td><?php if ($auths->descr=='yes') {
                    				$desc='checked';
                    			}else{
                    				$desc='';
                    			} ?>
                    			<input type="checkbox" name="desc" value="yes" <?=$desc?>>
                    		</td>
                    	</tr>
                    	<tr>
                    		<th>Image</th>
                    		<td><?php if ($auths->img=='yes') {
                    				$img='checked';
                    			}else{
                    				$img='';
                    			} ?>
                    			<input type="checkbox" name="img" value="yes" <?=$img?>>
                    		</td>
                    		<th>UPC</th>
                    		<td><?php if ($auths->upc=='yes') {
                    				$upc='checked';
                    			}else{
                    				$upc='';
                    			} ?>
                    			<input type="checkbox" name="upc" value="yes" <?=$upc?>>
                    		</td>
                            <th>Part Number</th>
                            <td><?php if ($auths->part_no=='yes') {
                                    $part_no='checked';
                                }else{
                                    $part_no='';
                                } ?>
                                <input type="checkbox" name="part" value="yes" <?=$part_no?>>
                            </td>
                    		
                    	</tr>
                    	<tr>
                            <th>Supplier</th>
                            <td><?php if ($auths->supplier=='yes') {
                                    $supplier='checked';
                                }else{
                                    $supplier='';
                                } ?>
                                <input type="checkbox" name="supplier" value="yes" <?=$supplier?>>
                            </td>
                    		<th>Tracking Number</th>
                    		<td><?php if ($auths->track_numb=='yes') {
                    				$track_numb='checked';
                    			}else{
                    				$track_numb='';
                    			} ?>
                    			<input type="checkbox" name="track_numb" value="yes" <?=$track_numb?>>
                    		</td>
                    		<th>Asin Number</th>
                    		<td><?php if ($auths->asin_numb=='yes') {
                    				$asin_numb='checked';
                    			}else{
                    				$asin_numb='';
                    			} ?>
                    			<input type="checkbox" name="asin_numb" value="yes" <?=$asin_numb?>>
                    		</td>
                    		
                    	</tr>
                    	<tr>
                            <th>Quantity</th>
                            <td><?php if ($auths->quantity=='yes') {
                                    $quantity='checked';
                                }else{
                                    $quantity='';
                                } ?>
                                <input type="checkbox" name="quantity" value="yes" <?=$quantity?>>
                            </td>
                    		<th>Size (in inches)</th>
                    		<td><?php if ($auths->size=='yes') {
                    				$size='checked';
                    			}else{
                    				$size='';
                    			} ?>
                    			<input type="checkbox" name="size" value="yes" <?=$size?>>
                    		</td>
                    		<th>Service</th>
                    		<td><?php if ($auths->service=='yes') {
                    				$service='checked';
                    			}else{
                    				$service='';
                    			} ?>
                    			<input type="checkbox" name="service" value="yes" <?=$service?>>
                    		</td>
                    		
                    	</tr>
                        <tr>
                            <th>Condition</th>
                            <td>
                                <?php if ($auths->cond=='yes') {
                                    $condition='checked';
                                }else{
                                    $condition='';
                                } ?>
                                <input type="checkbox" name="condition" value="yes" <?=$condition?>>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                    <button type="submit" name="submit" class="btn btn-success "><i class="fa fa-check"></i> Save</button>
            	</form>

              </div>

            </div>

          </div>

        </div>

      </div>

  </div>

</div>

<script>

</script>
