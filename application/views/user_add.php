<div class="main-content">

  <div class="content-wrapper"><!--Statistics cards Starts-->

      <div class="row">

        <div class="col-sm-12">

          <div class="card">

            <div class="card-header">

              <h4 class="card-title"><?=@(empty($record))?" Add New ": "Update "?> User</h4>

            </div>

            <div class="card-body">

              <div class="card-block">

                <form class="ajaxForm" role="form" action="<?php echo site_url("system_users/add");?>" method="POST">

                    <input type="hidden" name="is_editing" value="<?=@$record['is_editing'];?>">

                <div class="col-md-12">

                    <div class="col-md-6">

                    <div class="form-group">

                        <label for="username">Username</label>

                        <input type="text" class="form-control validate[required]" id="username" name="username" placeholder="Enter Username" value="<?php echo @$record['username'];?>" required>

                    </div>

                    <div class="form-group">

                        <label for="username">Password</label>

                        <input type="text" class="form-control validate[required]" id="password" name="password" placeholder="Enter Password" value="<?=$this->encryption->decrypt(@$record['password'])?>" required>

                    </div>

                    <div class="form-group">

                        <label for="email">Email</label>

                        <input type="text" class="form-control validate[required]" id="email" name="email" placeholder="Enter Email" value="<?=@$record['email']?>" required>

                    </div>

                    <div class="form-group">

                        <label for="user_type">

                          User Type </label>
                          <?php if(@$record['id']) { ?>
                          <select class="form-control" name="role" id="role" readonly required>
                            <option value="<?=@$record['role']?>"><?=@$record['role']?></option>
                            <!-- <option> -- select -- </option> -->
                            <!-- <option value="admin" <?=(@$record['role'] == 'admin')?'selected':''?>>Admin</option>
                            <option value="customer" <?=(@$record['role'] == 'customer')?'selected':''?>>Customer</option> -->
                          </select>
                        <?php } else { ?>
                          <select class="form-control" name="role" id="role" required>
                            <option> -- select -- </option>
                            <option value="admin" <?=(@$record['role'] == 'admin')?'selected':''?>>Admin</option>
                            <option value="customer" <?=(@$record['role'] == 'customer')?'selected':''?>>Customer</option>
                          </select>
                        <?php } ?>

                    </div>

                    <div class="form-group">
                        <label for="username">Phone</label>
                        <input type="text" class="form-control validate[required]" id="phone" name="phone" placeholder="Phone number" placeholder="Phone" value="<?php echo @$record['phone'];?>">
                    </div>
                    <div class="form-group">

                        <label for="username">Customer Name</label>

                        <input type="text" class="form-control validate[required]" id="customer" name="customer_name" placeholder="Enter customer name" value="<?php echo @$record['customer_name'];?>" required>

                    </div>
                    <div class="form-group">
                      <label for="username">known store name</label>
                      <input type="text" class="form-control validate[required]" id="store" name="store_name" placeholder="Enter store name" value="<?php echo @$record['store_name'];?>" required>
                    </div>
                    <div class="form-group amazon_div">
                      <label for="username">Amazon account</label>
                      <input type="text" class="form-control validate[required]" id="amazon_acc" name="amazon_acc_name" placeholder="Enter amazon account" value="<?php echo @$record['amazon_acc_name'];?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Address</label>
                       <textarea id="projectinput9" rows="5" class="form-control addr" id="address" name="address" required placeholder="address"><?=@$record['address']?></textarea>
                    </div>
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo @$record['id'];?>">

                </div>

                </div>

                <div class="col-md-12">

                  <div class="col-md-6">

                    <div class="form-group">

                      <?php

                        if(@$record['id']) {

                          echo '<button type="button" onclick="submit_user()" class="btn btn-primary" name="submit">Update user</button>';

                        } else {

                          echo '<button type="button" onclick="submit_user()" class="btn btn-primary" name="submit">Add User</button>';

                        }

                      ?>

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

<script>
function submit_user() {
  let obj = {};
  obj.user_id = $('#user_id').val();
  obj.address = $('.addr').val();
  obj.customer = $('#customer').val();
  obj.store = $('#store').val();
  obj.amazon_acc = $('#amazon_acc').val();
  obj.phone = $('#phone').val();
  obj.role = $('#role').find(":selected").val();
  obj.username = $('#username').val();
  obj.password = $('#password').val();
  obj.email = $('#email').val();

  // validate if all fields data is given
  if(obj.username == "" || obj.password == "" || obj.email == "" || obj.address == ""  || obj.customer == "" || obj.store == "" || obj.phone == "" || obj.role == "") {
    alert('Please Select all fields before submitting!');
    return;
  } else {
    // submit form
    $.ajax({
        url: "<?=base_url('system_users/add')?>",
        type: "POST",
        data: obj,
        success: function(res){
          // console.log(res);
          // alert();
          let json = JSON.parse(res);

          alert(json.msg);
          window.location = json.redirect;
        }
    })
  }

  console.log(obj);
}
// $('.amazon_div').hide();
var check_role = '<?=@$record['role']?>';
if (check_role == 'admin'){
   $('.amazon_div').show();
    $('input[name=amazon_acc_name]').prop('required',true);
  }else{
    $('.amazon_div').hide();
     $('input[name=amazon_acc_name]').prop('required',false);
}
$('select[name=role]').change(function() {
  if ($(this).val() == 'admin') {
    $('.amazon_div').show();
    $('input[name=amazon_acc_name]').prop('required',true);
  }else{
    $('.amazon_div').hide();
     $('input[name=amazon_acc_name]').prop('required',false);
  }
});
</script>
