<style>
  .card .card-header {
    padding-bottom: 0px;
  }
  #inventory_table th {
    font-weight: 500;
    font-size: 12px;
    padding: 8px;
  }
  #inventory_table td {
    font-size: 11px;
    padding: 8px;
  }
</style>
<div class="main-content">

  <div class="content-wrapper"><!--Statistics cards Starts-->

      <div class="row">

        <div class="col-sm-12">

          <div class="card">

            <div class="card-header">

              <h4 class="card-title">Invoices</h4>

              <?php if($this->session->userdata('role') == 'admin') { ?>
                <!-- <a href="<?=site_url('admin/new_invoice')?>" class="btn btn-link pull-right"><i class="fa fa-plus"></i> Add Invoice</a> -->
              <?php } ?>
              <br />
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

                <table class="table table-striped table-bordered table-hover table-checkable order-column display" id="inventory_table" style="width:100%">
                    <thead>
                        <tr>
                            <th> S.No </th>
                            <th> Invoice Number </th>
                            <th> Date of Invoice </th>
                            <th> Order Number </th>
                            <th> Order Date </th>
                            <th> Customer Name </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sno = 1;
                      foreach($invoices as $invoice) { ?>
                        <tr>
                          <td><?=$sno?></td>
                          <td><?=$invoice['invoice_id']?></td>
                          <td><?=date('d M Y', strtotime($invoice['invoice_dt']))?></td>
                          <td><?=$invoice['order_no']?></td>
                          <td><?=date('d M Y', strtotime($invoice['order_date']))?></td>
                          <td><?=$invoice['username']?></td>
                          <td>
                            <a href="<?=site_url('admin/print_orderdetails/'.$invoice['order_id'])?>" class="btn small-btn">View Invoice</a>
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
