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
              <h4 class="card-title">New Invoice</h4>
              <br />
            </div>
            <div class="card-body">
              <div class="card-block mcontainer">
                <form action="<?=site_url('admin/new_invoice')?>" method="post">
                  <div class="col-md-6">
                    <label>Select Order</label>
                    <select class="form-control">
                      <option value=""> -- select -- </option>
                      <?php foreach($orders as $order) { ?>
                        <option value="<?=$order['id']?>"><?=$order['id']?></option>
                      <?php } ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
