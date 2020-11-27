<style>
  #shipped_div {
    display: none;
  }
  .dimg {
    max-width: 100px;
    max-height: 100px;
  }
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
  .img_cont {
    width: 150px;
    height: 130px;
    border: 1px solid #ccc;
    box-shadow: 0 0 1px rgba(0,0,0,.3);
    background-position: center;
    background-size: cover;
    margin: 10px;
  }
</style>


<div class="main-content">
  <div class="content-wrapper"><!--Statistics cards Starts-->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Order New Item</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <form action="<?=site_url('admin/order_item')?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?=@$record['id']?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Select an Item to order</label>
                        <select class="form-control" name="order_id" required>
                          <option value=""> -- select -- </option>
                          <?php foreach($orders as $order) { ?>
                            <option value="<?=$order['id']?>"><?=$order['title']?></option>
                          <?php } ?>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-check"></i> Order Now</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
