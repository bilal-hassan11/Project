
<style>
  .card .card-header {
    padding-bottom: 0px;
  }
  #orders th {
    font-weight: 500;
    font-size: 12px;
    padding: 8px;
  }
  #orders td {
    font-size: 11px;
    padding: 8px;
  }
  .dimg {
    max-width: 100px;
    max-height: 100px;
  }
  .Completedbtn
  {
    padding:5px;
    background-color:green;
    color:white;
  }
  .Completedbtn:hover
  {
    color:white;
  }
</style>
<div class="main-content">

  <div class="content-wrapper"><!--Statistics cards Starts-->

      <div class="row">

        <div class="col-sm-12">

          <div class="card">

            <div class="card-header">

              <h4 class="card-title">Items Ordered Details</h4>
              <p>Following are the order Details</p>
            </div>

            <div class="card-body">

              <div class="card-block mcontainer">
              		<table class="table table-striped table-bordered table-hover table-checkable order-column display" id="orders" style="width:100%">
              			<thead>
                        <tr>
                            <th>S.No</th>
                            <th>Image</th>
                            <th>UPC</th>
                            <th>Part Number</th>
                            <th>Notes</th>
                            <th>Quantity Ordered</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $sno=1; foreach ($itemordereddetailsdata as $key => $value) { ?>
                    	<tr>
                    		<td><?php echo $sno;?></td>
                    		<td><img src="<?=base_url('uploads/').$value['image']?>" width='100' height='100' style="height:50px!important;"></td>
                    		<td><?php echo $value['upc']?></td>
                    		<td><?php echo $value['part_no']?></td>
                    		<td><?php echo $value['orderdetail_notes']?></td>
                    		<td><?php echo $value['good_qty']?></td>
                    		<td><?php echo $value['date_ordered']?></td>
                    	</tr>
                    	<?php $sno++; } ?>
                    </tbody>
              		</table>
              </div>

            </div>

          </div>

        </div>

      </div>

  </div>

</div>

</div>
