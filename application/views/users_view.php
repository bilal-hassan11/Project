
<style>
  .modal-backdrop.show {
        z-index: 1!important;
}

.wrapper{
z-index:1!important;}
</style>
<div class="main-content">

  <div class="content-wrapper"><!--Statistics cards Starts-->

      <div class="row">

        <div class="col-sm-12">

          <div class="card">

            <div class="card-header">

              <h4 class="card-title">Users
                <a href="<?=site_url('system_users/add')?>"  id="sample_editable_1_new" class="btn btn-sm btn-success bold pull-right"> <i class="fa fa-user"></i> Add New User</a>
              </h4>

            </div>

            <div class="card-body">
              

              <div class="card-block">

                <table class="table table-bordered table-checkable table-responsive order-column" id="sample_1">

                  <thead>

                      <tr>
                          <th> S.No </th>

                          <th> Username </th>

                          <th> Email </th>
                          <th>Password</th>
                          <th> Phone </th>

                          <th> Customer Name </th>
                          <th> Store Name </th>
                          <th> Amazaon acc# </th>
                          <th> Address </th>
                          <th> Created on </th>

                          <th> Role </th>
                          <th>Status</th>
                          <th> Actions </th>

                      </tr>

                  </thead>

                  <tbody>

                    <?php foreach($users as $key => $value){ ?>

                      <tr class="odd gradeX">

                          <td> <?php echo @$key+1?> </td>

                          <td> <?php echo @$value['username'];?> </td>

                          <td>

                              <?php echo @$value['email'];?>

                          </td>
                          <td> <a href='javascript:void(0)' onclick='showViewModal("<?=$this->encryption->decrypt(@$value['password'])?>")'>View Password</a> </td>
                          <td>
                              <?php echo @$value['phone'];?>
                          </td>

                          <td>
                              <?php echo @$value['customer_name'];?>
                          </td>

                          <td>
                              <?php echo @$value['store_name'];?>
                          </td>

                          <td>
                              <?php echo @$value['amazon_acc_name'];?>
                          </td>
                          <td>
                              <?php echo @$value['address'];?>
                          </td>

                          <td>
                              <?php echo date('d-m-Y',strtotime(@$value['created_on']));?>
                          </td>

                          <td>
                              <?php echo @$value['role'];?>
                          </td>
                          <td><span class="badge <?php if($value['user_status'] == 'blocked'){ echo 'badge-danger'; }else{ echo 'badge-success'; } ?> "><?=$value['user_status']?></span></td>
                          <td style="text-align: center;">

                                <div class="btn-group">

                                  <?php if($value['username'] === "admin") { ?>

                                  <?php  } else { ?>
                                    <a href="<?=site_url('system_users/edit/'.@$value['id']);?>" title="Edit"><i class="icon-pencil"></i> Edit </a> &nbsp; 
                                    <a href="<?=site_url('system_users/delete/'.@$value['id']);?>" title='Delete'><i class="icon-trash"></i> Delete </a>&nbsp;
                                    <?php if ($value['user_status'] == 'active') { ?>
                                      <a href='javascript:void(0)' onclick='bloclUser("<?=$value["user_status"]?>","<?=$value['id']?>")' title="Block"><i class="icon-ban"></i> Block</a>
                                    <?php }else{ ?>
                                      <a href='javascript:void(0)' onclick='bloclUser("<?=$value["user_status"]?>","<?=$value['id']?>")' title="Unblock"><i class="icon-user-following"></i> Unblock</a>
                                    <?php } ?>
                                    
                                    <!-- <button class="btn btn-xs" type="button" data-toggle="dropdown" aria-expanded="false"> Actions

                                        <i class="fa fa-angle-down"></i>

                                    </button>

                                    <ul class="dropdown-menu" role="menu">

                                        <li>

                                        </li>

                                        <li>

                                        </li>

                                    </ul> -->

                                  <?php } ?>
                                </div>

                          </td>

                      </tr>

                      <?php } ?>

                </tbody>

              </table>

              </div>

            </div>

          </div>

        </div>

      </div>

  </div>

</div>


 <script >
  function showViewModal(id){ 
   $('#viewModaluser').modal('show');
   $('.view_details_').html('User Password is '+id); 
  };

  function bloclUser(status,user_id) {
    $.ajax({
        url: "<?=base_url('system_users/block')?>",
        type: "POST",
        data: {status:status,user_id:user_id},
        success: function(res){
          let json = JSON.parse(res);

          alert(json.msg);
          window.location = json.redirect;
        }
    })
  }

</script> 

