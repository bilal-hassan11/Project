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

              <h4 class="card-title">Archived Orders </h4>
              <br>
              <a href="<?=site_url('admin/orders')?>" class="btn btn-sm btn-default pull-right"><i class="fa fa-plus"></i> Order New Item</a>
            </div>

            <div class="card-body">

              <div class="card-block mcontainer">

                <?php if($this->session->flashdata('response') == 'success') { ?>
                  <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?=$this->session->flashdata('msg')?>
                  </div>
                <?php } ?>
                <?php if($this->session->flashdata('response') == 'error') { ?>
                  <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?=$this->session->flashdata('msg')?>
                  </div>
                <?php } ?>

                <table class="table table-striped table-bordered table-hover table-checkable order-column display" id="orders" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Order#</th>
                            <th>Order Date</th>
                            <th>Order Status</th>
                            <th>Customer Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sno = 1;
                      foreach($orders as $order) { ?>
                        <tr>
                          <td><?=$sno?></td>
                          <td>
                            <?=$order['order_no']?>
                          </td>
                          <td><?=date('d M Y H:i a', strtotime($order['datetime']))?></td>
                          <td>
                            <?php if($order['status'] == 'new') {?>
                              <span class="badge badge-warning"><?=ucfirst($order['status'])?></span>
                            <?php } else { ?>
                              <span class="badge badge-success"><?=ucfirst($order['status'])?></span>
                            <?php } ?>
                          </td>
                          <td><?=$order['username']?></td>
                            <td>
                              <!-- <?php if($this->session->userdata('role') == 'admin') { ?>
                              <a href="<?=site_url('admin/create_invoice/'.$order['id']);?>" class="btn small-btn"><i class='ft-check'></i> Mark completed</a>
                               <?php } ?> -->
                               <a href="<?=site_url('admin/print_orderdetails/'.$order['id']);?>" class="btn small-btn"><i class='ft-printer'></i> Print</a>
                               <a href="#" class='btn small-btn' onclick="showOrderModal(<?=$order['id']?>)"><i class='icon-eye'></i> View</a>
                               <!-- <a href="<?=base_url('admin/archive_orderitem/'.$order['id'])?>" class='btn small-btn' onclick=\"return confirm('Are you sure you want to Archive?')\"><i class='ft-package'></i>Archive</a> -->
                            </td>

                        </tr>
                      <?php
                      $sno++;
                    } ?>
                    <?php if($sno == 1) { ?>
                      <tr>
                        <td colspan="8" style="text-align: center"> No Records Found</td>
                      </tr>
                    <?php }?>
                    </tbody>
                </table>
                <div class="clearfix">
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
  </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="0" role="dialog" aria-labelledby="statusModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 900px; margin-left: -100px">
      <form class="" action="<?=site_url('admin/change_status')?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalTitle">Order / Items Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="ordersDetailsContent">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  function showOrderModal(id) {

    $('#orderDetailsModal').modal('show');

    $.ajax({
      url: '<?=site_url('admin/getOrderDetails')?>/'+id,
      type: 'POST',
      success: function(res) {
        $('#ordersDetailsContent').html(res);
      }
    })
  }
</script>
