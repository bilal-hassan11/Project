<script>
function check_order_number(obj) {
  let order_no = $(obj).val();

  if(order_no != '') {
    $.ajax({
      url: "<?=site_url('admin/check_order_number')?>/"+order_no,
      type: 'POST',
      success: function(res) {
        let resp = JSON.parse(res);
        if(resp.type == 'exists') {
          $('#orderno').css({'borderColor': 'red'});
          $('#err_msg_box').html('<code>'+order_no+'</code>This order Number Already exists Please choose another one.')
          $('#orderno').val('');
        } else {
          $('#orderno').css({'borderColor': '#A6A9AE'});
          $('#err_msg_box').text('')
        }
      }
    })
  }
}
</script>
<!-- Cart Item Model Start -->
<div class="modal fade" id="cartitemmodel" tabindex="0" role="dialog" aria-labelledby="cartitemmodelTitle" aria-hidden="true">
  <div class="modal-dialog" role="document" style="margin-left: 10%">
    <div class="modal-content " style="width: 1100px; margin: auto">
      <form class="" action="<?=site_url('admin/order_item')?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="cartitemmodelTitle">Order Now</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <label>Order #</label>
            <input type="text" id="orderno" required="rquired" name="orderno" class="form-control" onfocusout="check_order_number(this)"  />
            <p id="err_msg_box"></p>

            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="2" cols="20"></textarea>
            <table class="table">
              <thead>
                <th>ID</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Bundle Quantity</th>
                <th>Notes</th>
                <th>Description</th>
                <th>Action</th>
              </thead>
              <tbody id="cartitemtablebody">

              </tbody>

            </table>
            <button type="button" class="btn btn-danger" onclick="destroycart()" data-dismiss="modal">Empty Cart</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Complete Order</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Cart Item Model End -->

</div>
<script>

$(document).ready( function () {
  $('.datatable').DataTable();

} );

</script>
<footer class="footer footer-static footer-light">

  <p class="clearfix text-muted text-sm-center px-2">Developed with <i class="fa fa-heart text-danger"></i> by <a href="https://www.alphinex.com" target="_blank">Alphinex Solutions</a> Team </p>
</footer>

</div>


<!-- ////////////////////////////////////////////////////////////////////////////-->



<!-- BEGIN VENDOR JS-->



<script src="<?=base_url('app-assets/vendors/js/core/popper.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('app-assets/vendors/js/core/bootstrap.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('app-assets/vendors/js/perfect-scrollbar.jquery.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('app-assets/vendors/js/prism.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('app-assets/vendors/js/jquery.matchHeight-min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('app-assets/vendors/js/screenfull.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('app-assets/vendors/js/pace/pace.min.js')?>" type="text/javascript"></script>

<!-- BEGIN VENDOR JS-->

<!-- BEGIN APEX JS-->

<script src="<?=base_url('app-assets/js/app-sidebar.js')?>" type="text/javascript"></script>

<script src="<?=base_url('app-assets/js/notification-sidebar.js')?>" type="text/javascript"></script>

<script src="<?=base_url('app-assets/js/customizer.js')?>" type="text/javascript"></script>

<!-- END APEX JS-->

<!-- BEGIN PAGE LEVEL JS-->

<script src="<?=base_url('app-assets/js/dashboard1.js')?>" type="text/javascript"></script>

<!-- END PAGE LEVEL JS-->
</body>





</html>
