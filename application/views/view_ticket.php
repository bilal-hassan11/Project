<style>
    .d-msg {
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 10px;
      background: rgba(0,0,0,0.05);
    }
    .d-msg p {
      margin: 10px 2px;
    }
    .d-msg p strong {
      font-size: 16px;
    }
    .d-msg .badge-pill {
      font-size: 10px;
      float: right;
    }
    .d-msg .date {
      float: right;
      font-size: 11px;
      color: #aaa;
      margin-right: 10px;
    }
</style>
<div class="main-content">
    <div class="content-wrapper"><!--Statistics cards Starts-->
      <div class="row">
        <div class="col-sm-12">
          <section id="fabs-examples">

            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-body">
                    <div class="card-block">
                      <br>
                      <div class="row">
                        <div class="col-md-12">
                          <h3><?=$ticket['title']?></h3>
                          <p><?=$ticket['issue']?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-block">
                      <br>
                      <div class="row">
                        <div class="col-md-6">
                            <label>Ticket Number: </label>
                        </div>
                        <div class="col-md-6">
                          <a href="javascript:void(0)"><?=$ticket['ticket_number']?></a>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <label>Customer Name: </label>
                        </div>
                        <div class="col-md-6">
                          <?=$ticket['customer_name']?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <label>Date Created: </label>
                        </div>
                        <div class="col-md-6">
                          <?=date('d-M-Y  H:i a', strtotime($ticket['datetime']))?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <label>Status: </label>
                        </div>
                        <div class="col-md-6">
                          <?php if($ticket['status'] == 'new') { ?>
                            <span class="badge badge-warning"><?=$ticket['status']?></span>
                          <?php } elseif($ticket['status'] == 'active') { ?>
                            <span class="badge badge-info"><?=$ticket['status']?></span>
                          <?php } else { ?>
                            <span class="badge badge-success"><?=$ticket['status']?></span>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>

            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-body">
                    <div class="card-block">
                      <br>
                      <?php foreach($ticket_msgs as $t_msg) { ?>
                        <!-- msg -->
                        <div class="d-msg">
                          <p><strong><?=ucfirst($t_msg['username'])?></strong>
                            <?php if($t_msg['is_customer'] == 0){ ?>
                              <span class="badge badge-pill badge-warning">Admin</span>
                            <?php } ?>
                             <span class="date"><?=date('d-M-Y H:i a', strtotime($t_msg['datetime']))?></span> </p>
                          <h6><?=$t_msg['msg']?></h6>
                        </div>
                        <!-- msg ends -->
                      <?php } ?>
                         
                      <hr>

                      <?php if($ticket['status'] !== 'resolved') { ?>
                        <div class="msg_box">
                          <form action="<?=site_url('admin/send_ticket_reply/'.$ticket['id'])?>" method="post">
                            <!-- <input type="" -->
                          <div class="row">
                              <div class="col-md-10">
                                <textarea name="msg" rows="2"  class="form-control col-md-12"></textarea>
                              </div>
                              <div class="col-md-2">
                                <input type="submit" class="btn btn-success" name="submit" value="Send">
                              </div>
                          </div>
                        </form>
                        </div>
                      <?php } else { ?>
                        <div class="text text-success">
                          This Ticket is Resolved you can't send any reply to it
                        </div>
                      <?php }  ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php if($ticket['status'] !== 'resolved') { ?>
                <div class="col-md-4">
                  <a href="<?=site_url('admin/mark_ticket_resolved/'.$ticket['id'])?>" onclick="return confirm('Is this issue Resolved?');" class="btn btn-primary btn-block">Mark as Resolved</a>
                </div>
              <?php } ?>
            </div>


          </section>
        </div>
      </div>
    </div>
  </div>
</div>
