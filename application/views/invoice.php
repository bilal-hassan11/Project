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
                <?php echo "<pre>";print_r($order); ?>
                <div class="col-md-12">
                  <div id="invoice">
                    <div class="toolbar hidden-print">
                      <div class="text-left">
                          <a href='<?=site_url('admin/invoices')?>' class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back</a>
                      </div>
                        <div class="text-right">
                            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
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
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">INVOICE TO:</div>
                                        <h2 class="to"><?=$order['username']?></h2>
                                        <div class="address">Phone: <?=$order['phone']?></div>
                                        <div class="email">Email: <a href="<?=$order['email']?>"><?=$order['email']?></a></div>
                                    </div>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id">INVOICE #<?=$invoice_id?></h1>
                                        <div class="date">Date of Invoice: <?=date('d M Y', strtotime($order['invoice_dt']))?></div>
                                    </div>
                                </div>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">Image</th>
                                            <th class="text-left">Details</th>
                                            <th class="text-right">Size in inches</th>
                                            <th class="text-right">Quantity</th>
                                            <!-- <th class="text-right">TOTAL</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sno=0; foreach($order_more as $v):?>
                                        <tr>
                                            <td class="no"><?=$sno?></td>
                                            <td class="img">
                                              <img src="<?=base_url('uploads/'.$v['image'])?>" class="img-thumbnail" width="150">
                                            </td>
                                            <td class="text-left"><h3><?=$v['title']?></h3><?=$v['description']?></td>
                                            <td class="qty"><?=$v['size_in_inches']?></td>
                                            <td class="unit"><?=$v['qty']?></td>
                                            <!-- <td class="total">$800.00</td> -->
                                        </tr>
                                        <?php $sno++; endforeach;?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">Date Ordered</td>
                                            <td><?=date('d M Y ', strtotime($order['order_date']))?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <br>
                                <br>
                                <div class="thanks">Thank you!</div>
                                <!-- <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                                </div> -->
                            </main>
                            <footer>
                                Invoice was created on a computer and is valid without the signature and seal.
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
