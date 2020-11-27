<style>
#invoice{
  padding: 30px;
}

.invoice {
  position: relative;
  background-color: #FFF;
  min-height: 680px;
  padding: 15px
}

.invoice header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #3989c6
}

.invoice .company-details {
  text-align: right
}

.invoice .company-details .name {
  margin-top: 0;
  margin-bottom: 0
}

.invoice .contacts {
  margin-bottom: 20px
}

.invoice .invoice-to {
  text-align: left
}

.invoice .invoice-to .to {
  margin-top: 0;
  margin-bottom: 0
}

.invoice .invoice-details {
  text-align: right
}

.invoice .invoice-details .invoice-id {
  margin-top: 0;
  color: #3989c6
}

.invoice main {
  padding-bottom: 50px
}

.invoice main .thanks {
  margin-top: -100px;
  font-size: 2em;
  margin-bottom: 50px
}

.invoice main .notices {
  padding-left: 6px;
  border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
  font-size: 1.2em
}

.invoice table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px
}

.invoice table td,.invoice table th {
  padding: 15px;
  background: #eee;
  border-bottom: 1px solid #fff
}

.invoice table th {
  white-space: nowrap;
  font-weight: 400;
  font-size: 16px
}

.invoice table td h3 {
  margin: 0;
  font-weight: 400;
  color: #3989c6;
  font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
  text-align: right;
  font-size: 1.2em
}

.invoice table .no {
  color: #fff;
  font-size: 1.6em;
  background: #3989c6
}

.invoice table .unit {
  background: #ddd
}

.invoice table .total {
  background: #3989c6;
  color: #fff
}

.invoice table tbody tr:last-child td {
  border: none
}

.invoice table tfoot td {
  background: 0 0;
  border-bottom: none;
  white-space: nowrap;
  text-align: right;
  padding: 10px 20px;
  font-size: 1.2em;
  border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
  border-top: none
}

.invoice table tfoot tr:last-child td {
  color: #3989c6;
  font-size: 1.4em;
  border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
  border: none
}

.invoice footer {
  width: 100%;
  text-align: center;
  color: #777;
  border-top: 1px solid #aaa;
  padding: 8px 0
}

@media print {
  .invoice {
      font-size: 11px!important;
      overflow: hidden!important
  }

  .invoice footer {
      position: absolute;
      bottom: 10px;
      page-break-after: always
  }

  .invoice > div:last-child {
      page-break-before: always
  }

  .noprint {
      visibility: hidden;
   }
}
</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="container">
  <div class="col-md-12">
    <div class="main-content">

      <div class="content-wrapper"><!--Statistics cards Starts-->

          <div class="row">

            <div class="col-sm-12">

              <div class="card-block mcontainer">

                <div class="col-md-12">
                  <div id="invoice">
                    <div class="toolbar hidden-print">
                      <div class="text-left">
                          <a href='<?=site_url('admin/items_ordered')?>' class="btn btn-default noprint"><i class="fa fa-arrow-left"></i> Go Back</a>
                      </div>
                        <div class="text-right">
                            <button id="printInvoice" class="btn btn-info noprint"><i class="fa fa-print"></i> Print</button>
                        </div>
                        <hr>
                    </div>
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <a target="_blank" href="https://lobianijs.com">
                                            <img src="<?=base_url('app-assets/images/logo.jpg')?>" width="80" data-holder-rendered="true" />
                                            <h2 style='display: inline-block; margin-left: 10px;'>Brown Box Ninja</h2>
                                            </a>
                                    </div>
                                </div>
                            </header>
                            <main>
                              <!-- <php print_r($orderdetails) ?> -->
                                <div class="row contacts">
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id">Order Details</h1>
                                        <div class="date"><strong>Order Number</strong>: <?=$order['order_no']?></div>

                                        <div class="date"><strong>Order Date</strong>: <?=date('d M Y', strtotime($order['datetime']))?></div>
                                        <!-- <div class="date"><strong>Order Time</strong>: <?=date('H:i a', strtotime($order['datetime']))?></div> -->
                                    </div>
                                </div>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">Image</th>
                                            <th class="text-left">UPC</th>
                                            <th class="text-left">Part Number</th>
                                            <th class="text-left">Asin Number</th>
                                            <th class="text-left">Bundle Qty</th>
                                            <th class="text-left">Notes</th>
                                            <th class="text-left"></th>
                                            <!-- <th class="text-left">Supplier</th> -->
                                            <th class="text-left">Location</th>
                                            <th class="text-left"></th>
                                            <th class="text-left">Quantity</th>
                                            <!-- <th class="text-right">TOTAL</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sno=1; foreach($orderdetails as $v):?>
                                        <tr>
                                            <td class="no"><?=$sno?></td>
                                            <td class="img">
                                              <img src="<?=base_url('uploads/'.$v['image'])?>" class="img-thumbnail" width="100">
                                            </td>
                                            <td><?=$v['upc']?></td>
                                            <td><?=$v['part_no']?></td>
                                            <td><?=$v['asin_number']?></td>
                                            <td><?=$v['bundle_quantity']?></td>
                                            <td><?=$v['orderdetail_notes']?></td>
                                            <td></td>
                                            <!-- <td class="text-left"><?=$v['supplier']?></td> -->
                                            <td><?=$v['location']?></td>
                                            <td></td>
                                            <td class="unit"><?=$v['qty']?></td>
                                            <!-- <td class="total">$800.00</td> -->
                                        </tr>
                                        <?php $sno++; endforeach;?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td colspan="3">Date Ordered</td>
                                            <td><?=@date('d M Y ', strtotime($orderdetails[0]['date_ordered']))?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <br>
                                <br>

                                <!-- <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                                </div> -->
                            </main>
                            <footer>
                                Details were generated from a computer and is valid without the signature and seal.
                            </footer>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
                </div>
              </div>

            </div>

          </div>

      </div>

    </div>
  </div>

</div>
<script>
$('#printInvoice').click(function(){
         Popup($('.invoice')[0].outerHTML);
         function Popup(data)
         {
             window.print();
             return true;
         }
     });
</script>
