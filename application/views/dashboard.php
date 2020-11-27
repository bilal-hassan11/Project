<style type="text/css">

    #chart{
        height: 125px;
    }
     #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
</style>
<div class="main-content">
          <div class="content-wrapper"><!--Statistics cards Starts-->
            <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <!-- <div class="card-header">
              <h4 class="card-title">Import Incoming Inventory</h4>
            </div> -->

            <div class="card-body">
              <div class="card-block">
              <form id="submit_form" method="post" > <br>
                <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                          <!-- <label>Import excel File</label> -->
                          <select id="type" class="form-control">
                              <option value="weekly">Weekly</option>
                              <option value="monthly">Monthly</option>
                              <option value="yearly">Yearly</option>
                              <option value="lifetime">Life Time</option>
                          </select>
                        </div>
                  </div>
                  <div class="col-md-6" id="yearly" style="display:none;">
                        <div class="form-group">
                          <!-- <label>Import excel File</label> -->
                          <select id="year" class="form-control">
                              <option value="">select year</option>
                              <option value="2015">2015</option>
                              <option value="2016">2016</option>
                              <option value="2017">2017</option>
                              <option value="2018">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                          </select>
                        </div>
                  </div>
                  <div class="col-md-6" id="monthly" style="display:none;">
                        <div class="form-group">
                          <!-- <label>Import excel File</label> -->
                          <select id="month" class="form-control">
                              <option value="">select month</option>
                              <option value="01">January</option>
                              <option value="02">February </option>
                              <option value="03">March </option>
                              <option value="04">April </option>
                              <option value="05">May </option>
                              <option value="06">June </option>
                              <option value="07">July  </option>
                              <option value="08">August  </option>
                              <option value="09">September </option>
                              <option value="10">October </option>
                              <option value="11">November </option>
                              <option value="12">December  </option>
                          </select>
                        </div>
                  </div>
                  <div class="col-md-6">
                        <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-success" >Filter</button>
                        </div>
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-blackberry">
            <div class="card-body" id="chart">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h3 class="font-large-1 mb-0"  id="shipped_qty"><?=($shipped->qty == '') ? 0 : $shipped->qty?></h3>
                            <span >Total Items Shipped</span>
                        </div>
                        <div class="media-right white text-right">
                            <i class="icon-plane font-large-1" ></i>
                        </div>
                    </div>
                </div>
                <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-ibiza-sunset">
            <div class="card-body" id="chart">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h3 class="font-large-1 mb-0"  id="inventory"><?=($inventory->qty == '') ? 0 : $inventory->qty?></h3>
                            <span >Total Items Inventory</span>
                        </div>
                        <div class="media-right white text-right">
                            <i class="ft-box font-large-1" ></i>
                        </div>
                    </div>
                </div>
                <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-green-tea">
            <div class="card-body" id="chart">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h3 class="font-large-1 mb-0"  id="incoming"><?=($incoming->qty == '') ? 0 : $incoming->qty?></h3>
                            <span >Total Items Incoming</span>
                        </div>
                        <div class="media-right white text-right">
                            <i class="ft-arrow-down-left font-large-1" ></i>
                        </div>
                    </div>
                </div>
                <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-pomegranate">
            <div class="card-body" id="chart">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h3 class="font-large-1 mb-0"  id="active_customer"><?=($active_customer->qty == '') ? 0 : $active_customer->qty?></h3>
                            <span >Total Active Customer</span>
                        </div>
                        <div class="media-right white text-right">
                            <i class="icon-user-following font-large-1" ></i>
                        </div>
                    </div>
                </div>
                <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-green-tea">
            <div class="card-body" id="chart">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h3 class="font-large-1 mb-0"  id="inactive_customer"><?=($inactive_customer->qty == '') ? 0 : $inactive_customer->qty?></h3>
                            <span >Total Inactive Customer</span>
                        </div>
                        <div class="media-right white text-right">
                            <i class="icon-user-unfollow font-large-1" ></i>
                        </div>
                    </div>
                </div>
                <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-pomegranate">
            <div class="card-body" id="chart">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h3 class="font-large-1 mb-0"  id="inactive_customer"><?=($open_orders->qty == '') ? 0 : $open_orders->qty?></h3>
                            <span >Total Open Orders</span>
                        </div>
                        <div class="media-right white text-right">
                            <i class="icon-shuffle font-large-1" ></i>
                        </div>
                    </div>
                </div>
                <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-pomegranate">
            <div class="card-body" id="chart">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h3 class="font-large-1 mb-0"  id="inactive_customer"><?=($pastdue_orders->qty == '') ? 0 : @$pastdue_orders->qty?></h3>
                            <span >Total Past Due Orders </span>
                        </div>
                        <div class="media-right white text-right">
                            <i class="icon-size-actual font-large-1" ></i>
                        </div>
                    </div>
                </div>
                <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card gradient-green-tea">
            <div class="card-body" id="chart">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h3 class="font-large-1 mb-0"  id="sizes1"><?=($sizes1 == '') ? 0 : $sizes1?> sqft</h3>
                            <span >Total Storage</span>
                        </div>
                        <div class="media-right white text-right">
                            <i class="icon-drawer font-large-1" ></i>
                        </div>
                    </div>
                </div>
                <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                </div>
            </div>
        </div>
      </div>

      <!-- new_box -->
      <div class="col-xl-3 col-lg-6 col-md-6 col-12">
          <div class="card gradient-blackberry">
              <div class="card-body" id="chart">
                  <div class="card-block pt-2 pb-0">
                      <div class="media">
                          <div class="media-body white text-left">
                              <h3 class="font-large-1 mb-0"  id="sizes1"><?=($storage_under_15 == '') ? 0 : $storage_under_15?> sqft</h3>
                              <span >Storage Under 15 Days</span>
                          </div>
                          <div class="media-right white text-right">
                              <i class="icon-drawer font-large-1" ></i>
                          </div>
                      </div>
                  </div>
                  <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                  </div>
              </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
            <div class="card gradient-green-tea">
                <div class="card-body" id="chart">
                    <div class="card-block pt-2 pb-0">
                        <div class="media">
                            <div class="media-body white text-left">
                                <h3 class="font-large-1 mb-0"  id="sizes1"><?=($bill_over_15 == '') ? 0 : $bill_over_15?> sqft</h3>
                                <span >Billed Storage</span>
                            </div>
                            <div class="media-right white text-right">
                                <i class="icon-pie-chart  font-large-1" ></i>
                            </div>
                        </div>
                    </div>
                    <div id="Widget-line-chart" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                    </div>
                </div>
            </div>
          </div>
</div>
<!--Statistics cards Ends-->

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Recently Added Customers</h4>
      </div>
      <div class="card-body">

        <div class="card-block mcontainer">
          <table class="table table-striped table-bordered table-hover table-checkable order-column display" id="orders" style="width:100%">
            <thead>
                <tr>
                  <th>S.No</th>
                  <th>Username</th>
                  <th> Email </th>
                  <th> Store Name </th>
                  <th> Status </th>
                  <th> Date </th>
                </tr>
            </thead>
            <tbody>
            <?php $i=0; foreach ($users as $user) { ?>
                <tr>
                  <td><?=++$i?></td>
                  <td><?php echo $user['username']?></td>
                  <td><?php echo $user['email']; ?></td>
                  <td><?php echo $user['store_name']; ?></td>
                  <td><span class="badge badge-<?=($user['user_status'] == 'active')?'success':'dark'?>"><?php echo $user['user_status']; ?></span></td>
                  <td><?php echo date('d M Y', strtotime($user['created_on'])); ?></td>
                </tr>
              <?php } ?>
              </tbody>
          </table>
          <div class="clearfix">
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
      <div>
        <?php $googlemap->getLatLong(); ?>
      </div>
          </div>
        </div>
    </div>

<script type="text/javascript">
$('#type').change(function() {
    var type = $('#type').val();
    if (type == 'monthly') {
        $('#yearly').hide();
        $('#monthly').show();
    }
    if (type == 'yearly') {
        $('#monthly').hide();
        $('#yearly').show();
    }if(type == 'weekly' || type == 'lifetime'){
        $('#monthly').hide();
        $('#yearly').hide();
    }
});

$('#submit_form').submit(function(e) {
    e.preventDefault();
    var type = $('#type').val();
    var month = $('#month').val();
    var year = $('#year').val();
    $.ajax({
        url: "<?=base_url('Admin/get_graphs')?>",
        type: "POST",
        data:{type:type,month:month,year:year},
        dataType: 'JSON',
        success: function(res){
            $('#shipped_qty').html(res.shipped_qty);
            $('#inventory').html(res.inventory);
            $('#incoming').html(res.incoming);
            $('#active_customer').html(res.active_customer);
            $('#inactive_customer').html(res.inactive_customer);
        }
    });
})
$(document).ready(function(){
  $('#orders').DataTable({});
});
</script>
