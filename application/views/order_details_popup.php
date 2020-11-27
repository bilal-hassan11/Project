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

              <h4 class="card-title">Item Details</h4>

            </div>

            <div class="card-body">

              <div class="card-block">
                <?php foreach($record_more as $v):?>
                <table class="table table-bordered details_table">
                    <tbody>
                      <?php if ($this->session->userdata('is_order_no')=='yes'): ?>
                        <tr>
                          <th>Order# </th>
                          <td><?=@$record->order_number?></td>
                        </tr>
                      <?php endif ?>
                      <?php if ($this->session->userdata('is_date_order')=='yes'): ?>
                        <tr>
                          <th>Customer</th>
                          <td><?=@$record->customer_name?></td>
                        </tr>
                        <tr>
                          <th>Date Ordered</th>
                          <td><?=@date('d M Y', strtotime($record->date_ordered))?></td>
                        </tr>
                      <?php endif ?>
                      <?php if ($this->session->userdata('is_img')=='yes'): ?>
                        <tr>
                          <th>Image</th>
                          <?php if($v['image'] != "" && file_exists('uploads/'.$v['image'])) { ?>
                            <td><a href='<?=base_url('uploads/'.$v['image'])?>' target='_blank'><img src='<?=base_url('uploads/'.$v['image'])?>' width='150' class='img-thumbnail' /></a></td>
                          <?php } else { ?>
                            <td><img src='<?=base_url('uploads/placeholder.jpg')?>' width='150' class='img-thumbnail' /></td>
                          <?php }  ?>
                        </tr>
                    <?php endif ?>
                    <?php if ($this->session->userdata('is_title')=='yes'): ?>
                      <tr>
                        <th>Title</th>
                        <td><?=@$v['title']?></td>
                      </tr>
                    <?php endif ?>
                    <?php if ($this->session->userdata('is_descr')=='yes'): ?>
                        <tr>
                          <th>Description</th>
                          <td><?=@$record->description?></td>
                        </tr>
                    <?php endif ?>
                    <?php if ($this->session->userdata('is_service')=='yes'): ?>
                      <tr>
                        <th>Inventory Type</th>
                        <td><?=@$v['services']?></td>
                      </tr>
                    <?php endif ?>
                    <?php if ($this->session->userdata('is_supplier')=='yes'): ?>
                      <tr>
                        <th>Supplier</th>
                        <td><?=@$v['supplier']?></td>
                      </tr>
                    <?php endif ?>
                    <?php if ($this->session->userdata('is_asin_numb')=='yes'): ?>
                      <tr>
                        <th>Asin Number</th>
                        <td><?=@$v['asin_number']?></td>
                      </tr>
                    <?php endif ?>
                    <?php if ($this->session->userdata('is_size')=='yes'): ?>
                        <tr>
                          <th>Dimension(LxWxH) in inches</th>
                          <td><?=@$v['length']." x " .$v['width'] ." x " .$v['height'] . " (inches)"?></td>
                        </tr>
                        <tr>
                          <th>Size (in cubicft)</th>
                          <td><?=@ round((($v['length']*$v['width']*@$v['height'])/1728), 2);?></td>
                        </tr>
                    <?php endif ?>
                    <?php if ($this->session->userdata('is_track_numb')=='yes'): ?>
                      <tr>
                        <th>Tracking Number</th>
                        <td><?=@$v['tracking_number']?></td>
                      </tr>
                    <?php endif ?>
                      <?php if ($this->session->userdata('is_received_date')=='yes'): ?>
                        <tr>
                          <th>Received Date</th>
                          <td>
                            <?php if (empty($record->received_date)): echo '-';?>
                              <?php else: echo @date('d M Y', strtotime($record->received_date))?>
                            <?php endif ?></td>
                        </tr>
                      <?php endif ?>
                     <?php if ($this->session->userdata('is_cond')=='yes'): ?>
                    <tr>
                      <th>Recieved Good</th>
                      <td><span class="badge badge-success"><?=@$v['good_qty']?></span> </td>
                    </tr>
                    <tr>
                      <th>Recieved Bad</th>
                      <td><span class="badge badge-danger"><?=@$v['bad_qty']?></span></td>
                    </tr>
                    <?php if ($this->session->userdata('is_quantity')=='yes'): ?>
                      <tr>
                        <th>Total Quantity</th>
                        <td>
                          <?=@$v['good_qty']+@$v['bad_qty']?>
                        </td>
                      </tr>
                    <?php endif ?>
                    <tr>
                      <th>Location</th>
                      <td><?=@$v['location']?></td>
                    </tr>
                    <?php endif ?>
                    <?php if ($this->session->userdata('is_status')=='yes'): ?>
                        <tr>
                          <th>Status</th>
                          <td>
                              <?php if($this->session->userdata('role') == "admin") { ?>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#statusModal"><span class="badge badge-<?=@($record->status == 'incoming')?'dark':'info'?>" onclick="showModal(<?=@$record->id?>)"><?=@$record->status?></span></a>
                            <?php }elseif ($this->session->userdata('role') == "customer") { ?>
                               <a href="javascript:void(0)" ><span class="badge badge-<?=@($record->status == 'incoming')?'dark':'info'?>"><?=@$record->status?></span></a>
                            <?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Note</th>
                          <td><?=@$v['notes']?></td>
                        </tr>
                      <?php endif ?>
                  </tbody>
                </table>
              <?php endforeach;?>
                <?php if($status == "incoming" && $this->session->userdata('role') == 'admin') { ?>
                  <a href="<?=site_url('admin/edit_order/'.$record->id.'/'.$record->status)?>" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit Order</a>
                <?php } ?>
              </div>

            </div>

          </div>

        </div>

      </div>

  </div>

</div>

</div>
