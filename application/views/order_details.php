<style media="screen">
.document_div {
  display: block;
  border: 1px solid #ccc;
  margin: 5px; padding: 5px;
  box-shadow: 0 0 1px 0px rgba(0,0,0,0.1);
  background: #f2f2f2;
}
.add_new_doc_btn {
  display: block;
  margin: 15px;
}
.remove_btn {
  padding: 0px 10px;
  float: right;
  color: #ad1902;
}
.remove_btn:hover {
  color: #4a0601;
}
</style>
<div class="main-content">

  <div class="content-wrapper"><!--Statistics cards Starts-->

      <div class="row">

        <div class="col-sm-12">

          <div class="card">

            <div class="card-header">

              <h4 class="card-title">Order Details</h4>

            </div>

            <div class="card-body">

              <div class="card-block">
                <table class="table table-bordered details_table">
                    <tbody>
                        <tr>
                          <th>Order# </th>
                          <td><?=$record['order_number']?></td>
                        </tr>
                        <tr>
                          <th>Date Ordered</th>
                          <td><?=@date('d M Y', strtotime($record['date_ordered']))?></td>
                        </tr>
                        <tr>
                          <th>Received Date</th>
                          <td>
                            <?php if (empty($record['received_date'])): echo '-';?>
                              <?php else: echo @date('d M Y', strtotime($record['received_date']))?>
                            <?php endif ?></td>
                        </tr>
                        <tr>
                          <th>Status</th>
                          <td>
                              <?php if($this->session->userdata('role') == "admin") { ?>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#statusModal"><span class="badge badge-<?=@($record['status'] == 'incoming')?'dark':'info'?>" onclick="showModal(<?=@$record['id']?>)"><?=@$record['status']?></span></a>
                            <?php }elseif ($this->session->userdata('role') == "customer") { ?>
                               <a href="javascript:void(0)" ><span class="badge badge-<?=@($record['status'] == 'incoming')?'dark':'info'?>"><?=@$record['status']?></span></a>
                            <?php } ?>
                          </td> 
                        </tr>
                        <tr>
                          <th>Description</th>
                          <td><?=@$record['description']?></td>
                        </tr>
                    </tbody>
                </table>
                <?php foreach($record_more as $v):?>
                <table class="table table-bordered details_table">
                  <tbody>
                    <tr>
                      <th>Image</th>
                      <?php if($v['image'] != "" && file_exists('uploads/'.$v['image'])) { ?>
                        <td><a href='<?=base_url('uploads/'.$v['image'])?>' target='_blank'><img src='<?=base_url('uploads/'.$v['image'])?>' width='150' class='img-thumbnail' /></a></td>
                      <?php } else { ?>
                        <td><img src='<?=base_url('uploads/placeholder.jpg')?>' width='150' class='img-thumbnail' /></td>
                      <?php }  ?>
                    </tr>
                    <tr>
                      <th>Title</th>
                      <td><?=@$v['title']?></td>
                    </tr>
                    <tr>
                      <th>Supplier</th>
                      <td><?=@$v['supplier']?></td>
                    </tr>
                    <tr>
                      <th>Tracking Number</th>
                      <td><?=@$v['tracking_number']?></td>
                    </tr>
                    <tr>
                      <th>Asin Number</th>
                      <td><?=@$v['asin_number']?></td>
                    </tr>
                    <tr>
                      <th>Quantity</th>
                      <td>
                        <?=@$v['qty']?>
                      </td>
                    </tr>
                    <tr>
                      <th>Size (in inches)</th>
                      <td><?=@$v['size_in_inches']?></td>
                    </tr>
                    <tr>
                      <th>Service</th>
                      <td><?=@$v['services']?></td>
                    </tr>
                    <tr>
                      <th>Condition</th>
                      <td><?=@$v['quality']?></td>
                    </tr>
                  </tbody>
                </table>
              <?php endforeach;?>
                <?php if($status == "incoming" && $this->session->userdata('role') == 'admin') { ?>
                  <a href="<?=site_url('admin/edit_order/'.$record['id'].'/'.$record['status'])?>" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit Order</a>
                <?php } ?>
                <a href="<?=site_url('admin/orders/'.$status)?>" class="btn btn-sm btn-default pull-right"><i class="fa fa-chevron-left"></i> Go back</a>
              </div>

            </div>

          </div>

        </div>

      </div>

  </div>

</div>

</div>
<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="0" role="dialog" aria-labelledby="statusModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="" action="<?=site_url('admin/change_status')?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalTitle">Change Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="order_id" id="order_id">
          <select class="form-control" name="status" required>
            <option> -- change status -- </option>
            <option value="incoming">Incoming</option>
            <option value="picked">Picked</option>
            <option value="prepared">Prepared</option>
            <option value="packed">Packed</option>
            <option value="shipped">Shipped</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Change</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
    function showModal(id) {
      $('#order_id').val(id);
    }
</script>
