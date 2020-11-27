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
  .custom-control{
    margin-left: 10px;
  }
  .input-group{
    margin-bottom: 0px!important;
  }
  .special_input {
    width: 150px;
    border: none;
    border-bottom: 1px solid #ccc;
  }

</style>
<div class="main-content">

  <div class="content-wrapper"><!--Statistics cards Starts-->

      <div class="row">

        <div class="col-sm-12">

          <div class="card">

            <div class="card-header">
              <h4 class="card-title"><?=($status=='incoming')?"Incoming Inventory":"Received Inventory"?> </h4>
              <?php if($status=='incoming') { ?>
                <a href="<?=site_url('admin/new_order')?>" class="btn btn-sm btn-default pull-right"><i class="fa fa-plus"></i> New Incoming order</a>
              <?php } else { ?>
                <br/>
                <br/>
              <?php } ?>
            </div>

            <div class="card-body">
              <input type="hidden" id="status" value="<?=$status?>">
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
                <?php }?>
                <table class="table table-striped table-bordered table-hover table-checkable order-column display" id="orders" style="width:100%">
                    <thead>
                        <tr>
                            <th> S.No </th>
                            <?php if ($this->session->userdata('is_customer')=='yes'): ?>
                            <th>Customer</th>
                            <?php endif ?>
                            <?php if ($this->session->userdata('is_img')=='yes'): ?>
                            <th> Image </th>
                            <?php endif ?>
                            <?php if ($this->session->userdata('is_descr')=='yes'): ?>
                            <th> Description </th>
                            <?php endif ?>
                            <?php if($status == 'incoming') { ?>
                            <th> Qty Ordered</th>
                              <th> Date Ordered </th>
                            <?php } else { ?>
                              <th> Good Qty Received </th>
                              <th> Bad Qty Received </th>
                              <!-- <th> Qty Received </th> -->
                              <th> Received Total </th>
                              <th> Date Received </th>
                              <th>Location</th>
                            <?php } ?>
                            <?php if ($this->session->userdata('is_status')=='yes'){ ?>
                              <th> Status </th>
                            <?php } ?>
                            <th> Actions </th>
                            <?php if($this->session->userdata('role') == 'customer') { if ($status != 'incoming') { ?>
                             <th> Order </th>
                           <?php } } ?>
                        </tr>
                    </thead>
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
<div class="modal fade" id="statusModal" tabindex="0" role="dialog" aria-labelledby="statusModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="width: 138%; margin-left: -20%">
      <form class="" action="<?=site_url('admin/change_status')?>" method="post" id="statusform">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalTitle">Change Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="order_id" id="order_id">

          <!-- <select class="form-control status_order" name="status" required>
            <option> -- change status -- </option>
            <option value="received">Received</option>
          </select> -->

          <input class="form-control status_order" type="hidden" name="status" value="received" required>

          <div class="row item_god_bad mt-2">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="statusbtnsave" class="btn btn-primary">Print Location</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="save_form">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- viewModal -->
<div class="modal fade" id="viewModal" tabindex="0" role="dialog" aria-labelledby="statusModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalTitle">View Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body view_details_">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add To Cart Modal Start -->
<div class="modal fade" id="addtocartmodal" tabindex="0" role="dialog" aria-labelledby="addtocartmodalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 600px; margin-left: -50px">
      <form class="" action="<?=site_url('admin/addtocart')?>" method="post">
        <input type="hidden" name="max_qty" id="max_qty">
        <!-- Order Item Function Inserts Order -->
        <div class="modal-header">
          <h5 class="modal-title" id="addtocartmodalTitle">Order Now</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <input type="hidden" name="order_id" id="order_id1">
            <label>Quantity</label>
            <input type="number" class="form-control" name="qty" min="0" id="addtocartqty">
            <label>Bundles</label>
            <input type="number" class="form-control" name="bundle">
            <label>Notes</label>
            <textarea class="form-control" name="notes"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add to cart</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add To Cart Modal End -->
<script type="text/javascript" language="javascript">


function show_modal(id) {
   $('#order_id').val(id);
   $('#statusModal').modal('show');
   $('.item_god_bad').show();
      var id = $('#order_id').val();
      $.ajax({
        url : '<?=site_url('admin/getReceivedOrderInfo')?>',
        data : {id : id},
        method:'post',
        success : function (data) {
          $('.item_god_bad').html(data);
        }
      });
      $('input[name=received_date]').prop('required',true);
}

function showModal(id){
    $('#order_id').val(id);
    $('#viewModal').modal('hide');
    $('#statusModal').modal('show');
    $('.item_god_bad').hide();
}


//  $('.status_order').change(function(){
//     if ($(this).val() == 'received') {
//       $('.item_god_bad').show();
//       var id = $('#order_id').val();
//       $.ajax({
//         url : '<?=site_url('admin/getReceivedOrderInfo')?>',
//         data : {id : id},
//         method:'post',
//         success : function (data) {
//           $('.item_god_bad').html(data);
//         }
//       });

//       $('input[name=received_date]').prop('required',true);
//     }
//     else
//     {
//       $('.item_god_bad').hide();
//       $('input[name=received_date]').prop('required',false);
//     }
//  })



 $(document).ready(function(){
    $("#save_form").on('click',function(e){
        e.preventDefault();
        var total_qty=$("#qunatity").text();
        var good_qty=$("#good_qty").val();
        var location=$("#statuslocation").val();

        if(location == "") {
          alert('Please add a Location first');
          return;
        }
        if(parseInt(total_qty)!=parseInt(good_qty))
        {
            var a = confirm("Are You Sure, Total Quantity and Good Items Quantity are not same ?");
            if(a)
            {
                $("#statusform").submit();
            }
        }else{
            $("#statusform").submit();
        }
    })


    let status = $('#status').val();

    $('#orders').DataTable({
      "processing" : true,
      "serverSide" : true,
      "ajax" : {
        url:"<?=site_url('admin/getOrders')?>/"+status,
        type:"POST"
      },
      dom: 'lBfrtip',
      buttons: [{ extend: 'excel', text: 'Export to excel' }],
      "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]

    });
 });


  function addtocartmodal(id,qty) {
    $('#order_id1').val(id);
    $('#addtocartqty').attr("max",qty);
    $('#max_qty').val(qty);
    // alert(qty);
    $('#addtocartmodal').modal('show');
  }

 function showViewModal(id){
   $('#viewModal').modal('show');

   $.ajax({
    url : '<?=site_url('admin/view_details_popup/')?>'+id,
    dataType : 'json',
    success :function(data) {
      $('.view_details_').html(data);
    }
   })

 }

 $("#statusbtnsave").on("click", function () {
      var divContents = $("#statuslocation").val();
      var printWindow = window.open('', '', 'height=400,width=800');
      printWindow.document.write('<html><head><title>DIV Contents</title>');
      printWindow.document.write('</head><body>');
      printWindow.document.write('<h1 align="center">'+divContents+'</h1>');
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      printWindow.print();
      // printDiv(divContents);
  });

//   $("#statusform").submit(function(){
//       $('<div></div>').appendTo('body')
//         .html('<div><h6>Are you sure the qty of item recieved is not equal to the total quantity</h6></div>')
//         .dialog({
//           modal: true,
//           title: 'Delete message',
//           zIndex: 10000,
//           autoOpen: true,
//           width: 'auto',
//           resizable: false,
//           buttons: {
//             Yes: function() {


//               $('body').append('<h1>Confirm Dialog Result: <i>Yes</i></h1>');

//               $(this).dialog("close");
//             },
//             No: function() {
//               $('body').append('<h1>Confirm Dialog Result: <i>No</i></h1>');

//               $(this).dialog("close");
//             }
//           },
//           close: function(event, ui) {
//             $(this).remove();
//           }
//         });
//     });

    function ConfirmDialog(message) {

    };


</script>
