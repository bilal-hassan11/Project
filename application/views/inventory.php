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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<div class="main-content">
  <div class="content-wrapper"><!--Statistics cards Starts-->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Invoices</h4>
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
                            <th> Image </th>
                            <th> Order Number </th>
                            <th> Supplier </th>
                            <th> Pieces </th>
                            <th> Total Weight </th>
                            <th> Recieved Date </th>
                            <th> Shipped </th>
                            <th> Type </th>
                            <th> Status </th>
                            <th> Action </th>
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

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){

  $('#inventory_table').DataTable({
   "processing" : true,
   "serverSide" : true,
   "ajax" : {
    url:"<?=site_url('admin/getShippedData')?>",
    type:"POST"
   },
   dom: 'lBfrtip',
   buttons: [
    { extend: 'excel', text: 'Export to excel' }
   ],
   "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
  });

 });

</script>
