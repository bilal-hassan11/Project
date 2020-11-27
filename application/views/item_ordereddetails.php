<div><strong>Order Number: </strong> <?=$order['order_no']?></div>
<div><strong>Order Date: </strong> <?=date('d M Y', strtotime($order['datetime']))?></div>
<!-- <div><strong>Order Time: </strong> <?=date('H:i a', strtotime($order['datetime']))?></div> -->
<br />
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
      <td>
        <a href="<?=base_url('uploads/').$value['image']?>" target="_blank">
          <img src="<?=base_url('uploads/').$value['image']?>" max-width='100' style="height:50px!important;">
        </a>
      </td>
      <td><?php echo $value['upc']?></td>
      <td><?php echo $value['part_no']?></td>
      <td><?php echo $value['orderdetail_notes']?></td>
      <td><?php echo $value['good_qty']?></td>
      <td><?php echo $value['date_ordered']?></td>
    </tr>
    <?php $sno++; } ?>
  </tbody>
</table>
