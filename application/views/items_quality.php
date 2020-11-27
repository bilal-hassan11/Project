<div class="col-md-12">
  <div class="form-group">
    <label>Recieved Date:</label>
    <input type="date" name="received_date" class="form-control" value="<?=date('Y-m-d')?>">
  </div>
  <table class="table table-bordered table-responsive">
    <tr>
      <th>S.No</th>
      <th>UPC</th>
      <th>Part Number</th>
      <th>Total Quantity</th>
      <th>Location</th>
      <th>Good Items Quantity</th>
      <th>Bad Items Quantity</th>
      <th>Notes</th>
    </tr>

    <?php $sno = 1;foreach($items as $item) { ?>
      <tr>
        <td><?=$sno?></td>
        <td><?=$item['upc']?></td>
        <td><?=$item['part_no']?></td>
        <td id="qunatity"><?=$item['qty']?></td>
        <td>
        <input type="text" id="statuslocation" name="location_<?=$item['order_more_id']?>" class="special_input" value="<?=$item['location']?>" min="0" required>
        </td>

        <td>
        <input type="number" name="recieved_good.<?=$item['order_more_id']?>" class="special_input" id="good_qty" value="<?=$item['good_qty']?>" min="0">
        </td>
        <td >
        <input type="number" name="recieved_bad.<?=$item['order_more_id']?>" class="special_input" value="<?=$item['bad_qty']?>" min="0" >
         </td>
        <td>
        <textarea name="recieved_notes_<?=$item['order_more_id']?>" rows="3" cols="30" class="special_input"><?=$item['recieved_notes']?></textarea>
        </td>
      </tr>
    <?php $sno++; } ?>
  </table>
</div>
